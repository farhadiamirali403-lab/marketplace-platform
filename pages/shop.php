<?php
// pages/shop.php - صفحه فروشگاه

// ============ شامل کردن هدر ============
require_once 'header.php';

// ============ متغیرهای اضافی مخصوص این صفحه ============
$page_title = "فروشگاه | R_REX";
$page_description = "بیش از ۱۲,۰۰۰ محصول دیجیتال با کیفیت بالا";

// ============ دریافت پیام‌ها از URL ============
$success_message = '';
$error_message = '';

if (isset($_GET['success'])) {
    $success_message = htmlspecialchars($_GET['success']);
}
if (isset($_GET['error'])) {
    $error_message = htmlspecialchars($_GET['error']);
}

// ============ تنظیم عنوان صفحه ============
// (عنوان قبلاً در header.php تعریف شده، اینجا فقط برای صفحه است)
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    
    <!-- Font & Styles (قبلاً در header.php لود شده، اما برای اطمینان دوباره) -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="stylesheet" href="../css/responsive.css">
    
    <style>
        /* استایل‌های اضافی مخصوص فروشگاه */
        .shop-hero {
            background: var(--gradient-brand);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            margin-bottom: var(--space-8);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .shop-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 30rem;
            height: 30rem;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .shop-hero h1 {
            color: white;
            position: relative;
            z-index: 1;
        }
        
        .shop-hero p {
            color: rgba(255,255,255,0.85);
            position: relative;
            z-index: 1;
        }
        
        .filter-section {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            position: sticky;
            top: calc(var(--navbar-height) + var(--space-4));
        }
        
        .filter-section .form-group {
            margin-bottom: var(--space-4);
        }
        
        .filter-section .form-group:last-child {
            margin-bottom: 0;
        }
        
        .active-filter {
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            padding: 0.25rem 0.75rem;
            background: var(--bg-brand);
            color: var(--text-brand);
            border-radius: var(--radius-full);
            font-size: var(--font-size-xs);
            border: 1px solid var(--accent-200);
        }
        
        .active-filter .remove-filter {
            cursor: pointer;
            margin-right: var(--space-1);
            color: var(--text-tertiary);
            transition: color var(--transition-fast);
        }
        
        .active-filter .remove-filter:hover {
            color: var(--color-danger-500);
        }
        
        .product-count {
            font-size: var(--font-size-sm);
            color: var(--text-tertiary);
        }
    </style>
</head>
<body>

<!-- ============================================
     نوار بالا (از header.php قبلاً لود شده)
     ============================================ -->

<!-- ============================================
     Breadcrumb
     ============================================ -->
<div class="page-container" style="padding-top: calc(var(--navbar-height) + var(--space-4))">
    <nav class="breadcrumb">
        <span class="breadcrumb-item"><a href="../index.php">خانه</a></span>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active">فروشگاه</span>
    </nav>
</div>

<!-- ============================================
     Shop Hero
     ============================================ -->
<div class="page-container">
    <div class="shop-hero">
        <h1 style="font-size: var(--font-size-3xl); margin-bottom: var(--space-2);">
            🛒 فروشگاه دیجیتال
        </h1>
        <p style="font-size: var(--font-size-md); max-width: 32rem;">
            بیش از ۱۲,۰۰۰ محصول دیجیتال با کیفیت بالا
        </p>
        
        <?php if ($is_logged_in): ?>
            <div style="margin-top: var(--space-4); position: relative; z-index: 1;">
                <span style="background: rgba(255,255,255,0.15); padding: 0.25rem 1rem; border-radius: var(--radius-full); font-size: var(--font-size-sm);">
                    👋 خوش آمدید <?php echo htmlspecialchars($user_fullname); ?>
                </span>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- ============================================
     Page Header with Filters
     ============================================ -->
<div class="page-container">
    <div class="page-header">
        <div class="page-header-row">
            <div>
                <h1 class="page-title">فروشگاه</h1>
                <p class="page-subtitle"><?php echo $page_description; ?></p>
            </div>
            <div class="flex gap-3" style="flex-wrap:wrap;">
                <button class="btn btn-secondary btn-sm" onclick="toggleFilters()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                    </svg>
                    فیلترها
                </button>
                <select class="form-select" style="width:auto;padding-left:2rem;">
                    <option>مرتب‌سازی: جدیدترین</option>
                    <option>محبوب‌ترین</option>
                    <option>پرفروش‌ترین</option>
                    <option>ارزان‌ترین</option>
                    <option>گران‌ترین</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Filters & Products Grid -->
    <div class="layout-two-col-sidebar" id="shop-grid">
        <!-- Sidebar Filters -->
        <aside id="filter-sidebar" style="display: block;">
            <div class="filter-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-4);">
                    <span style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">فیلترها</span>
                    <button class="btn btn-ghost btn-xs" onclick="clearFilters()">پاک کردن</button>
                </div>
                
                <!-- Categories -->
                <div class="form-group">
                    <label class="form-label">دسته‌بندی</label>
                    <div class="flex flex-col gap-2">
                        <label class="form-check">
                            <input type="checkbox" checked onchange="applyFilter()">
                            <span class="form-check-label">قالب وب‌سایت</span>
                            <span class="badge badge-neutral" style="margin-right: auto;">۱۲۴</span>
                        </label>
                        <label class="form-check">
                            <input type="checkbox" onchange="applyFilter()">
                            <span class="form-check-label">طراحی UI/UX</span>
                            <span class="badge badge-neutral" style="margin-right: auto;">۸۹</span>
                        </label>
                        <label class="form-check">
                            <input type="checkbox" onchange="applyFilter()">
                            <span class="form-check-label">ابزار توسعه</span>
                            <span class="badge badge-neutral" style="margin-right: auto;">۵۶</span>
                        </label>
                        <label class="form-check">
                            <input type="checkbox" onchange="applyFilter()">
                            <span class="form-check-label">گرافیک</span>
                            <span class="badge badge-neutral" style="margin-right: auto;">۱۷۸</span>
                        </label>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="form-group">
                    <label class="form-label">محدوده قیمت</label>
                    <div class="flex gap-2">
                        <input type="text" class="form-input" placeholder="از" style="width:50%;">
                        <input type="text" class="form-input" placeholder="تا" style="width:50%;">
                    </div>
                </div>

                <!-- Rating -->
                <div class="form-group">
                    <label class="form-label">امتیاز</label>
                    <div class="flex flex-col gap-2">
                        <label class="form-check">
                            <input type="radio" name="rating" onchange="applyFilter()">
                            <span class="form-check-label flex items-center gap-1">
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                ۵
                            </span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="rating" onchange="applyFilter()">
                            <span class="form-check-label">۴ و بالاتر</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="rating" onchange="applyFilter()">
                            <span class="form-check-label">۳ و بالاتر</span>
                        </label>
                    </div>
                </div>

                <!-- Discount -->
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-check">
                        <input type="checkbox" onchange="applyFilter()">
                        <span class="form-check-label">🎯 فقط محصولات تخفیف‌دار</span>
                    </label>
                </div>
            </div>
        </aside>

        <!-- Products Grid -->
        <div>
            <!-- Active Filters -->
            <div class="flex items-center gap-2 mb-4" style="flex-wrap:wrap;">
                <span class="product-count">۱۲۴ محصول یافت شد</span>
                <span style="color: var(--text-tertiary); margin: 0 var(--space-2);">|</span>
                <span class="text-sm text-secondary">فیلتر فعال:</span>
                <span class="active-filter">
                    قالب وب‌سایت
                    <span class="remove-filter" onclick="removeFilter(this)">✕</span>
                </span>
                <span class="active-filter">
                    تخفیف‌دار
                    <span class="remove-filter" onclick="removeFilter(this)">✕</span>
                </span>
            </div>

            <!-- Products Grid -->
            <div class="content-grid content-grid-3">
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

                <!-- Product 5 -->
                <div class="product-card">
                    <div class="product-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:2rem;">🖼️</div>
                    <div class="product-badge">
                        <span class="badge badge-danger">۳۰٪ تخفیف</span>
                    </div>
                    <div class="product-info">
                        <div class="product-category">گرافیک</div>
                        <div class="product-title">بسته آیکون‌های مینیمال - ۱۲۰۰ آیکون</div>
                        <div class="product-rating">
                            <div class="rating">
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                            <span class="rating-text">(۴۵)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">۱۳۹,۰۰۰ تومان</span>
                            <span class="original-price">۱۹۹,۰۰۰ تومان</span>
                        </div>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="product-card">
                    <div class="product-image" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); display:flex; align-items:center; justify-content:center; color:white; font-size:2rem;">📱</div>
                    <div class="product-info">
                        <div class="product-category">قالب اپلیکیشن</div>
                        <div class="product-title">قالب اپلیکیشن فروشگاهی - Flutter</div>
                        <div class="product-rating">
                            <div class="rating">
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg class="star filled" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg class="star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg class="star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                            <span class="rating-text">(۶۷)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">۸۹۰,۰۰۰ تومان</span>
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
                    <button class="pagination-btn">۱۲</button>
                    <button class="pagination-btn">بعدی →</button>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     اسکریپت‌ها
     ============================================ -->
<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>

<script>
    // توابع فیلتر (اختیاری)
    function toggleFilters() {
        const sidebar = document.getElementById('filter-sidebar');
        if (sidebar.style.display === 'none') {
            sidebar.style.display = 'block';
        } else {
            sidebar.style.display = 'none';
        }
    }
    
    function applyFilter() {
        // اینجا میتونی کد فیلتر کردن رو بنویسی
        console.log('فیلتر اعمال شد');
    }
    
    function clearFilters() {
        const checkboxes = document.querySelectorAll('#filter-sidebar input[type="checkbox"]');
        const radios = document.querySelectorAll('#filter-sidebar input[type="radio"]');
        
        checkboxes.forEach(cb => cb.checked = false);
        radios.forEach(r => r.checked = false);
        
        applyFilter();
    }
    
    function removeFilter(element) {
        // حذف فیلتر فعال
        const filter = element.parentElement;
        filter.style.display = 'none';
        applyFilter();
    }
</script>

</body>
</html>