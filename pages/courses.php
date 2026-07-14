<?php
// pages/courses.php - صفحه آموزش‌ها

require_once 'header.php';

$page_title = "آموزش‌ها | R_REX";
$page_description = "دوره‌های آموزشی حرفه‌ای و به‌روز";
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
        .course-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            margin-bottom: var(--space-8);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .course-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 30rem;
            height: 30rem;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .course-hero h1 {
            color: white;
            position: relative;
            z-index: 1;
        }
        
        .course-hero p {
            color: rgba(255,255,255,0.85);
            position: relative;
            z-index: 1;
        }
        
        .course-search {
            position: relative;
            max-width: 32rem;
            margin-top: var(--space-4);
            z-index: 1;
        }
        
        .course-search input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border-radius: var(--radius-full);
            border: none;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            color: white;
            font-size: var(--font-size-sm);
        }
        
        .course-search input::placeholder {
            color: rgba(255,255,255,0.6);
        }
        
        .course-search svg {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.6);
        }
        
        .course-meta {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding-top: var(--space-3);
            border-top: 1px solid var(--border-secondary);
        }
        
        .course-meta span {
            font-size: var(--font-size-xs);
            color: var(--text-tertiary);
            display: flex;
            align-items: center;
            gap: var(--space-1);
        }
        
        .course-progress {
            width: 100%;
            height: 0.25rem;
            background: var(--bg-tertiary);
            border-radius: var(--radius-full);
            overflow: hidden;
            margin-top: var(--space-2);
        }
        
        .course-progress-bar {
            height: 100%;
            background: var(--gradient-brand);
            border-radius: var(--radius-full);
            transition: width var(--transition-slow);
        }
        
        .course-level-badge {
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            padding: 0.125rem 0.625rem;
            border-radius: var(--radius-full);
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-medium);
        }
        
        .course-level-badge.beginner {
            background: var(--color-success-50);
            color: var(--color-success-600);
        }
        
        .course-level-badge.intermediate {
            background: var(--color-warning-50);
            color: var(--color-warning-600);
        }
        
        .course-level-badge.advanced {
            background: var(--color-danger-50);
            color: var(--color-danger-600);
        }
        
        [data-theme="dark"] .course-level-badge.beginner {
            background: rgba(16, 185, 129, 0.15);
            color: var(--color-success-500);
        }
        
        [data-theme="dark"] .course-level-badge.intermediate {
            background: rgba(245, 158, 11, 0.15);
            color: var(--color-warning-500);
        }
        
        [data-theme="dark"] .course-level-badge.advanced {
            background: rgba(239, 68, 68, 0.15);
            color: var(--color-danger-500);
        }
    </style>
</head>
<body>

<!-- Breadcrumb -->
<div class="page-container" style="padding-top: calc(var(--navbar-height) + var(--space-4))">
    <nav class="breadcrumb">
        <span class="breadcrumb-item"><a href="../index.php">خانه</a></span>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active">آموزش‌ها</span>
    </nav>
</div>

<!-- Hero Section -->
<div class="page-container">
    <div class="course-hero">
        <h1 style="font-size: var(--font-size-3xl); margin-bottom: var(--space-2);">
            📚 آموزش‌های حرفه‌ای
        </h1>
        <p style="font-size: var(--font-size-md); max-width: 32rem;">
            دوره‌های آموزشی به‌روز و تخصصی در حوزه‌های مختلف
        </p>
        
        <div class="course-search">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" placeholder="جستجوی دوره‌های آموزشی...">
        </div>
    </div>
</div>

<!-- Categories -->
<div class="page-container">
    <div class="page-header">
        <div class="page-header-row">
            <div>
                <h1 class="page-title">دوره‌های آموزشی</h1>
                <p class="page-subtitle">بیش از ۵۰۰ دوره آموزشی در حوزه‌های مختلف</p>
            </div>
            <div class="flex gap-3" style="flex-wrap:wrap;">
                <select class="form-select" style="width:auto;padding-left:2rem;">
                    <option>همه دسته‌بندی‌ها</option>
                    <option>برنامه‌نویسی</option>
                    <option>طراحی</option>
                    <option>بازاریابی</option>
                    <option>سئو</option>
                </select>
                <select class="form-select" style="width:auto;padding-left:2rem;">
                    <option>مرتب‌سازی: جدیدترین</option>
                    <option>محبوب‌ترین</option>
                    <option>ارزان‌ترین</option>
                    <option>گران‌ترین</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Courses Grid -->
    <div class="content-grid content-grid-3">
        <!-- Course 1 -->
        <div class="course-card">
            <div class="course-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">⚛️</div>
            <div class="course-info">
                <div class="course-category">برنامه‌نویسی</div>
                <div class="course-title">دوره جامع React.js از صفر تا صد</div>
                <div style="display:flex; gap:var(--space-2); margin: var(--space-2) 0; flex-wrap:wrap;">
                    <span class="course-level-badge beginner">مبتدی</span>
                    <span class="badge badge-warning">۴.۸ ★</span>
                </div>
                <div class="course-meta">
                    <span>🕐 ۴۲ ساعت</span>
                    <span>📹 ۸۶ جلسه</span>
                    <span>👤 ۱۲,۴۰۰ دانشجو</span>
                </div>
                <div class="course-progress">
                    <div class="course-progress-bar" style="width: 0%;"></div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top: var(--space-3);">
                    <div class="course-price">۴۹۹,۰۰۰ تومان</div>
                    <a href="#" class="btn btn-primary btn-sm">مشاهده دوره</a>
                </div>
            </div>
        </div>

        <!-- Course 2 -->
        <div class="course-card">
            <div class="course-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">🎨</div>
            <div class="course-info">
                <div class="course-category">طراحی</div>
                <div class="course-title">آموزش جامع Figma برای طراحان UI/UX</div>
                <div style="display:flex; gap:var(--space-2); margin: var(--space-2) 0; flex-wrap:wrap;">
                    <span class="course-level-badge intermediate">متوسط</span>
                    <span class="badge badge-warning">۴.۹ ★</span>
                </div>
                <div class="course-meta">
                    <span>🕐 ۱۸ ساعت</span>
                    <span>📹 ۴۵ جلسه</span>
                    <span>👤 ۸,۷۰۰ دانشجو</span>
                </div>
                <div class="course-progress">
                    <div class="course-progress-bar" style="width: 0%;"></div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top: var(--space-3);">
                    <div class="course-price">۳۹۹,۰۰۰ تومان</div>
                    <a href="#" class="btn btn-primary btn-sm">مشاهده دوره</a>
                </div>
            </div>
        </div>

        <!-- Course 3 -->
        <div class="course-card">
            <div class="course-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">🐍</div>
            <div class="course-info">
                <div class="course-category">برنامه‌نویسی</div>
                <div class="course-title">دوره پیشرفته Python و Django</div>
                <div style="display:flex; gap:var(--space-2); margin: var(--space-2) 0; flex-wrap:wrap;">
                    <span class="course-level-badge advanced">پیشرفته</span>
                    <span class="badge badge-warning">۴.۷ ★</span>
                </div>
                <div class="course-meta">
                    <span>🕐 ۳۶ ساعت</span>
                    <span>📹 ۷۲ جلسه</span>
                    <span>👤 ۶,۱۰۰ دانشجو</span>
                </div>
                <div class="course-progress">
                    <div class="course-progress-bar" style="width: 0%;"></div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top: var(--space-3);">
                    <div class="course-price">۶۹۹,۰۰۰ تومان</div>
                    <a href="#" class="btn btn-primary btn-sm">مشاهده دوره</a>
                </div>
            </div>
        </div>

        <!-- Course 4 -->
        <div class="course-card">
            <div class="course-image" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">📊</div>
            <div class="course-info">
                <div class="course-category">بازاریابی</div>
                <div class="course-title">دیجیتال مارکتینگ و سئو پیشرفته</div>
                <div style="display:flex; gap:var(--space-2); margin: var(--space-2) 0; flex-wrap:wrap;">
                    <span class="course-level-badge intermediate">متوسط</span>
                    <span class="badge badge-warning">۴.۶ ★</span>
                </div>
                <div class="course-meta">
                    <span>🕐 ۲۴ ساعت</span>
                    <span>📹 ۵۰ جلسه</span>
                    <span>👤 ۴,۲۰۰ دانشجو</span>
                </div>
                <div class="course-progress">
                    <div class="course-progress-bar" style="width: 0%;"></div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top: var(--space-3);">
                    <div class="course-price">۴۵۰,۰۰۰ تومان</div>
                    <a href="#" class="btn btn-primary btn-sm">مشاهده دوره</a>
                </div>
            </div>
        </div>

        <!-- Course 5 -->
        <div class="course-card">
            <div class="course-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">📱</div>
            <div class="course-info">
                <div class="course-category">برنامه‌نویسی</div>
                <div class="course-title">توسعه اپلیکیشن موبایل با Flutter</div>
                <div style="display:flex; gap:var(--space-2); margin: var(--space-2) 0; flex-wrap:wrap;">
                    <span class="course-level-badge beginner">مبتدی</span>
                    <span class="badge badge-warning">۴.۸ ★</span>
                </div>
                <div class="course-meta">
                    <span>🕐 ۳۰ ساعت</span>
                    <span>📹 ۶۰ جلسه</span>
                    <span>👤 ۵,۸۰۰ دانشجو</span>
                </div>
                <div class="course-progress">
                    <div class="course-progress-bar" style="width: 0%;"></div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top: var(--space-3);">
                    <div class="course-price">۵۵۰,۰۰۰ تومان</div>
                    <a href="#" class="btn btn-primary btn-sm">مشاهده دوره</a>
                </div>
            </div>
        </div>

        <!-- Course 6 -->
        <div class="course-card">
            <div class="course-image" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">🎯</div>
            <div class="course-info">
                <div class="course-category">طراحی</div>
                <div class="course-title">آموزش Adobe Photoshop و Illustrator</div>
                <div style="display:flex; gap:var(--space-2); margin: var(--space-2) 0; flex-wrap:wrap;">
                    <span class="course-level-badge beginner">مبتدی</span>
                    <span class="badge badge-warning">۴.۹ ★</span>
                </div>
                <div class="course-meta">
                    <span>🕐 ۲۰ ساعت</span>
                    <span>📹 ۴۰ جلسه</span>
                    <span>👤 ۳,۲۰۰ دانشجو</span>
                </div>
                <div class="course-progress">
                    <div class="course-progress-bar" style="width: 0%;"></div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top: var(--space-3);">
                    <div class="course-price">۳۹۰,۰۰۰ تومان</div>
                    <a href="#" class="btn btn-primary btn-sm">مشاهده دوره</a>
                </div>
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
            <button class="pagination-btn">۱۰</button>
            <button class="pagination-btn">بعدی →</button>
        </nav>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>

</body>
</html>