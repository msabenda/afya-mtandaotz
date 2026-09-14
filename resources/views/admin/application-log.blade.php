@extends('admin.layout')

@section('title', 'Application log')

@section('subtitle', 'Tail of the Laravel log file for quick triage. Rotate logs in production to avoid huge files.')

@section('content')
    <div class="dash-card">
        <p class="dash-hint" style="margin:0 0 14px;">
            Path: <code class="dash-code-inline">{{ $logPath }}</code>
        </p>
        @if (count($lines) === 0)
            <p class="dash-hint" style="margin:0;">Log file is missing or empty.</p>
        @else
            <pre class="dash-pre-log">@foreach ($lines as $line){{ $line }}

@endforeach</pre>
        @endif
    </div>
@endsection
