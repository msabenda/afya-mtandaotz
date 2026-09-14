<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePendingPublisherLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('publisher_login_id')) {
            return redirect()->route('publisher.login')
                ->withErrors(['email' => 'Please sign in again.']);
        }

        return $next($request);
    }
}
