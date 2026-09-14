@extends('auth.layout-publisher-guest')

@section('title', 'Email verification')

@section('heading', 'Verify your email')

@section('subheading', 'Finish securing your account')

@section('back_secondary')
    <a class="text-link" href="{{ route('publisher.login') }}">Back to sign in</a>
@endsection

@section('content')
    <p class="flow-copy">
        We sent a <strong>6-digit code</strong> to <strong>{{ $maskedEmail }}</strong>. Enter it below. The code expires in 10 minutes — check spam if needed.
    </p>

    @if (session('status'))
        <div class="notice notice--info" role="status">{{ session('status') }}</div>
    @endif

    <form method="post" action="{{ route('publisher.login.2fa.setup.confirm') }}">
        @csrf
        @if ($errors->any())
            <div class="notice notice--error" role="alert">{{ $errors->first() }}</div>
        @endif

        <div class="otp-panel">
            <p class="otp-label">Verification code</p>
            <div class="field field-code" style="margin-bottom:0;">
                <label class="sr-only" for="code">6-digit code</label>
                <input id="code" name="code" inputmode="numeric" pattern="[0-9]*" maxlength="6" autocomplete="one-time-code" required placeholder="000000" autofocus>
            </div>
        </div>

        <button class="submit" type="submit">Confirm and continue</button>
    </form>

    <form method="post" action="{{ route('publisher.login.2fa.resend') }}">
        @csrf
        <button class="btn-secondary" type="submit">Send a new code</button>
    </form>
@endsection

@push('styles')
    <style>
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
@endpush
