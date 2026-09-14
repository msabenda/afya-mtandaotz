<?php

use App\Http\Middleware\AuditHttpRequest;
use App\Http\Middleware\EnsurePendingPublisherLogin;
use App\Http\Middleware\EnsurePublisher;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\RejectBlockedIp;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            return '/';
        });

        $middleware->redirectUsersTo(function () {
            $user = auth()->user();
            if ($user && $user->isAdmin()) {
                return route('admin.dashboard');
            }
            if ($user && $user->isPublisher()) {
                return route('publisher.dashboard');
            }

            return '/';
        });

        $middleware->web(prepend: [
            RejectBlockedIp::class,
        ]);

        $middleware->web(append: [
            SecurityHeaders::class,
            AuditHttpRequest::class,
        ]);

        $middleware->alias([
            'publisher' => EnsurePublisher::class,
            'pending.publisher' => EnsurePendingPublisherLogin::class,
            'admin' => EnsureUserIsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $e, Request $request) {
            if ($request->expectsJson()) {
                return null;
            }

            if (! $request->is('publisher*') && ! $request->is('admin*')) {
                return null;
            }

            if ($e instanceof AuthorizationException
                || $e instanceof AccessDeniedHttpException
                || ($e instanceof HttpException && $e->getStatusCode() === 403)) {
                return redirect('/');
            }

            return null;
        });
    })->create();
