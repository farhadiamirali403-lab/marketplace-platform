<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>آموزش‌ها | R_REX</title>
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
      <a href="../index.html" class="navbar-brand">
        <div class="navbar-logo">R</div>
        <span class="navbar-brand-text">R_REX</span>
      </a>
      <div class="navbar-nav hide-md">
        <a href="../index.php" class="nav-link">خانه</a>
        <a href="shop.php" class="nav-link">فروشگاه</a>
        <a href="freelance.php" class="nav-link">فریلنسری</a>
        <a href="courses.php" class="nav-link active">آموزش‌ها</a>
        <a href="community.php" class="nav-link">انجمن</a>
        <a href="pricing.php" class="nav-link">اشتراک‌ها</a>
      </div>
      <div class="navbar-actions">
        <button class="theme-toggle"></button>
        <div class="notification-bell">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </div>
        <div class="navbar-user"><div class="navbar-user-avatar">ع</div></div>
        <button class="mobile-menu-toggle">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section style="padding: calc(var(--navbar-height) + var(--space-12)) 0 var(--space-12); background: var(--bg-secondary)">
    <div class="page-container text-center">
      <div class="section-badge" style="margin-bottom:var(--space-4)">📚 پلتفرم آموزشی</div>
      <h1 style="font-size:var(--font-size-4xl);font-weight:var(--font-weight-bold);margin-bottom:var(--space-3)">دوره‌ها و آموزش‌ها</h1>
      <p style="font-size:var(--font-size-lg);color:var(--text-secondary);max-width:32rem;margin:0 auto">
        مهارت‌های خود را با دوره‌های حرفه‌ای و مقالات تخصصی ارتقا دهید.
      </p>
    </div>
  </section>

  <!-- Tabs -->
  <div class="page-container">
    <div class="tabs" style="margin-top:calc(-1 * var(--space-6));margin-bottom:var(--space-8)">
      <button class="tab active" data-tab="courses-tab">دوره‌ها</button>
      <button class="tab" data-tab="articles-tab">مقالات</button>
      <button class="tab" data-tab="blog-tab">بلاگ</button>
    </div>

    <!-- Courses -->
    <div class="tab-panel active" id="courses-tab">
      <!-- Filters -->
      <div class="flex items-center gap-3 mb-6">
        <div class="search-bar" style="flex:1;max-width:20rem">
          <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" class="search-input" placeholder="جستجوی دوره‌ها...">
        </div>
        <select class="form-select" style="width:auto">
          <option>همه دسته‌ها</option>
          <option>برنامه‌نویسی</option>
          <option>طراحی</option>
          <option>بازاریابی</option>
          <option>مدیریت</option>
        </select>
        <select class="form-select" style="width:auto">
          <option>همه سطوح</option>
          <option>مبتدی</option>
          <option>متوسط</option>
          <option>پیشرفته</option>
        </select>
      </div>

      <div class="content-grid content-grid-3">
        <!-- Course 1 -->
        <div class="course-card">
          <div class="course-image" style="background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:white;font-size:3rem">⚛️</div>
          <div class="course-info">
            <div class="course-category">برنامه‌نویسی فرانت‌اند</div>
            <div class="course-title">دوره جامع React.js - از مبتدی تا حرفه‌ای</div>
            <div class="product-rating mb-3">
              <div class="rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              </div>
              <span class="rating-text">(۳۲۴)</span>
            </div>
            <div class="flex items-center gap-3 mb-3" style="font-size:var(--font-size-xs);color:var(--text-tertiary)">
              <span class="flex items-center gap-1">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                ۴۲ ساعت
              </span>
              <span class="flex items-center gap-1">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                ۱,۲۵۰ دانشجو
              </span>
            </div>
            <div class="course-meta">
              <div class="course-instructor">
                <div class="avatar avatar-xs" style="background:var(--accent-50);color:var(--accent-600)">م</div>
                محمد رضایی
              </div>
              <div class="course-price">۸۹۰,۰۰۰ تومان</div>
            </div>
          </div>
        </div>

        <!-- Course 2 -->
        <div class="course-card">
          <div class="course-image" style="background:linear-gradient(135deg,#f093fb,#f5576c);display:flex;align-items:center;justify-content:center;color:white;font-size:3rem">🎨</div>
          <div class="course-info">
            <div class="course-category">طراحی UI/UX</div>
            <div class="course-title">آموزش جامع طراحی رابط کاربری با Figma</div>
            <div class="product-rating mb-3">
              <div class="rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              </div>
              <span class="rating-text">(۱۸۹)</span>
            </div>
            <div class="flex items-center gap-3 mb-3" style="font-size:var(--font-size-xs);color:var(--text-tertiary)">
              <span class="flex items-center gap-1">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                ۲۸ ساعت
              </span>
              <span class="flex items-center gap-1">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                ۹۸۰ دانشجو
              </span>
            </div>
            <div class="course-meta">
              <div class="course-instructor">
                <div class="avatar avatar-xs" style="background:rgba(139,92,246,0.1);color:#8b5cf6">س</div>
                سارا احمدی
              </div>
              <div class="course-price">۶۵۰,۰۰۰ تومان</div>
            </div>
          </div>
        </div>

        <!-- Course 3 -->
        <div class="course-card">
          <div class="course-image" style="background:linear-gradient(135deg,#43e97b,#38f9d7);display:flex;align-items:center;justify-content:center;color:white;font-size:3rem">🐍</div>
          <div class="course-info">
            <div class="course-category">برنامه‌نویسی بک‌اند</div>
            <div class="course-title">آموزش Python و Django برای وب</div>
            <div class="product-rating mb-3">
              <div class="rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              </div>
              <span class="rating-text">(۲۵۶)</span>
            </div>
            <div class="flex items-center gap-3 mb-3" style="font-size:var(--font-size-xs);color:var(--text-tertiary)">
              <span class="flex items-center gap-1">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                ۳۵ ساعت
              </span>
              <span class="flex items-center gap-1">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                ۱,۱۲۰ دانشجو
              </span>
            </div>
            <div class="course-meta">
              <div class="course-instructor">
                <div class="avatar avatar-xs" style="background:var(--color-success-50);color:var(--color-success-600)">ع</div>
                عرفان کریمی
              </div>
              <div class="course-price">۷۵۰,۰۰۰ تومان</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Articles -->
    <div class="tab-panel" id="articles-tab">
      <div class="content-grid content-grid-3" style="margin-top:var(--space-6)">
        <div class="article-card">
          <div class="article-image" style="background:linear-gradient(135deg,#4facfe,#00f2fe);display:flex;align-items:center;justify-content:center;color:white;font-size:2rem">📝</div>
          <div class="article-content">
            <div class="article-meta">
              <span class="badge badge-primary">مقاله</span>
              <span class="text-xs text-tertiary">۱۴۰۵/۰۴/۱۰</span>
            </div>
            <h3 class="article-title">۱۰ نکته طلایی برای یادگیری سریع‌تر برنامه‌نویسی</h3>
            <p class="article-excerpt">در این مقاله با ۱۰ روش علمی و عملی برای یادگیری سریع‌تر و مؤثرتر برنامه‌نویسی آشنا می‌شوید.</p>
          </div>
        </div>
        <div class="article-card">
          <div class="article-image" style="background:linear-gradient(135deg,#fa709a,#fee140);display:flex;align-items:center;justify-content:center;color:white;font-size:2rem">💡</div>
          <div class="article-content">
            <div class="article-meta">
              <span class="badge badge-primary">مقاله</span>
              <span class="text-xs text-tertiary">۱۴۰۵/۰۴/۰۸</span>
            </div>
            <h3 class="article-title">آینده طراحی UI/UX در سال ۱۴۰۵</h3>
            <p class="article-excerpt">بررسی روندها و فناوری‌های نوین در طراحی رابط کاربری و تجربه کاربری.</p>
          </div>
        </div>
        <div class="article-card">
          <div class="article-image" style="background:linear-gradient(135deg,#a18cd1,#fbc2eb);display:flex;align-items:center;justify-content:center;color:white;font-size:2rem">🚀</div>
          <div class="article-content">
            <div class="article-meta">
              <span class="badge badge-primary">مقاله</span>
              <span class="text-xs text-tertiary">۱۴۰۵/۰۴/۰۵</span>
            </div>
            <h3 class="article-title">راه‌اندازی کسب‌وکار فریلنسری موفق</h3>
            <p class="article-excerpt">راهنمای جامع شروع و رشد کسب‌وکار فریلنسری از صفر تا صد.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Blog -->
    <div class="tab-panel" id="blog-tab">
      <div class="empty-state" style="margin-top:var(--space-6)">
        <div class="empty-state-icon">📰</div>
        <h3 class="empty-state-title">بلاگ به زودی راه‌اندازی می‌شود</h3>
        <p class="empty-state-text">مقالات تخصصی و اخبار دنیای تکنولوژی به زودی در بلاگ R_REX منتشر خواهد شد.</p>
      </div>
    </div>
  </div>

  <script src="../js/theme.js"></script>
  <script src="../js/components.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>
