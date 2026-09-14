<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecurityLog extends Model
{
    public const EVENT_HTTP_ACCESS = 'http_access';

    public const EVENT_AUTH_LOGIN_FAILED = 'auth_login_failed';

    public const EVENT_AUTH_LOGIN_SUCCESS = 'auth_login_success';

    public const EVENT_AUTH_ADMIN_SUCCESS = 'auth_admin_success';

    public const EVENT_AUTH_ADMIN_FAILED = 'auth_admin_failed';

    public const EVENT_TWO_FACTOR_FAILED = 'two_factor_failed';

    public const EVENT_TWO_FACTOR_SUCCESS = 'two_factor_success';

    public const EVENT_IP_BLOCKED = 'ip_blocked';

    protected $fillable = [
        'event_type',
        'level',
        'message',
        'context',
        'ip_address',
        'user_agent',
        'method',
        'path',
        'response_status',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'context' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
