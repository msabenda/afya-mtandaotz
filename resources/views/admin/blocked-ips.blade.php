@extends('admin.layout')

@section('title', 'Blocked IPs')

@section('subtitle', 'Requests from these addresses receive an empty 403 before application routes run.')

@section('content')
    <div class="dash-card">
        <h2 style="margin:0 0 12px;font-size:1rem;">Add block</h2>
        <form method="post" action="{{ route('admin.blocked-ips.store') }}" style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
            @csrf
            <div class="dash-field" style="margin:0;">
                <label for="ip_address">IPv4 / IPv6</label>
                <input id="ip_address" name="ip_address" required placeholder="203.0.113.42">
            </div>
            <div class="dash-field" style="margin:0;flex:1;min-width:200px;">
                <label for="reason">Reason (optional)</label>
                <input id="reason" name="reason" placeholder="Brute force / abuse">
            </div>
            <button class="dash-btn" type="submit">Block</button>
        </form>
        @error('ip_address')
            <p class="dash-error" style="margin-top:8px;">{{ $message }}</p>
        @enderror
    </div>

    <div class="dash-card">
        <table class="dash-table">
            <thead>
                <tr><th>IP</th><th>Reason</th><th>Added by</th><th>Created</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($blocked as $row)
                    <tr>
                        <td><code>{{ $row->ip_address }}</code></td>
                        <td>{{ $row->reason ?? '—' }}</td>
                        <td>{{ $row->creator?->email ?? '—' }}</td>
                        <td>{{ $row->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form method="post" action="{{ route('admin.blocked-ips.destroy', $row) }}" onsubmit="return confirm('Remove this block?');">
                                @csrf
                                @method('delete')
                                <button class="dash-btn dash-btn-danger" type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No blocked IPs.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:12px;">{{ $blocked->links() }}</div>
    </div>
@endsection
