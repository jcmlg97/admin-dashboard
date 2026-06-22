import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// aplicar tema al cargar
const html = document.documentElement;

// toggle global
window.toggleTheme = function () {
    const html = document.documentElement;
    const icon = document.getElementById('themeIcon');

    const isDark = html.classList.contains('dark');

    if (isDark) {
        html.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        if (icon) icon.textContent = '☀️';
    } else {
        html.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        if (icon) icon.textContent = '🌙';
    }
};

// conectar botón
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('themeToggle')
        ?.addEventListener('click', window.toggleTheme);
});