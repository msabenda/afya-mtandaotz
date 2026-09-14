<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedIp;
use App\Models\SecurityLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $since24h = Carbon::now()->subDay();
        $since7d = Carbon::now()->subDays(7);

        $events24h = SecurityLog::query()->where('created_at', '>=', $since24h)->count();

        $failedAuth24h = SecurityLog::query()
            ->where('created_at', '>=', $since24h)
            ->whereIn('event_type', [
                SecurityLog::EVENT_AUTH_LOGIN_FAILED,
                SecurityLog::EVENT_AUTH_ADMIN_FAILED,
                SecurityLog::EVENT_TWO_FACTOR_FAILED,
            ])
            ->count();

        $uniqueIps24h = (int) DB::table('security_logs')
            ->where('created_at', '>=', $since24h)
            ->whereNotNull('ip_address')
            ->selectRaw('count(distinct ip_address) as c')
            ->value('c');

        $topIps = SecurityLog::query()
            ->select('ip_address', DB::raw('count(*) as c'))
            ->where('created_at', '>=', $since7d)
            ->whereNotNull('ip_address')
            ->groupBy('ip_address')
            ->orderByDesc('c')
            ->limit(8)
            ->get();

        $recentAlerts = SecurityLog::query()
            ->whereIn('level', ['warning', 'error'])
            ->orderByDesc('id')
            ->limit(12)
            ->get();

        $blockedCount = BlockedIp::query()->count();

        return view('admin.dashboard', [
            'events24h' => $events24h,
            'failedAuth24h' => $failedAuth24h,
            'uniqueIps24h' => $uniqueIps24h,
            'topIps' => $topIps,
            'recentAlerts' => $recentAlerts,
            'blockedCount' => $blockedCount,
        ]);
    }
}
