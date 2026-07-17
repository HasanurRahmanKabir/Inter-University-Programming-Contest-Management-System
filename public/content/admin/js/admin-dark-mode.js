document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtns = document.querySelectorAll('.theme-toggle-btn');
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Apply theme on initial load
    if (currentTheme === 'dark') {
        document.body.setAttribute('data-theme', 'dark');
    }

    themeToggleBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            let theme = document.body.getAttribute('data-theme');
            if (theme === 'dark') {
                document.body.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            } else {
                document.body.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    });
});

// Immediately apply theme before DOMContentLoaded to prevent white flash (FOUC)
(function () {
    if (localStorage.getItem('theme') === 'dark') {
        document.body.setAttribute('data-theme', 'dark');
    }
})();
