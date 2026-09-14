<?php

namespace App\Http\Middleware;

use App\Models\BlockedIp;
use App\Models\SecurityLog;
use App\Services\SecurityAudit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RejectBlockedIp
{
    public function handle(Request $request, Closure $next): Response
    {
        $ip = (string) $request->ip();

        try {
            $blocked = $ip !== '' && BlockedIp::query()->where('ip_address', $ip)->exists();
        } catch (\Throwable) {
            return $next($request);
        }

        if ($blocked) {
            SecurityAudit::record(
                SecurityLog::EVENT_IP_BLOCKED,
                'Blocked IP attempted access',
                ['path' => '/'.$request->path()],
                $request,
                null,
                'warning',
                403,
            );

            return response('', 403);
        }

        return $next($request);
    }
}
