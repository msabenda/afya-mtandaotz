<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SecurityLog;
use App\Services\SecurityAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {
            SecurityAudit::record(
                SecurityLog::EVENT_AUTH_ADMIN_FAILED,
                'Failed admin sign-in attempt for '.$credentials['email'],
                ['email' => $credentials['email']],
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
        if (! $user->isAdmin()) {
            Auth::logout();
            SecurityAudit::record(
                SecurityLog::EVENT_AUTH_ADMIN_FAILED,
                'Non-admin account used on admin sign-in: '.$credentials['email'],
                ['email' => $credentials['email']],
                $request,
                null,
                'warning',
                null,
            );

            return back()->withErrors([
                'email' => 'This account is not authorised for administration.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        SecurityAudit::record(
            SecurityLog::EVENT_AUTH_ADMIN_SUCCESS,
            'Admin signed in: '.$user->email,
            ['user_id' => $user->id],
            $request,
            $user->id,
            'info',
            null,
        );

        return redirect()->intended(route('admin.dashboard'))
            ->with('admin_login_success', true);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('admin_logout_success', true);
    }
}
