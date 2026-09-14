@php
    $logoRelative = config('mail.brand_logo', 'images/logo.jpeg');
    $logoPath = public_path($logoRelative);
@endphp
@if (is_string($logoPath) && $logoPath !== '' && file_exists($logoPath))
    <img
        src="{{ $message->embed($logoPath) }}"
        alt="{{ config('app.name') }}"
        width="88"
        height="88"
        style="display:block;margin:0 auto;border-radius:14px;border:2px solid rgba(255,255,255,0.35);"
    >
@else
    <span style="display:inline-block;font-family:system-ui,-apple-system,sans-serif;font-size:1.35rem;font-weight:800;color:#ffffff;letter-spacing:-0.02em;">
        {{ config('app.name') }}
    </span>
@endif
