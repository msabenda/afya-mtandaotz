<?php

return [

    /*
    |--------------------------------------------------------------------------
    | HTTP audit logging
    |--------------------------------------------------------------------------
    | When true, successful responses to matching paths are written to security_logs.
    */
    'audit_http_enabled' => env('SECURITY_AUDIT_HTTP', true),

    /*
    |--------------------------------------------------------------------------
    | Paths (prefix match) to record for SOC / access review
    |--------------------------------------------------------------------------
    */
    'audit_path_prefixes' => [
        'admin',
        'publisher',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application log viewer (tail bytes)
    |--------------------------------------------------------------------------
    */
    'app_log_tail_bytes' => (int) env('SECURITY_APP_LOG_TAIL_BYTES', 180_000),

    'app_log_tail_lines' => (int) env('SECURITY_APP_LOG_TAIL_LINES', 350),

];
