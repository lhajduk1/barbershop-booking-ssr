<button type="button" @click="toggleTheme()" :aria-label="theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme'" class="admin-outline inline-flex min-h-11 items-center gap-2 px-3 text-xs font-medium">
    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" class="size-4"><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.5" /><path d="M12 2v2m0 16v2M2 12h2m16 0h2M5 5l1.5 1.5m11 11L19 19M5 19l1.5-1.5m11-11L19 5" stroke="currentColor" stroke-width="1.5" /></svg>
    <span x-text="theme === 'dark' ? 'Light mode' : 'Dark mode'">Change theme</span>
</button>
