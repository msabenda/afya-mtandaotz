<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') · {{ config('app.name') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
        @include('auth.partials.publisher-guest-styles')
        @stack('styles')
    </head>
    <body>
        @include('partials.dashboard-theme-boot')
        <div class="shell">
            <div class="top-row">
                <div class="nav-links">
                    <a class="home-link" href="{{ url('/') }}">← @yield('back_primary_label', 'Back to site')</a>
                    @hasSection('back_secondary')
                        @yield('back_secondary')
                    @endif
                </div>
                <button type="button" class="theme-btn" id="themeToggle" aria-label="Toggle dark mode">Dark mode</button>
            </div>

            <div class="card">
                <div class="brand">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="" width="52" height="52" onerror="this.style.display='none'">
                    <div>
                        <h1>@yield('heading')</h1>
                        <p>@yield('subheading')</p>
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
        <script>
            (function () {
                var key = 'afya_dashboard_theme';
                var legacyKey = 'afya_publisher_theme';
                var body = document.body;
                var btn = document.getElementById('themeToggle');
                function apply(t) {
                    var dark = t === 'dark';
                    body.classList.toggle('theme-dark', dark);
                    if (btn) btn.textContent = dark ? 'Light mode' : 'Dark mode';
                    if (btn) btn.setAttribute('aria-label', dark ? 'Switch to light mode' : 'Switch to dark mode');
                }
                var saved = null;
                try {
                    saved = localStorage.getItem(key) || localStorage.getItem(legacyKey);
                } catch (e) {}
                var prefers = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                apply(saved || (prefers ? 'dark' : 'light'));
                if (btn) {
                    btn.addEventListener('click', function () {
                        var next = body.classList.contains('theme-dark') ? 'light' : 'dark';
                        try {
                            localStorage.setItem(key, next);
                        } catch (e) {}
                        apply(next);
                    });
                }
            })();
        </script>
        @stack('scripts')
    </body>
</html>
