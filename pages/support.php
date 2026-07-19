<?php
// pages/support.php - صفحه پشتیبانی

require_once 'header.php';

$page_title = "پشتیبانی | R_REX";
$page_description = "مرکز پشتیبانی و راهنمای R_REX";
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="stylesheet" href="../css/responsive.css">
    
    <style>
        .support-hero {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            margin-bottom: var(--space-8);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .support-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 30rem;
            height: 30rem;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .support-hero h1 {
            color: white;
            position: relative;
            z-index: 1;
        }
        
        .support-hero p {
            color: rgba(255,255,255,0.85);
            position: relative;
            z-index: 1;
        }
        
        .support-contact-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-4);
            margin-bottom: var(--space-8);
        }
        
        .support-contact-card {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-xl);
            padding: var(--space-5);
            text-align: center;
            transition: all var(--transition-base);
        }
        
        .support-contact-card:hover {
            box-shadow: var(--shadow-card-hover);
            transform: translateY(-2px);
        }
        
        .support-contact-card .contact-icon {
            font-size: var(--font-size-3xl);
            margin-bottom: var(--space-3);
        }
        
        .support-contact-card .contact-title {
            font-size: var(--font-size-md);
            font-weight: var(--font-weight-semibold);
            color: var(--text-primary);
            margin-bottom: var(--space-1);
        }
        
        .support-contact-card .contact-desc {
            font-size: var(--font-size-sm);
            color: var(--text-tertiary);
        }
        
        .support-contact-card .contact-value {
            font-size: var(--font-size-sm);
            color: var(--text-brand);
            font-weight: var(--font-weight-medium);
            margin-top: var(--space-2);
            display: block;
        }
        
        .faq-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-4);
            margin-bottom: var(--space-8);
        }
        
        .faq-item {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-xl);
            padding: var(--space-5);
            cursor: pointer;
            transition: all var(--transition-base);
        }
        
        .faq-item:hover {
            border-color: var(--accent-primary);
            box-shadow: var(--shadow-card-hover);
        }
        
        .faq-item .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: var(--font-weight-semibold);
            color: var(--text-primary);
        }
        
        .faq-item .faq-question .faq-icon {
            font-size: var(--font-size-lg);
            transition: transform var(--transition-fast);
        }
        
        .faq-item.active .faq-question .faq-icon {
            transform: rotate(180deg);
        }
        
        .faq-item .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height var(--transition-slow);
            color: var(--text-secondary);
            font-size: var(--font-size-sm);
            line-height: var(--line-height-relaxed);
        }
        
        .faq-item.active .faq-answer {
            max-height: 300px;
            padding-top: var(--space-3);
        }
        
        .ticket-card {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            transition: all var(--transition-base);
        }
        
        .ticket-card:hover {
            box-shadow: var(--shadow-card-hover);
        }
        
        .ticket-header {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            margin-bottom: var(--space-3);
        }
        
        .ticket-status {
            padding: 0.125rem 0.75rem;
            border-radius: var(--radius-full);
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-medium);
        }
        
        .ticket-status.open {
            background: rgba(16, 185, 129, 0.1);
            color: var(--color-success-500);
        }
        
        .ticket-status.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--color-warning-500);
        }
        
        .ticket-status.closed {
            background: rgba(148, 163, 184, 0.1);
            color: var(--text-tertiary);
        }
        
        [data-theme="dark"] .ticket-status.open {
            background: rgba(16, 185, 129, 0.15);
        }
        
        [data-theme="dark"] .ticket-status.pending {
            background: rgba(245, 158, 11, 0.15);
        }
        
        [data-theme="dark"] .ticket-status.closed {
            background: rgba(148, 163, 184, 0.15);
        }
        
        .ticket-title {
            font-size: var(--font-size-md);
            font-weight: var(--font-weight-semibold);
            color: var(--text-primary);
            margin-bottom: var(--space-1);
        }
        
        .ticket-meta {
            display: flex;
            gap: var(--space-4);
            font-size: var(--font-size-xs);
            color: var(--text-tertiary);
        }
        
        .ticket-meta span {
            display: flex;
            align-items: center;
            gap: var(--space-1);
        }
        
        .support-form-section {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
        }
        
        .support-form-section .form-group {
            margin-bottom: var(--space-4);
        }
        
        .support-form-section .form-group:last-child {
            margin-bottom: 0;
        }
        
        @media (max-width: 1024px) {
            .support-contact-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .faq-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {
            .support-contact-grid {
                grid-template-columns: 1fr;
            }
            .support-form-section {
                padding: var(--space-4);
            }
        }
    </style>
</head>
<body>

<!-- Breadcrumb -->
<div class="page-container" style="padding-top: calc(var(--navbar-height) + var(--space-4))">
    <nav class="breadcrumb">
        <span class="breadcrumb-item"><a href="../index.php">خانه</a></span>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active">پشتیبانی</span>
    </nav>
</div>

<!-- Hero Section -->
<div class="page-container">
    <div class="support-hero">
        <h1 style="font-size: var(--font-size-3xl); margin-bottom: var(--space-2);">
            💬 مرکز پشتیبانی R_REX
        </h1>
        <p style="font-size: var(--font-size-md); max-width: 32rem;">
            ما اینجا هستیم تا به شما کمک کنیم. سوالات، مشکلات و پیشنهادات خود را با ما در میان بگذارید.
        </p>
        
        <?php if ($is_logged_in): ?>
            <div style="margin-top: var(--space-4); position: relative; z-index: 1;">
                <span style="background: rgba(255,255,255,0.15); padding: 0.25rem 1rem; border-radius: var(--radius-full); font-size: var(--font-size-sm); display: inline-flex; align-items:center; gap:var(--space-2);">
                    👋 <?php echo htmlspecialchars($user_fullname); ?> عزیز، چطور میتونیم کمک کنیم؟
                </span>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Contact Methods -->
<div class="page-container">
    <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--text-primary); margin-bottom: var(--space-6); text-align:center;">
        راه‌های ارتباط با ما
    </h2>
    
    <div class="support-contact-grid">
        <div class="support-contact-card">
            <div class="contact-icon">📧</div>
            <div class="contact-title">ایمیل</div>
            <div class="contact-desc">پاسخگویی طی ۲۴ ساعت</div>
            <span class="contact-value">support@r-rex.com</span>
        </div>
        
        <div class="support-contact-card">
            <div class="contact-icon">📞</div>
            <div class="contact-title">تلفن</div>
            <div class="contact-desc">شنبه تا چهارشنبه ۹ تا ۱۸</div>
            <span class="contact-value">۰۲۱-۱۲۳۴۵۶۷۸</span>
        </div>
        
        <div class="support-contact-card">
            <div class="contact-icon">💬</div>
            <div class="contact-title">چت آنلاین</div>
            <div class="contact-desc">پاسخ فوری در ساعات کاری</div>
            <span class="contact-value" style="color: var(--color-success-500);">🟢 آنلاین</span>
        </div>
        
        <div class="support-contact-card">
            <div class="contact-icon">📱</div>
            <div class="contact-title">واتساپ</div>
            <div class="contact-desc">پاسخگویی سریع</div>
            <span class="contact-value">۰۹۰۰-۱۲۳-۴۵۶۷</span>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="page-container">
    <div style="text-align:center; margin-bottom: var(--space-6);">
        <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--text-primary); margin-bottom: var(--space-2);">
            ❓ سوالات متداول
        </h2>
        <p style="font-size: var(--font-size-sm); color: var(--text-tertiary);">
            پاسخ سوالات رایج کاربران
        </p>
    </div>
    
    <div class="faq-grid">
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <span>چطور میتونم حساب کاربری بسازم؟</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                برای ساخت حساب کاربری، روی دکمه "ثبت نام" در بالای صفحه کلیک کنید. سپس اطلاعات مورد نیاز شامل نام، نام کاربری، ایمیل و رمز عبور را وارد کنید. پس از تایید ایمیل، حساب شما فعال میشود.
            </div>
        </div>
        
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <span>چطور میتونم محصولات را خریداری کنم؟</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                پس از ورود به حساب کاربری، به صفحه فروشگاه بروید و محصول مورد نظر را انتخاب کنید. روی دکمه "افزودن به سبد خرید" کلیک کنید و سپس مراحل پرداخت را تکمیل کنید. پس از پرداخت موفق، محصول به صورت خودکار در دسترس شما قرار میگیرد.
            </div>
        </div>
        
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <span>روش‌های پرداخت چیست؟</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                ما از تمام روش‌های پرداخت آنلاین شامل کارت‌های بانکی، کیف پول الکترونیکی، انتقال بانکی و پرداخت از طریق درگاه‌های معتبر پشتیبانی میکنیم. همچنین میتوانید از اعتبار کیف پول خود استفاده کنید.
            </div>
        </div>
        
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <span>چطور میتوانم تیکت پشتیبانی ایجاد کنم؟</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                برای ایجاد تیکت پشتیبانی، به بخش "تیکت‌های پشتیبانی" در پایین صفحه بروید و روی دکمه "ایجاد تیکت جدید" کلیک کنید. موضوع و توضیحات مشکل خود را وارد کنید و تیکت را ارسال کنید. تیم پشتیبانی در اسرع وقت پاسخ خواهد داد.
            </div>
        </div>
        
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <span>مدت زمان پاسخگویی چقدر است؟</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                تیم پشتیبانی R_REX در ساعات کاری (شنبه تا چهارشنبه ۹ تا ۱۸) به تیکت‌ها پاسخ میدهد. میانگین زمان پاسخگویی کمتر از ۴ ساعت است. در روزهای تعطیل، پاسخگویی ممکن است کمی بیشتر طول بکشد.
            </div>
        </div>
        
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <span>چطور میتوانم اشتراک خود را لغو کنم؟</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                برای لغو اشتراک، به بخش "داشبورد" بروید و روی "مدیریت اشتراک" کلیک کنید. سپس گزینه "لغو اشتراک" را انتخاب کنید. در صورت لغو، دسترسی شما تا پایان دوره فعال باقی میماند و دیگر تمدید نخواهد شد.
            </div>
        </div>
    </div>
</div>

<!-- Tickets Section -->
<div class="page-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-6); flex-wrap: wrap; gap: var(--space-3);">
        <div>
            <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--text-primary); margin-bottom: var(--space-1);">
                🎫 تیکت‌های پشتیبانی
            </h2>
            <p style="font-size: var(--font-size-sm); color: var(--text-tertiary);">
                وضعیت تیکت‌های خود را مشاهده کنید
            </p>
        </div>
        <a href="#new-ticket" class="btn btn-primary btn-sm">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            ایجاد تیکت جدید
        </a>
    </div>
    
    <div style="display: flex; flex-direction: column; gap: var(--space-3); margin-bottom: var(--space-8);">
        <!-- Ticket 1 -->
        <div class="ticket-card">
            <div class="ticket-header">
                <span class="ticket-status open">● باز</span>
                <span style="font-size: var(--font-size-xs); color: var(--text-tertiary);">#T-۱۰۲۴</span>
            </div>
            <div class="ticket-title">مشکل در دانلود محصول خریداری شده</div>
            <div class="ticket-meta">
                <span>📅 ۱۴۰۴/۰۴/۱۵</span>
                <span>🕐 ۲ ساعت پیش</span>
                <span>💬 ۲ پاسخ</span>
            </div>
        </div>
        
        <!-- Ticket 2 -->
        <div class="ticket-card">
            <div class="ticket-header">
                <span class="ticket-status pending">● در انتظار</span>
                <span style="font-size: var(--font-size-xs); color: var(--text-tertiary);">#T-۱۰۲۳</span>
            </div>
            <div class="ticket-title">سوال درباره روش پرداخت</div>
            <div class="ticket-meta">
                <span>📅 ۱۴۰۴/۰۴/۱۴</span>
                <span>🕐 ۱ روز پیش</span>
                <span>💬 ۱ پاسخ</span>
            </div>
        </div>
        
        <!-- Ticket 3 -->
        <div class="ticket-card">
            <div class="ticket-header">
                <span class="ticket-status closed">● بسته شده</span>
                <span style="font-size: var(--font-size-xs); color: var(--text-tertiary);">#T-۱۰۲۲</span>
            </div>
            <div class="ticket-title">درخواست مشاوره برای انتخاب پلن</div>
            <div class="ticket-meta">
                <span>📅 ۱۴۰۴/۰۴/۱۲</span>
                <span>🕐 ۳ روز پیش</span>
                <span>💬 ۳ پاسخ</span>
            </div>
        </div>
    </div>
</div>

<!-- New Ticket Form -->
<div class="page-container" id="new-ticket">
    <div class="support-form-section">
        <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--text-primary); margin-bottom: var(--space-4);">
            ✉️ ایجاد تیکت جدید
        </h2>
        
        <form action="support_process.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo isset($csrf_token) ? $csrf_token : ''; ?>">
            
            <div class="form-group">
                <label class="form-label" for="ticket_subject">
                    موضوع <span class="required">*</span>
                </label>
                <input type="text" 
                       id="ticket_subject" 
                       name="ticket_subject" 
                       class="form-input"
                       placeholder="موضوع تیکت خود را وارد کنید"
                       required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="ticket_category">
                    دسته‌بندی <span class="required">*</span>
                </label>
                <select id="ticket_category" name="ticket_category" class="form-select" required>
                    <option value="">انتخاب دسته‌بندی...</option>
                    <option value="technical">مشکل فنی</option>
                    <option value="payment">پرداخت و صورتحساب</option>
                    <option value="product">محصولات</option>
                    <option value="account">حساب کاربری</option>
                    <option value="other">سایر</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="ticket_priority">
                    اولویت
                </label>
                <select id="ticket_priority" name="ticket_priority" class="form-select">
                    <option value="low">کم</option>
                    <option value="medium" selected>متوسط</option>
                    <option value="high">بالا</option>
                    <option value="urgent">فوری</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="ticket_message">
                    توضیحات <span class="required">*</span>
                </label>
                <textarea id="ticket_message" 
                          name="ticket_message" 
                          class="form-textarea" 
                          rows="6"
                          placeholder="مشکل خود را به طور کامل توضیح دهید..."
                          required></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="ticket_attachment">
                    پیوست (اختیاری)
                </label>
                <input type="file" id="ticket_attachment" name="ticket_attachment" class="form-input" style="padding:0.5rem;">
                <span class="form-help">حداکثر حجم ۵ مگابایت - فرمت‌های مجاز: jpg, png, pdf, zip</span>
            </div>
            
            <div style="display: flex; gap: var(--space-3); margin-top: var(--space-4); flex-wrap: wrap;">
                <button type="submit" class="btn btn-primary btn-lg">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                    ارسال تیکت
                </button>
                <button type="reset" class="btn btn-outline">پاک کردن</button>
            </div>
        </form>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>

<script>
    function toggleFAQ(element) {
        element.classList.toggle('active');
    }
</script>

</body>
</html>