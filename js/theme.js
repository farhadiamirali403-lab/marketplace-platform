/* ============================================
   R_REX - Theme Manager
   ============================================ */

const ThemeManager = {
  STORAGE_KEY: 'rrex-theme',
  THEMES: { ARCTIC: 'arctic', DARK: 'dark' },

  init() {
    const saved = localStorage.getItem(this.STORAGE_KEY);
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const theme = saved || (prefersDark ? this.THEMES.DARK : this.THEMES.ARCTIC);
    this.apply(theme);

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
      if (!localStorage.getItem(this.STORAGE_KEY)) {
        this.apply(e.matches ? this.THEMES.DARK : this.THEMES.ARCTIC);
      }
    });
  },

  apply(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    this.updateToggleIcons(theme);
    localStorage.setItem(this.STORAGE_KEY, theme);
    window.dispatchEvent(new CustomEvent('themechange', { detail: { theme } }));
  },

  toggle() {
    const current = document.documentElement.getAttribute('data-theme');
    const next = current === this.THEMES.DARK ? this.THEMES.ARCTIC : this.THEMES.DARK;
    this.apply(next);
  },

  get() {
    return document.documentElement.getAttribute('data-theme') || this.THEMES.ARCTIC;
  },

  updateToggleIcons(theme) {
    document.querySelectorAll('.theme-toggle').forEach(btn => {
      const sunIcon = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>`;
      const moonIcon = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>`;
      btn.innerHTML = theme === this.THEMES.DARK ? sunIcon : moonIcon;
      btn.setAttribute('data-tooltip', theme === this.THEMES.DARK ? 'حالت روشن' : 'حالت تاریک');
    });
  }
};

document.addEventListener('DOMContentLoaded', () => ThemeManager.init());
