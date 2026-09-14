<?php

namespace App\Services;

use App\Models\SecurityLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityAudit
{
    public static function record(
        string $eventType,
        string $message,
        array $context = [],
        ?Request $request = null,
        ?int $userId = null,
        string $level = 'info',
        ?int $responseStatus = null,
    ): void {
        try {
            $request ??= request();

            SecurityLog::query()->create([
                'event_type' => $eventType,
                'level' => $level,
                'message' => mb_substr($message, 0, 500),
                'context' => $context ?: null,
                'ip_address' => $request->ip(),
                'user_agent' => self::truncateUa((string) $request->userAgent()),
                'method' => $request->method(),
                'path' => '/'.$request->path(),
                'response_status' => $responseStatus,
                'user_id' => $userId ?? ($request->user()?->id),
            ]);
        } catch (\Throwable) {
            // Never break primary request flow
        }
    }

    public static function recordHttpAccess(Request $request, Response $response): void
    {
        if (! config('security.audit_http_enabled', true)) {
            return;
        }

        $path = $request->path();
        foreach ((array) config('security.audit_path_prefixes', []) as $prefix) {
            $prefix = trim((string) $prefix, '/');
            if ($prefix === '') {
                continue;
            }
            if ($path === $prefix || str_starts_with($path, $prefix.'/')) {
                self::record(
                    SecurityLog::EVENT_HTTP_ACCESS,
                    'HTTP '.$request->method().' /'.$path,
                    ['route' => $request->route()?->getName()],
                    $request,
                    $request->user()?->id,
                    $response->getStatusCode() >= 500 ? 'error' : 'info',
                    $response->getStatusCode(),
                );

                return;
            }
        }
    }

    public static function truncateUa(string $ua): ?string
    {
        if ($ua === '') {
            return null;
        }

        return mb_substr($ua, 0, 500);
    }
}
