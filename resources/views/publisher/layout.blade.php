<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Publisher Dashboard')</title>
        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700;800&display=swap" rel="stylesheet">
        @include('partials.dashboard-app-styles')
    </head>
    <body class="dash-app-body">
        @include('partials.dashboard-theme-boot')

        @if (session('publisher_login_success'))
            <div class="dash-toast-host" aria-live="polite">
                <div class="dash-toast" id="loginToast" role="status">
                    <div>
                        <strong>Welcome back</strong>
                        <p>You are signed in to the publisher dashboard.</p>
                    </div>
                    <button type="button" class="dash-toast-close" data-dismiss-toast aria-label="Dismiss">×</button>
                </div>
            </div>
        @endif

        <div class="dash-app-shell">
            <aside class="dash-sidebar">
                <div class="dash-brand">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Afya logo">
                    <div>
                        <strong>Afya Publisher</strong>
                        <small>Health content panel</small>
                    </div>
                </div>

                <nav class="dash-menu">
                    <a class="{{ request()->routeIs('publisher.dashboard') ? 'active' : '' }}" href="{{ route('publisher.dashboard') }}">Dashboard</a>
                    <a class="{{ request()->routeIs('publisher.articles.*') ? 'active' : '' }}" href="{{ route('publisher.articles.index') }}">Articles</a>
                    <a class="{{ request()->routeIs('publisher.news.*') ? 'active' : '' }}" href="{{ route('publisher.news.index') }}">Health News</a>
                    <a class="{{ request()->routeIs('publisher.contact-submissions.*') ? 'active' : '' }}" href="{{ route('publisher.contact-submissions.index') }}">Contact Submissions</a>
                </nav>

                <div class="dash-sidebar-footer">
                    <form action="{{ route('publisher.logout') }}" method="post">
                        @csrf
                        <button class="dash-btn dash-btn-outline" type="submit" style="width:100%;">Logout</button>
                    </form>
                </div>
            </aside>

            <main class="dash-main">
                <div class="dash-topbar">
                    <div>
                        <h1>@yield('title', 'Publisher Dashboard')</h1>
                        <p>@yield('subtitle', 'Manage health publications and keep public content updated.')</p>
                    </div>
                    <div class="dash-topbar-meta">
                        <button type="button" class="theme-btn" id="themeToggle" aria-label="Toggle dark mode">Dark mode</button>
                        <span class="dash-topbar-date">{{ now()->format('M j, Y') }}</span>
                    </div>
                </div>

                @if (session('status'))
                    <div class="dash-status">{{ session('status') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
        <script>
            (function () {
                var toast = document.getElementById('loginToast');
                if (!toast) return;
                var host = toast.closest('.dash-toast-host');
                var btn = toast.querySelector('[data-dismiss-toast]');
                function hide() {
                    if (host) host.remove();
                    else toast.style.display = 'none';
                }
                if (btn) btn.addEventListener('click', hide);
                setTimeout(hide, 9000);
            })();
        </script>
        @include('partials.dashboard-theme-script')
        @stack('scripts')
    </body>
</html>
