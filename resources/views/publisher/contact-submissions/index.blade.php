@extends('publisher.layout')

@section('title', 'Contact Submissions')

@section('content')
    <div class="card">
        <h2 style="margin-top:0;">Contact Form Messages</h2>
        <p style="margin:0;color:#64748b;">These are messages submitted by public users from the website contact section.</p>
    </div>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Received At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($submissions as $submission)
                    <tr>
                        <td>{{ $submission->name }}</td>
                        <td><a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a></td>
                        <td style="max-width:420px;">{{ $submission->message }}</td>
                        <td>{{ $submission->created_at?->format('M j, Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No contact messages yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:10px;">{{ $submissions->links() }}</div>
    </div>
@endsection

