@extends('auth.layout-publisher-guest')

@section('title', 'Administration')

@section('heading', 'Administration')

@section('subheading', 'Security and operations console. Authorised accounts only.')

@section('content')
    @if (session('admin_logout_success'))
        <div class="notice notice--success" role="status">You have been signed out.</div>
    @endif

    @if ($errors->any())
        <div class="notice notice--error" role="alert">{{ $errors->first() }}</div>
    @endif

    <form method="post" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" autocomplete="username" required value="{{ old('email') }}" placeholder="admin@example.com">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="••••••••">
        </div>
        <label class="remember">
            <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
            Stay signed in on this device
        </label>
        <button class="submit" type="submit">Continue</button>
    </form>
@endsection
