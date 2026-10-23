document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtns = document.querySelectorAll('.theme-toggle-btn');
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Apply theme on initial load to both html and body
    if (currentTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        document.body.setAttribute('data-theme', 'dark');
    }

    themeToggleBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            let theme = document.body.getAttribute('data-theme') || document.documentElement.getAttribute('data-theme');
            if (theme === 'dark') {
                document.documentElement.removeAttribute('data-theme');
                document.body.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
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

    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (!form || form.tagName !== 'FORM') return;
        if (form.method && form.method.toUpperCase() === 'GET') return;
        if (form.getAttribute('data-submitting') === 'true') {
            e.preventDefault();
            return false;
        }
        form.setAttribute('data-submitting', 'true');
        var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]') || document.activeElement;
        if (submitBtn && (submitBtn.type === 'submit' || submitBtn.tagName === 'BUTTON')) {
            var origWidth = submitBtn.offsetWidth;
            if (origWidth) {
                submitBtn.style.minWidth = origWidth + 'px';
            }
            var textSpan = submitBtn.querySelector('.btn-text');
            if (textSpan) {
                textSpan.textContent = 'Saving...';
            } else if (!submitBtn.querySelector('.spinner-border')) {
                var currentText = submitBtn.innerText.trim();
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> ' + (currentText ? currentText : 'Processing...');
            }
            submitBtn.style.pointerEvents = 'none';
            submitBtn.style.opacity = '0.75';
            setTimeout(function() {
                submitBtn.disabled = true;
            }, 50);
        }
    }, true);
})();
