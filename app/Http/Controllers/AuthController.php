<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Publisher\TwoFactorController;
use App\Models\SecurityLog;
use App\Services\SecurityAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $remember)) {
            SecurityAudit::record(
                SecurityLog::EVENT_AUTH_LOGIN_FAILED,
                'Failed publisher-area sign-in for '.$credentials['email'],
                ['email' => $credentials['email'], 'area' => 'publisher'],
                $request,
                null,
                'warning',
                null,
            );

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $user = Auth::user();
        $request->session()->regenerate();

        if ($user->isPublisher()) {
            Auth::logout();

            TwoFactorController::forgetFailedAttemptsForUserId($user->id);

            $request->session()->put('publisher_login_id', $user->id);
            $request->session()->put('publisher_login_remember', $remember);

            SecurityAudit::record(
                SecurityLog::EVENT_AUTH_LOGIN_SUCCESS,
                'Publisher password verified; email code required: '.$user->email,
                ['email' => $user->email, 'user_id' => $user->id],
                $request,
                $user->id,
                'info',
                null,
            );

            if (! $user->fresh()->two_factor_confirmed_at) {
                return redirect()->route('publisher.login.2fa.setup');
            }

            return redirect()->route('publisher.login.2fa.challenge');
        }

        Auth::logout();

        SecurityAudit::record(
            SecurityLog::EVENT_AUTH_LOGIN_FAILED,
            'Non-publisher account attempted publisher sign-in: '.$credentials['email'],
            ['email' => $credentials['email']],
            $request,
            null,
            'warning',
            null,
        );

        return redirect()->intended('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('publisher.login')
            ->with('publisher_logout_success', true);
    }
}
