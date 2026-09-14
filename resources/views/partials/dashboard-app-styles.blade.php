<style>
    :root {
        --dash-bg: #f4f7fb;
        --dash-card: #ffffff;
        --dash-text: #0f172a;
        --dash-muted: #64748b;
        --dash-line: #e2e8f0;
        --dash-green: #16a34a;
        --dash-green-soft: rgba(22, 163, 74, 0.1);
        --dash-shadow: 0 14px 36px rgba(15, 23, 42, 0.08);
        --dash-code: #0d9488;
        --dash-log-bg: #0f172a;
        --dash-log-fg: #cbd5e1;
    }
    body.theme-dark {
        --dash-bg: #070b12;
        --dash-card: rgba(15, 23, 42, 0.92);
        --dash-text: #f1f5f9;
        --dash-muted: #94a3b8;
        --dash-line: rgba(148, 163, 184, 0.22);
        --dash-green-soft: rgba(22, 163, 74, 0.18);
        --dash-shadow: 0 14px 40px rgba(0, 0, 0, 0.42);
        --dash-code: #38bdf8;
        --dash-log-bg: #020617;
        --dash-log-fg: #e2e8f0;
    }
    * { box-sizing: border-box; }
    body.dash-app-body {
        margin: 0;
        font-family: 'Mulish', Arial, sans-serif;
        background: var(--dash-bg);
        color: var(--dash-text);
        min-height: 100vh;
    }
    body.dash-app-body::before {
        content: '';
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: -1;
        background:
            linear-gradient(rgba(22, 163, 74, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(22, 163, 74, 0.04) 1px, transparent 1px),
            radial-gradient(900px 520px at 20% 0%, rgba(22, 163, 74, 0.07) 0%, transparent 65%);
        background-size: 32px 32px, 32px 32px, auto;
        opacity: 1;
    }
    body.theme-dark.dash-app-body::before {
        opacity: 0.55;
    }
    .dash-app-shell { min-height: 100vh; display: grid; grid-template-columns: 280px 1fr; }
    .dash-sidebar {
        background: linear-gradient(180deg, #052e16 0%, #064e3b 55%, #022c22 100%);
        color: #ecfdf5;
        padding: 20px 16px;
        display: grid;
        grid-template-rows: auto 1fr auto;
        gap: 18px;
        position: sticky;
        top: 0;
        height: 100vh;
        border-right: 1px solid rgba(255, 255, 255, 0.08);
    }
    .dash-brand { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: 12px; background: rgba(255, 255, 255, 0.08); }
    .dash-brand img { width: 42px; height: 42px; border-radius: 10px; object-fit: cover; border: 1px solid rgba(255, 255, 255, 0.2); }
    .dash-brand strong { display: block; font-size: 0.98rem; letter-spacing: 0.01em; font-weight: 800; }
    .dash-brand small { color: rgba(236, 253, 245, 0.78); font-size: 0.8rem; }
    .dash-menu { display: grid; gap: 8px; align-content: start; }
    .dash-menu a {
        text-decoration: none;
        color: #ecfdf5;
        font-weight: 700;
        padding: 10px 12px;
        border-radius: 10px;
        background: transparent;
        border: 1px solid transparent;
        font-size: 0.92rem;
    }
    .dash-menu a:hover,
    .dash-menu a.active {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.24);
    }
    .dash-sidebar-footer form { margin: 0; }
    .dash-main { padding: 20px; }
    .dash-topbar {
        background: var(--dash-card);
        border: 1px solid var(--dash-line);
        border-radius: 14px;
        box-shadow: var(--dash-shadow);
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }
    .dash-topbar h1 { margin: 0; font-size: 1.1rem; font-weight: 800; color: var(--dash-text); }
    .dash-topbar p { margin: 3px 0 0; color: var(--dash-muted); font-size: 0.92rem; line-height: 1.45; }
    .dash-topbar-meta { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .dash-topbar-date { font-size: 0.85rem; color: var(--dash-muted); font-weight: 600; }
    .theme-btn {
        border: 1px solid var(--dash-line);
        background: var(--dash-card);
        color: var(--dash-text);
        border-radius: 999px;
        padding: 8px 14px;
        font: inherit;
        font-weight: 700;
        font-size: 0.82rem;
        cursor: pointer;
    }
    .theme-btn:hover { border-color: rgba(22, 163, 74, 0.35); }
    .dash-card {
        background: var(--dash-card);
        border: 1px solid var(--dash-line);
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 14px;
        box-shadow: var(--dash-shadow);
    }
    .dash-grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .dash-grid--stats { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
    .dash-btn {
        border: none;
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 800;
        cursor: pointer;
        background: var(--dash-green);
        color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-family: inherit;
    }
    .dash-btn-outline { background: var(--dash-card); color: #166534; border: 1px solid #86efac; }
    body.theme-dark .dash-btn-outline {
        background: rgba(30, 41, 59, 0.6);
        color: #bbf7d0;
        border-color: rgba(74, 222, 128, 0.35);
    }
    .dash-btn-danger { background: #b91c1c; color: #fff; border: none; }
    .dash-btn-danger:hover { filter: brightness(1.05); }
    .dash-table { width: 100%; border-collapse: collapse; font-size: 0.88rem; }
    .dash-table th, .dash-table td { padding: 10px; border-bottom: 1px solid var(--dash-line); text-align: left; vertical-align: top; }
    .dash-table th {
        color: var(--dash-muted);
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 800;
    }
    .dash-field { display: grid; gap: 6px; margin-bottom: 10px; }
    .dash-field label {
        font-size: 0.78rem;
        font-weight: 800;
        color: var(--dash-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .dash-field input, .dash-field textarea, .dash-field select {
        border: 1px solid var(--dash-line);
        border-radius: 10px;
        padding: 10px 12px;
        font: inherit;
        width: 100%;
        max-width: 100%;
        background: var(--dash-card);
        color: var(--dash-text);
    }
    body.theme-dark .dash-field input,
    body.theme-dark .dash-field textarea,
    body.theme-dark .dash-field select {
        background: rgba(2, 6, 23, 0.45);
    }
    .dash-field input:focus, .dash-field textarea:focus, .dash-field select:focus {
        outline: none;
        border-color: rgba(22, 163, 74, 0.45);
        box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
    }
    .dash-status {
        padding: 10px 14px;
        border-radius: 10px;
        background: rgba(22, 163, 74, 0.12);
        color: #166534;
        margin-bottom: 12px;
        font-weight: 700;
        border: 1px solid rgba(22, 163, 74, 0.22);
    }
    body.theme-dark .dash-status {
        background: rgba(22, 163, 74, 0.15);
        color: #bbf7d0;
        border-color: rgba(52, 211, 153, 0.25);
    }
    .dash-error { color: #b91c1c; font-size: 0.9rem; }
    body.theme-dark .dash-error { color: #fecaca; }
    .dash-stat {
        padding: 14px;
        border-radius: 12px;
        border: 1px solid var(--dash-line);
        background: var(--dash-card);
        box-shadow: var(--dash-shadow);
    }
    .dash-stat strong { display: block; font-size: 1.65rem; color: var(--dash-green); font-weight: 800; }
    .dash-stat span { color: var(--dash-muted); font-size: 0.85rem; font-weight: 600; }
    .dash-stat-tile { border: 1px solid var(--dash-line); border-radius: 14px; padding: 16px; box-shadow: var(--dash-shadow); }
    .dash-stat-tile h3 { margin: 0 0 8px; font-size: 1rem; font-weight: 800; }
    .dash-stat-tile .dash-stat-num { font-size: 2rem; font-weight: 800; line-height: 1.1; }
    .dash-stat-tile .dash-stat-meta { margin-top: 8px; font-size: 0.9rem; font-weight: 600; }
    .dash-stat-tile--articles {
        background: linear-gradient(135deg, #ecfdf3 0%, #d1fae5 100%);
        color: #166534;
    }
    .dash-stat-tile--articles .dash-stat-num { color: #065f46; }
    .dash-stat-tile--articles .dash-stat-meta { color: #166534; }
    .dash-stat-tile--blue {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #1d4ed8;
    }
    .dash-stat-tile--blue .dash-stat-num { color: #1e40af; }
    .dash-stat-tile--blue .dash-stat-meta { color: #1e3a8a; }
    .dash-stat-tile--orange {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        color: #c2410c;
    }
    .dash-stat-tile--orange .dash-stat-num { color: #9a3412; }
    .dash-stat-tile--orange .dash-stat-meta { color: #9a3412; }
    .dash-stat-tile--violet {
        background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);
        color: #6d28d9;
    }
    .dash-stat-tile--violet .dash-stat-num { color: #5b21b6; }
    .dash-stat-tile--violet .dash-stat-meta { color: #5b21b6; }
    body.theme-dark .dash-stat-tile--articles {
        background: linear-gradient(135deg, rgba(6, 78, 59, 0.55) 0%, rgba(15, 23, 42, 0.9) 100%);
        color: #bbf7d0;
        border-color: rgba(52, 211, 153, 0.2);
    }
    body.theme-dark .dash-stat-tile--articles .dash-stat-num { color: #86efac; }
    body.theme-dark .dash-stat-tile--articles .dash-stat-meta { color: #a7f3d0; }
    body.theme-dark .dash-stat-tile--blue {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.5) 0%, rgba(15, 23, 42, 0.92) 100%);
        color: #bfdbfe;
        border-color: rgba(96, 165, 250, 0.25);
    }
    body.theme-dark .dash-stat-tile--blue .dash-stat-num { color: #93c5fd; }
    body.theme-dark .dash-stat-tile--blue .dash-stat-meta { color: #dbeafe; }
    body.theme-dark .dash-stat-tile--orange {
        background: linear-gradient(135deg, rgba(154, 52, 18, 0.45) 0%, rgba(15, 23, 42, 0.92) 100%);
        color: #fed7aa;
        border-color: rgba(251, 146, 60, 0.25);
    }
    body.theme-dark .dash-stat-tile--orange .dash-stat-num { color: #fdba74; }
    body.theme-dark .dash-stat-tile--orange .dash-stat-meta { color: #ffedd5; }
    body.theme-dark .dash-stat-tile--violet {
        background: linear-gradient(135deg, rgba(91, 33, 182, 0.45) 0%, rgba(15, 23, 42, 0.92) 100%);
        color: #e9d5ff;
        border-color: rgba(167, 139, 250, 0.3);
    }
    body.theme-dark .dash-stat-tile--violet .dash-stat-num { color: #d8b4fe; }
    body.theme-dark .dash-stat-tile--violet .dash-stat-meta { color: #ede9fe; }
    .dash-list-row {
        padding: 10px;
        border: 1px solid var(--dash-line);
        border-radius: 10px;
        display: flex;
        gap: 10px;
    }
    .dash-list-row .dash-muted { color: var(--dash-muted); font-size: 0.9rem; }
    .news-thumb, .article-thumb {
        width: 74px;
        height: 52px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--dash-line);
    }
    .dash-pre-log {
        background: var(--dash-log-bg);
        color: var(--dash-log-fg);
        padding: 14px;
        border-radius: 12px;
        overflow: auto;
        max-height: 70vh;
        font-size: 0.78rem;
        line-height: 1.45;
        border: 1px solid var(--dash-line);
        margin: 0;
    }
    .dash-code-inline { color: var(--dash-code); font-size: 0.9em; }
    .dash-hint { margin: 12px 0 0; color: var(--dash-muted); font-size: 0.88rem; line-height: 1.5; }
    .dash-toast-host {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10050;
        width: min(360px, calc(100vw - 28px));
        pointer-events: none;
    }
    .dash-toast {
        pointer-events: auto;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        padding: 14px 16px;
        border-radius: 14px;
        margin: 0;
        border: 1px solid #86efac;
        background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%);
        color: #14532d;
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.14);
        animation: dashToastIn 0.38s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    body.theme-dark .dash-toast {
        border-color: rgba(52, 211, 153, 0.35);
        background: linear-gradient(135deg, rgba(6, 78, 59, 0.95) 0%, rgba(15, 23, 42, 0.98) 100%);
        color: #dcfce7;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.45);
    }
    @keyframes dashToastIn {
        from { opacity: 0; transform: translateX(14px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .dash-toast strong { display: block; font-size: 1rem; margin-bottom: 4px; }
    .dash-toast p { margin: 0; font-size: 0.9rem; color: #166534; line-height: 1.45; }
    body.theme-dark .dash-toast p { color: #bbf7d0; }
    .dash-toast-close {
        flex-shrink: 0;
        border: none;
        background: rgba(22, 163, 74, 0.12);
        color: #14532d;
        width: 32px;
        height: 32px;
        border-radius: 10px;
        font-size: 1.1rem;
        line-height: 1;
        cursor: pointer;
        font-weight: 800;
    }
    body.theme-dark .dash-toast-close {
        background: rgba(22, 163, 74, 0.2);
        color: #ecfdf5;
    }
    .pagination { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; }
    .pagination a, .pagination span {
        padding: 6px 11px;
        border-radius: 8px;
        border: 1px solid var(--dash-line);
        color: var(--dash-text);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        background: var(--dash-card);
    }
    .pagination .active span { background: var(--dash-green-soft); border-color: rgba(22, 163, 74, 0.35); color: var(--dash-green); }
    @media (max-width: 980px) {
        .dash-app-shell { grid-template-columns: 1fr; }
        .dash-sidebar { position: static; height: auto; grid-template-rows: auto; }
        .dash-menu { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .dash-main { padding: 14px; }
    }
    @media (max-width: 800px) {
        .dash-grid { grid-template-columns: 1fr; }
        .dash-menu { grid-template-columns: 1fr; }
    }
    @media (max-width: 520px) {
        .dash-toast-host { top: 12px; right: 12px; left: 12px; width: auto; }
    }

    /* Publisher screens: legacy utility names map to the same design tokens */
    .dash-main .card {
        background: var(--dash-card);
        border: 1px solid var(--dash-line);
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 14px;
        box-shadow: var(--dash-shadow);
    }
    .dash-main .grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .dash-main .btn {
        border: none;
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 800;
        cursor: pointer;
        background: var(--dash-green);
        color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-family: inherit;
    }
    .dash-main .btn-outline { background: var(--dash-card); color: #166534; border: 1px solid #86efac; }
    body.theme-dark .dash-main .btn-outline {
        background: rgba(30, 41, 59, 0.6);
        color: #bbf7d0;
        border-color: rgba(74, 222, 128, 0.35);
    }
    .dash-main .table { width: 100%; border-collapse: collapse; }
    .dash-main .table th, .dash-main .table td { padding: 10px; border-bottom: 1px solid var(--dash-line); text-align: left; vertical-align: top; }
    .dash-main .table th { color: var(--dash-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.02em; font-weight: 800; }
    .dash-main .field { display: grid; gap: 6px; margin-bottom: 10px; }
    .dash-main .field input, .dash-main .field textarea {
        border: 1px solid var(--dash-line);
        border-radius: 8px;
        padding: 10px;
        font: inherit;
        width: 100%;
        background: var(--dash-card);
        color: var(--dash-text);
    }
    body.theme-dark .dash-main .field input,
    body.theme-dark .dash-main .field textarea {
        background: rgba(2, 6, 23, 0.45);
    }
    .dash-main .error { color: #b91c1c; font-size: 0.9rem; }
    body.theme-dark .dash-main .error { color: #fecaca; }
    @media (max-width: 800px) {
        .dash-main .grid { grid-template-columns: 1fr; }
    }
</style>
