<?php
// pages/pricing.php - صفحه اشتراک‌ها

require_once 'header.php';

$page_title = "اشتراک‌ها | R_REX";
$page_description = "پلن‌های اشتراک ویژه R_REX";
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
        .pricing-hero {
            text-align: center;
            padding: var(--space-12) 0;
        }
        
        .pricing-hero h1 {
            margin-bottom: var(--space-2);
        }
        
        .pricing-hero p {
            max-width: 32rem;
            margin: 0 auto;
            color: var(--text-secondary);
        }
        
        .pricing-toggle {
            display: inline-flex;
            align-items: center;
            gap: var(--space-3);
            background: var(--bg-tertiary);
            padding: 0.375rem;
            border-radius: var(--radius-full);
            margin-top: var(--space-4);
        }
        
        .pricing-toggle .btn {
            padding: 0.5rem 1.5rem;
            border-radius: var(--radius-full);
            font-size: var(--font-size-sm);
        }
        
        .pricing-toggle .btn.active {
            background: var(--accent-primary);
            color: white;
        }
        
        .pricing-card.featured {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 1px var(--accent-primary), var(--shadow-card-hover);
            transform: scale(1.02);
        }
        
        .pricing-card.featured::before {
            content: '⭐ محبوب‌ترین';
            position: absolute;
            top: -0.75rem;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.25rem 1.5rem;
            background: var(--accent-primary);
            color: white;
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-semibold);
            border-radius: var(--radius-full);
            white-space: nowrap;
        }
        
        .pricing-price .price-amount {
            font-size: var(--font-size-4xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
        }
        
        .pricing-price .price-period {
            font-size: var(--font-size-sm);
            color: var(--text-tertiary);
        }
        
        .pricing-feature .check {
            width: 1.25rem;
            height: 1.25rem;
            color: var(--color-success-500);
            flex-shrink: 0;
        }
        
        .pricing-feature.disabled .check {
            color: var(--text-tertiary);
        }
        
        .pricing-feature.disabled {
            color: var(--text-tertiary);
        }
    </style>
</head>
<body>

<!-- Breadcrumb -->
<div class="page-container" style="padding-top: calc(var(--navbar-height) + var(--space-4))">
    <nav class="breadcrumb">
        <span class="breadcrumb-item"><a href="../index.php">خانه</a></span>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active">اشتراک‌ها</span>
    </nav>
</div>

<!-- Pricing Hero -->
<div class="page-container">
    <div class="pricing-hero">
        <h1 style="font-size: var(--font-size-3xl);">
            💎 پلن‌های اشتراک R_REX
        </h1>
        <p style="font-size: var(--font-size-md);">
            پلن‌های متنوع با امکانات ویژه برای هر نیاز
        </p>
        
        <?php if ($is_logged_in): ?>
            <div style="margin-top: var(--space-3);">
                <span style="background: rgba(16, 185, 129, 0.15); padding: 0.25rem 1.25rem; border-radius: var(--radius-full); font-size: var(--font-size-sm); color: var(--color-success-500);">
                    ✅ <?php echo htmlspecialchars($user_fullname); ?> عزیز، شما مشترک پلن رایگان هستید
                </span>
            </div>
        <?php endif; ?>
        
        <div class="pricing-toggle">
            <button class="btn active" onclick="togglePricing('monthly')">ماهانه</button>
            <button class="btn" onclick="togglePricing('yearly')">سالیانه <span class="badge badge-success" style="font-size:0.625rem;">۲۰٪ تخفیف</span></button>
        </div>
    </div>

    <!-- Pricing Grid -->
    <div class="pricing-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:var(--space-6); align-items:start;">
        
        <!-- Plan 1: Free -->
        <div class="pricing-card">
            <div class="pricing-name">رایگان</div>
            <div class="pricing-desc">برای شروع و آشنایی با پلتفرم</div>
            <div class="pricing-price">
                <span class="price-amount">۰</span>
                <span class="price-period">تومان</span>
            </div>
            <div class="pricing-features">
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    دسترسی به محصولات رایگان
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    ۳ دانلود رایگان در ماه
                </div>
                <div class="pricing-feature disabled">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    پشتیبانی اختصاصی
                </div>
                <div class="pricing-feature disabled">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    تخفیف ویژه
                </div>
            </div>
            <button class="btn btn-outline" style="width:100%;">شروع کنید</button>
        </div>

        <!-- Plan 2: Basic -->
        <div class="pricing-card">
            <div class="pricing-name">پایه</div>
            <div class="pricing-desc">مناسب برای کاربران حرفه‌ای</div>
            <div class="pricing-price">
                <span class="price-amount">۱۹۹</span>
                <span class="price-period">هزار تومان/ماه</span>
            </div>
            <div class="pricing-features">
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    دسترسی به همه محصولات
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    دانلود نامحدود
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    پشتیبانی ۲۴/۷
                </div>
                <div class="pricing-feature disabled">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    تخفیف ویژه
                </div>
            </div>
            <button class="btn btn-primary" style="width:100%;">خرید اشتراک</button>
        </div>

        <!-- Plan 3: Pro (Featured) -->
        <div class="pricing-card featured">
            <div class="pricing-name">حرفه‌ای</div>
            <div class="pricing-desc">بهترین انتخاب برای تیم‌ها</div>
            <div class="pricing-price">
                <span class="price-amount">۳۹۹</span>
                <span class="price-period">هزار تومان/ماه</span>
            </div>
            <div class="pricing-features">
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    همه امکانات پلن پایه
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    تخفیف ۲۰٪ روی همه محصولات
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    پشتیبانی VIP
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    دسترسی به دوره‌های ویژه
                </div>
            </div>
            <button class="btn btn-primary" style="width:100%;">خرید اشتراک</button>
        </div>

        <!-- Plan 4: Enterprise -->
        <div class="pricing-card">
            <div class="pricing-name">سازمانی</div>
            <div class="pricing-desc">راهکار کامل برای سازمان‌ها</div>
            <div class="pricing-price">
                <span class="price-amount">۷۹۹</span>
                <span class="price-period">هزار تومان/ماه</span>
            </div>
            <div class="pricing-features">
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    همه امکانات پلن حرفه‌ای
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    تیم اختصاصی پشتیبانی
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    مشاوره استراتژی
                </div>
                <div class="pricing-feature">
                    <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    API و سفارشی‌سازی
                </div>
            </div>
            <button class="btn btn-outline" style="width:100%;">تماس با ما</button>
        </div>
    </div>

    <!-- FAQ Section -->
    <div style="margin-top: var(--space-16);">
        <h2 style="text-align:center; font-size: var(--font-size-2xl); margin-bottom: var(--space-8);">سوالات متداول</h2>
        <div style="max-width: 48rem; margin: 0 auto; display:flex; flex-direction:column; gap:var(--space-3);">
            <div class="accordion-item" style="cursor:pointer;" onclick="toggleAccordion(this)">
                <div class="accordion-header">
                    <span class="accordion-title">آیا میتوانم پلن خود را تغییر دهم؟</span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content">
                        بله، شما میتوانید در هر زمان پلن اشتراک خود را تغییر دهید. تغییرات در صورت پرداخت تفاوت قیمت اعمال میشود.
                    </div>
                </div>
            </div>
            <div class="accordion-item" style="cursor:pointer;" onclick="toggleAccordion(this)">
                <div class="accordion-header">
                    <span class="accordion-title">آیا امکان لغو اشتراک وجود دارد؟</span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content">
                        بله، شما میتوانید اشتراک خود را در هر زمان لغو کنید. در صورت لغو، دسترسی شما تا پایان دوره فعال باقی میماند.
                    </div>
                </div>
            </div>
            <div class="accordion-item" style="cursor:pointer;" onclick="toggleAccordion(this)">
                <div class="accordion-header">
                    <span class="accordion-title">روش‌های پرداخت چیست؟</span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content">
                        ما از تمام روش‌های پرداخت آنلاین شامل کارت‌های بانکی، کیف پول الکترونیکی و انتقال بانکی پشتیبانی میکنیم.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>

<script>
    function togglePricing(type) {
        document.querySelectorAll('.pricing-toggle .btn').forEach(b => b.classList.remove('active'));
        document.querySelector(`.pricing-toggle .btn:first-child`).classList.toggle('active', type === 'monthly');
        document.querySelector(`.pricing-toggle .btn:last-child`).classList.toggle('active', type === 'yearly');
        // اینجا میتونی قیمت‌ها رو تغییر بدی
        if (type === 'yearly') {
            document.querySelectorAll('.pricing-card:not(:first-child) .price-amount').forEach((el, i) => {
                const prices = [159, 319, 639];
                el.textContent = prices[i];
            });
        } else {
            document.querySelectorAll('.pricing-card:not(:first-child) .price-amount').forEach((el, i) => {
                const prices = [199, 399, 799];
                el.textContent = prices[i];
            });
        }
    }
    
    function toggleAccordion(item) {
        item.classList.toggle('active');
    }
</script>

</body>
</html>