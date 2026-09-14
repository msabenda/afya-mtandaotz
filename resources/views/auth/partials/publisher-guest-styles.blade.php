<style>
    :root {
        --page-bg: linear-gradient(145deg, #ecfdf5 0%, #f8fafc 45%, #e0f2fe 100%);
        --card-bg: rgba(255, 255, 255, 0.92);
        --card-border: rgba(22, 163, 74, 0.18);
        --text: #0f172a;
        --muted: #64748b;
        --line: rgba(15, 23, 42, 0.1);
        --input-bg: #ffffff;
        --green: #16a34a;
        --green-dark: #15803d;
        --shadow: 0 22px 60px rgba(15, 23, 42, 0.12);
    }
    body.theme-dark {
        --page-bg: linear-gradient(145deg, #020617 0%, #0f172a 50%, #022c22 100%);
        --card-bg: rgba(15, 23, 42, 0.88);
        --card-border: rgba(52, 211, 153, 0.22);
        --text: #f1f5f9;
        --muted: #94a3b8;
        --line: rgba(148, 163, 184, 0.2);
        --input-bg: rgba(2, 6, 23, 0.55);
        --shadow: 0 24px 70px rgba(0, 0, 0, 0.45);
    }
    * { box-sizing: border-box; }
    body {
        margin: 0;
        min-height: 100vh;
        font-family: 'Mulish', system-ui, sans-serif;
        color: var(--text);
        background: var(--page-bg);
        display: grid;
        place-items: center;
        padding: 24px 16px;
    }
    .shell { width: min(440px, 100%); }
    .top-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }
    .nav-links { display: flex; flex-wrap: wrap; align-items: center; gap: 10px 14px; }
    .home-link, .text-link {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--green);
        text-decoration: none;
    }
    .text-link { font-weight: 600; }
    .home-link:hover, .text-link:hover { text-decoration: underline; }
    body.theme-dark .home-link, body.theme-dark .text-link { color: #4ade80; }
    .theme-btn {
        border: 1px solid var(--line);
        background: var(--card-bg);
        color: var(--text);
        border-radius: 999px;
        padding: 8px 14px;
        font: inherit;
        font-weight: 700;
        font-size: 0.82rem;
        cursor: pointer;
        backdrop-filter: blur(8px);
    }
    .theme-btn:hover { border-color: rgba(22, 163, 74, 0.35); }
    .card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 20px;
        padding: 28px 26px 26px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(12px);
    }
    .brand {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 22px;
    }
    .brand img {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        object-fit: cover;
        border: 2px solid rgba(22, 163, 74, 0.25);
    }
    .brand h1 {
        margin: 0;
        font-family: 'Outfit', system-ui, sans-serif;
        font-size: 1.45rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1.15;
    }
    .brand p {
        margin: 4px 0 0;
        font-size: 0.88rem;
        color: var(--muted);
        font-weight: 600;
    }
    .notice {
        padding: 11px 13px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 16px;
        line-height: 1.45;
    }
    .notice--success {
        background: rgba(22, 163, 74, 0.12);
        color: var(--green-dark);
        border: 1px solid rgba(22, 163, 74, 0.22);
    }
    body.theme-dark .notice--success {
        background: rgba(22, 163, 74, 0.15);
        color: #bbf7d0;
    }
    .notice--error {
        background: rgba(239, 68, 68, 0.1);
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.22);
    }
    body.theme-dark .notice--error {
        background: rgba(239, 68, 68, 0.12);
        color: #fecaca;
    }
    .notice--info {
        background: rgba(59, 130, 246, 0.1);
        color: #1d4ed8;
        border: 1px solid rgba(59, 130, 246, 0.22);
        font-weight: 600;
    }
    body.theme-dark .notice--info {
        background: rgba(59, 130, 246, 0.15);
        color: #bfdbfe;
    }
    .field { display: grid; gap: 7px; margin-bottom: 14px; }
    .field label {
        font-size: 0.82rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        color: var(--muted);
    }
    .field input, .field textarea {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 13px 14px;
        font: inherit;
        font-size: 1rem;
        color: var(--text);
        background: var(--input-bg);
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .field input:focus, .field textarea:focus {
        border-color: rgba(22, 163, 74, 0.45);
        box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.12);
    }
    .field-code input {
        text-align: center;
        letter-spacing: 0.35em;
        font-size: 1.35rem;
        font-weight: 800;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        padding: 16px 14px;
    }
    .otp-panel {
        margin-bottom: 18px;
        padding: 18px 16px;
        border-radius: 16px;
        background: rgba(22, 163, 74, 0.08);
        border: 1px solid rgba(22, 163, 74, 0.2);
        text-align: center;
    }
    body.theme-dark .otp-panel {
        background: rgba(22, 163, 74, 0.12);
        border-color: rgba(52, 211, 153, 0.25);
    }
    .otp-panel .otp-label {
        margin: 0 0 10px;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--green-dark);
    }
    body.theme-dark .otp-panel .otp-label { color: #86efac; }
    .remember {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        font-size: 0.92rem;
        font-weight: 600;
        color: var(--muted);
    }
    .remember input { width: 16px; height: 16px; accent-color: var(--green); }
    .submit {
        width: 100%;
        border: none;
        border-radius: 14px;
        padding: 14px 16px;
        font: inherit;
        font-weight: 800;
        font-size: 1rem;
        cursor: pointer;
        color: #fff;
        background: linear-gradient(135deg, var(--green) 0%, #0b1220 125%);
        box-shadow: 0 10px 28px rgba(22, 163, 74, 0.28);
        transition: transform 0.15s ease, filter 0.15s ease;
    }
    .submit:hover { transform: translateY(-1px); filter: brightness(1.03); }
    .submit:active { transform: translateY(0); }
    .btn-secondary {
        width: 100%;
        margin-top: 10px;
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 12px 16px;
        font: inherit;
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        color: var(--text);
        background: rgba(241, 245, 249, 0.85);
    }
    body.theme-dark .btn-secondary {
        background: rgba(30, 41, 59, 0.85);
        border-color: rgba(148, 163, 184, 0.25);
        color: #e2e8f0;
    }
    .btn-secondary:hover { filter: brightness(0.98); }
    .hint {
        margin: 16px 0 0;
        font-size: 0.86rem;
        color: var(--muted);
        line-height: 1.55;
        text-align: center;
    }
    .flow-copy { margin: 0 0 18px; font-size: 0.95rem; line-height: 1.65; color: var(--muted); }
    .flow-copy strong { color: var(--text); }
</style>
