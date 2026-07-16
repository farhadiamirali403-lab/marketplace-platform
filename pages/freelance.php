<?php
// pages/freelance.php - صفحه فریلنسری

require_once 'header.php';

$page_title = "فریلنسری | R_REX";
$page_description = "بهترین فریلنسرهای ایران در یک پلتفرم";
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
        .freelance-hero {
            background: var(--gradient-brand);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            margin-bottom: var(--space-8);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .freelance-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 30rem;
            height: 30rem;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .freelance-hero h1 {
            color: white;
            position: relative;
            z-index: 1;
        }
        
        .freelance-hero p {
            color: rgba(255,255,255,0.85);
            position: relative;
            z-index: 1;
        }
        
        .freelance-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-4);
            margin-top: var(--space-6);
            position: relative;
            z-index: 1;
        }
        
        .freelance-stat {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-xl);
            padding: var(--space-4);
            text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .freelance-stat-value {
            font-size: var(--font-size-2xl);
            font-weight: var(--font-weight-bold);
            color: white;
        }
        
        .freelance-stat-label {
            font-size: var(--font-size-xs);
            color: rgba(255,255,255,0.7);
            margin-top: var(--space-1);
        }
        
        .category-tabs {
            display: flex;
            gap: var(--space-2);
            flex-wrap: wrap;
            margin-bottom: var(--space-6);
        }
        
        .category-tab {
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius-full);
            border: 1px solid var(--border-primary);
            background: var(--surface-card);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all var(--transition-fast);
            font-size: var(--font-size-sm);
        }
        
        .category-tab:hover {
            border-color: var(--accent-primary);
            color: var(--text-primary);
        }
        
        .category-tab.active {
            background: var(--accent-primary);
            color: white;
            border-color: var(--accent-primary);
        }
        
        .project-card .project-tags {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-2);
            margin-top: var(--space-3);
        }
    </style>
</head>
<body>

<!-- Breadcrumb -->
<div class="page-container" style="padding-top: calc(var(--navbar-height) + var(--space-4))">
    <nav class="breadcrumb">
        <span class="breadcrumb-item"><a href="../index.php">خانه</a></span>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active">فریلنسری</span>
    </nav>
</div>

<!-- Hero Section -->
<div class="page-container">
    <div class="freelance-hero">
        <h1 style="font-size: var(--font-size-3xl); margin-bottom: var(--space-2);">
            💼 پلتفرم فریلنسری
        </h1>
        <p style="font-size: var(--font-size-md); max-width: 32rem;">
            ارتباط با بهترین فریلنسرهای ایران در حوزه‌های مختلف
        </p>
        
        <div class="freelance-stats">
            <div class="freelance-stat">
                <div class="freelance-stat-value">۸,۵۰۰+</div>
                <div class="freelance-stat-label">فریلنسر فعال</div>
            </div>
            <div class="freelance-stat">
                <div class="freelance-stat-value">۱۲,۰۰۰+</div>
                <div class="freelance-stat-label">پروژه تکمیل شده</div>
            </div>
            <div class="freelance-stat">
                <div class="freelance-stat-value">۹۸%</div>
                <div class="freelance-stat-label">رضایت مشتری</div>
            </div>
            <div class="freelance-stat">
                <div class="freelance-stat-value">۴.۸</div>
                <div class="freelance-stat-label">میانگین امتیاز</div>
            </div>
        </div>
        
        <?php if ($is_logged_in): ?>
            <div style="margin-top: var(--space-4); position: relative; z-index: 1;">
                <span style="background: rgba(255,255,255,0.15); padding: 0.25rem 1rem; border-radius: var(--radius-full); font-size: var(--font-size-sm);">
                    👋 <?php echo htmlspecialchars($user_fullname); ?> عزیز، یک پروژه جدید ثبت کن!
                </span>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Categories & Filters -->
<div class="page-container">
    <div class="page-header">
        <div class="page-header-row">
            <div>
                <h1 class="page-title">پروژه‌های فریلنسری</h1>
                <p class="page-subtitle">پروژه‌های خود را به بهترین فریلنسرها بسپارید</p>
            </div>
            <div class="flex gap-3" style="flex-wrap:wrap;">
                <a href="#post-project" class="btn btn-primary btn-sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    ثبت پروژه جدید
                </a>
                <select class="form-select" style="width:auto;padding-left:2rem;">
                    <option>مرتب‌سازی: جدیدترین</option>
                    <option>بیشترین بودجه</option>
                    <option>کمترین بودجه</option>
                    <option>پرطرفدارترین</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="category-tabs">
        <button class="category-tab active">همه</button>
        <button class="category-tab">طراحی UI/UX</button>
        <button class="category-tab">توسعه وب</button>
        <button class="category-tab">برنامه‌نویسی موبایل</button>
        <button class="category-tab">نوشتن محتوا</button>
        <button class="category-tab">ترجمه</button>
        <button class="category-tab">سئو</button>
        <button class="category-tab">گرافیک</button>
    </div>

    <!-- Projects Grid -->
    <div class="content-grid content-grid-2" style="grid-template-columns: 1fr 1fr; gap: var(--space-6);">
        
        <!-- Project 1 -->
        <div class="project-card">
            <div class="project-header">
                <div>
                    <div class="project-title">طراحی رابط کاربری اپلیکیشن فروشگاهی</div>
                    <div style="display:flex; gap: var(--space-2); margin-top: var(--space-1); flex-wrap:wrap;">
                        <span class="badge badge-primary">طراحی UI/UX</span>
                        <span class="badge badge-success">فوری</span>
                    </div>
                </div>
                <div class="project-budget">۲,۵۰۰,۰۰۰ تومان</div>
            </div>
            <p class="project-desc">
                طراحی کامل رابط کاربری اپلیکیشن فروشگاهی با تمرکز بر تجربه کاربری عالی. نیاز به طراحی صفحه اصلی، دسته‌بندی، سبد خرید و پروفایل کاربر.
            </p>
            <div class="project-meta">
                <span>📅 مهلت: ۱۰ روز</span>
                <span>📍 پروژه: ۲۴ ساعت پیش</span>
                <span>👤 ۳ پیشنهاد</span>
            </div>
            <div class="project-tags">
                <span class="tag">Figma</span>
                <span class="tag">Adobe XD</span>
                <span class="tag">UI/UX</span>
            </div>
            <div style="margin-top: var(--space-3); display: flex; gap: var(--space-2);">
                <a href="#" class="btn btn-primary btn-sm">ثبت پیشنهاد</a>
                <a href="#" class="btn btn-outline btn-sm">جزئیات</a>
            </div>
        </div>

        <!-- Project 2 -->
        <div class="project-card">
            <div class="project-header">
                <div>
                    <div class="project-title">توسعه وب‌سایت با React.js</div>
                    <div style="display:flex; gap: var(--space-2); margin-top: var(--space-1); flex-wrap:wrap;">
                        <span class="badge badge-primary">توسعه وب</span>
                        <span class="badge badge-warning">متوسط</span>
                    </div>
                </div>
                <div class="project-budget">۴,۰۰۰,۰۰۰ تومان</div>
            </div>
            <p class="project-desc">
                ساخت وب‌سایت شرکتی با React.js و Next.js. نیاز به طراحی ریسپانسیو، ارتباط با API و داشبورد مدیریتی.
            </p>
            <div class="project-meta">
                <span>📅 مهلت: ۲۰ روز</span>
                <span>📍 پروژه: ۲ روز پیش</span>
                <span>👤 ۷ پیشنهاد</span>
            </div>
            <div class="project-tags">
                <span class="tag">React.js</span>
                <span class="tag">Next.js</span>
                <span class="tag">Tailwind</span>
            </div>
            <div style="margin-top: var(--space-3); display: flex; gap: var(--space-2);">
                <a href="#" class="btn btn-primary btn-sm">ثبت پیشنهاد</a>
                <a href="#" class="btn btn-outline btn-sm">جزئیات</a>
            </div>
        </div>

        <!-- Project 3 -->
        <div class="project-card">
            <div class="project-header">
                <div>
                    <div class="project-title">نوشتن مقالات تخصصی سئو</div>
                    <div style="display:flex; gap: var(--space-2); margin-top: var(--space-1); flex-wrap:wrap;">
                        <span class="badge badge-primary">نوشتن محتوا</span>
                        <span class="badge badge-success">فوری</span>
                    </div>
                </div>
                <div class="project-budget">۱,۲۰۰,۰۰۰ تومان</div>
            </div>
            <p class="project-desc">
                نوشتن ۱۰ مقاله تخصصی با موضوع سئو و دیجیتال مارکتینگ. نیاز به تحقیق کلمات کلیدی و رعایت اصول سئو.
            </p>
            <div class="project-meta">
                <span>📅 مهلت: ۵ روز</span>
                <span>📍 پروژه: ۱ روز پیش</span>
                <span>👤 ۵ پیشنهاد</span>
            </div>
            <div class="project-tags">
                <span class="tag">سئو</span>
                <span class="tag">نوشتن محتوا</span>
                <span class="tag">دیجیتال مارکتینگ</span>
            </div>
            <div style="margin-top: var(--space-3); display: flex; gap: var(--space-2);">
                <a href="#" class="btn btn-primary btn-sm">ثبت پیشنهاد</a>
                <a href="#" class="btn btn-outline btn-sm">جزئیات</a>
            </div>
        </div>

        <!-- Project 4 -->
        <div class="project-card">
            <div class="project-header">
                <div>
                    <div class="project-title">طراحی لوگو و هویت بصری</div>
                    <div style="display:flex; gap: var(--space-2); margin-top: var(--space-1); flex-wrap:wrap;">
                        <span class="badge badge-primary">گرافیک</span>
                        <span class="badge badge-info">طولانی</span>
                    </div>
                </div>
                <div class="project-budget">۳,۰۰۰,۰۰۰ تومان</div>
            </div>
            <p class="project-desc">
                طراحی لوگو و هویت بصری کامل برای برند جدید. شامل لوگو، رنگ‌بندی، تایپوگرافی و راهنمای برند.
            </p>
            <div class="project-meta">
                <span>📅 مهلت: ۱۵ روز</span>
                <span>📍 پروژه: ۳ روز پیش</span>
                <span>👤 ۸ پیشنهاد</span>
            </div>
            <div class="project-tags">
                <span class="tag">Logo Design</span>
                <span class="tag">Brand Identity</span>
                <span class="tag">Illustrator</span>
            </div>
            <div style="margin-top: var(--space-3); display: flex; gap: var(--space-2);">
                <a href="#" class="btn btn-primary btn-sm">ثبت پیشنهاد</a>
                <a href="#" class="btn btn-outline btn-sm">جزئیات</a>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8">
        <nav class="pagination">
            <button class="pagination-btn" disabled>← قبلی</button>
            <button class="pagination-btn active">۱</button>
            <button class="pagination-btn">۲</button>
            <button class="pagination-btn">۳</button>
            <span class="pagination-ellipsis">...</span>
            <button class="pagination-btn">۸</button>
            <button class="pagination-btn">بعدی →</button>
        </nav>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>

<script>
    // تغییر دسته‌بندی
    document.querySelectorAll('.category-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>
</html>