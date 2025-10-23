const themeBtn = document.getElementById('theme-btn');
const html = document.documentElement;

const theme = localStorage.getItem('theme') || 'dark';
html.setAttribute('data-theme', theme);

themeBtn.addEventListener('click', () => {
    const curTheme = html.getAttribute('data-theme');
    const newTheme = curTheme === 'light' ? 'dark' : 'light';
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
});