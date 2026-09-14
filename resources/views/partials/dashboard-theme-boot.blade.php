<script>
    (function () {
        try {
            var k = 'afya_dashboard_theme';
            var s = localStorage.getItem(k) || localStorage.getItem('afya_publisher_theme');
            var dark = s ? s === 'dark' : window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (dark) {
                document.body.classList.add('theme-dark');
            }
        } catch (e) {}
    })();
</script>
