/* ============================================
   R_REX - UI Components
   ============================================ */

const Components = {
  // ============================================
  // Modal
  // ============================================
  modal: {
    open(id) {
      const overlay = document.getElementById(id);
      if (!overlay) return;
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
      
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) Components.modal.close(id);
      });
      
      const closeBtn = overlay.querySelector('.modal-close');
      if (closeBtn) {
        closeBtn.onclick = () => Components.modal.close(id);
      }

      document.addEventListener('keydown', function handler(e) {
        if (e.key === 'Escape') {
          Components.modal.close(id);
          document.removeEventListener('keydown', handler);
        }
      });
    },
    close(id) {
      const overlay = document.getElementById(id);
      if (!overlay) return;
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }
  },

  // ============================================
  // Drawer
  // ============================================
  drawer: {
    open(id) {
      const drawer = document.getElementById(id);
      const overlay = document.getElementById(`${id}-overlay`);
      if (drawer) drawer.classList.add('active');
      if (overlay) overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    },
    close(id) {
      const drawer = document.getElementById(id);
      const overlay = document.getElementById(`${id}-overlay`);
      if (drawer) drawer.classList.remove('active');
      if (overlay) overlay.classList.remove('active');
      document.body.style.overflow = '';
    }
  },

  // ============================================
  // Toast
  // ============================================
  toast: {
    container: null,
    init() {
      if (this.container) return;
      this.container = document.createElement('div');
      this.container.className = 'toast-container';
      document.body.appendChild(this.container);
    },
    show({ type = 'info', title, message, duration = 4000 }) {
      this.init();
      
      const icons = {
        success: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        danger: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
        warning: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        info: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
      };

      const toast = document.createElement('div');
      toast.className = 'toast';
      toast.innerHTML = `
        <div class="toast-icon">${icons[type] || icons.info}</div>
        <div class="toast-body">
          <div class="toast-title">${title}</div>
          ${message ? `<div class="toast-message">${message}</div>` : ''}
        </div>
        <button class="toast-close" onclick="this.closest('.toast').remove()">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      `;
      
      this.container.appendChild(toast);
      
      if (duration > 0) {
        setTimeout(() => {
          toast.style.opacity = '0';
          toast.style.transform = 'translateX(20px)';
          setTimeout(() => toast.remove(), 300);
        }, duration);
      }
    }
  },

  // ============================================
  // Accordion
  // ============================================
  accordion: {
    init(container) {
      const items = container.querySelectorAll('.accordion-item');
      items.forEach(item => {
        const header = item.querySelector('.accordion-header');
        header.addEventListener('click', () => {
          const isActive = item.classList.contains('active');
          items.forEach(i => i.classList.remove('active'));
          if (!isActive) item.classList.add('active');
        });
      });
    }
  },

  // ============================================
  // Dropdown
  // ============================================
  dropdown: {
    init(trigger) {
      const menu = trigger.nextElementSibling;
      if (!menu) return;
      
      trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        document.querySelectorAll('.dropdown-menu.active').forEach(m => {
          if (m !== menu) m.classList.remove('active');
        });
        menu.classList.toggle('active');
      });
    },
    closeAll() {
      document.querySelectorAll('.dropdown-menu.active').forEach(m => {
        m.classList.remove('active');
      });
    }
  },

  // ============================================
  // Tabs
  // ============================================
  tabs: {
    init(container) {
      const tabs = container.querySelectorAll('.tab');
      const panels = container.querySelectorAll('.tab-panel');
      
      tabs.forEach(tab => {
        tab.addEventListener('click', () => {
          tabs.forEach(t => t.classList.remove('active'));
          panels.forEach(p => p.classList.remove('active'));
          
          tab.classList.add('active');
          const target = container.querySelector(`#${tab.dataset.tab}`);
          if (target) target.classList.add('active');
        });
      });
    }
  },

  // ============================================
  // Search Modal
  // ============================================
  search: {
    open() {
      const modal = document.getElementById('search-modal');
      if (modal) {
        modal.classList.add('active');
        const input = modal.querySelector('input');
        if (input) input.focus();
      }
    },
    close() {
      const modal = document.getElementById('search-modal');
      if (modal) modal.classList.remove('active');
    }
  },

  // ============================================
  // Notification Panel
  // ============================================
  notifications: {
    isOpen: false,
    toggle() {
      const panel = document.getElementById('notification-panel');
      if (!panel) return;
      this.isOpen = !this.isOpen;
      panel.style.display = this.isOpen ? 'block' : 'none';
    },
    close() {
      const panel = document.getElementById('notification-panel');
      if (panel) {
        panel.style.display = 'none';
        this.isOpen = false;
      }
    }
  },

  // ============================================
  // Sidebar Toggle
  // ============================================
  sidebar: {
    toggle() {
      const sidebar = document.querySelector('.sidebar');
      if (sidebar) sidebar.classList.toggle('collapsed');
    },
    toggleMobile() {
      const sidebar = document.querySelector('.sidebar');
      const overlay = document.querySelector('.sidebar-overlay');
      if (sidebar) sidebar.classList.toggle('mobile-open');
      if (overlay) overlay.classList.toggle('active');
      document.body.style.overflow = sidebar.classList.contains('mobile-open') ? 'hidden' : '';
    }
  },

  // ============================================
  // Copy to Clipboard
  // ============================================
  copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
      Components.toast.show({
        type: 'success',
        title: 'کپی شد!',
        message: 'متن با موفقیت کپی شد',
        duration: 2000
      });
    });
  },

  // ============================================
  // Lazy Images
  // ============================================
  lazyLoad() {
    const images = document.querySelectorAll('img[data-src]');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.removeAttribute('data-src');
          observer.unobserve(img);
        }
      });
    });
    images.forEach(img => observer.observe(img));
  }
};

// Global click handler for dropdowns
document.addEventListener('click', () => Components.dropdown.closeAll());

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
  if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
    e.preventDefault();
    Components.search.open();
  }
  if (e.key === 'Escape') {
    Components.search.close();
    Components.notifications.close();
  }
});
