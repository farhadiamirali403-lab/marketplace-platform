<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>کیف پول | R_REX</title>
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/variables.css">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/components.css">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/pages.css">
  <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar-inner">
      <div class="flex items-center gap-4">
        <button class="mobile-menu-toggle" onclick="Components.sidebar.toggleMobile()">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <a href="../index.html" class="navbar-brand">
          <div class="navbar-logo">R</div>
          <span class="navbar-brand-text">R_REX</span>
        </a>
      </div>
      <div class="navbar-actions">
        <button class="theme-toggle"></button>
        <div class="notification-bell">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="notification-count">۲</span>
        </div>
        <div class="navbar-user">
          <div class="navbar-user-avatar">ع</div>
          <div class="navbar-user-info hide-md">
            <span class="navbar-user-name">علی محمدی</span>
            <span class="navbar-user-role">توسعه‌دهنده</span>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="sidebar-overlay" onclick="Components.sidebar.toggleMobile()"></div>

  <div class="layout-dashboard">
    <aside class="sidebar">
      <div class="sidebar-section">
        <div class="sidebar-section-title">منوی اصلی</div>
        <nav class="sidebar-nav">
          <a href="dashboard.html" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            <span class="sidebar-link-text">داشبورد</span>
          </a>
          <a href="wallet.html" class="sidebar-link active">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
            <span class="sidebar-link-text">کیف پول</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            <span class="sidebar-link-text">سفارشات من</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            <span class="sidebar-link-text">دانلودها</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <span class="sidebar-link-text">پروفایل</span>
          </a>
        </nav>
      </div>
    </aside>

    <main class="main-content">
      <!-- Page Header -->
      <div class="page-header">
        <div class="page-header-row">
          <div>
            <h1 class="page-title">کیف پول</h1>
            <p class="page-subtitle">مدیریت مالی و تراکنش‌ها</p>
          </div>
        </div>
      </div>

      <!-- Balance Card -->
      <div class="wallet-balance" style="margin-bottom:var(--space-6)">
        <div class="wallet-balance-label">موجودی کیف پول</div>
        <div class="wallet-balance-amount">۲,۴۵۰,۰۰۰ تومان</div>
        <div class="wallet-balance-actions">
          <button class="btn" onclick="Components.modal.open('deposit-modal')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            افزایش موجودی
          </button>
          <button class="btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
            برداشت
          </button>
          <button class="btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
            تاریخچه تراکنش‌ها
          </button>
        </div>
      </div>

      <!-- Quick Stats -->
      <div class="content-grid content-grid-4" style="margin-bottom:var(--space-6)">
        <div class="stat-card">
          <div class="stat-icon" style="background:var(--color-success-50);color:var(--color-success-500)">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
          </div>
          <div class="stat-value">۱۲,۵۰۰,۰۰۰</div>
          <div class="stat-label">کل درآمد (تومان)</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:var(--color-danger-50);color:var(--color-danger-500)">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/></svg>
          </div>
          <div class="stat-value">۱۰,۰۵۰,۰۰۰</div>
          <div class="stat-label">کل برداشت (تومان)</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(139,92,246,0.1);color:#8b5cf6">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
          </div>
          <div class="stat-value">۴۵</div>
          <div class="stat-label">تعداد تراکنش</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(245,158,11,0.1);color:#f59e0b">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
          </div>
          <div class="stat-value">۱۵۰,۰۰۰</div>
          <div class="stat-label">کش‌بک دریافتی (تومان)</div>
        </div>
      </div>

      <!-- Transactions -->
      <div class="card">
        <div class="card-header">
          <span class="card-title" style="margin:0">آخرین تراکنش‌ها</span>
          <div class="flex gap-2">
            <button class="btn btn-secondary btn-xs">همه</button>
            <button class="btn btn-ghost btn-xs">واریزی</button>
            <button class="btn btn-ghost btn-xs">برداشت</button>
          </div>
        </div>
        <div class="card-body" style="padding:0">
          <div class="transaction-list" style="padding:0 var(--space-6)">
            <div class="transaction-item">
              <div class="transaction-icon income">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
              </div>
              <div class="transaction-info">
                <div class="transaction-title">فروش قالب شرکتی مدرن</div>
                <div class="transaction-desc">از فروشگاه دیجیتال</div>
              </div>
              <div class="transaction-amount income">+۳۴۹,۰۰۰ تومان</div>
              <div class="transaction-date">۱۴۰۵/۰۴/۱۰</div>
            </div>
            <div class="transaction-item">
              <div class="transaction-icon income">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
              </div>
              <div class="transaction-info">
                <div class="transaction-title">تکمیل پروژه</div>
                <div class="transaction-desc">پروژه اپلیکیشن فینتک</div>
              </div>
              <div class="transaction-amount income">+۵,۰۰۰,۰۰۰ تومان</div>
              <div class="transaction-date">۱۴۰۵/۰۴/۰۸</div>
            </div>
            <div class="transaction-item">
              <div class="transaction-icon expense">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/></svg>
              </div>
              <div class="transaction-info">
                <div class="transaction-title">خرید اشتراک Pro</div>
                <div class="transaction-desc">اشتراک ۳ ماهه</div>
              </div>
              <div class="transaction-amount expense">-۸۹۰,۰۰۰ تومان</div>
              <div class="transaction-date">۱۴۰۵/۰۴/۰۵</div>
            </div>
            <div class="transaction-item">
              <div class="transaction-icon expense">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/></svg>
              </div>
              <div class="transaction-info">
                <div class="transaction-title">برداشت به حساب بانکی</div>
                <div class="transaction-desc">حساب بانک ملت</div>
              </div>
              <div class="transaction-amount expense">-۲,۰۰۰,۰۰۰ تومان</div>
              <div class="transaction-date">۱۴۰۵/۰۴/۰۳</div>
            </div>
            <div class="transaction-item">
              <div class="transaction-icon income">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
              </div>
              <div class="transaction-info">
                <div class="transaction-title">کش‌بک خرید</div>
                <div class="transaction-desc">۱۰٪ کش‌بک خرید اشتراک</div>
              </div>
              <div class="transaction-amount income">+۸۹,۰۰۰ تومان</div>
              <div class="transaction-date">۱۴۰۵/۰۴/۰۵</div>
            </div>
          </div>
        </div>
        <div class="card-footer flex justify-center">
          <button class="btn btn-ghost btn-sm">مشاهده همه تراکنش‌ها</button>
        </div>
      </div>
    </main>
  </div>

  <!-- Deposit Modal -->
  <div id="deposit-modal" class="modal-overlay">
    <div class="modal" style="max-width:28rem">
      <div class="modal-header">
        <h3 class="modal-title">افزایش موجودی</h3>
        <button class="modal-close" onclick="Components.modal.close('deposit-modal')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-4">
          <label class="form-label">مبلغ (تومان)</label>
          <input type="text" class="form-input form-input-lg" placeholder="مبلغ مورد نظر را وارد کنید">
        </div>
        <div class="form-group mb-4">
          <label class="form-label">روش پرداخت</label>
          <div class="flex flex-col gap-3">
            <label class="form-check" style="padding:var(--space-3);border:1px solid var(--border-primary);border-radius:var(--radius-lg);cursor:pointer">
              <input type="radio" name="payment" checked>
              <span class="form-check-label">درگاه پرداخت آنلاین</span>
            </label>
            <label class="form-check" style="padding:var(--space-3);border:1px solid var(--border-primary);border-radius:var(--radius-lg);cursor:pointer">
              <input type="radio" name="payment">
              <span class="form-check-label">کارت به کارت</span>
            </label>
            <label class="form-check" style="padding:var(--space-3);border:1px solid var(--border-primary);border-radius:var(--radius-lg);cursor:pointer">
              <input type="radio" name="payment">
              <span class="form-check-label">گیفت کارت</span>
            </label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" onclick="Components.modal.close('deposit-modal')">انصراف</button>
        <button class="btn btn-primary" onclick="Components.toast.show({type:'success',title:'موفق!',message:'در حال انتقال به درگاه پرداخت...'})">پرداخت</button>
      </div>
    </div>
  </div>

  <script src="../js/theme.js"></script>
  <script src="../js/components.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>
