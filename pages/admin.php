<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>پنل مدیریت | R_REX Admin</title>
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/variables.css">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/components.css">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/pages.css">
  <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
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
        <span class="badge badge-primary">پنل مدیریت</span>
      </div>
      <div class="navbar-actions">
        <button class="theme-toggle"></button>
        <div class="notification-bell">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="notification-count">۵</span>
        </div>
        <div class="navbar-user">
          <div class="navbar-user-avatar" style="background:var(--color-danger-500)">م</div>
          <div class="navbar-user-info hide-md">
            <span class="navbar-user-name">مدیر سیستم</span>
            <span class="navbar-user-role">ادمین</span>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="sidebar-overlay" onclick="Components.sidebar.toggleMobile()"></div>

  <div class="layout-dashboard">
    <!-- Admin Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-section">
        <div class="sidebar-section-title"> مدیریت</div>
        <nav class="sidebar-nav">
          <a href="admin.html" class="sidebar-link active">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            <span class="sidebar-link-text">داشبورد</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            <span class="sidebar-link-text">کاربران</span>
            <span class="sidebar-link-badge">۴۵K</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            <span class="sidebar-link-text">محصولات</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
            <span class="sidebar-link-text">پروژه‌ها</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <span class="sidebar-link-text">سفارشات</span>
            <span class="sidebar-link-badge">۱۲</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
            <span class="sidebar-link-text">مالی</span>
          </a>
        </nav>
      </div>

      <div class="sidebar-section">
        <div class="sidebar-section-title">محتوا</div>
        <nav class="sidebar-nav">
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            <span class="sidebar-link-text">بلاگ</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <span class="sidebar-link-text">رسانه</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="4 7 4 4 20 4 20 7"/><line x1="9" y1="20" x2="15" y2="20"/><line x1="12" y1="4" x2="12" y2="20"/></svg>
            <span class="sidebar-link-text">CMS</span>
          </a>
        </nav>
      </div>

      <div class="sidebar-section">
        <div class="sidebar-section-title">سیستم</div>
        <nav class="sidebar-nav">
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
            <span class="sidebar-link-text">تنظیمات</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span class="sidebar-link-text">امنیت</span>
          </a>
          <a href="#" class="sidebar-link">
            <svg class="sidebar-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            <span class="sidebar-link-text">گزارش‌ها</span>
          </a>
        </nav>
      </div>
    </aside>

    <!-- Admin Content -->
    <main class="main-content">
      <div class="page-header">
        <div class="page-header-row">
          <div>
            <h1 class="page-title">داشبورد مدیریت</h1>
            <p class="page-subtitle">نمای کلی سیستم R_REX</p>
          </div>
          <div class="flex gap-3">
            <button class="btn btn-secondary btn-sm">گزارش جامع</button>
            <button class="btn btn-primary btn-sm">+ محصول جدید</button>
          </div>
        </div>
      </div>

      <!-- Admin Stats -->
      <div class="dashboard-stats">
        <div class="stat-card">
          <div class="stat-icon" style="background:var(--accent-50);color:var(--accent-600)">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
          </div>
          <div class="stat-value">۴۵,۲۸۰</div>
          <div class="stat-label">کل کاربران</div>
          <div class="stat-change positive">+۱۲٪ ماهانه</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background:var(--color-success-50);color:var(--color-success-600)">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
          </div>
          <div class="stat-value">۱۲۵,۰۰۰,۰۰۰</div>
          <div class="stat-label">کل درآمد (تومان)</div>
          <div class="stat-change positive">+۲۵٪ ماهانه</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(139,92,246,0.1);color:#8b5cf6">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
          </div>
          <div class="stat-value">۱۲,۳۵۰</div>
          <div class="stat-label">کل سفارشات</div>
          <div class="stat-change positive">+۸٪ ماهانه</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(245,158,11,0.1);color:#f59e0b">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          </div>
          <div class="stat-value">۸۵</div>
          <div class="stat-label">تیکت‌های باز</div>
          <div class="stat-change negative">-۵٪ ماهانه</div>
        </div>
      </div>

      <!-- Charts Row -->
      <div class="content-grid" style="grid-template-columns: 1fr 1fr; margin-bottom: var(--space-6)">
        <div class="chart-container">
          <div class="chart-header">
            <div class="chart-title">فروش ماهانه</div>
          </div>
          <div class="chart-body" style="display:flex;align-items:flex-end;gap:var(--space-3);padding:var(--space-4) 0">
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--accent-primary);border-radius:var(--radius-md) var(--radius-md) 0 0;height:35%;opacity:0.7"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۱</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--accent-primary);border-radius:var(--radius-md) var(--radius-md) 0 0;height:55%;opacity:0.7"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۲</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--accent-primary);border-radius:var(--radius-md) var(--radius-md) 0 0;height:40%;opacity:0.7"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۳</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--accent-primary);border-radius:var(--radius-md) var(--radius-md) 0 0;height:75%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۴</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--accent-primary);border-radius:var(--radius-md) var(--radius-md) 0 0;height:60%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۵</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--accent-primary);border-radius:var(--radius-md) var(--radius-md) 0 0;height:85%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۶</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--accent-primary);border-radius:var(--radius-md) var(--radius-md) 0 0;height:70%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۷</span>
            </div>
          </div>
        </div>

        <div class="chart-container">
          <div class="chart-header">
            <div class="chart-title">کاربران جدید</div>
          </div>
          <div class="chart-body" style="display:flex;align-items:flex-end;gap:var(--space-3);padding:var(--space-4) 0">
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--color-success-500);border-radius:var(--radius-md) var(--radius-md) 0 0;height:45%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۱</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--color-success-500);border-radius:var(--radius-md) var(--radius-md) 0 0;height:60%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۲</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--color-success-500);border-radius:var(--radius-md) var(--radius-md) 0 0;height:50%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۳</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--color-success-500);border-radius:var(--radius-md) var(--radius-md) 0 0;height:80%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۴</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--color-success-500);border-radius:var(--radius-md) var(--radius-md) 0 0;height:65%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۵</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--color-success-500);border-radius:var(--radius-md) var(--radius-md) 0 0;height:90%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۶</span>
            </div>
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:var(--space-2)">
              <div style="width:100%;background:var(--color-success-500);border-radius:var(--radius-md) var(--radius-md) 0 0;height:75%"></div>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۷</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Orders Table -->
      <div class="card">
        <div class="card-header">
          <span class="card-title" style="margin:0">آخرین سفارشات</span>
          <button class="btn btn-ghost btn-xs">مشاهده همه</button>
        </div>
        <div class="table-wrapper" style="border:none;border-radius:0">
          <table class="table">
            <thead>
              <tr>
                <th>شماره</th>
                <th>کاربر</th>
                <th>محصول</th>
                <th>مبلغ</th>
                <th>وضعیت</th>
                <th>تاریخ</th>
                <th>عملیات</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>#۱۲۳۴</td>
                <td>
                  <div class="flex items-center gap-2">
                    <div class="avatar avatar-sm" style="background:var(--accent-50);color:var(--accent-600)">م</div>
                    <span>محمد رضایی</span>
                  </div>
                </td>
                <td>قالب شرکتی مدرن</td>
                <td style="font-weight:var(--font-weight-semibold)">۳۴۹,۰۰۰</td>
                <td><span class="badge badge-success">تکمیل</span></td>
                <td>۱۴۰۵/۰۴/۱۰</td>
                <td><button class="btn btn-ghost btn-xs">مشاهده</button></td>
              </tr>
              <tr>
                <td>#۱۲۳۳</td>
                <td>
                  <div class="flex items-center gap-2">
                    <div class="avatar avatar-sm" style="background:rgba(139,92,246,0.1);color:#8b5cf6">س</div>
                    <span>سارا احمدی</span>
                  </div>
                </td>
                <td>اشتراک Pro</td>
                <td style="font-weight:var(--font-weight-semibold)">۴۹۹,۰۰۰</td>
                <td><span class="badge badge-warning">در انتظار</span></td>
                <td>۱۴۰۵/۰۴/۰۹</td>
                <td><button class="btn btn-ghost btn-xs">مشاهده</button></td>
              </tr>
              <tr>
                <td>#۱۲۳۲</td>
                <td>
                  <div class="flex items-center gap-2">
                    <div class="avatar avatar-sm" style="background:var(--color-success-50);color:var(--color-success-600)">ع</div>
                    <span>عرفان کریمی</span>
                  </div>
                </td>
                <td>کیت طراحی UI/UX</td>
                <td style="font-weight:var(--font-weight-semibold)">۵۹۰,۰۰۰</td>
                <td><span class="badge badge-success">تکمیل</span></td>
                <td>۱۴۰۵/۰۴/۰۸</td>
                <td><button class="btn btn-ghost btn-xs">مشاهده</button></td>
              </tr>
              <tr>
                <td>#۱۲۳۱</td>
                <td>
                  <div class="flex items-center gap-2">
                    <div class="avatar avatar-sm" style="background:var(--color-warning-50);color:var(--color-warning-600)">ن</div>
                    <span>نیلوفر شریفی</span>
                  </div>
                </td>
                <td>پلاگین VS Code</td>
                <td style="font-weight:var(--font-weight-semibold)">۱۹۹,۰۰۰</td>
                <td><span class="badge badge-success">تکمیل</span></td>
                <td>۱۴۰۵/۰۴/۰۷</td>
                <td><button class="btn btn-ghost btn-xs">مشاهده</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <script src="../js/theme.js"></script>
  <script src="../js/components.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>
