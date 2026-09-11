export default () => ({
    theme:
        document.documentElement.dataset.adminTheme === 'light'
            ? 'light'
            : 'dark',
    menuOpen: false,
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        document.documentElement.dataset.adminTheme = this.theme;
        try {
            localStorage.setItem('barbershop-admin-theme', this.theme);
        } catch {}
    },
});
