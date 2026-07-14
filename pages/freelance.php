<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>فریلنسری | R_REX</title>
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
      <a href="../index.html" class="navbar-brand">
        <div class="navbar-logo">R</div>
        <span class="navbar-brand-text">R_REX</span>
      </a>
      <div class="navbar-nav hide-md">
        <a href="../index.php" class="nav-link">خانه</a>
        <a href="shop.php" class="nav-link">فروشگاه</a>
        <a href="freelance.php" class="nav-link active">فریلنسری</a>
        <a href="courses.php" class="nav-link">آموزش‌ها</a>
        <a href="community.php" class="nav-link">انجمن</a>
        <a href="pricing.php" class="nav-link">اشتراک‌ها</a>
      </div>
      <div class="navbar-actions">
        <button class="navbar-search-btn hide-md" data-search>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <span>جستجو...</span>
          <kbd>⌘K</kbd>
        </button>
        <button class="theme-toggle"></button>
        <div class="notification-bell">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="notification-count">۲</span>
        </div>
        <div class="navbar-user"><div class="navbar-user-avatar">ع</div></div>
        <button class="mobile-menu-toggle">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
      </div>
    </div>
  </nav>

  <!-- Search Modal -->
  <div id="search-modal" class="search-modal">
    <div class="search-modal-content">
      <div class="search-modal-input">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="جستجوی فریلنسرها و پروژه‌ها..." autofocus>
        <kbd style="padding:0.25rem 0.5rem;font-size:0.75rem;background:var(--bg-tertiary);border:1px solid var(--border-primary);border-radius:var(--radius-sm);cursor:pointer" onclick="Components.search.close()">ESC</kbd>
      </div>
    </div>
  </div>

  <!-- Hero Section -->
  <section style="padding: calc(var(--navbar-height) + var(--space-12)) 0 var(--space-12); background: var(--bg-secondary)">
    <div class="page-container text-center">
      <div class="section-badge" style="margin-bottom: var(--space-4)">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        بازار کار فریلنسری
      </div>
      <h1 style="font-size:var(--font-size-4xl);font-weight:var(--font-weight-bold);margin-bottom:var(--space-4)">بهترین فریلنسرها را پیدا کنید</h1>
      <p style="font-size:var(--font-size-lg);color:var(--text-secondary);max-width:36rem;margin:0 auto var(--space-8)">
        هزاران فریلنسر حرفه‌ای در حوزه‌های مختلف آماده اجرای پروژه‌های شما هستند.
      </p>
      <div class="flex justify-center gap-3">
        <a href="#projects" class="btn btn-primary btn-lg">مشاهده پروژه‌ها</a>
        <button class="btn btn-outline btn-lg">ثبت پروژه جدید</button>
      </div>
    </div>
  </section>

  <!-- Tabs -->
  <div class="page-container" style="margin-top: calc(-1 * var(--space-6))">
    <div class="card">
      <div class="tabs" style="padding: 0 var(--space-4)">
        <button class="tab active" data-tab="freelancers-tab">فریلنسرها</button>
        <button class="tab" data-tab="projects-tab">پروژه‌ها</button>
        <button class="tab" data-tab="proposals-tab">پیشنهادها</button>
      </div>
    </div>
  </div>

  <!-- Freelancers Section -->
  <div class="page-container">
    <div class="tab-panel active" id="freelancers-tab">
      <!-- Filters -->
      <div class="flex items-center gap-3 mb-6" style="margin-top:var(--space-6)">
        <div class="search-bar" style="flex:1;max-width:24rem">
          <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" class="search-input" placeholder="جستجوی فریلنسر...">
        </div>
        <select class="form-select" style="width:auto">
          <option>همه حوزه‌ها</option>
          <option>طراحی UI/UX</option>
          <option>توسعه فرانت‌اند</option>
          <option>توسعه بک‌اند</option>
          <option>موبایل</option>
          <option>نویسندگی</option>
        </select>
        <select class="form-select" style="width:auto">
          <option>مرتب‌سازی: بهترین</option>
          <option>جدیدترین</option>
          <option>پرفروش‌ترین</option>
        </select>
      </div>

      <!-- Freelancers Grid -->
      <div class="content-grid content-grid-3" style="margin-bottom:var(--space-10)">
        <!-- Freelancer 1 -->
        <div class="freelancer-card">
          <div class="freelancer-header">
            <div class="freelancer-avatar" style="background:linear-gradient(135deg,#667eea,#764ba2);color:white">م</div>
            <div class="freelancer-info">
              <div class="freelancer-name">محمد رضایی</div>
              <div class="freelancer-title">طراح UI/UX • ۴ سال تجربه</div>
              <div class="freelancer-rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <span style="font-size:var(--font-size-sm);font-weight:var(--font-weight-semibold)">۴.۹</span>
                <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">(۸۷ پروژه)</span>
              </div>
            </div>
            <div class="freelancer-rate">۲۵۰K/ساعت</div>
          </div>
          <p style="font-size:var(--font-size-sm);color:var(--text-secondary);margin-bottom:var(--space-3)">
            طراح رابط کاربری و تجربه کاربری با تمرکز بر محصولات دیجیتال. تخصص در Figma و Adobe XD.
          </p>
          <div class="freelancer-skills">
            <span class="tag tag-active">Figma</span>
            <span class="tag">UI Design</span>
            <span class="tag">UX Research</span>
            <span class="tag">Prototyping</span>
          </div>
          <div style="margin-top:var(--space-4);padding-top:var(--space-4);border-top:1px solid var(--border-primary);display:flex;justify-content:space-between;align-items:center">
            <div class="flex gap-4">
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۹۸٪ رضایت</span>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۲۴ ساعت پاسخگویی</span>
            </div>
            <button class="btn btn-primary btn-sm">ارسال پیام</button>
          </div>
        </div>

        <!-- Freelancer 2 -->
        <div class="freelancer-card">
          <div class="freelancer-header">
            <div class="freelancer-avatar" style="background:linear-gradient(135deg,#f093fb,#f5576c);color:white">س</div>
            <div class="freelancer-info">
              <div class="freelancer-name">سارا احمدی</div>
              <div class="freelancer-title">توسعه‌دهنده فرانت‌اند • ۵ سال تجربه</div>
              <div class="freelancer-rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <span style="font-size:var(--font-size-sm);font-weight:var(--font-weight-semibold)">۴.۷</span>
                <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">(۱۲۴ پروژه)</span>
              </div>
            </div>
            <div class="freelancer-rate">۴۰۰K/ساعت</div>
          </div>
          <p style="font-size:var(--font-size-sm);color:var(--text-secondary);margin-bottom:var(--space-3)">
            توسعه‌دهنده فرانت‌اند مسلط به React, Vue, TypeScript. تجربه کار روی پروژه‌های بزرگ و تیمی.
          </p>
          <div class="freelancer-skills">
            <span class="tag tag-active">React</span>
            <span class="tag tag-active">Vue.js</span>
            <span class="tag">TypeScript</span>
            <span class="tag">Next.js</span>
          </div>
          <div style="margin-top:var(--space-4);padding-top:var(--space-4);border-top:1px solid var(--border-primary);display:flex;justify-content:space-between;align-items:center">
            <div class="flex gap-4">
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۹۶٪ رضایت</span>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۱۲ ساعت پاسخگویی</span>
            </div>
            <button class="btn btn-primary btn-sm">ارسال پیام</button>
          </div>
        </div>

        <!-- Freelancer 3 -->
        <div class="freelancer-card">
          <div class="freelancer-header">
            <div class="freelancer-avatar" style="background:linear-gradient(135deg,#43e97b,#38f9d7);color:white">ع</div>
            <div class="freelancer-info">
              <div class="freelancer-name">عرفان کریمی</div>
              <div class="freelancer-title">توسعه‌دهنده بک‌اند • ۶ سال تجربه</div>
              <div class="freelancer-rating">
                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <span style="font-size:var(--font-size-sm);font-weight:var(--font-weight-semibold)">۴.۸</span>
                <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">(۶۵ پروژه)</span>
              </div>
            </div>
            <div class="freelancer-rate">۵۰۰K/ساعت</div>
          </div>
          <p style="font-size:var(--font-size-sm);color:var(--text-secondary);margin-bottom:var(--space-3)">
            توسعه‌دهنده بک‌اند با تخصص Node.js, Python, Go. طراحی API و معماری سیستم‌های مقیاس‌پذیر.
          </p>
          <div class="freelancer-skills">
            <span class="tag tag-active">Node.js</span>
            <span class="tag tag-active">Python</span>
            <span class="tag">Go</span>
            <span class="tag">PostgreSQL</span>
          </div>
          <div style="margin-top:var(--space-4);padding-top:var(--space-4);border-top:1px solid var(--border-primary);display:flex;justify-content:space-between;align-items:center">
            <div class="flex gap-4">
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۹۹٪ رضایت</span>
              <span style="font-size:var(--font-size-xs);color:var(--text-tertiary)">۶ ساعت پاسخگویی</span>
            </div>
            <button class="btn btn-primary btn-sm">ارسال پیام</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Projects Section -->
    <div class="tab-panel" id="projects-tab">
      <div style="margin-top:var(--space-6)">
        <div class="flex justify-between items-center mb-6">
          <h2 style="font-size:var(--font-size-xl);font-weight:var(--font-weight-semibold)">پروژه‌های باز</h2>
          <button class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            ثبت پروژه جدید
          </button>
        </div>

        <div class="flex flex-col gap-4">
          <!-- Project 1 -->
          <div class="project-card">
            <div class="project-header">
              <div>
                <div class="badge badge-success" style="margin-bottom:var(--space-2)">باز</div>
                <div class="project-title">طراحی UI/UX اپلیکیشن فینتک</div>
              </div>
              <div class="project-budget">۱۵,۰۰۰,۰۰۰ تومان</div>
            </div>
            <div class="project-desc">
              نیاز به طراح رابط کاربری حرفه‌ای برای اپلیکیشن موبایل فینتک داریم. پروژه شامل طراحی ۲۵ صفحه اصلی، سیستم دیزاین و پروتوتایپ تعاملی است. مهلت اجرا: ۳۰ روز.
            </div>
            <div class="project-meta">
              <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                مهلت: ۳۰ روز
              </span>
              <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                ۸ پیشنهاد
              </span>
            </div>
            <div class="project-tags">
              <span class="tag">UI Design</span>
              <span class="tag">UX Design</span>
              <span class="tag">Figma</span>
              <span class="tag">Mobile</span>
            </div>
          </div>

          <!-- Project 2 -->
          <div class="project-card">
            <div class="project-header">
              <div>
                <div class="badge badge-success" style="margin-bottom:var(--space-2)">باز</div>
                <div class="project-title">توسعه وب‌سایت فروشگاهی با React</div>
              </div>
              <div class="project-budget">۲۵,۰۰۰,۰۰۰ تومان</div>
            </div>
            <div class="project-desc">
              توسعه وب‌سایت فروشگاهی کامل با React, Node.js و پنل مدیریت. شامل سیستم پرداخت آنلاین، مدیریت محصولات، سفارشات و گزارش‌گیری. مهلت اجرا: ۴۵ روز.
            </div>
            <div class="project-meta">
              <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                مهلت: ۴۵ روز
              </span>
              <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                ۱۲ پیشنهاد
              </span>
            </div>
            <div class="project-tags">
              <span class="tag">React</span>
              <span class="tag">Node.js</span>
              <span class="tag">E-commerce</span>
              <span class="tag">Full Stack</span>
            </div>
          </div>

          <!-- Project 3 -->
          <div class="project-card">
            <div class="project-header">
              <div>
                <div class="badge badge-warning" style="margin-bottom:var(--space-2)">در حال بررسی</div>
                <div class="project-title">نوشتن محتوای تخصصی بلاکچین</div>
              </div>
              <div class="project-budget">۵,۰۰۰,۰۰۰ تومان</div>
            </div>
            <div class="project-desc">
              نیاز به نویسنده متخصص بلاکچین و ارزهای دیجیتال برای تولید ۲۰ مقاله تخصصی داریم. هر مقاله حداقل ۲۰۰۰ کلمه با منابع معتبر.
            </div>
            <div class="project-meta">
              <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                مهلت: ۲۰ روز
              </span>
              <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                ۵ پیشنهاد
              </span>
            </div>
            <div class="project-tags">
              <span class="tag">Content Writing</span>
              <span class="tag">Blockchain</span>
              <span class="tag">Persian</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Proposals Section -->
    <div class="tab-panel" id="proposals-tab">
      <div class="empty-state" style="margin-top:var(--space-6)">
        <div class="empty-state-icon">
          <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <h3 class="empty-state-title">هنوز پیشنهادی ارسال نکرده‌اید</h3>
        <p class="empty-state-text">پروژه‌های مناسب خود را پیدا کنید و پیشنهاد ارسال کنید.</p>
        <button class="btn btn-primary">مشاهده پروژه‌ها</button>
      </div>
    </div>
  </div>

  <script src="../js/theme.js"></script>
  <script src="../js/components.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>
