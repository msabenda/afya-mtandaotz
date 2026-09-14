<script>
    (function () {
        var key = 'afya_dashboard_theme';
        var body = document.body;
        var btn = document.getElementById('themeToggle');
        function apply(t) {
            var dark = t === 'dark';
            body.classList.toggle('theme-dark', dark);
            if (btn) {
                btn.textContent = dark ? 'Light mode' : 'Dark mode';
                btn.setAttribute('aria-label', dark ? 'Switch to light mode' : 'Switch to dark mode');
            }
        }
        var saved = null;
        try {
            saved = localStorage.getItem(key) || localStorage.getItem('afya_publisher_theme');
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
