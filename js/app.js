/* ============================================
   R_REX - Main Application
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
  // Initialize all accordions
  document.querySelectorAll('.accordion').forEach(acc => Components.accordion.init(acc));
  
  // Initialize all dropdowns
  document.querySelectorAll('.dropdown > button, .dropdown > [data-toggle]').forEach(btn => {
    Components.dropdown.init(btn);
  });
  
  // Initialize all tab containers
  document.querySelectorAll('.tabs-container').forEach(tabs => Components.tabs.init(tabs));
  
  // Theme toggles
  document.querySelectorAll('.theme-toggle').forEach(btn => {
    btn.addEventListener('click', () => ThemeManager.toggle());
  });

  // Sidebar toggles
  document.querySelectorAll('.sidebar-toggle').forEach(btn => {
    btn.addEventListener('click', () => Components.sidebar.toggle());
  });
  
  document.querySelectorAll('.mobile-menu-toggle').forEach(btn => {
    btn.addEventListener('click', () => Components.sidebar.toggleMobile());
  });

  // Search triggers
  document.querySelectorAll('.navbar-search-btn, [data-search]').forEach(btn => {
    btn.addEventListener('click', () => Components.search.open());
  });
  document.querySelectorAll('#search-modal').forEach(modal => {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) Components.search.close();
    });
  });

  // Notification triggers
  document.querySelectorAll('.notification-bell').forEach(btn => {
    btn.addEventListener('click', () => Components.notifications.toggle());
  });

  // Sidebar overlay close
  document.querySelectorAll('.sidebar-overlay').forEach(overlay => {
    overlay.addEventListener('click', () => Components.sidebar.toggleMobile());
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Lazy loading
  Components.lazyLoad();

  // Initialize navbar scroll effect
  initNavbarScroll();
});

function initNavbarScroll() {
  const navbar = document.querySelector('.navbar');
  if (!navbar) return;
  
  let lastScroll = 0;
  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll > 50) {
      navbar.style.boxShadow = 'var(--shadow-navbar)';
    } else {
      navbar.style.boxShadow = 'none';
    }
    lastScroll = currentScroll;
  }, { passive: true });
}

/* ============================================
   Persian Number Converter
   ============================================ */
function toPersianNum(num) {
  const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
  return String(num).replace(/\d/g, d => persianDigits[d]);
}

function formatPrice(price) {
  return toPersianNum(price.toLocaleString('fa-IR')) + ' تومان';
}

/* ============================================
   Persian Date Formatter
   ============================================ */
function toPersianDate(date) {
  try {
    return new Intl.DateTimeFormat('fa-IR', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    }).format(date);
  } catch {
    return date.toLocaleDateString('fa-IR');
  }
}

function toPersianDateTime(date) {
  try {
    return new Intl.DateTimeFormat('fa-IR', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    }).format(date);
  } catch {
    return date.toLocaleDateString('fa-IR');
  }
}

/* ============================================
   Utility Functions
   ============================================ */
function debounce(fn, ms = 300) {
  let timeout;
  return function (...args) {
    clearTimeout(timeout);
    timeout = setTimeout(() => fn.apply(this, args), ms);
  };
}

function throttle(fn, ms = 300) {
  let last = 0;
  return function (...args) {
    const now = Date.now();
    if (now - last >= ms) {
      last = now;
      fn.apply(this, args);
    }
  };
}

/* ============================================
   Simulated Data Store (for UI demo)
   ============================================ */
const Store = {
  user: {
    name: 'علی محمدی',
    username: '@alimohammadi',
    avatar: null,
    role: 'توسعه‌دهنده',
    balance: 2450000,
    points: 1250,
    level: 3
  },
  notifications: [
    { id: 1, title: 'سفارش جدید', message: 'سفارش شما ثبت شد', time: '۵ دقیقه پیش', unread: true },
    { id: 2, title: 'پرداخت موفق', message: 'مبلغ ۵۰۰,۰۰۰ تومان به کیف پول اضافه شد', time: '۱ ساعت پیش', unread: true },
    { id: 3, title: 'پیام جدید', message: 'پروژه شما با موفقیت تکمیل شد', time: '۳ ساعت پیش', unread: false }
  ]
};
