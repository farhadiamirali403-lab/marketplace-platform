<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مرکز پشتیبانی | R_REX</title>
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
        <a href="freelance.php" class="nav-link">فریلنسری</a>
        <a href="courses.php" class="nav-link">آموزش‌ها</a>
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
      <div style="font-size:3rem;margin-bottom:var(--space-4)">💬</div>
      <h1 style="font-size:var(--font-size-4xl);font-weight:var(--font-weight-bold);margin-bottom:var(--space-3)">مرکز پشتیبانی</h1>
      <p style="font-size:var(--font-size-lg);color:var(--text-secondary);max-width:32rem;margin:0 auto var(--space-6)">
        ما اینجا هستیم تا کمکتان کنیم. سوالات خود را جستجو کنید یا تیکت ارسال کنید.
      </p>
      <div class="search-bar" style="max-width:32rem;margin:0 auto">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" class="search-input" placeholder="جستجوی سوالات و مقالات..." style="padding:0.875rem 1rem 0.875rem 3rem;font-size:var(--font-size-md)">
      </div>
    </div>
  </section>

  <!-- Quick Links -->
  <div class="page-container">
    <div class="content-grid content-grid-4" style="margin-top: calc(-1 * var(--space-8)); margin-bottom: var(--space-10)">
      <div class="card" style="text-align:center;cursor:pointer" onclick="Components.modal.open('ticket-modal')">
        <div class="card-body">
          <div style="font-size:2rem;margin-bottom:var(--space-2)">🎫</div>
          <div class="font-semibold" style="margin-bottom:var(--space-1)">ایجاد تیکت</div>
          <div class="text-sm text-secondary">ارسال درخواست پشتیبانی</div>
        </div>
      </div>
      <div class="card" style="text-align:center;cursor:pointer">
        <div class="card-body">
          <div style="font-size:2rem;margin-bottom:var(--space-2)">❓</div>
          <div class="font-semibold" style="margin-bottom:var(--space-1)">سوالات متداول</div>
          <div class="text-sm text-secondary">پاسخ سوالات رایج</div>
        </div>
      </div>
      <div class="card" style="text-align:center;cursor:pointer">
        <div class="card-body">
          <div style="font-size:2rem;margin-bottom:var(--space-2)">📚</div>
          <div class="font-semibold" style="margin-bottom:var(--space-1)">آموزش‌ها</div>
          <div class="text-sm text-secondary">راهنمای استفاده از پلتفرم</div>
        </div>
      </div>
      <div class="card" style="text-align:center;cursor:pointer">
        <div class="card-body">
          <div style="font-size:2rem;margin-bottom:var(--space-2)">💡</div>
          <div class="font-semibold" style="margin-bottom:var(--space-1)">پیشنهاد قابلیت</div>
          <div class="text-sm text-secondary">ایده‌های خود را بفرستید</div>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="tabs-container">
      <div class="tabs" style="margin-bottom:var(--space-6)">
        <button class="tab active" data-tab="tickets-tab">تیکت‌های من</button>
        <button class="tab" data-tab="faq-tab">سوالات متداول</button>
        <button class="tab" data-tab="articles-tab">آموزش‌ها</button>
      </div>

      <!-- Tickets -->
      <div class="tab-panel active" id="tickets-tab">
        <div class="flex justify-between items-center mb-4">
          <h2 style="font-size:var(--font-size-lg);font-weight:var(--font-weight-semibold)">تیکت‌های پشتیبانی</h2>
          <button class="btn btn-primary btn-sm" onclick="Components.modal.open('ticket-modal')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            تیکت جدید
          </button>
        </div>

        <div class="ticket-list">
          <div class="ticket-item">
            <div class="ticket-status open"></div>
            <div class="ticket-info">
              <div class="ticket-title">مشکل در دانلود محصول خریداری شده</div>
              <div class="ticket-meta">#T-۱۲۳۴ • پشتیبانی فنی • اولویت متوسط</div>
            </div>
            <div class="badge badge-success">باز</div>
            <div class="ticket-last-reply">پاسخ اخیر: ۲ ساعت پیش</div>
          </div>

          <div class="ticket-item">
            <div class="ticket-status pending"></div>
            <div class="ticket-info">
              <div class="ticket-title">درخواست بازگشت وجه محصول</div>
              <div class="ticket-meta">#T-۱۲۳۰ • مالی • اولویت بالا</div>
            </div>
            <div class="badge badge-warning">در انتظار پاسخ</div>
            <div class="ticket-last-reply">پاسخ اخیر: دیروز</div>
          </div>

          <div class="ticket-item">
            <div class="ticket-status closed"></div>
            <div class="ticket-info">
              <div class="ticket-title">سوال درباره اشتراک Pro</div>
              <div class="ticket-meta">#T-۱۲۲۵ • فروش • اولویت پایین</div>
            </div>
            <div class="badge badge-neutral">بسته شده</div>
            <div class="ticket-last-reply">پاسخ اخیر: ۳ روز پیش</div>
          </div>

          <div class="ticket-item">
            <div class="ticket-status closed"></div>
            <div class="ticket-info">
              <div class="ticket-title">به‌روزرسانی اطلاعات پروفایل</div>
              <div class="ticket-meta">#T-۱۲۱۸ • حساب کاربری • اولویت پایین</div>
            </div>
            <div class="badge badge-neutral">بسته شده</div>
            <div class="ticket-last-reply">پاسخ اخیر: ۱ هفته پیش</div>
          </div>
        </div>
      </div>

      <!-- FAQ -->
      <div class="tab-panel" id="faq-tab">
        <h2 style="font-size:var(--font-size-lg);font-weight:var(--font-weight-semibold);margin-bottom:var(--space-6)">سوالات متداول</h2>

        <div class="accordion" style="max-width:48rem">
          <div class="accordion-item active">
            <div class="accordion-header">
              <span class="accordion-title">چگونه می‌توانم محصولی را خریداری کنم؟</span>
              <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="accordion-body">
              <div class="accordion-content">
                برای خرید محصول کافی است محصول مورد نظر را از فروشگاه انتخاب کرده و روی دکمه «افزودن به سبد خرید» کلیک کنید. سپس مراحل پرداخت را دنبال کنید. پس از پرداخت موفق، لینک دانلود محصول در اختیار شما قرار می‌گیرد.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <div class="accordion-header">
              <span class="accordion-title">آیا امکان بازگشت وجه وجود دارد؟</span>
              <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="accordion-body">
              <div class="accordion-content">
                بله، در صورتی که محصول خریداری شده مشکلی داشته باشد یا با توضیحات مطابقت نداشته باشد، ظرف ۷ روز پس از خرید امکان بازگشت وجه وجود دارد. برای این منظور یک تیکت پشتیبانی ارسال کنید.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <div class="accordion-header">
              <span class="accordion-title">چگونه می‌توانم فریلنسر پیدا کنم؟</span>
              <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="accordion-body">
              <div class="accordion-content">
                از بخش فریلنسری می‌توانید فریلنسرها را بر اساس مهارت، امتیاز و نمونه کار جستجو کنید. همچنین می‌توانید پروژه خود را ثبت کرده و پیشنهادهای فریلنسرها را دریافت کنید.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <div class="accordion-header">
              <span class="accordion-title">چگونه اشتراک خود را ارتقا دهم؟</span>
              <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="accordion-body">
              <div class="accordion-content">
                از بخش «اشتراک‌ها» در پنل کاربری می‌توانید پلن مورد نظر خود را انتخاب و خریداری کنید. در صورت ارتقا در حین دوره اشتراک فعلی، مابه‌التفاوت محاسبه می‌شود.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <div class="accordion-header">
              <span class="accordion-title">نحوه دریافت کش‌بک چگونه است؟</span>
              <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="accordion-body">
              <div class="accordion-content">
                بسته به سطح اشتراک شما، درصدی از هر خرید به عنوان کش‌بک به کیف پول شما اضافه می‌شود. کش‌بک بلافاصله پس از تکمیل خرید قابل استفاده است.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Articles -->
      <div class="tab-panel" id="articles-tab">
        <h2 style="font-size:var(--font-size-lg);font-weight:var(--font-weight-semibold);margin-bottom:var(--space-6)">راهنماها و آموزش‌ها</h2>

        <div class="content-grid content-grid-3">
          <div class="article-card">
            <div class="article-image" style="background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:white;font-size:2rem">📖</div>
            <div class="article-content">
              <div class="article-meta">
                <span class="badge badge-primary">راهنما</span>
                <span class="text-xs text-tertiary">۵ دقیقه مطالعه</span>
              </div>
              <h3 class="article-title">راهنمای شروع کار با R_REX</h3>
              <p class="article-excerpt">آموزش گام به گام ثبت نام، تکمیل پروفایل و شروع خرید در پلتفرم.</p>
            </div>
          </div>

          <div class="article-card">
            <div class="article-image" style="background:linear-gradient(135deg,#f093fb,#f5576c);display:flex;align-items:center;justify-content:center;color:white;font-size:2rem">💳</div>
            <div class="article-content">
              <div class="article-meta">
                <span class="badge badge-primary">راهنما</span>
                <span class="text-xs text-tertiary">۳ دقیقه مطالعه</span>
              </div>
              <h3 class="article-title">نحوه استفاده از کیف پول</h3>
              <p class="article-excerpt">آموزش افزایش موجودی، برداشت و مدیریت تراکنش‌ها در کیف پول دیجیتال.</p>
            </div>
          </div>

          <div class="article-card">
            <div class="article-image" style="background:linear-gradient(135deg,#43e97b,#38f9d7);display:flex;align-items:center;justify-content:center;color:white;font-size:2rem">🚀</div>
            <div class="article-content">
              <div class="article-meta">
                <span class="badge badge-primary">آموزش</span>
                <span class="text-xs text-tertiary">۸ دقیقه مطالعه</span>
              </div>
              <h3 class="article-title">نحوه ثبت پروژه فریلنسری</h3>
              <p class="article-excerpt">آموزش ثبت پروژه، انتخاب فریلنسر و مدیریت قرارداد تا تحویل نهایی.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- New Ticket Modal -->
  <div id="ticket-modal" class="modal-overlay">
    <div class="modal" style="max-width:36rem">
      <div class="modal-header">
        <h3 class="modal-title">ایجاد تیکت جدید</h3>
        <button class="modal-close" onclick="Components.modal.close('ticket-modal')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-4">
          <label class="form-label">موضوع <span class="required">*</span></label>
          <input type="text" class="form-input" placeholder="موضوع تیکت را وارد کنید">
        </div>
        <div class="form-group mb-4">
          <label class="form-label">دسته‌بندی</label>
          <select class="form-select">
            <option>انتخاب کنید</option>
            <option>پشتیبانی فنی</option>
            <option>مالی</option>
            <option>فروش</option>
            <option>حساب کاربری</option>
            <option>گزارش مشکل</option>
          </select>
        </div>
        <div class="form-group mb-4">
          <label class="form-label">اولویت</label>
          <select class="form-select">
            <option>متوسط</option>
            <option>پایین</option>
            <option>بالا</option>
            <option>فوری</option>
          </select>
        </div>
        <div class="form-group mb-4">
          <label class="form-label">توضیحات <span class="required">*</span></label>
          <textarea class="form-textarea" rows="5" placeholder="توضیحات خود را بنویسید..."></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">فایل پیوست</label>
          <div class="upload-zone" style="padding:var(--space-6)">
            <div class="upload-icon">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
            </div>
            <div class="upload-text">فایل را بکشید یا کلیک کنید</div>
            <div class="upload-hint">حداکثر ۵ مگابایت (PNG, JPG, PDF)</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" onclick="Components.modal.close('ticket-modal')">انصراف</button>
        <button class="btn btn-primary" onclick="Components.modal.close('ticket-modal');Components.toast.show({type:'success',title:'تیکت ایجاد شد!',message:'تیکت شما با موفقیت ثبت شد'})">ارسال تیکت</button>
      </div>
    </div>
  </div>

  <script src="../js/theme.js"></script>
  <script src="../js/components.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>
