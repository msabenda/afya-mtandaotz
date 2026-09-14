@extends('admin.layout')

@section('title', 'SOC overview')

@section('subtitle', 'High-level signals for access, authentication failures, and IP diversity in the last rolling window.')

@section('content')
    <div class="dash-grid dash-grid--stats" style="margin-bottom: 4px;">
        <div class="dash-stat">
            <strong>{{ number_format($events24h) }}</strong>
            <span>Security events (24h)</span>
        </div>
        <div class="dash-stat">
            <strong>{{ number_format($failedAuth24h) }}</strong>
            <span>Failed sign-in / 2FA (24h)</span>
        </div>
        <div class="dash-stat">
            <strong>{{ number_format($uniqueIps24h) }}</strong>
            <span>Distinct IPs seen (24h)</span>
        </div>
        <div class="dash-stat">
            <strong>{{ number_format($blockedCount) }}</strong>
            <span>Manually blocked IPs</span>
        </div>
    </div>

    <div class="dash-card">
        <h2 style="margin:0 0 12px;font-size:1rem;">Top source IPs (7 days)</h2>
        <table class="dash-table">
            <thead>
                <tr><th>IP address</th><th>Events</th></tr>
            </thead>
            <tbody>
                @forelse ($topIps as $row)
                    <tr>
                        <td><code>{{ $row->ip_address }}</code></td>
                        <td>{{ number_format($row->c) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2">No data yet. Browse the site and admin areas to populate audit logs.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="dash-card">
        <h2 style="margin:0 0 12px;font-size:1rem;">Recent warnings</h2>
        <table class="dash-table">
            <thead>
                <tr><th>Time</th><th>Event</th><th>Message</th><th>IP</th></tr>
            </thead>
            <tbody>
                @forelse ($recentAlerts as $log)
                    <tr>
                        <td>{{ $log->created_at->format('M j H:i') }}</td>
                        <td><code>{{ $log->event_type }}</code></td>
                        <td>{{ \Illuminate\Support\Str::limit($log->message, 80) }}</td>
                        <td>{{ $log->ip_address ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No warning-level events recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
        <p class="dash-hint">
            Use <strong>Security logs</strong> for full filtering, <strong>Blocked IPs</strong> for deny-list management, and <strong>Application log</strong> for Laravel file output.
        </p>
    </div>
@endsection
