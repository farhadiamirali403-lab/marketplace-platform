<?php
// index.php - صفحه اصلی با تم Arctic

// استارت سشن
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// ============ تعریف متغیرهای پیش‌فرض ============
$is_logged_in = false;
$user_fullname = '';
$user_username = '';
$user_role = 'user';
$user_avatar = 'default.jpg';
$user_id = 0;
$role_persian = 'کاربر';
$first_letter = '؟';

// ============ بررسی لاگین بودن کاربر ============
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    $is_logged_in = true;
    $user_fullname = $_SESSION['fullname'] ?? '';
    $user_username = $_SESSION['username'] ?? '';
    $user_role = $_SESSION['role'] ?? 'user';
    $user_avatar = $_SESSION['avatar'] ?? 'default.jpg';
    $user_id = $_SESSION['user_id'] ?? 0;
    
    // تنظیم نقش فارسی
    $role_persian = ($user_role === 'admin') ? 'مدیر' : 'کاربر';
    
    // حرف اول برای آواتار
    $first_letter = !empty($user_fullname) ? mb_substr($user_fullname, 0, 1, 'UTF-8') : '؟';
}

// پیام خوش‌آمدگویی
$welcome_message = '';
if (isset($_GET['welcome']) && $_GET['welcome'] == 1 && $is_logged_in) {
    $welcome_message = "🎉 خوش آمدید " . htmlspecialchars($user_fullname) . "!";
}

// پیام خروج
$logout_message = '';
if (isset($_GET['message']) && $_GET['message'] == 'شما با موفقیت خارج شدید') {
    $logout_message = "👋 " . htmlspecialchars($_GET['message']);
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="R_REX - پلتفرم دیجیتال ابری ایران | فروشگاه، فریلنسری، کیف پول و بیشتر">
  <meta name="theme-color" content="#3b82f6">
  <title>R_REX | اکوسیستم دیجیتال ابری</title>
  
  <!-- Vazirmatn Font -->
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/pages.css">
  <link rel="stylesheet" href="css/responsive.css">
  
  <style>
    /* استایل‌های اضافی برای نوار بالا */
    .navbar-user-avatar {
      width: 2.2rem;
      height: 2.2rem;
      border-radius: var(--radius-full);
      background: var(--gradient-brand);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: var(--font-size-sm);
      font-weight: var(--font-weight-bold);
      flex-shrink: 0;
      overflow: hidden;
    }
    
    .navbar-user-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .navbar-user-name {
      font-size: var(--font-size-sm);
      font-weight: var(--font-weight-medium);
      color: var(--text-primary);
      line-height: 1.2;
    }
    
    .navbar-user-role {
      font-size: 0.6875rem;
      color: var(--text-tertiary);
    }
    
    .auth-buttons {
      display: flex;
      gap: var(--space-2);
      align-items: center;
    }
    
    .auth-buttons .btn {
      padding: 0.5rem 1rem;
      font-size: var(--font-size-sm);
      border-radius: var(--radius-lg);
    }
    
    .btn-outline-sm {
      padding: 0.4rem 0.8rem;
      font-size: 0.75rem;
      border-radius: var(--radius-lg);
      background: transparent;
      color: var(--text-secondary);
      border: 1px solid var(--border-primary);
      transition: all var(--transition-fast);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: var(--space-1);
    }
    
    .btn-outline-sm:hover {
      background: var(--bg-hover);
      color: var(--text-primary);
      border-color: var(--text-tertiary);
    }
    
    .welcome-banner {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.3);
      color: var(--color-success-500);
      padding: var(--space-3) var(--space-4);
      border-radius: var(--radius-lg);
      margin-bottom: var(--space-4);
      text-align: center;
      font-weight: var(--font-weight-medium);
      animation: fadeIn 0.5s ease;
    }
    
    .logout-banner {
      background: rgba(59, 130, 246, 0.15);
      border: 1px solid rgba(59, 130, 246, 0.3);
      color: var(--accent-400);
      padding: var(--space-3) var(--space-4);
      border-radius: var(--radius-lg);
      margin-bottom: var(--space-4);
      text-align: center;
      font-weight: var(--font-weight-medium);
      animation: fadeIn 0.5s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <!-- ============================================
       NAVBAR
       ============================================ -->
  <nav class="navbar">
    <div class="navbar-inner">
      <!-- Brand -->
      <a href="index.php" class="navbar-brand">
        <div class="navbar-logo">R</div>
        <span class="navbar-brand-text">R_REX</span>
      </a>

      <!-- Nav Links -->
      <div class="navbar-nav hide-md">
        <a href="index.php" class="nav-link active">خانه</a>
        <a href="pages/shop.php" class="nav-link">فروشگاه</a>
        <a href="pages/freelance.php" class="nav-link">فریلنسری</a>
        <a href="pages/courses.php" class="nav-link">آموزش‌ها</a>
        <a href="pages/community.php" class="nav-link">انجمن</a>
        <a href="pages/pricing.php" class="nav-link">اشتراک‌ها</a>
      </div>

      <!-- Actions -->
      <div class="navbar-actions">
        <!-- Search -->
        <button class="navbar-search-btn hide-md" data-search>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <span>جستجو...</span>
        </button>

        <!-- ============ بخش کاربر ============ -->
        <?php if ($is_logged_in === true): ?>
          <!-- کاربر وارد شده -->
          <div class="navbar-user" onclick="window.location.href='pages/dashboard.php'" style="cursor:pointer;">
            <div class="navbar-user-avatar">
              <?php echo htmlspecialchars($first_letter); ?>
            </div>
            <div class="navbar-user-info hide-md">
              <span class="navbar-user-name"><?php echo htmlspecialchars($user_fullname); ?></span>
              <span class="navbar-user-role"><?php echo $role_persian; ?></span>
            </div>
          </div>
          
          <a href="auth/logout.php" class="btn-outline-sm">🚪 خروج</a>
          
        <?php else: ?>
          <!-- کاربر وارد نشده -->
          <div class="auth-buttons">
            <a href="auth/login.php" class="btn btn-outline btn-sm">ورود</a>
            <a href="auth/register.php" class="btn btn-primary btn-sm">ثبت نام</a>
          </div>
        <?php endif; ?>

        <!-- Theme Toggle -->
        <button class="theme-toggle" data-tooltip="حالت تاریک"></button>

        <!-- Notifications -->
        <div class="notification-bell">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="notification-count">۲</span>
        </div>

        <!-- Mobile Menu -->
        <button class="mobile-menu-toggle">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
      </div>
    </div>
  </nav>

  <!-- Notification Panel -->
  <div id="notification-panel" class="notification-panel" style="display:none">
    <div class="notification-panel-header">
      <span class="font-semibold text-sm">اعلان‌ها</span>
      <button class="btn btn-ghost btn-xs">خواندن همه</button>
    </div>
    <div class="notification-panel-body">
      <div class="notification-item unread">
        <div class="notification-item-avatar">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
        </div>
        <div class="notification-item-content">
          <div class="notification-item-text"><strong>سفارش جدید</strong> ثبت شد و در انتظار پرداخت است</div>
          <div class="notification-item-time">۵ دقیقه پیش</div>
        </div>
      </div>
      <div class="notification-item unread">
        <div class="notification-item-avatar">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
        </div>
        <div class="notification-item-content">
          <div class="notification-item-text"><strong>پرداخت موفق</strong> مبلغ ۵۰۰,۰۰۰ تومان به کیف پول اضافه شد</div>
          <div class="notification-item-time">۱ ساعت پیش</div>
        </div>
      </div>
      <div class="notification-item">
        <div class="notification-item-avatar">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        </div>
        <div class="notification-item-content">
          <div class="notification-item-text"><strong>پیام جدید</strong> فریلنسر پروژه شما را تحویل داد</div>
          <div class="notification-item-time">۳ ساعت پیش</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Search Modal -->
  <div id="search-modal" class="search-modal">
    <div class="search-modal-content">
      <div class="search-modal-input">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="جستجوی محصولات، فریلنسرها، دوره‌ها..." autofocus>
        <kbd style="padding:0.25rem 0.5rem;font-size:0.75rem;background:var(--bg-tertiary);border:1px solid var(--border-primary);border-radius:var(--radius-sm);cursor:pointer" onclick="Components.search.close()">ESC</kbd>
      </div>
      <div class="search-modal-results">
        <div class="search-modal-group-title">پیشنهادات</div>
        <div class="search-modal-item">
          <div class="search-modal-item-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <div class="search-modal-item-text">
            <div class="search-modal-item-title">قالب وب‌سایت شرکتی</div>
            <div class="search-modal-item-desc">فروشگاه > قالب HTML</div>
          </div>
        </div>
        <div class="search-modal-item">
          <div class="search-modal-item-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </div>
          <div class="search-modal-item-text">
            <div class="search-modal-item-title">محمد رضایی - طراح UI</div>
            <div class="search-modal-item-desc">فریلنسر > طراحی</div>
          </div>
        </div>
        <div class="search-modal-item">
          <div class="search-modal-item-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
          </div>
          <div class="search-modal-item-text">
            <div class="search-modal-item-title">دوره جامع React.js</div>
            <div class="search-modal-item-desc">آموزش > برنامه‌نویسی</div>
          </div>
        </div>
        <div class="search-modal-group-title">دسته‌بندی‌ها</div>
        <div class="search-modal-item">
          <div class="search-modal-item-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          </div>
          <div class="search-modal-item-text">
            <div class="search-modal-item-title">محصولات دیجیتال</div>
            <div class="search-modal-item-desc">۱,۲۳۴ محصول</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ============================================
       HERO SECTION
       ============================================ -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        اکوسیستم دیجیتال نسل جدید
      </div>
      <h1 class="hero-title">
        پلتفرم <span class="gradient-text">دیجیتال ابری</span> ایران
      </h1>
      <p class="hero-subtitle">
        R_REX ترکیبی از فروشگاه دیجیتال، پلتفرم فریلنسری، کیف پول هوشمند، سیستم اشتراک و باشگاه مشتریان است. یک اکوسیستم کامل برای کسب‌وکار و زندگی دیجیتال شما.
      </p>
      <div class="hero-actions">
        <a href="pages/shop.php" class="btn btn-primary btn-lg">
          شروع خرید
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
        <a href="pages/freelance.php" class="btn btn-outline btn-lg"> استخدام فریلنسر</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat">
          <div class="hero-stat-value">۱۲,۰۰۰+</div>
          <div class="hero-stat-label">محصول دیجیتال</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-value">۸,۵۰۰+</div>
          <div class="hero-stat-label">فریلنسر فعال</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-value">۴۵,۰۰۰+</div>
          <div class="hero-stat-label">کاربر فعال</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-value">۹۸%</div>
          <div class="hero-stat-label">رضایت مشتری</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       FEATURES
       ============================================ -->
  <section class="section">
    <div class="page-container">
      <div class="section-header">
        <div class="section-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          امکانات پلتفرم
        </div>
        <h2 class="section-title">همه چیز در یک پلتفرم</h2>
        <p class="section-desc">از فروشگاه دیجیتال تا فریلنسری، از کیف پول هوشمند تا باشگاه مشتریان، همه آنچه نیاز دارید در R_REX در دسترس شماست.</p>
      </div>

      <div class="features-grid">
        <!-- Feature 1 -->
        <div class="feature-card">
          <div class="feature-icon blue">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
          </div>
          <h3 class="feature-title">فروشگاه دیجیتال</h3>
          <p class="feature-desc">هزاران محصول دیجیتال با کیفیت بالا، از قالب و افزونه تا منابع آموزشی و ابزارهای حرفه‌ای.</p>
        </div>

        <!-- Feature 2 -->
        <div class="feature-card">
          <div class="feature-icon purple">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="16" y1="11" x2="22" y2="11"/></svg>
          </div>
          <h3 class="feature-title">پلتفرم فریلنسری</h3>
          <p class="feature-desc">اتصال کارفرما و فریلنسر با سیستم پرداخت امن، قرارداد هوشمند و مدیریت پروژه حرفه‌ای.</p>
        </div>

        <!-- Feature 3 -->
        <div class="feature-card">
          <div class="feature-icon green">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
          </div>
          <h3 class="feature-title">کیف پول هوشمند</h3>
          <p class="feature-desc">کیف پول دیجیتال با امکان افزایش موجودی، برداشت، گزارش مالی دقیق و دریافت کش‌بک.</p>
        </div>

        <!-- Feature 4 -->
        <div class="feature-card">
          <div class="feature-icon orange">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
          </div>
          <h3 class="feature-title">اشتراک و عضویت</h3>
          <p class="feature-desc">پلن‌های متنوع اشتراک با امکانات ویژه، امتیازات اختصاصی و دسترسی‌های حرفه‌ای.</p>
        </div>

        <!-- Feature 5 -->
        <div class="feature-card">
          <div class="feature-icon pink">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
          </div>
          <h3 class="feature-title">باشگاه مشتریان</h3>
          <p class="feature-desc">سیستم امتیازدهی، سطوح کاربری، ماموریت‌های روزانه، دستاوردها و جوایز ویژه.</p>
        </div>

        <!-- Feature 6 -->
        <div class="feature-card">
          <div class="feature-icon cyan">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
          </div>
          <h3 class="feature-title">آموزش و یادگیری</h3>
          <p class="feature-desc">دوره‌های آموزشی حرفه‌ای، مقالات تخصصی، وبینارها و منابع یادگیری به‌روز.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       POPULAR PRODUCTS
       ============================================ -->
  <section class="section" style="background: var(--bg-secondary)">
    <div class="page-container">
      <div class="section-header">
        <div class="section-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          محبوب‌ترین‌ها
        </div>
        <h2 class="section-title">محصولات پیشنهادی</h2>
        <p class="section-desc">محصولات دیجیتال پرفروش و محبوب که توسط هزاران کاربر تایید شده‌اند.</p>
      </div>

      <div class="content-grid content-grid-4">
        <!-- Product 1 -->
        <div class="product-card">
          <div class="product-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:2rem;">📝</div>
          <div class="product-badge">
            <span class="badge badge-danger">۲۵٪ تخفیف</span>
          </div>
          <div class="product-actions">
            <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="افزودن به علاقه‌مندی">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            </button>
            <button class="btn btn-icon-only btn-sm btn-primary">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            </button>
          </div>
          <div class="product-info">
            <div class="product-category">قالب وب‌سایت</div>
            <div class="product-title">قالب شرکتی مدرن - فریم‌ورک React</div>
            <div class="product-rating">
              <div class="rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              </div>
              <span class="rating-text">(۱۲۸)</span>
            </div>
            <div class="product-price">
              <span class="current-price">۳۴۹,۰۰۰ تومان</span>
              <span class="original-price">۴۶۵,۰۰۰ تومان</span>
            </div>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="product-card">
          <div class="product-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:2rem;">🎨</div>
          <div class="product-info">
            <div class="product-category">طراحی UI/UX</div>
            <div class="product-title">کیت طراحی اپلیکیشن موبایل - Figma</div>
            <div class="product-rating">
              <div class="rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              </div>
              <span class="rating-text">(۲۵۶)</span>
            </div>
            <div class="product-price">
              <span class="current-price">۵۹۰,۰۰۰ تومان</span>
            </div>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="product-card">
          <div class="product-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:2rem;">⚡</div>
          <div class="product-badge">
            <span class="badge badge-success">جدید</span>
          </div>
          <div class="product-info">
            <div class="product-category">ابزار توسعه</div>
            <div class="product-title">پلاگین VS Code - هوش مصنوعی</div>
            <div class="product-rating">
              <div class="rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              </div>
              <span class="rating-text">(۸۹)</span>
            </div>
            <div class="product-price">
              <span class="current-price">۱۹۹,۰۰۰ تومان</span>
            </div>
          </div>
        </div>

        <!-- Product 4 -->
        <div class="product-card">
          <div class="product-image" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:2rem;">📊</div>
          <div class="product-info">
            <div class="product-category">قالب داشبورد</div>
            <div class="product-title">قالب داشبورد مدیریتی - Vue.js</div>
            <div class="product-rating">
              <div class="rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              </div>
              <span class="rating-text">(۳۱۲)</span>
            </div>
            <div class="product-price">
              <span class="current-price">۴۲۰,۰۰۰ تومان</span>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-8">
        <a href="pages/shop.php" class="btn btn-outline btn-lg">
          مشاهده همه محصولات
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>
    </div>
  </section>

  <!-- ============================================
       FREELANCE SECTION
       ============================================ -->
  <section class="section">
    <div class="page-container">
      <div class="section-header">
        <div class="section-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          فریلنسری
        </div>
        <h2 class="section-title">بهترین فریلنسرهای ایران</h2>
        <p class="section-desc">با هزاران فریلنسر حرفه‌ای در حوزه‌های مختلف آشنا شوید و پروژه‌های خود را با کیفیت بالا تحویل بگیرید.</p>
      </div>

      <div class="content-grid content-grid-4">
        <!-- Freelancer 1 -->
        <div class="user-card">
          <div class="user-avatar">م</div>
          <div class="user-name">محمد رضایی</div>
          <div class="user-role">طراح UI/UX</div>
          <div class="product-rating mb-4" style="justify-content:center">
            <div class="rating">
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="rating-text">(۴.۹)</span>
          </div>
          <div class="user-stats">
            <div class="user-stat">
              <div class="user-stat-value">۸۷</div>
              <div class="user-stat-label">پروژه</div>
            </div>
            <div class="user-stat">
              <div class="user-stat-value">۹۸٪</div>
              <div class="user-stat-label">رضایت</div>
            </div>
          </div>
        </div>

        <!-- Freelancer 2 -->
        <div class="user-card">
          <div class="user-avatar">س</div>
          <div class="user-name">سارا احمدی</div>
          <div class="user-role">توسعه‌دهنده فرانت‌اند</div>
          <div class="product-rating mb-4" style="justify-content:center">
            <div class="rating">
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="rating-text">(۴.۷)</span>
          </div>
          <div class="user-stats">
            <div class="user-stat">
              <div class="user-stat-value">۱۲۴</div>
              <div class="user-stat-label">پروژه</div>
            </div>
            <div class="user-stat">
              <div class="user-stat-value">۹۶٪</div>
              <div class="user-stat-label">رضایت</div>
            </div>
          </div>
        </div>

        <!-- Freelancer 3 -->
        <div class="user-card">
          <div class="user-avatar">ع</div>
          <div class="user-name">عرفان کریمی</div>
          <div class="user-role">توسعه‌دهنده بک‌اند</div>
          <div class="product-rating mb-4" style="justify-content:center">
            <div class="rating">
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="rating-text">(۴.۸)</span>
          </div>
          <div class="user-stats">
            <div class="user-stat">
              <div class="user-stat-value">۶۵</div>
              <div class="user-stat-label">پروژه</div>
            </div>
            <div class="user-stat">
              <div class="user-stat-value">۹۹٪</div>
              <div class="user-stat-label">رضایت</div>
            </div>
          </div>
        </div>

        <!-- Freelancer 4 -->
        <div class="user-card">
          <div class="user-avatar">ن</div>
          <div class="user-name">نیلوفر شریفی</div>
          <div class="user-role">نویسنده محتوا</div>
          <div class="product-rating mb-4" style="justify-content:center">
            <div class="rating">
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="rating-text">(۴.۶)</span>
          </div>
          <div class="user-stats">
            <div class="user-stat">
              <div class="user-stat-value">۲۰۳</div>
              <div class="user-stat-label">پروژه</div>
            </div>
            <div class="user-stat">
              <div class="user-stat-value">۹۷٪</div>
              <div class="user-stat-label">رضایت</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       CTA SECTION
       ============================================ -->
  <section class="section">
    <div class="page-container">
      <div class="cta-section">
        <h2 class="cta-title">آماده‌اید تا شروع کنید؟</h2>
        <p class="cta-desc">به هزاران کاربر R_REX بپیوندید و از امکانات بی‌نظیر اکوسیستم دیجیتال ابری بهره‌مند شوید.</p>
        <div class="cta-actions">
          <a href="pages/shop.php" class="btn btn-white btn-lg">شروع کنید</a>
          <a href="pages/pricing.php" class="btn btn-ghost-white btn-lg">مشاهده پلن‌ها</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       FOOTER
       ============================================ -->
  <footer class="footer">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-brand-name">R_REX</div>
        <p class="footer-brand-desc">اکوسیستم دیجیتال ابری ایران. ترکیبی از فروشگاه دیجیتال، پلتفرم فریلنسری، کیف پول هوشمند و بیشتر.</p>
        <div class="footer-social">
          <a href="#" aria-label="اینستاگرام">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
          <a href="#" aria-label="توییتر">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
          </a>
          <a href="#" aria-label="لینکدین">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          </a>
          <a href="#" aria-label="گیتهاب">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/></svg>
          </a>
        </div>
      </div>

      <div>
        <div class="footer-column-title">فروشگاه</div>
        <div class="footer-links">
          <a href="#" class="footer-link">محصولات دیجیتال</a>
          <a href="#" class="footer-link">قالب‌ها</a>
          <a href="#" class="footer-link">افزونه‌ها</a>
          <a href="#" class="footer-link">ابزارها</a>
          <a href="#" class="footer-link">تخفیف‌ها</a>
        </div>
      </div>

      <div>
        <div class="footer-column-title">فریلنسری</div>
        <div class="footer-links">
          <a href="#" class="footer-link">ثبت پروژه</a>
          <a href="#" class="footer-link">یافتن فریلنسر</a>
          <a href="#" class="footer-link">نمونه کارها</a>
          <a href="#" class="footer-link">آموزش فریلنسری</a>
          <a href="#" class="footer-link">راهنمای پروژه</a>
        </div>
      </div>

      <div>
        <div class="footer-column-title">پشتیبانی</div>
        <div class="footer-links">
          <a href="#" class="footer-link">مرکز کمک</a>
          <a href="#" class="footer-link">سوالات متداول</a>
          <a href="#" class="footer-link">تماس با ما</a>
          <a href="#" class="footer-link">شرایط استفاده</a>
          <a href="#" class="footer-link">حریم خصوصی</a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <span>© ۱۴۰۵ R_REX. تمامی حقوق محفوظ است.</span>
      <span>طراحی و توسعه با عشق در ایران</span>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="js/theme.js"></script>
  <script src="js/components.js"></script>
  <script src="js/app.js"></script>
</body>
</html>