<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Afya Mtandaoni')</title>
        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
        <style>
            :root {
                --bg: #ffffff;
                --card: #ffffff;
                --text: #0b1220;
                --muted: #475569;
                --line: rgba(15, 23, 42, 0.12);
                --green: #16a34a;
                --green-soft: rgba(22, 163, 74, 0.12);
                --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                --shadow-strong: 0 18px 55px rgba(0, 0, 0, 0.12);
            }
            body.theme-dark {
                --bg: #070b12;
                --text: #f8fafc;
                --muted: rgba(226, 232, 240, 0.76);
                --line: rgba(148, 163, 184, 0.18);
                --card: rgba(15, 23, 42, 0.72);
                --shadow: 0 14px 40px rgba(0, 0, 0, 0.38);
                --shadow-strong: 0 20px 65px rgba(0, 0, 0, 0.46);
            }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: 'Mulish', Arial, sans-serif;
                color: var(--text);
                background: var(--bg);
                overflow-x: hidden;
                position: relative;
            }
            body::before {
                content: '';
                position: fixed;
                inset: 0;
                pointer-events: none;
                z-index: -1;
                background:
                    linear-gradient(rgba(22, 163, 74, 0.05) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(22, 163, 74, 0.05) 1px, transparent 1px),
                    radial-gradient(1200px 700px at 30% 0%, rgba(22, 163, 74, 0.08) 0%, rgba(22, 163, 74, 0.00) 68%);
                background-size: 34px 34px, 34px 34px, auto;
            }
            body.theme-dark::before {
                background:
                    linear-gradient(rgba(74, 222, 128, 0.09) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(74, 222, 128, 0.09) 1px, transparent 1px),
                    radial-gradient(1200px 700px at 30% 0%, rgba(22, 163, 74, 0.14) 0%, rgba(22, 163, 74, 0.00) 68%);
                background-size: 34px 34px, 34px 34px, auto;
            }
            a { color: inherit; text-decoration: none; }
            .wrap { width: min(1100px, 92vw); margin: 0 auto; }
            .site-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                background: rgba(255, 255, 255, 0.92);
                backdrop-filter: blur(18px);
                box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
                border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            }
            body.theme-dark .site-header {
                background: rgba(7, 11, 18, 0.72);
                border-bottom: 1px solid rgba(148, 163, 184, 0.14);
                box-shadow: 0 2px 20px rgba(0, 0, 0, 0.28);
            }
            .site-header.site-header--scrolled {
                background: rgba(255, 255, 255, 0.72);
                backdrop-filter: blur(22px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.10);
            }
            body.theme-dark .site-header.site-header--scrolled {
                background: rgba(7, 11, 18, 0.58);
                box-shadow: 0 14px 40px rgba(0, 0, 0, 0.34);
            }
            .site-header-inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                min-height: 82px;
            }
            .site-brand {
                display: flex;
                align-items: center;
                gap: 12px;
                color: inherit;
                text-decoration: none;
            }
            .site-brand img {
                width: 52px;
                height: 52px;
                border-radius: 14px;
                object-fit: cover;
                border: 1px solid rgba(15, 23, 42, 0.10);
            }
            .site-brand-copy { display: grid; }
            .site-brand-name { font-family: 'Outfit', Arial, sans-serif; font-weight: 900; font-size: 1.1rem; letter-spacing: -0.02em; }
            .site-brand-tagline { font-size: 0.84rem; color: #64748b; font-weight: 600; }
            .site-nav { display: flex; gap: 0.45rem; flex-wrap: wrap; align-items: center; justify-content: center; flex: 1; }
            .site-nav a {
                position: relative;
                text-decoration: none;
                font-weight: 700;
                font-size: 0.95rem;
                color: #334155;
                border-radius: 10px;
                padding: 0.52rem 0.9rem;
                transition: all 0.25s ease;
            }
            .site-nav a:hover {
                color: var(--green);
                background: rgba(22, 163, 74, 0.10);
            }
            .site-nav a::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 0;
                height: 2px;
                background: linear-gradient(135deg, var(--green) 0%, #0b1220 100%);
                transition: width 0.25s ease;
            }
            .site-nav a:hover::after { width: 100%; }
            body.theme-dark .site-nav a { color: rgba(226, 232, 240, 0.86); }
            body.theme-dark .site-nav a:hover { color: #86efac; }
            .header-actions { display: inline-flex; align-items: center; gap: 10px; margin-left: auto; }
            .icon-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 14px;
                border: 1px solid rgba(15, 23, 42, 0.12);
                background: rgba(255, 255, 255, 0.76);
                color: var(--text);
                cursor: pointer;
                transition: transform 0.2s ease, border-color 0.2s ease, background-color 0.2s ease;
            }
            .icon-btn:hover { transform: translateY(-2px); border-color: rgba(22, 163, 74, 0.38); }
            body.theme-dark .icon-btn {
                border-color: rgba(148, 163, 184, 0.18);
                background: rgba(15, 23, 42, 0.65);
                color: rgba(248, 250, 252, 0.92);
            }
            .menu-btn { display: none; }
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
            main.wrap { padding-top: 104px; }
            .hero { padding: 28px 0 16px; }
            .hero h1 { margin: 0 0 8px; font-size: clamp(1.6rem, 3vw, 2.4rem); }
            .hero p { margin: 0; color: var(--muted); }
            .hero.hero-detail {
                background: linear-gradient(120deg, rgba(22, 163, 74, 0.08), rgba(11, 18, 32, 0.02));
                border: 1px solid var(--line);
                border-radius: 18px;
                padding: 20px;
                margin-bottom: 14px;
            }
            .card { background: var(--card); border: 1px solid var(--line); border-radius: 16px; box-shadow: var(--shadow); overflow: hidden; }
            .article-cover { width: 100%; max-height: 460px; object-fit: cover; display: block; }
            .content { padding: 22px; }
            .meta { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; }
            .pill { border-radius: 999px; padding: 5px 10px; background: var(--green-soft); color: #166534; font-weight: 700; font-size: 0.84rem; }
            .rich { color: #1f2937; line-height: 1.85; }
            .rich img { max-width: 100%; height: auto; border-radius: 10px; margin: 8px 0; }
            .rich h1, .rich h2, .rich h3 { color: #0f172a; line-height: 1.35; }
            .rich blockquote { margin: 14px 0; border-left: 4px solid #86efac; padding: 8px 14px; background: #f0fdf4; border-radius: 6px; }
            .rich ul, .rich ol { padding-left: 1.2rem; }
            body.theme-dark .rich { color: rgba(226, 232, 240, 0.88); }
            body.theme-dark .rich h1, body.theme-dark .rich h2, body.theme-dark .rich h3 { color: #f8fafc; }
            body.theme-dark .rich blockquote { background: rgba(22, 163, 74, 0.14); border-left-color: rgba(74, 222, 128, 0.6); }
            .nav-row { margin: 16px 0 28px; display: flex; justify-content: space-between; gap: 10px; }
            .btn { display: inline-flex; align-items: center; justify-content: center; text-decoration: none; border-radius: 10px; padding: 10px 14px; font-weight: 800; border: 1px solid #86efac; color: #166534; background: #fff; }
            .btn-primary { background: #16a34a; border-color: #16a34a; color: #fff; }
            body.theme-dark .btn { background: rgba(15, 23, 42, 0.62); color: #dcfce7; border-color: rgba(74, 222, 128, 0.36); }
            .grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }
            .item { background: var(--card); border: 1px solid var(--line); border-radius: 14px; overflow: hidden; box-shadow: var(--shadow); }
            .item img { width: 100%; height: 170px; object-fit: cover; display: block; }
            .item .body { padding: 12px; display: grid; gap: 8px; }
            .item h3 { margin: 0; font-size: 1.03rem; }
            .item p { margin: 0; color: var(--muted); }
            .post-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
            .post-card {
                position: relative;
                border-radius: 18px;
                overflow: hidden;
                border: 1px solid var(--line);
                background: var(--card);
                box-shadow: var(--shadow);
                transition: transform 0.26s ease, box-shadow 0.26s ease, border-color 0.26s ease;
            }
            .post-card:hover {
                transform: translateY(-6px);
                border-color: rgba(22, 163, 74, 0.38);
                box-shadow: var(--shadow-strong);
            }
            .post-media-wrap { position: relative; }
            .post-media-wrap img { width: 100%; height: 220px; object-fit: cover; display: block; transition: transform 0.35s ease; }
            .post-card:hover .post-media-wrap img { transform: scale(1.04); }
            .post-chip {
                position: absolute;
                top: 10px;
                left: 10px;
                border-radius: 999px;
                background: rgba(255,255,255,0.92);
                color: #14532d;
                padding: 5px 10px;
                font-size: 0.77rem;
                font-weight: 900;
                border: 1px solid rgba(22, 163, 74, 0.25);
            }
            .post-body { padding: 14px; display: grid; gap: 10px; }
            .post-title { margin: 0; font-size: 1.05rem; line-height: 1.35; }
            .post-excerpt { margin: 0; color: var(--muted); line-height: 1.7; }
            .post-meta { display: flex; gap: 7px; flex-wrap: wrap; }
            .post-meta span {
                font-size: 0.78rem;
                font-weight: 800;
                color: #166534;
                background: rgba(22, 163, 74, 0.11);
                border: 1px solid rgba(22, 163, 74, 0.2);
                border-radius: 999px;
                padding: 4px 8px;
            }
            .post-link {
                margin-top: 2px;
                color: var(--green);
                font-weight: 900;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }
            .post-link::after { content: '›'; font-size: 1.2rem; line-height: 1; }
            .post-link:hover { text-decoration: underline; text-underline-offset: 3px; }
            .reader-shell {
                display: grid;
                grid-template-columns: minmax(0, 1fr);
                gap: 16px;
                max-width: 920px;
                margin: 0 auto 26px;
            }
            .reader-card {
                border-radius: 20px;
                overflow: hidden;
                border: 1px solid var(--line);
                background: var(--card);
                box-shadow: var(--shadow-strong);
            }
            .reader-cover { width: 100%; height: clamp(230px, 42vw, 480px); object-fit: cover; display: block; }
            .reader-content { padding: clamp(16px, 3vw, 28px); }
            .lead-text {
                margin: 0 0 16px;
                padding: 14px 16px;
                border-radius: 12px;
                background: rgba(22, 163, 74, 0.08);
                border: 1px solid rgba(22, 163, 74, 0.18);
                color: #1f2937;
                font-weight: 700;
            }
            .nav-row .btn { min-width: 160px; }
            .pagination { margin: 16px 0 30px; }
            @media (max-width: 980px) { .post-grid { grid-template-columns: 1fr 1fr; } }
            @media (max-width: 900px) { .grid { grid-template-columns: 1fr 1fr; } }
            @media (max-width: 980px) {
                .site-header-inner { flex-wrap: wrap; align-items: center; }
            }
            @media (max-width: 640px) {
                .site-nav { display: none; width: 100%; }
                .site-nav.is-open { display: flex; gap: 14px; padding-top: 10px; }
                .menu-btn { display: inline-flex; }
                .site-brand-copy { display: none; }
                main.wrap { padding-top: 92px; }
                .post-grid { grid-template-columns: 1fr; }
                .reader-shell { margin-bottom: 18px; }
                .nav-row .btn { min-width: 0; flex: 1; }
            }
            @media (max-width: 640px) { .grid { grid-template-columns: 1fr; } .content { padding: 16px; } }
        </style>
        @stack('styles')
    </head>
    <body>
        <header class="site-header">
            <div class="wrap site-header-inner">
                <a class="site-brand" href="{{ url('/') }}" aria-label="Afya Mtandaoni home">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Afya logo">
                    <span class="site-brand-copy">
                        <span class="site-brand-name">AFYA MTANDAONI</span>
                        <span class="site-brand-tagline">Health Awareness &amp; Publications</span>
                    </span>
                </a>
                <nav class="site-nav" id="primaryNav" aria-label="Primary navigation">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('articles.index') }}">Articles</a>
                    <a href="{{ route('news.index') }}">Health News</a>
                    <a href="{{ url('/#topics') }}">Topics</a>
                    <a href="{{ url('/#newsletter') }}">Newsletter</a>
                    <a href="{{ url('/#contact') }}">Contact</a>
                </nav>
                <div class="header-actions">
                    <button class="icon-btn" type="button" id="themeToggle" aria-label="Toggle dark mode">
                        <span aria-hidden="true">◐</span>
                        <span class="sr-only">Toggle theme</span>
                    </button>
                    <button class="icon-btn menu-btn" type="button" id="menuToggle" aria-label="Open menu">
                        <span aria-hidden="true">≡</span>
                        <span class="sr-only">Menu</span>
                    </button>
                </div>
            </div>
        </header>
        <main class="wrap">
            @yield('content')
        </main>
        <script>
            (function () {
                const storageKey = 'afya_theme';
                const body = document.body;
                const themeToggle = document.getElementById('themeToggle');
                const menuToggle = document.getElementById('menuToggle');
                const nav = document.getElementById('primaryNav');
                const header = document.querySelector('.site-header');

                function applyTheme(theme) {
                    const isDark = theme === 'dark';
                    body.classList.toggle('theme-dark', isDark);
                    if (themeToggle) {
                        themeToggle.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
                    }
                }

                const saved = localStorage.getItem(storageKey);
                const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                applyTheme(saved || (prefersDark ? 'dark' : 'light'));

                if (themeToggle) {
                    themeToggle.addEventListener('click', function () {
                        const next = body.classList.contains('theme-dark') ? 'light' : 'dark';
                        localStorage.setItem(storageKey, next);
                        applyTheme(next);
                    });
                }

                function syncHeader() {
                    if (!header) return;
                    header.classList.toggle('site-header--scrolled', window.scrollY > 8);
                }
                syncHeader();
                window.addEventListener('scroll', syncHeader, { passive: true });

                if (menuToggle && nav) {
                    menuToggle.addEventListener('click', function () {
                        nav.classList.toggle('is-open');
                        const isOpen = nav.classList.contains('is-open');
                        menuToggle.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
                    });
                }
            })();
        </script>
    </body>
</html>

