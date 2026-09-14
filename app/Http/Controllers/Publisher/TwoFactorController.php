<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Mail\PublisherLoginCodeMail;
use App\Models\SecurityLog;
use App\Models\User;
use App\Services\SecurityAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TwoFactorController extends Controller
{
    private const OTP_TTL_MINUTES = 10;

    private const SEND_COOLDOWN_SECONDS = 60;

    public function showSetup(Request $request): View|RedirectResponse
    {
        $user = $this->pendingUser($request);
        if (! $user) {
            return redirect()->route('publisher.login');
        }

        if ($user->two_factor_confirmed_at) {
            return redirect()->route('publisher.login.2fa.challenge');
        }

        $this->ensureCodeIssued($user);

        return view('auth.two-factor-setup', [
            'maskedEmail' => $this->maskEmail($user->email),
        ]);
    }

    public function confirmSetup(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $this->pendingUser($request);
        if (! $user) {
            return redirect()->route('publisher.login');
        }

        if (! $this->verifyAndConsumeCode($user, (string) $request->input('code'))) {
            return $this->failedCodeResponse($request, $user);
        }

        $this->clearFailedAttempts($user);

        $user->forceFill(['two_factor_confirmed_at' => now()])->save();

        return $this->completeLogin($request, $user);
    }

    public function showChallenge(Request $request): View|RedirectResponse
    {
        $user = $this->pendingUser($request);
        if (! $user) {
            return redirect()->route('publisher.login');
        }

        if (! $user->two_factor_confirmed_at) {
            return redirect()->route('publisher.login.2fa.setup');
        }

        $this->ensureCodeIssued($user);

        return view('auth.two-factor-challenge', [
            'maskedEmail' => $this->maskEmail($user->email),
        ]);
    }

    public function verifyChallenge(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $this->pendingUser($request);
        if (! $user) {
            return redirect()->route('publisher.login');
        }

        if (! $this->verifyAndConsumeCode($user, (string) $request->input('code'))) {
            return $this->failedCodeResponse($request, $user);
        }

        $this->clearFailedAttempts($user);

        return $this->completeLogin($request, $user);
    }

    public function resend(Request $request): RedirectResponse
    {
        $user = $this->pendingUser($request);
        if (! $user) {
            return redirect()->route('publisher.login');
        }

        if (Cache::has($this->sendCooldownKey($user))) {
            return back()->with('status', 'Please wait a minute before requesting another code.');
        }

        Cache::forget($this->otpKey($user));
        $this->issueCode($user);

        return back()->with('status', 'A new code has been sent to your email.');
    }

    private function failedCodeResponse(Request $request, User $user): RedirectResponse
    {
        usleep(random_int(80_000, 220_000));

        $max = max(1, (int) config('publisher.two_factor.max_code_attempts', 5));
        $windowMinutes = max(1, (int) config('publisher.two_factor.attempt_window_minutes', 30));

        $key = $this->failedAttemptsKey($user);
        $fails = (int) Cache::get($key, 0) + 1;
        Cache::put($key, $fails, now()->addMinutes($windowMinutes));

        if ($fails >= $max) {
            Cache::forget($key);
            Cache::forget($this->otpKey($user));
            Cache::forget($this->sendCooldownKey($user));
            $request->session()->forget(['publisher_login_id', 'publisher_login_remember']);

            SecurityAudit::record(
                SecurityLog::EVENT_TWO_FACTOR_FAILED,
                'Publisher 2FA lockout after repeated failures for user '.$user->id,
                ['user_id' => $user->id, 'email' => $user->email, 'lockout' => true],
                $request,
                $user->id,
                'warning',
                null,
            );

            return redirect()->route('publisher.login')
                ->withErrors(['email' => 'Too many incorrect verification codes. For your security, please sign in again.']);
        }

        SecurityAudit::record(
            SecurityLog::EVENT_TWO_FACTOR_FAILED,
            'Invalid publisher email verification code (user '.$user->id.')',
            ['user_id' => $user->id],
            $request,
            $user->id,
            'info',
            null,
        );

        return back()->withErrors(['code' => 'Invalid or expired code. Request a new code if needed.']);
    }

    private function clearFailedAttempts(User $user): void
    {
        Cache::forget($this->failedAttemptsKey($user));
    }

    private function failedAttemptsKey(User $user): string
    {
        return 'publisher_2fa_fail:'.$user->id;
    }

    private function ensureCodeIssued(User $user): void
    {
        if (Cache::has($this->otpKey($user))) {
            return;
        }

        $this->issueCode($user);
    }

    private function issueCode(User $user): void
    {
        $code = sprintf('%06d', random_int(0, 999_999));

        Cache::put($this->otpKey($user), hash('sha256', $code), now()->addMinutes(self::OTP_TTL_MINUTES));
        Cache::put($this->sendCooldownKey($user), true, now()->addSeconds(self::SEND_COOLDOWN_SECONDS));

        Mail::to($user->email)->send(new PublisherLoginCodeMail($user, $code));
    }

    private function verifyAndConsumeCode(User $user, string $input): bool
    {
        $hash = Cache::get($this->otpKey($user));
        if (! $hash) {
            return false;
        }

        $ok = hash_equals($hash, hash('sha256', $input));
        if ($ok) {
            Cache::forget($this->otpKey($user));
            Cache::forget($this->sendCooldownKey($user));
        }

        return $ok;
    }

    private function otpKey(User $user): string
    {
        return 'publisher_2fa_otp:'.$user->id;
    }

    private function sendCooldownKey(User $user): string
    {
        return 'publisher_2fa_otp_cooldown:'.$user->id;
    }

    private function maskEmail(string $email): string
    {
        $parts = explode('@', $email, 2);
        if (count($parts) !== 2) {
            return $email;
        }

        [$local, $domain] = $parts;
        $len = strlen($local);
        $visible = $len <= 2
            ? str_repeat('*', $len)
            : substr($local, 0, 2).str_repeat('*', max(0, $len - 2));

        return $visible.'@'.$domain;
    }

    private function pendingUser(Request $request): ?User
    {
        $id = $request->session()->get('publisher_login_id');
        if (! $id) {
            return null;
        }

        return User::query()->find($id);
    }

    private function completeLogin(Request $request, User $user): RedirectResponse
    {
        $remember = (bool) $request->session()->get('publisher_login_remember', false);

        $request->session()->forget(['publisher_login_id', 'publisher_login_remember']);

        Auth::login($user, $remember);
        $request->session()->regenerate();

        SecurityAudit::record(
            SecurityLog::EVENT_TWO_FACTOR_SUCCESS,
            'Publisher sign-in completed: '.$user->email,
            ['user_id' => $user->id],
            $request,
            $user->id,
            'info',
            null,
        );

        return redirect()->intended(route('publisher.dashboard'))
            ->with('publisher_login_success', true);
    }

    public static function forgetFailedAttemptsForUserId(int $userId): void
    {
        Cache::forget('publisher_2fa_fail:'.$userId);
    }
}
