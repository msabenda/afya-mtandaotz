<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Afya Mtandaoni provides health awareness online through blog posts and helpful articles.">

        <title>Afya Mtandaoni | Health Awareness Online</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">

        {{-- Optional: If you later run Vite, it will enhance (not required for styling). --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }

            :root {
                --bg: #ffffff;
                --text: #0b1220;
                --muted: #475569;
                --line: rgba(15, 23, 42, 0.12);
                --card: #ffffff;
                --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                --shadow-strong: 0 18px 55px rgba(0, 0, 0, 0.12);
                --green: #16a34a;
                --green-dark: #0f7a36;
                --green-soft: rgba(22, 163, 74, 0.12);
                --fade: linear-gradient(135deg, #ffffff 0%, #f1f5f9 65%, rgba(22, 163, 74, 0.08) 115%);
            }

            body.theme-dark {
                --bg: #070b12;
                --text: #f8fafc;
                --muted: rgba(226, 232, 240, 0.76);
                --line: rgba(148, 163, 184, 0.18);
                --card: rgba(15, 23, 42, 0.72);
                --shadow: 0 14px 40px rgba(0, 0, 0, 0.38);
                --shadow-strong: 0 20px 65px rgba(0, 0, 0, 0.46);
                --fade: radial-gradient(1400px 700px at 30% 0%, rgba(22, 163, 74, 0.14) 0%, rgba(7, 11, 18, 0.00) 60%), linear-gradient(135deg, rgba(15, 23, 42, 0.96) 0%, rgba(7, 11, 18, 1) 85%);
            }

            html { scroll-behavior: smooth; }

            body {
                font-family: 'Mulish', sans-serif;
                line-height: 1.6;
                color: var(--text);
                overflow-x: hidden;
                background: var(--bg);
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

            img { display: block; width: 100%; }
            a { color: inherit; text-decoration: none; }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .landing-page { min-height: 100vh; position: relative; }

            /* Header */
            .site-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.92);
                backdrop-filter: blur(18px);
                z-index: 1000;
                padding: 1rem 0;
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
                justify-content: space-between;
                align-items: center;
                gap: 18px;
            }

            .site-brand {
                display: flex;
                align-items: center;
                gap: 12px;
                color: var(--text);
            }

            .site-brand img {
                width: 52px;
                height: 52px;
                border-radius: 14px;
                object-fit: cover;
                background: #fff;
                border: 1px solid rgba(15, 23, 42, 0.10);
            }

            .site-brand-name {
                font-family: 'Outfit', sans-serif;
                font-weight: 900;
                font-size: 1.28rem;
                line-height: 1.1;
                letter-spacing: -0.02em;
                display: block;
            }

            .site-brand-tagline {
                font-size: 0.85rem;
                color: #64748b;
                font-weight: 600;
                display: block;
            }

            .site-nav {
                display: flex;
                gap: 0.45rem;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                flex: 1;
            }

            .site-nav a {
                color: #334155;
                font-weight: 700;
                font-size: 0.95rem;
                transition: all 0.25s ease;
                position: relative;
                padding: 0.52rem 0.9rem;
                border-radius: 10px;
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

            .icon-btn:hover {
                transform: translateY(-2px);
                border-color: rgba(22, 163, 74, 0.38);
            }

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

            /* Back to top */
            .back-to-top {
                position: fixed;
                right: 24px;
                bottom: 24px;
                width: 46px;
                height: 46px;
                display: grid;
                place-items: center;
                border-radius: 14px;
                background: linear-gradient(135deg, var(--green) 0%, #0b1220 130%);
                color: #fff;
                box-shadow: 0 14px 30px rgba(22, 163, 74, 0.22);
                z-index: 1100;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .back-to-top:hover { transform: translateY(-3px); }

            /* Floating social buttons */
            .floating-social-left,
            .floating-whatsapp-right {
                position: fixed;
                z-index: 1090;
                display: grid;
                gap: 10px;
            }

            .floating-ai-assistant {
                position: fixed;
                right: 14px;
                bottom: 138px;
                z-index: 1096;
                opacity: 0;
                pointer-events: none;
                transform: translateY(10px);
                transition: opacity 0.28s ease, transform 0.28s ease;
            }

            .floating-ai-assistant.is-visible {
                opacity: 1;
                pointer-events: auto;
                transform: translateY(0);
            }

            .ai-assistant-btn {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                min-height: 48px;
                padding: 0 14px 0 8px;
                border-radius: 999px;
                border: 1px solid rgba(22, 163, 74, 0.36);
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.96) 0%, rgba(220, 252, 231, 0.95) 100%);
                color: #065f46;
                font-weight: 900;
                font-size: 0.9rem;
                box-shadow: 0 12px 28px rgba(16, 185, 129, 0.22);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .ai-assistant-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 16px 34px rgba(16, 185, 129, 0.30);
            }

            .ai-dot {
                width: 30px;
                height: 30px;
                border-radius: 999px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 0.9rem;
                background: linear-gradient(135deg, #16a34a 0%, #0b1220 130%);
                overflow: hidden;
            }

            .ai-dot img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            body.theme-dark .ai-assistant-btn {
                color: #d1fae5;
                border-color: rgba(74, 222, 128, 0.36);
                background: linear-gradient(135deg, rgba(15, 23, 42, 0.92) 0%, rgba(22, 101, 52, 0.82) 100%);
            }

            .ai-chat-panel {
                position: fixed;
                right: 14px;
                bottom: 194px;
                width: min(360px, calc(100vw - 24px));
                border-radius: 16px;
                border: 1px solid rgba(15, 23, 42, 0.12);
                background: rgba(255, 255, 255, 0.97);
                box-shadow: 0 24px 54px rgba(0, 0, 0, 0.18);
                overflow: hidden;
                z-index: 1102;
                opacity: 0;
                pointer-events: none;
                transform: translateY(10px) scale(0.98);
                transition: opacity 0.24s ease, transform 0.24s ease;
            }

            .ai-chat-panel.is-open {
                opacity: 1;
                pointer-events: auto;
                transform: translateY(0) scale(1);
            }

            .ai-chat-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                padding: 12px 12px;
                background: linear-gradient(135deg, rgba(22, 163, 74, 0.12) 0%, rgba(220, 252, 231, 0.74) 100%);
                border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            }

            .ai-chat-title {
                display: flex;
                align-items: center;
                gap: 10px;
                font-weight: 900;
                color: #064e3b;
            }

            .ai-chat-title img {
                width: 30px;
                height: 30px;
                border-radius: 999px;
                border: 1px solid rgba(22, 163, 74, 0.30);
                object-fit: cover;
            }

            .ai-chat-close {
                border: none;
                background: transparent;
                color: #065f46;
                font-size: 1.05rem;
                cursor: pointer;
                font-weight: 900;
            }

            .ai-chat-messages {
                display: grid;
                gap: 8px;
                max-height: 260px;
                overflow: auto;
                padding: 12px;
                background: rgba(248, 250, 252, 0.62);
            }

            .ai-msg {
                font-size: 0.9rem;
                line-height: 1.55;
                padding: 8px 10px;
                border-radius: 12px;
                max-width: 92%;
            }

            .ai-msg.bot {
                background: rgba(22, 163, 74, 0.14);
                color: #065f46;
                justify-self: start;
            }

            .ai-msg.user {
                background: rgba(15, 23, 42, 0.08);
                color: #0f172a;
                justify-self: end;
            }

            .ai-chat-input {
                display: grid;
                grid-template-columns: 1fr auto;
                gap: 8px;
                padding: 10px;
                border-top: 1px solid rgba(15, 23, 42, 0.08);
                background: #fff;
            }

            .ai-chat-input input {
                border: 1px solid rgba(15, 23, 42, 0.14);
                border-radius: 10px;
                padding: 10px;
                font: inherit;
                outline: none;
            }

            .ai-chat-input button {
                border: none;
                border-radius: 10px;
                padding: 10px 12px;
                font-weight: 900;
                color: #fff;
                background: linear-gradient(135deg, #16a34a 0%, #0b1220 130%);
                cursor: pointer;
            }

            body.theme-dark .ai-chat-panel {
                border-color: rgba(148, 163, 184, 0.18);
                background: rgba(15, 23, 42, 0.96);
                box-shadow: 0 24px 54px rgba(0, 0, 0, 0.36);
            }
            body.theme-dark .ai-chat-header {
                background: linear-gradient(135deg, rgba(22, 163, 74, 0.24) 0%, rgba(15, 23, 42, 0.85) 100%);
                border-bottom-color: rgba(148, 163, 184, 0.14);
            }
            body.theme-dark .ai-chat-title,
            body.theme-dark .ai-chat-close { color: #d1fae5; }
            body.theme-dark .ai-chat-messages { background: rgba(15, 23, 42, 0.80); }
            body.theme-dark .ai-msg.bot { background: rgba(22, 163, 74, 0.20); color: #dcfce7; }
            body.theme-dark .ai-msg.user { background: rgba(148, 163, 184, 0.16); color: #e2e8f0; }
            body.theme-dark .ai-chat-input {
                background: rgba(15, 23, 42, 0.94);
                border-top-color: rgba(148, 163, 184, 0.14);
            }
            body.theme-dark .ai-chat-input input {
                background: rgba(15, 23, 42, 0.86);
                color: #e2e8f0;
                border-color: rgba(148, 163, 184, 0.18);
            }

            .floating-social-left {
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
            }

            .floating-whatsapp-right {
                right: 14px;
                bottom: 84px;
                top: auto;
                transform: translateY(0);
            }

            .floating-social-left,
            .floating-whatsapp-right {
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.28s ease, transform 0.28s ease;
            }

            .floating-social-left.is-visible,
            .floating-whatsapp-right.is-visible {
                opacity: 1;
                pointer-events: auto;
            }

            .floating-social-left { transform: translate(-8px, -50%); }
            .floating-whatsapp-right { transform: translateX(8px); }
            .floating-social-left.is-visible { transform: translate(0, -50%); }
            .floating-whatsapp-right.is-visible { transform: translateX(0); }

            .floating-link {
                width: 44px;
                height: 44px;
                border-radius: 13px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: 900;
                border: 1px solid rgba(15, 23, 42, 0.12);
                background: rgba(255, 255, 255, 0.86);
                color: var(--text);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
                transition: transform 0.2s ease, border-color 0.2s ease, background-color 0.2s ease;
            }

            .social-svg {
                width: 20px;
                height: 20px;
                stroke: currentColor;
                fill: none;
                stroke-width: 2;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .social-svg-fill {
                width: 20px;
                height: 20px;
                fill: currentColor;
            }

            .floating-link:hover {
                transform: translateY(-2px);
                border-color: rgba(22, 163, 74, 0.35);
            }

            .floating-link.whatsapp {
                background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
                color: #fff;
                border-color: rgba(22, 163, 74, 0.45);
            }

            body.theme-dark .floating-link {
                border-color: rgba(148, 163, 184, 0.18);
                background: rgba(15, 23, 42, 0.72);
                color: rgba(248, 250, 252, 0.94);
            }

            body.theme-dark .floating-link.whatsapp {
                background: linear-gradient(135deg, #16a34a 0%, #0f7a36 100%);
                color: #fff;
            }

            /* Intro */
            .intro-section {
                min-height: 100svh;
                padding: 120px 0 70px;
                background: var(--fade);
                position: relative;
                overflow: hidden;
                border-bottom: 1px solid rgba(15, 23, 42, 0.06);
                display: flex;
                align-items: center;
            }

            body.theme-dark .intro-section {
                background: linear-gradient(135deg, rgba(12, 22, 16, 0.96) 0%, rgba(14, 30, 20, 0.98) 52%, rgba(22, 163, 74, 0.22) 120%);
                border-bottom: 1px solid rgba(148, 163, 184, 0.12);
            }

            .intro-section::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(900px 340px at 20% 0%, rgba(22, 163, 74, 0.10) 0%, rgba(22, 163, 74, 0) 72%);
                opacity: 0.75;
                pointer-events: none;
            }

            body.theme-dark .intro-section::before {
                background: radial-gradient(1000px 380px at 24% 0%, rgba(134, 239, 172, 0.22) 0%, rgba(134, 239, 172, 0) 68%);
                opacity: 0.46;
            }

            .intro-copy {
                max-width: 900px;
                text-align: left;
                position: relative;
                z-index: 2;
                margin: 0;
                padding: 18px 22px 18px clamp(24px, 6vw, 84px);
            }

            body.theme-dark .intro-copy {
                background: linear-gradient(90deg, rgba(134, 239, 172, 0.10) 0%, rgba(134, 239, 172, 0.00) 70%);
                border-left: 3px solid rgba(34, 197, 94, 0.55);
                border-radius: 0 14px 14px 0;
            }

            .section-kicker {
                background: linear-gradient(135deg, var(--green) 0%, #0b1220 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: 900;
                font-size: 0.85rem;
                letter-spacing: 2px;
                text-transform: uppercase;
                margin-bottom: 1rem;
                display: inline-flex;
            }

            body.theme-dark .section-kicker {
                background: linear-gradient(135deg, #86efac 0%, #22c55e 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                text-shadow: 0 0 26px rgba(34, 197, 94, 0.22);
            }

            h1 {
                font-family: 'Outfit', sans-serif;
                font-weight: 900;
                font-size: clamp(2.5rem, 5vw, 4.1rem);
                line-height: 1.08;
                margin-bottom: 1.25rem;
                color: var(--text);
                letter-spacing: -0.04em;
                text-wrap: balance;
                max-width: 920px;
            }

            body.theme-dark h1 {
                color: #f8fafc;
                text-shadow: 0 10px 34px rgba(0, 0, 0, 0.35);
            }

            .intro-copy p {
                font-size: 1.2rem;
                max-width: 760px;
                margin: 0;
                color: var(--muted);
                text-wrap: pretty;
            }

            body.theme-dark .intro-copy p {
                color: rgba(226, 232, 240, 0.90);
            }

            .hero-highlight {
                color: var(--green-dark);
                text-shadow: 0 8px 24px rgba(22, 163, 74, 0.15);
            }

            body.theme-dark .hero-highlight {
                color: #86efac;
            }

            /* Section header */
            .section-header {
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                gap: 18px;
                margin-bottom: 22px;
            }

            .section-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                font-weight: 900;
                letter-spacing: -0.02em;
                color: var(--text);
            }

            .section-link { display: inline-flex; align-items: center; gap: 10px; font-weight: 900; color: var(--green); }
            .section-link::after { content: '›'; font-size: 1.5rem; line-height: 0; }

            /* Cards */
            .articles-section { padding: 60px 0 80px; }
            .article-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 28px; }

            .article-card {
                overflow: hidden;
                border: 1px solid rgba(15, 23, 42, 0.10);
                border-radius: 18px;
                background: var(--card);
                box-shadow: var(--shadow);
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .article-card:hover {
                transform: translateY(-6px);
                box-shadow: var(--shadow-strong);
            }

            .article-card img { height: 235px; object-fit: cover; }

            .article-card-body {
                display: flex;
                flex-direction: column;
                min-height: 250px;
                padding: 26px;
            }

            .article-meta {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 14px;
                margin-bottom: 16px;
                color: #64748b;
                font-weight: 800;
                font-size: 0.9rem;
            }

            .article-chip {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 6px 12px;
                border-radius: 999px;
                background: var(--green-soft);
                color: var(--green-dark);
                font-weight: 900;
                letter-spacing: 1px;
                text-transform: uppercase;
                font-size: 0.72rem;
            }

            .article-card h2 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.22rem;
                line-height: 1.22;
                color: var(--text);
            }

            .article-card p { margin: 14px 0 0; font-size: 1rem; line-height: 1.9; color: var(--muted); }
            .article-meta-extra {
                margin-top: 16px;
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }

            .meta-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 28px;
                padding: 0 10px;
                border-radius: 999px;
                background: rgba(22, 163, 74, 0.10);
                color: #065f46;
                border: 1px solid rgba(22, 163, 74, 0.20);
                font-weight: 800;
                font-size: 0.78rem;
            }

            .article-card a {
                margin-top: auto;
                padding-top: 18px;
                font-size: 1rem;
                font-weight: 900;
                color: var(--green);
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: color 0.2s ease, transform 0.2s ease, text-shadow 0.2s ease;
            }
            .article-card a::after { content: '›'; margin-left: 12px; font-size: 1.5rem; line-height: 0; vertical-align: middle; }
            .article-card a:hover {
                color: #0f7a36;
                transform: translateX(3px);
                text-shadow: 0 8px 22px rgba(22, 163, 74, 0.28);
            }

            .articles-actions {
                margin-top: 26px;
                display: flex;
                justify-content: center;
            }

            .view-all-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 46px;
                padding: 0 18px;
                border-radius: 12px;
                border: 1px solid rgba(22, 163, 74, 0.35);
                background: rgba(22, 163, 74, 0.10);
                color: #065f46;
                font-weight: 900;
                transition: transform 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
            }

            .view-all-btn:hover {
                transform: translateY(-2px);
                background: rgba(22, 163, 74, 0.18);
                border-color: rgba(22, 163, 74, 0.52);
            }

            /* News */
            .news-section { padding: 0 0 80px; }
            .news-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 22px; }

            .news-card {
                border: 1px solid rgba(15, 23, 42, 0.10);
                border-radius: 18px;
                background: var(--card);
                box-shadow: var(--shadow);
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .news-card:hover {
                transform: translateY(-6px);
                box-shadow: var(--shadow-strong);
            }

            .news-card-body { padding: 24px 26px; display: grid; gap: 12px; }

            .news-media {
                height: 180px;
                object-fit: cover;
                border-top-left-radius: 18px;
                border-top-right-radius: 18px;
            }
            .news-meta { display: flex; align-items: center; justify-content: space-between; gap: 14px; color: #64748b; font-weight: 800; font-size: 0.9rem; }
            .news-title { margin: 0; font-family: 'Outfit', sans-serif; font-size: 1.22rem; line-height: 1.22; color: var(--text); }
            .news-summary { margin: 0; color: var(--muted); line-height: 1.9; }
            .news-footer { margin-top: 4px; display: flex; align-items: center; justify-content: space-between; gap: 14px; }
            .news-source { color: #64748b; font-weight: 800; font-size: 0.95rem; }
            .news-link { font-weight: 900; color: var(--green); }
            .news-link::after { content: '›'; margin-left: 10px; font-size: 1.4rem; line-height: 0; vertical-align: middle; }

            /* Topics */
            .topics-section { padding-bottom: 52px; }
            .topics-row { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; }
            .topics-row span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 44px;
                padding: 0 20px;
                border: 1px solid rgba(22, 163, 74, 0.25);
                border-radius: 999px;
                background: rgba(22, 163, 74, 0.08);
                color: #334155;
                font-weight: 800;
                transition: transform 0.2s ease;
            }
            .topics-row span:hover { transform: translateY(-2px); }

            /* CTA + Newsletter form */
            .cta-section { padding: 0 0 88px; }
            .cta-band {
                display: grid;
                grid-template-columns: 1.2fr 0.8fr;
                gap: 22px;
                align-items: center;
                padding: 34px 34px 34px 36px;
                border-radius: 18px;
                background: linear-gradient(135deg, #0b1220 0%, var(--green) 65%, #0b1220 140%);
                color: #fff;
                box-shadow: 0 24px 54px rgba(0, 0, 0, 0.22);
            }
            .cta-copy h3 { margin: 0 0 10px; font-family: 'Outfit', sans-serif; font-size: 2rem; line-height: 1.08; }
            .cta-copy p { margin: 0; font-size: 1.02rem; line-height: 1.9; color: rgba(255, 255, 255, 0.9); }

            .form-row { display: grid; grid-template-columns: 1fr auto; gap: 12px; margin-top: 14px; }
            .input, .textarea {
                width: 100%;
                border: 1px solid rgba(15, 23, 42, 0.14);
                border-radius: 14px;
                padding: 14px 14px;
                outline: none;
                font: inherit;
                color: var(--text);
                background: rgba(255, 255, 255, 0.98);
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }
            .input:focus, .textarea:focus {
                border-color: rgba(22, 163, 74, 0.55);
                box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.12);
            }
            .textarea { min-height: 140px; resize: vertical; }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border: none;
                border-radius: 14px;
                padding: 14px 18px;
                font: inherit;
                font-weight: 900;
                cursor: pointer;
                color: #ffffff;
                background: linear-gradient(135deg, var(--green) 0%, #0b1220 130%);
                transition: transform 0.2s ease, filter 0.2s ease;
                white-space: nowrap;
            }
            .btn:hover { transform: translateY(-2px); filter: brightness(1.02); }

            .cta-form-note { margin-top: 10px; font-size: 0.95rem; color: rgba(255, 255, 255, 0.86); }

            .form-feedback {
                margin-bottom: 12px;
                padding: 10px 12px;
                border-radius: 10px;
                font-weight: 700;
                font-size: 0.95rem;
                line-height: 1.45;
            }
            .form-feedback--newsletter-success {
                background: rgba(255, 255, 255, 0.22);
                color: #fff;
            }
            .form-feedback--newsletter-error {
                background: rgba(254, 226, 226, 0.98);
                color: #991b1b;
            }
            .form-feedback--contact-success {
                background: #dcfce7;
                color: #166534;
            }
            .form-feedback--contact-error {
                background: #fee2e2;
                color: #991b1b;
            }
            .btn.is-loading { opacity: 0.72; pointer-events: none; cursor: wait; }

            /* Contact + map */
            .contact-section { padding: 0 0 88px; }
            .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; align-items: stretch; }
            .contact-card {
                border: 1px solid rgba(15, 23, 42, 0.10);
                border-radius: 18px;
                background: #ffffff;
                box-shadow: var(--shadow);
                overflow: hidden;
            }
            .contact-card-body { padding: 22px; display: grid; gap: 12px; }
            .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
            .label { font-weight: 900; font-size: 0.92rem; color: #0b1220; margin-bottom: 6px; display: block; }
            .map-frame { width: 100%; height: 100%; min-height: 420px; border: 0; }

            /* Empty states */
            .empty-state {
                grid-column: 1 / -1;
                padding: 24px;
                border-radius: 18px;
                border: 1px dashed rgba(15, 23, 42, 0.22);
                background: rgba(255, 255, 255, 0.75);
            }
            .empty-state h3 { margin: 0 0 8px; font-family: 'Outfit', sans-serif; color: var(--text); }
            .empty-state p { margin: 0; color: var(--muted); line-height: 1.8; }

            /* Footer */
            .site-footer {
                padding: 54px 0 42px;
                border-top: 1px solid rgba(15, 23, 42, 0.10);
                background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 70%, rgba(22, 163, 74, 0.06) 120%);
                position: relative;
                overflow: hidden;
            }

            .site-footer::before {
                content: '';
                position: absolute;
                inset: 0;
                pointer-events: none;
                opacity: 0.36;
                background:
                    linear-gradient(rgba(22, 163, 74, 0.06) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(22, 163, 74, 0.06) 1px, transparent 1px),
                    url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='1600' height='360' viewBox='0 0 1600 360'%3E%3Cdefs%3E%3Cfilter id='g' x='-30%25' y='-30%25' width='160%25' height='160%25'%3E%3CfeGaussianBlur stdDeviation='3.2' result='b'/%3E%3CfeMerge%3E%3CfeMergeNode in='b'/%3E%3CfeMergeNode in='SourceGraphic'/%3E%3C/feMerge%3E%3C/filter%3E%3C/defs%3E%3Cpath d='M10 220 H480 L545 220 L575 145 L592 220 L610 288 L650 220 L730 220 L768 220 L804 48 L824 220 L845 324 L910 220 L996 220 L1044 220 L1082 122 L1100 220 L1118 274 L1160 220 H1590' stroke='%2322c55e' stroke-width='6' fill='none' stroke-linecap='round' stroke-linejoin='round' filter='url(%23g)'/%3E%3C/svg%3E");
                background-size: 26px 26px, 26px 26px, min(1360px, 98%) 300px;
                background-repeat: repeat, repeat, no-repeat;
                background-position: center, center, right 74%;
                animation: ecgPulseMove 7s ease-in-out infinite;
            }
            body.theme-dark .site-footer {
                background: linear-gradient(135deg, rgba(15, 23, 42, 0.92) 0%, rgba(7, 11, 18, 1) 85%);
                border-top: 1px solid rgba(148, 163, 184, 0.14);
            }

            body.theme-dark .site-footer::before { opacity: 0.42; }

            @keyframes ecgPulseMove {
                0% { background-position: center, center, right 74%; }
                50% { background-position: center, center, right calc(74% - 6px); }
                100% { background-position: center, center, right 74%; }
            }

            .site-footer::after {
                content: '';
                position: absolute;
                top: 0;
                bottom: 0;
                right: 0;
                width: min(460px, 46%);
                pointer-events: none;
                background:
                    linear-gradient(90deg, rgba(34, 197, 94, 0) 0%, rgba(34, 197, 94, 0.34) 42%, rgba(34, 197, 94, 0.58) 72%, rgba(187, 247, 208, 0.78) 100%);
                mix-blend-mode: normal;
                opacity: 0;
                filter: saturate(1.25);
                animation: ecgPass 4.2s ease-in-out infinite;
            }

            body.theme-dark .site-footer::after {
                mix-blend-mode: screen;
                background:
                    linear-gradient(90deg, rgba(34, 197, 94, 0) 0%, rgba(34, 197, 94, 0.42) 42%, rgba(34, 197, 94, 0.66) 72%, rgba(187, 247, 208, 0.86) 100%);
            }

            @keyframes ecgPass {
                0%, 46% { transform: translateX(125%); opacity: 0; }
                54% { opacity: 0.28; }
                68% { transform: translateX(0%); opacity: 0.74; }
                84% { transform: translateX(-62%); opacity: 0.46; }
                100% { transform: translateX(-130%); opacity: 0; }
            }
            .footer-inner {
                display: grid;
                grid-template-columns: 1.2fr 0.8fr;
                gap: 28px;
                align-items: start;
                padding-bottom: 22px;
            }
            .footer-name { font-family: 'Outfit', sans-serif; font-weight: 900; letter-spacing: -0.02em; font-size: 1.2rem; color: var(--text); }
            .footer-copy { margin: 10px 0 0; color: var(--muted); line-height: 1.9; max-width: 560px; }
            .footer-links { display: grid; gap: 12px; justify-items: start; }
            .footer-links a { font-weight: 900; color: #0b1220; transition: color 0.3s ease; }
            .footer-links a:hover { color: var(--green); }
            body.theme-dark .footer-links a { color: rgba(226, 232, 240, 0.9); }
            .footer-bottom {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 14px;
                padding-top: 18px;
                border-top: 1px solid rgba(15, 23, 42, 0.10);
                color: #64748b;
                font-weight: 800;
                flex-wrap: wrap;
            }

            .footer-logo {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 10px;
            }

            .footer-logo img {
                width: 58px;
                height: 58px;
                border-radius: 14px;
                object-fit: cover;
                border: 2px solid rgba(22, 163, 74, 0.40);
                box-shadow: 0 10px 24px rgba(22, 163, 74, 0.25);
            }

            body.theme-dark .footer-logo img {
                border-color: rgba(148, 163, 184, 0.14);
            }

            .footer-meta {
                display: grid;
                gap: 10px;
                margin-top: 14px;
                color: var(--muted);
                font-weight: 700;
            }

            .social-row {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 10px;
            }

            .social-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 12px;
                border: 1px solid rgba(15, 23, 42, 0.10);
                background: rgba(255, 255, 255, 0.7);
                transition: transform 0.2s ease, border-color 0.2s ease, background-color 0.2s ease;
                font-weight: 900;
                color: var(--text);
                font-size: 0.95rem;
            }

            .footer-links {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 14px;
            }

            .footer-links a {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 38px;
                padding: 0 14px;
                border-radius: 999px;
                border: 1px solid rgba(15, 23, 42, 0.12);
                background: rgba(255, 255, 255, 0.74);
                font-weight: 800;
                color: var(--text);
                transition: all 0.2s ease;
            }

            .footer-links a:hover {
                border-color: rgba(22, 163, 74, 0.35);
                color: var(--green);
                transform: translateY(-1px);
            }

            .social-link:hover {
                transform: translateY(-2px);
                border-color: rgba(22, 163, 74, 0.34);
            }

            body.theme-dark .social-link {
                border-color: rgba(148, 163, 184, 0.14);
                background: rgba(15, 23, 42, 0.62);
                color: rgba(248, 250, 252, 0.92);
            }

            body.theme-dark .meta-pill {
                color: #dcfce7;
                background: rgba(22, 163, 74, 0.18);
                border-color: rgba(74, 222, 128, 0.24);
            }

            body.theme-dark .view-all-btn {
                color: #dcfce7;
                background: rgba(22, 163, 74, 0.18);
                border-color: rgba(74, 222, 128, 0.36);
            }

            body.theme-dark .footer-links a {
                border-color: rgba(148, 163, 184, 0.16);
                background: rgba(15, 23, 42, 0.62);
                color: rgba(248, 250, 252, 0.92);
            }

            body.theme-dark .footer-links a:hover { color: #86efac; }

            /* Scroll reveal animation */
            .reveal-on-scroll {
                opacity: 0;
                transform: translateY(18px);
                transition: opacity 0.45s ease, transform 0.45s ease;
                transition-delay: var(--reveal-delay, 0ms);
            }

            .reveal-on-scroll.is-revealed {
                opacity: 1;
                transform: translateY(0);
            }

            /* Responsive */
            @media (max-width: 980px) {
                .site-header-inner { flex-wrap: wrap; align-items: center; }
                .article-grid { grid-template-columns: 1fr; }
                .news-grid { grid-template-columns: 1fr; }
                .cta-band { grid-template-columns: 1fr; }
                .footer-inner { grid-template-columns: 1fr; }
                .contact-grid { grid-template-columns: 1fr; }
                .field-grid { grid-template-columns: 1fr; }
                .form-row { grid-template-columns: 1fr; }
            }

            @media (max-width: 640px) {
                .intro-section {
                    min-height: 100svh;
                    padding: 110px 0 64px;
                    align-items: flex-start;
                }
                .intro-copy p { font-size: 1.08rem; }
                .intro-copy { text-align: left; }
                .section-header { flex-direction: column; align-items: flex-start; }
                .cta-copy h3 { font-size: 1.6rem; }
                .site-nav { display: none; width: 100%; }
                .site-nav.is-open { display: flex; gap: 14px; padding-top: 10px; }
                .menu-btn { display: inline-flex; }
                .site-header-inner { align-items: center; }
                .site-brand { min-width: 0; }
                .site-brand-copy { display: none; }
                .floating-social-left { left: 10px; }
                .floating-whatsapp-right {
                    right: 10px;
                    bottom: 78px;
                }
                .floating-ai-assistant {
                    right: 10px;
                    bottom: 126px;
                }
                .ai-chat-panel {
                    right: 10px;
                    bottom: 176px;
                    width: calc(100vw - 20px);
                }
                .ai-assistant-btn {
                    min-height: 42px;
                    padding-right: 12px;
                    font-size: 0.82rem;
                }
                .ai-dot { width: 26px; height: 26px; font-size: 0.8rem; }
                .floating-link { width: 40px; height: 40px; font-size: 0.88rem; }
            }
        </style>
    </head>

    <body>
        <div class="landing-page">
            <a class="back-to-top" href="#home" aria-label="Back to top">↑</a>

            <div class="floating-social-left" aria-label="Floating social media">
                <a class="floating-link" href="#" aria-label="Instagram" title="Instagram">
                    <svg class="social-svg" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="5"></rect>
                        <circle cx="12" cy="12" r="4"></circle>
                        <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor"></circle>
                    </svg>
                </a>
                <a class="floating-link" href="#" aria-label="LinkedIn" title="LinkedIn">
                    <svg class="social-svg-fill" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6.94 8.5a1.86 1.86 0 1 1 0-3.72 1.86 1.86 0 0 1 0 3.72zM5.35 9.75h3.17V19H5.35V9.75zm5.02 0h3.03v1.26h.04c.42-.8 1.45-1.65 2.98-1.65 3.18 0 3.77 2.1 3.77 4.82V19H17v-4.25c0-1.01-.02-2.32-1.41-2.32-1.42 0-1.64 1.1-1.64 2.24V19h-3.58V9.75z"/>
                    </svg>
                </a>
                <a class="floating-link" href="#" aria-label="X (Twitter)" title="X (Twitter)">
                    <svg class="social-svg-fill" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M18.9 3h2.9l-6.33 7.24L23 21h-5.87l-4.6-6.1L7.2 21H4.28l6.77-7.74L1 3h6.02l4.16 5.5L18.9 3zm-1.03 16.2h1.62L6.14 4.72H4.4L17.87 19.2z"/>
                    </svg>
                </a>
            </div>

            <div class="floating-whatsapp-right" aria-label="WhatsApp">
                <a class="floating-link whatsapp" href="#" aria-label="WhatsApp" title="WhatsApp">
                    <svg class="social-svg-fill" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M20.52 3.48A11.86 11.86 0 0 0 12.06 0C5.5 0 .16 5.34.16 11.9c0 2.1.55 4.15 1.6 5.95L0 24l6.35-1.66a11.86 11.86 0 0 0 5.7 1.45h.01c6.56 0 11.9-5.34 11.9-11.9 0-3.18-1.24-6.18-3.44-8.41zM12.06 21.8h-.01a9.9 9.9 0 0 1-5.04-1.38l-.36-.21-3.77.98 1-3.67-.24-.37a9.91 9.91 0 0 1-1.53-5.25c0-5.45 4.43-9.88 9.89-9.88 2.64 0 5.12 1.03 6.98 2.9a9.82 9.82 0 0 1 2.9 6.98c0 5.45-4.43 9.89-9.88 9.89zm5.43-7.43c-.3-.15-1.77-.87-2.05-.97-.27-.1-.46-.15-.65.15-.19.3-.75.97-.92 1.16-.17.2-.34.22-.64.08-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.75-1.64-2.05-.17-.3-.02-.46.13-.61.14-.14.3-.34.45-.51.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.08-.15-.65-1.57-.9-2.15-.23-.55-.47-.47-.64-.48h-.55c-.2 0-.52.08-.8.37-.27.3-1.04 1.01-1.04 2.46 0 1.45 1.07 2.86 1.22 3.06.15.2 2.1 3.2 5.08 4.49.71.31 1.27.5 1.7.64.71.23 1.36.2 1.87.12.57-.09 1.77-.72 2.02-1.41.25-.69.25-1.28.17-1.4-.08-.12-.27-.2-.57-.35z"/>
                    </svg>
                </a>
            </div>

            <div class="floating-ai-assistant" aria-label="AI assistant">
                <button class="ai-assistant-btn" type="button" title="Afya Bot assistant" id="aiAssistantToggle">
                    <span class="ai-dot"><img src="{{ asset('images/logo.jpeg') }}" alt="Afya Bot"></span>
                    <span>Afya Bot</span>
                </button>
            </div>

            <aside class="ai-chat-panel" id="aiChatPanel" aria-label="Afya Bot chat">
                <div class="ai-chat-header">
                    <div class="ai-chat-title">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Afya Bot logo">
                        <span>Afya Bot</span>
                    </div>
                    <button class="ai-chat-close" type="button" id="aiChatClose" aria-label="Close chat">✕</button>
                </div>
                <div class="ai-chat-messages" id="aiChatMessages">
                    <div class="ai-msg bot">Hi, I'm Afya Bot. Ask me about articles, health news, or finding contact details.</div>
                </div>
                <form class="ai-chat-input" id="aiChatForm">
                    <input id="aiChatInput" type="text" placeholder="Type your question..." autocomplete="off" />
                    <button type="submit">Send</button>
                </form>
            </aside>

            <header class="site-header" id="home">
                <div class="container site-header-inner">
                    <a class="site-brand" href="#home" aria-label="Afya Mtandaoni home">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Afya Mtandaoni logo">
                        <span class="site-brand-copy">
                            <span class="site-brand-name">AFYA MTANDAONI</span>
                            <span class="site-brand-tagline">Health Awareness &amp; Publications</span>
                        </span>
                    </a>

                    <nav class="site-nav" id="primaryNav" aria-label="Primary navigation">
                        <a href="#home">Home</a>
                        <a href="#articles">Articles</a>
                        <a href="#news">Health News</a>
                        <a href="#topics">Topics</a>
                        <a href="#newsletter">Newsletter</a>
                        <a href="#contact">Contact</a>
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

            <main>
                <section class="intro-section reveal-on-scroll">
                    <div class="container intro-copy">
                        <p class="section-kicker">AFYA MTANDAONI</p>
                        <h1>Professional <span class="hero-highlight">Health Awareness</span> Through Trusted Articles &amp; News</h1>
                        <p>
                            Access credible, reader-friendly health education, prevention guidance, and
                            timely wellness updates designed for individuals, families, and communities.
                        </p>
                    </div>
                </section>

                <section class="articles-section reveal-on-scroll" id="articles">
                    <div class="container">
                        <header class="section-header">
                            <div>
                                <p class="section-kicker">LATEST ARTICLES</p>
                                <h2 class="section-title">Newly Published Articles</h2>
                            </div>
                            <a class="section-link" href="{{ route('articles.index') }}">Browse all articles</a>
                        </header>

                        <div class="article-grid">
                            @forelse ($latestArticles as $article)
                                <article class="article-card">
                                    @php
                                        $authorName = $article instanceof \App\Models\Article
                                            ? $article->authorDisplayName()
                                            : ($article->author_name ?? config('app.name'));
                                        $readSource = trim((string) ($article->body ?? $article->excerpt ?? ''));
                                        $wordCount = max(str_word_count(strip_tags($readSource)), 140);
                                        $readTime = max(1, (int) ceil($wordCount / 200));
                                        preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', (string) ($article->body ?? ''), $articleImageMatch);
                                        $articleImage = $articleImageMatch[1] ?? $article->cover_image_url ?? null;
                                        if (empty($articleImage) || \Illuminate\Support\Str::startsWith((string) $articleImage, 'data:image')) {
                                            $articleImage = 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1200&q=80';
                                        }
                                        $articleSnippet = \Illuminate\Support\Str::limit(strip_tags((string) ($article->excerpt ?? $article->body ?? '')), 170);
                                    @endphp
                                    <img
                                        src="{{ $articleImage }}"
                                        alt="{{ $article->title ?? 'Health article cover' }}"
                                        loading="lazy"
                                    >
                                    <div class="article-card-body">
                                        <div class="article-meta">
                                            <span class="article-chip">Article</span>
                                            @if (!empty($article->published_at))
                                                <time datetime="{{ \Illuminate\Support\Carbon::parse($article->published_at)->toDateString() }}">
                                                    {{ \Illuminate\Support\Carbon::parse($article->published_at)->format('M j, Y') }}
                                                </time>
                                            @endif
                                        </div>
                                        <h2>{{ $article->title }}</h2>
                                        @if (!empty($articleSnippet))
                                            <p>{{ $articleSnippet }}</p>
                                        @endif
                                        <div class="article-meta-extra">
                                            <span class="meta-pill">By {{ $authorName }}</span>
                                            @if (!empty($article->published_at))
                                                <span class="meta-pill">{{ \Illuminate\Support\Carbon::parse($article->published_at)->format('M j, Y') }}</span>
                                            @endif
                                            <span class="meta-pill">{{ $readTime }} min read</span>
                                        </div>
                                        <a href="{{ route('articles.show', $article->slug) }}" aria-label="Read {{ $article->title }}">Read full article</a>
                                    </div>
                                </article>
                            @empty
                                <div class="empty-state">
                                    <h3>No articles yet</h3>
                                    <p>Once you publish articles, they’ll appear here automatically.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="articles-actions">
                            <a class="view-all-btn" href="{{ route('articles.index') }}">View All Articles</a>
                        </div>
                    </div>
                </section>

                <section class="news-section reveal-on-scroll" id="news">
                    <div class="container">
                        <header class="section-header">
                            <div>
                                <p class="section-kicker">LATEST HEALTH NEWS</p>
                                <h2 class="section-title">Health Updates &amp; Headlines</h2>
                            </div>
                            <a class="section-link" href="{{ route('news.index') }}">Browse all health news</a>
                        </header>

                        <div class="news-grid">
                            @forelse ($latestNews as $news)
                                <article class="news-card">
                                    @php
                                        $newsImage = $news->image_url
                                            ?? ('https://source.unsplash.com/featured/800x500?health,' . urlencode((string) ($news->headline ?? 'news')));
                                        $newsAuthor = $news instanceof \App\Models\HealthNews
                                            ? $news->authorDisplayName()
                                            : ($news->author_name ?? config('app.name'));
                                    @endphp
                                    <img class="news-media" src="{{ $newsImage }}" alt="{{ ($news->headline ?? 'Health news') . ' cover' }}" loading="lazy">
                                    <div class="news-card-body">
                                        <div class="news-meta">
                                            <span class="article-chip">News</span>
                                            @if (!empty($news->published_at))
                                                <time datetime="{{ \Illuminate\Support\Carbon::parse($news->published_at)->toDateString() }}">
                                                    {{ \Illuminate\Support\Carbon::parse($news->published_at)->format('M j, Y') }}
                                                </time>
                                            @endif
                                        </div>
                                        <h3 class="news-title">{{ $news->headline }}</h3>
                                        @if (!empty($news->summary))
                                            <div class="news-summary">{{ \Illuminate\Support\Str::limit(strip_tags((string) $news->summary), 170) }}</div>
                                        @endif
                                        <div class="news-footer">
                                            <span class="news-source">By {{ $newsAuthor }} · {{ $news->source_name ?? 'Health News' }}</span>

                                            @if (!empty($news->source_url))
                                                <a class="news-link" href="{{ route('news.show', $news->slug) }}">Read full news</a>
                                            @else
                                                <a class="news-link" href="{{ route('news.show', $news->slug) }}">Learn more</a>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="empty-state">
                                    <h3>No news yet</h3>
                                    <p>Add health news updates and they’ll show up here.</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="articles-actions">
                            <a class="view-all-btn" href="{{ route('news.index') }}">View All Health News</a>
                        </div>
                    </div>
                </section>

                <section class="topics-section reveal-on-scroll" id="topics">
                    <div class="container">
                        <header class="section-header">
                            <div>
                                <p class="section-kicker">TOPICS</p>
                                <h2 class="section-title">Browse Topics</h2>
                            </div>
                        </header>

                        <div class="topics-row">
                            <span>Nutrition</span>
                            <span>Mental Wellbeing</span>
                            <span>Family Health</span>
                            <span>Prevention</span>
                            <span>Healthy Living</span>
                        </div>
                    </div>
                </section>

                <section class="cta-section reveal-on-scroll" id="newsletter">
                    <div class="container">
                        <div class="cta-band">
                            <div class="cta-copy">
                                <p class="section-kicker" style="-webkit-text-fill-color: unset; background: none; color: rgba(255, 255, 255, 0.9);">NEWSLETTER</p>
                                <h3>Subscribe and get new posts in your inbox</h3>
                                <p>Get the latest articles and health news updates as soon as they’re published.</p>
                                <p class="cta-form-note">No spam. Unsubscribe anytime.</p>
                            </div>

                            <div
                                id="newsletter-feedback"
                                class="form-feedback {{ session('newsletter_status') ? 'form-feedback--newsletter-success' : '' }}"
                                role="status"
                                aria-live="polite"
                                @if (session('newsletter_status')) style="display:block" @else style="display:none" @endif
                            >
                                @if (session('newsletter_status'))
                                    {{ session('newsletter_status') }}
                                @endif
                            </div>

                            <form id="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="post" class="newsletter-form" aria-label="Newsletter subscribe form">
                                @csrf
                                <div class="form-row">
                                    <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required autocomplete="email">
                                    <button class="btn" type="submit" data-label="Subscribe">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <section class="contact-section reveal-on-scroll" id="contact">
                    <div class="container">
                        <header class="section-header">
                            <div>
                                <p class="section-kicker">CONTACT</p>
                                <h2 class="section-title">Send us a message</h2>
                            </div>
                            <a class="section-link" href="#home">Back to top</a>
                        </header>

                        <div class="contact-grid">
                            <div class="contact-card">
                                <div class="contact-card-body">
                                    <div
                                        id="contact-feedback"
                                        class="form-feedback {{ session('status') ? 'form-feedback--contact-success' : '' }}"
                                        role="status"
                                        aria-live="polite"
                                        @if (session('status')) style="display:block" @else style="display:none" @endif
                                    >
                                        @if (session('status'))
                                            {{ session('status') }}
                                        @endif
                                    </div>
                                    <form id="contact-form" action="{{ route('contact.submit') }}" method="post" aria-label="Contact form">
                                        @csrf
                                        <div class="field-grid">
                                            <div>
                                                <label class="label" for="name">Full name</label>
                                                <input class="input" id="name" name="name" type="text" placeholder="Your name" value="{{ old('name') }}" required autocomplete="name">
                                            </div>
                                            <div>
                                                <label class="label" for="contact_email">Email</label>
                                                <input class="input" id="contact_email" name="email" type="email" placeholder="you@example.com" value="{{ old('email') }}" required autocomplete="email">
                                            </div>
                                        </div>

                                        <div style="margin-top:12px;">
                                            <label class="label" for="subject">Subject</label>
                                            <input class="input" id="subject" name="subject" type="text" placeholder="How can we help?" value="{{ old('subject') }}">
                                        </div>

                                        <div style="margin-top:12px;">
                                            <label class="label" for="message">Message</label>
                                            <textarea class="textarea" id="message" name="message" placeholder="Write your message..." required>{{ old('message') }}</textarea>
                                        </div>

                                        <div style="margin-top:12px;">
                                            <button class="btn" type="submit" data-label="Send message">Send message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="contact-card" aria-label="Location map">
                                <iframe
                                    class="map-frame"
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    src="https://www.google.com/maps?q=Mwanza%2C%20Tanzania&output=embed"
                                    title="Location map"
                                ></iframe>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="site-footer">
                <div class="container footer-inner">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Afya Mtandaoni logo">
                            <span class="footer-name">Afya Mtandaoni</span>
                        </div>
                        <p class="footer-copy">
                            Health awareness online through blog posts, articles, and health news.
                        </p>

                        <div class="footer-meta" aria-label="Contact information">
                            <span><strong>Location:</strong> Mwanza, Tanzania</span>
                            <span><strong>Email:</strong> info@afya-mtandaoni.test</span>
                            <span><strong>Phone:</strong> +255 000 000 000</span>
                        </div>

                        <div class="footer-links" aria-label="Footer quick links">
                            <a href="#home">Home</a>
                            <a href="#articles">Articles</a>
                            <a href="#news">Health News</a>
                            <a href="#topics">Topics</a>
                            <a href="#newsletter">Newsletter</a>
                            <a href="#contact">Contact</a>
                        </div>

                        <div class="social-row" aria-label="Social media links">
                            <a class="social-link" href="#" aria-label="Instagram" title="Instagram">
                                <svg class="social-svg" viewBox="0 0 24 24" aria-hidden="true">
                                    <rect x="3" y="3" width="18" height="18" rx="5"></rect>
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor"></circle>
                                </svg>
                            </a>
                            <a class="social-link" href="#" aria-label="LinkedIn" title="LinkedIn">
                                <svg class="social-svg-fill" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6.94 8.5a1.86 1.86 0 1 1 0-3.72 1.86 1.86 0 0 1 0 3.72zM5.35 9.75h3.17V19H5.35V9.75zm5.02 0h3.03v1.26h.04c.42-.8 1.45-1.65 2.98-1.65 3.18 0 3.77 2.1 3.77 4.82V19H17v-4.25c0-1.01-.02-2.32-1.41-2.32-1.42 0-1.64 1.1-1.64 2.24V19h-3.58V9.75z"/>
                                </svg>
                            </a>
                            <a class="social-link" href="#" aria-label="X (Twitter)" title="X (Twitter)">
                                <svg class="social-svg-fill" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M18.9 3h2.9l-6.33 7.24L23 21h-5.87l-4.6-6.1L7.2 21H4.28l6.77-7.74L1 3h6.02l4.16 5.5L18.9 3zm-1.03 16.2h1.62L6.14 4.72H4.4L17.87 19.2z"/>
                                </svg>
                            </a>
                            <a class="social-link" href="#" aria-label="YouTube" title="YouTube">
                                <svg class="social-svg-fill" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M23.5 7.1a3 3 0 0 0-2.1-2.1C19.5 4.5 12 4.5 12 4.5s-7.5 0-9.4.5A3 3 0 0 0 .5 7.1 31.4 31.4 0 0 0 0 12a31.4 31.4 0 0 0 .5 4.9 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31.4 31.4 0 0 0 24 12a31.4 31.4 0 0 0-.5-4.9zM9.6 15.5v-7l6.1 3.5-6.1 3.5z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container footer-bottom">
                    <span>© {{ now()->year }} Afya Mtandaoni. All rights reserved.</span>
                    <span>Built for accessible, reader-friendly health information.</span>
                </div>
            </footer>
        </div>
        <script>
            (function () {
                const storageKey = 'afya_theme';
                const body = document.body;
                const themeToggle = document.getElementById('themeToggle');
                const menuToggle = document.getElementById('menuToggle');
                const nav = document.getElementById('primaryNav');
                const header = document.querySelector('.site-header');
                const backToTop = document.querySelector('.back-to-top');
                const floatingLeft = document.querySelector('.floating-social-left');
                const floatingWhatsapp = document.querySelector('.floating-whatsapp-right');
                const floatingAi = document.querySelector('.floating-ai-assistant');
                const aiToggle = document.getElementById('aiAssistantToggle');
                const aiPanel = document.getElementById('aiChatPanel');
                const aiClose = document.getElementById('aiChatClose');
                const aiForm = document.getElementById('aiChatForm');
                const aiInput = document.getElementById('aiChatInput');
                const aiMessages = document.getElementById('aiChatMessages');
                const revealItems = document.querySelectorAll('.reveal-on-scroll');

                function csrfToken() {
                    const meta = document.querySelector('meta[name="csrf-token"]');
                    return meta ? meta.getAttribute('content') : '';
                }

                function showFormFeedback(el, message, className) {
                    if (!el) return;
                    el.textContent = message;
                    el.style.display = 'block';
                    el.className = className;
                }

                function bindAjaxForm(form, feedbackEl, successClass, errorClass, onSuccess) {
                    if (!form || !feedbackEl) {
                        return;
                    }
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const defaultBtnText = submitBtn && submitBtn.dataset.label ? submitBtn.dataset.label : (submitBtn ? submitBtn.textContent : '');

                    form.addEventListener('submit', function (e) {
                        e.preventDefault();

                        if (submitBtn) {
                            submitBtn.classList.add('is-loading');
                            submitBtn.disabled = true;
                            submitBtn.textContent = 'Sending…';
                        }

                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                Accept: 'application/json',
                                'X-CSRF-TOKEN': csrfToken(),
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            body: new FormData(form),
                            credentials: 'same-origin',
                        })
                            .then(function (res) {
                                return res.json().then(function (data) {
                                    return { status: res.status, data: data };
                                }).catch(function () {
                                    return {
                                        status: res.status,
                                        data: { message: res.status === 419 ? 'Page expired. Please refresh and try again.' : 'Something went wrong. Please try again.' },
                                    };
                                });
                            })
                            .then(function (result) {
                                if (result.status === 422 && result.data.errors) {
                                    const parts = [];
                                    Object.keys(result.data.errors).forEach(function (k) {
                                        result.data.errors[k].forEach(function (m) {
                                            parts.push(m);
                                        });
                                    });
                                    showFormFeedback(feedbackEl, parts.join(' '), errorClass);
                                    return;
                                }
                                if (result.status >= 200 && result.status < 300) {
                                    showFormFeedback(feedbackEl, result.data.message || 'Done.', successClass);
                                    if (typeof onSuccess === 'function') {
                                        onSuccess();
                                    }
                                    return;
                                }
                                const errMsg = (result.data && result.data.message) ? result.data.message : 'Could not complete your request.';
                                showFormFeedback(feedbackEl, errMsg, errorClass);
                            })
                            .catch(function () {
                                showFormFeedback(feedbackEl, 'Network error. Check your connection and try again.', errorClass);
                            })
                            .finally(function () {
                                if (submitBtn) {
                                    submitBtn.classList.remove('is-loading');
                                    submitBtn.disabled = false;
                                    submitBtn.textContent = defaultBtnText;
                                }
                            });
                    });
                }

                bindAjaxForm(
                    document.getElementById('newsletter-form'),
                    document.getElementById('newsletter-feedback'),
                    'form-feedback form-feedback--newsletter-success',
                    'form-feedback form-feedback--newsletter-error',
                    function () {
                        document.getElementById('newsletter-form').reset();
                    }
                );

                bindAjaxForm(
                    document.getElementById('contact-form'),
                    document.getElementById('contact-feedback'),
                    'form-feedback form-feedback--contact-success',
                    'form-feedback form-feedback--contact-error',
                    function () {
                        document.getElementById('contact-form').reset();
                    }
                );

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

                function syncFloatingSocials() {
                    const show = window.scrollY > 120;
                    if (floatingLeft) floatingLeft.classList.toggle('is-visible', show);
                    if (floatingWhatsapp) floatingWhatsapp.classList.toggle('is-visible', show);
                    if (floatingAi) floatingAi.classList.toggle('is-visible', show);
                }

                syncHeader();
                syncFloatingSocials();
                window.addEventListener('scroll', syncHeader, { passive: true });
                window.addEventListener('scroll', syncFloatingSocials, { passive: true });

                if (menuToggle && nav) {
                    menuToggle.addEventListener('click', function () {
                        nav.classList.toggle('is-open');
                        const isOpen = nav.classList.contains('is-open');
                        menuToggle.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
                    });
                }

                if (nav) {
                    nav.addEventListener('click', function (e) {
                        const target = e.target;
                        if (target && target.tagName === 'A') {
                            nav.classList.remove('is-open');
                        }
                    });
                }

                if (backToTop) {
                    backToTop.addEventListener('click', function (e) {
                        e.preventDefault();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    });
                }

                function addChatMessage(text, role) {
                    if (!aiMessages) return;
                    const bubble = document.createElement('div');
                    bubble.className = 'ai-msg ' + role;
                    bubble.textContent = text;
                    aiMessages.appendChild(bubble);
                    aiMessages.scrollTop = aiMessages.scrollHeight;
                }

                function botReply(userText) {
                    const q = userText.toLowerCase();
                    if (q.includes('article')) return 'You can explore our latest publications in the Articles section.';
                    if (q.includes('news')) return 'Check the Health News section for recent updates and headlines.';
                    if (q.includes('contact') || q.includes('location')) return 'You can reach us through the Contact form or find us in Mwanza, Tanzania.';
                    if (q.includes('subscribe') || q.includes('newsletter')) return 'Use the Newsletter section to subscribe and receive new health posts.';
                    return 'I can help you navigate Articles, Health News, Newsletter, and Contact. What would you like to open?';
                }

                function openChat() {
                    if (!aiPanel) return;
                    aiPanel.classList.add('is-open');
                    if (aiInput) aiInput.focus();
                }

                function closeChat() {
                    if (!aiPanel) return;
                    aiPanel.classList.remove('is-open');
                }

                if (aiToggle) {
                    aiToggle.addEventListener('click', function () {
                        if (!aiPanel) return;
                        aiPanel.classList.toggle('is-open');
                        if (aiPanel.classList.contains('is-open') && aiInput) aiInput.focus();
                    });
                }

                if (aiClose) {
                    aiClose.addEventListener('click', function () {
                        closeChat();
                    });
                }

                if (aiForm) {
                    aiForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        if (!aiInput) return;
                        const text = aiInput.value.trim();
                        if (!text) return;
                        addChatMessage(text, 'user');
                        aiInput.value = '';
                        window.setTimeout(function () {
                            addChatMessage(botReply(text), 'bot');
                        }, 320);
                    });
                }

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') closeChat();
                });

                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-revealed');
                                observer.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

                    revealItems.forEach(function (el, index) {
                        el.style.setProperty('--reveal-delay', Math.min(index * 60, 220) + 'ms');
                        observer.observe(el);
                    });
                } else {
                    revealItems.forEach(function (el) { el.classList.add('is-revealed'); });
                }
            })();
        </script>
    </body>
</html>