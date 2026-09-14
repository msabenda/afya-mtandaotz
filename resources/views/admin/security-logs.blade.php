@extends('admin.layout')

@section('title', 'Security logs')

@section('subtitle', 'HTTP access to privileged areas, authentication outcomes, and defensive events.')

@section('content')
    <div class="dash-card">
        <form method="get" action="{{ route('admin.security-logs.index') }}" style="display:grid;gap:10px;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));align-items:end;">
            <div class="dash-field" style="margin:0;">
                <label for="event_type">Event type</label>
                <select id="event_type" name="event_type">
                    <option value="">Any</option>
                    @foreach ($eventTypes as $et)
                        <option value="{{ $et }}" @selected(request('event_type') === $et)>{{ $et }}</option>
                    @endforeach
                </select>
            </div>
            <div class="dash-field" style="margin:0;">
                <label for="ip">IP contains</label>
                <input id="ip" name="ip" value="{{ request('ip') }}" placeholder="203.0.113">
            </div>
            <div class="dash-field" style="margin:0;">
                <label for="path">Path contains</label>
                <input id="path" name="path" value="{{ request('path') }}" placeholder="/admin">
            </div>
            <div class="dash-field" style="margin:0;">
                <label for="user_id">User ID</label>
                <input id="user_id" name="user_id" value="{{ request('user_id') }}" placeholder="1">
            </div>
            <div>
                <button class="dash-btn" type="submit">Filter</button>
                <a class="dash-btn dash-btn-outline" href="{{ route('admin.security-logs.index') }}" style="margin-left:8px;">Reset</a>
            </div>
        </form>
    </div>

    <div class="dash-card">
        <table class="dash-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Level</th>
                    <th>Event</th>
                    <th>Message</th>
                    <th>IP</th>
                    <th>User</th>
                    <th>Path</th>
                    <th>HTTP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $log->level }}</td>
                        <td><code>{{ $log->event_type }}</code></td>
                        <td>{{ \Illuminate\Support\Str::limit($log->message, 64) }}</td>
                        <td>{{ $log->ip_address ?? '—' }}</td>
                        <td>{{ $log->user?->email ?? '—' }}</td>
                        <td><code style="font-size:0.75rem;">{{ \Illuminate\Support\Str::limit($log->path ?? '—', 36) }}</code></td>
                        <td>{{ $log->response_status ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top:12px;">{{ $logs->links() }}</div>
    </div>
@endsection
