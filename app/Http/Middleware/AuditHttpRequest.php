<?php

namespace App\Http\Middleware;

use App\Services\SecurityAudit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditHttpRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response instanceof Response) {
            SecurityAudit::recordHttpAccess($request, $response);
        }

        return $response;
    }
}
