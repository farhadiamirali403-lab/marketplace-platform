<?php
// pages/community.php - صفحه انجمن

require_once 'header.php';

$page_title = "انجمن | R_REX";
$page_description = "انجمن تخصصی R_REX برای تبادل نظر";
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
        .community-hero {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            margin-bottom: var(--space-8);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .community-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 30rem;
            height: 30rem;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .community-hero h1 {
            color: white;
            position: relative;
            z-index: 1;
        }
        
        .community-hero p {
            color: rgba(255,255,255,0.85);
            position: relative;
            z-index: 1;
        }
        
        .forum-post .forum-post-stats {
            display: flex;
            gap: var(--space-4);
            font-size: var(--font-size-xs);
            color: var(--text-tertiary);
        }
        
        .forum-post .forum-post-stats span {
            display: flex;
            align-items: center;
            gap: var(--space-1);
        }
        
        .forum-category-badge {
            display: inline-block;
            padding: 0.125rem 0.625rem;
            border-radius: var(--radius-full);
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-medium);
        }
        
        .forum-category-badge.technical {
            background: var(--accent-50);
            color: var(--accent-600);
        }
        
        .forum-category-badge.design {
            background: rgba(139, 92, 246, 0.1);
            color: #8b5cf6;
        }
        
        .forum-category-badge.marketing {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        

        
        [data-theme="dark"] .forum-category-badge.technical {
            background: rgba(59, 130, 246, 0.15);
            color: var(--accent-400);
        }
    </style>
</head>
<body>

<!-- Breadcrumb -->
<div class="page-container" style="padding-top: calc(var(--navbar-height) + var(--space-4))">
    <nav class="breadcrumb">
        <span class="breadcrumb-item"><a href="../index.php">خانه</a></span>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active">انجمن</span>
    </nav>
</div>

<!-- Hero Section -->
<div class="page-container">
    <div class="community-hero">
        <h1 style="font-size: var(--font-size-3xl); margin-bottom: var(--space-2);">
            💬 انجمن تخصصی R_REX
        </h1>
        <p style="font-size: var(--font-size-md); max-width: 32rem;">
            محلی برای تبادل نظر، پرسش و پاسخ و اشتراک‌گذاری تجربیات
        </p>
        
        <div style="margin-top: var(--space-4); position: relative; z-index: 1; display: flex; gap: var(--space-3); flex-wrap:wrap;">
            <a href="#" class="btn btn-white btn-sm">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                ایجاد موضوع جدید
            </a>
            <a href="#" class="btn btn-ghost-white btn-sm">
                داغ‌ترین بحث‌ها
            </a>
            <?php if ($is_logged_in): ?>
                <span style="background: rgba(255,255,255,0.15); padding: 0.25rem 1rem; border-radius: var(--radius-full); font-size: var(--font-size-sm); display: flex; align-items:center; gap:var(--space-2);">
                    👋 <?php echo htmlspecialchars($user_fullname); ?>
                    <span style="font-size: var(--font-size-xs); opacity:0.7;">| <?php echo $role_persian; ?></span>
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Community Stats -->
<div class="page-container">
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--space-4); margin-bottom: var(--space-8);">
        <div class="stat-card" style="text-align:center;">
            <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--text-primary);">۲,۴۵۰</div>
            <div style="color: var(--text-tertiary); font-size: var(--font-size-sm);">موضوعات</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--text-primary);">۱۲,۸۰۰</div>
            <div style="color: var(--text-tertiary); font-size: var(--font-size-sm);">پاسخ‌ها</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--text-primary);">۴,۲۰۰</div>
            <div style="color: var(--text-tertiary); font-size: var(--font-size-sm);">کاربران آنلاین</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--text-primary);">۹۸%</div>
            <div style="color: var(--text-tertiary); font-size: var(--font-size-sm);">رضایت کاربران</div>
        </div>
    </div>
</div>

<!-- Categories & Forum Posts -->
<div class="page-container">
    <div class="page-header">
        <div class="page-header-row">
            <div>
                <h1 class="page-title">آخرین موضوعات</h1>
                <p class="page-subtitle">جدیدترین بحث‌های انجمن</p>
            </div>
            <div style="display:flex; gap:var(--space-2); flex-wrap:wrap;">
                <select class="form-select" style="width:auto;padding-left:2rem;">
                    <option>همه دسته‌ها</option>
                    <option>تکنیکال</option>
                    <option>طراحی</option>
                    <option>بازاریابی</option>
                </select>
                <select class="form-select" style="width:auto;padding-left:2rem;">
                    <option>جدیدترین</option>
                    <option>پاسخ‌دار</option>
                    <option>بدون پاسخ</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Forum Posts -->
    <div style="display:flex; flex-direction:column; gap:var(--space-3);">
        <!-- Post 1 -->
        <div class="forum-post">
            <div class="forum-post-header">
                <div class="forum-post-avatar" style="width:2.5rem;height:2.5rem;border-radius:var(--radius-full);background:var(--gradient-brand);display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:var(--font-size-sm);">م</div>
                <div>
                    <div class="forum-post-author">محمد رضایی</div>
                    <div class="forum-post-time">۲ ساعت پیش</div>
                </div>
                <div style="margin-right:auto;">
                    <span class="forum-category-badge technical">تکنیکال</span>
                </div>
            </div>
            <div class="forum-post-title">بهترین فریم‌ورک برای شروع پروژه‌های React در ۲۰۲۵</div>
            <div class="forum-post-excerpt">
                سلام دوستان! من تازه شروع به یادگیری React کردم و میخوام بدونم برای شروع یک پروژه واقعی، کدوم فریم‌ورک یا ابزار رو پیشنهاد میکنید؟ Next.js، Vite یا Create React App؟ تجربیاتتون رو به اشتراک بذارید.
            </div>
            <div class="forum-post-footer">
                <div class="forum-post-stats">
                    <span>💬 ۱۲ پاسخ</span>
                    <span>👁️ ۸۵ بازدید</span>
                </div>
                <div style="display:flex; gap:var(--space-2); margin-right:auto;">
                    <button class="btn btn-ghost btn-xs">پاسخ</button>
                    <button class="btn btn-ghost btn-xs">ذخیره</button>
                </div>
            </div>
        </div>

        <!-- Post 2 -->
        <div class="forum-post">
            <div class="forum-post-header">
                <div class="forum-post-avatar" style="width:2.5rem;height:2.5rem;border-radius:var(--radius-full);background:linear-gradient(135deg,#f093fb,#f5576c);display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:var(--font-size-sm);">س</div>
                <div>
                    <div class="forum-post-author">سارا احمدی</div>
                    <div class="forum-post-time">۵ ساعت پیش</div>
                </div>
                <div style="margin-right:auto;">
                    <span class="forum-category-badge design">طراحی</span>
                </div>
            </div>
            <div class="forum-post-title">نحوه ایجاد سیستم طراحی در Figma</div>
            <div class="forum-post-excerpt">
                سلام! میخوام بدونم چطور میتونم یک سیستم طراحی جامع و مقیاس‌پذیر در Figma ایجاد کنم. دنبال راهنمایی برای ساخت components، variants و styles هستم. کسی تجربه داره؟
            </div>
            <div class="forum-post-footer">
                <div class="forum-post-stats">
                    <span>💬 ۸ پاسخ</span>
                    <span>👁️ ۵۶ بازدید</span>
                </div>
                <div style="display:flex; gap:var(--space-2); margin-right:auto;">
                    <button class="btn btn-ghost btn-xs">پاسخ</button>
                    <button class="btn btn-ghost btn-xs">ذخیره</button>
                </div>
            </div>
        </div>

        <!-- Post 3 -->
        <div class="forum-post">
            <div class="forum-post-header">
                <div class="forum-post-avatar" style="width:2.5rem;height:2.5rem;border-radius:var(--radius-full);background:linear-gradient(135deg,#43e97b,#38f9d7);display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:var(--font-size-sm);">ن</div>
                <div>
                    <div class="forum-post-author">نیلوفر شریفی</div>
                    <div class="forum-post-time">۲ روز پیش</div>
                </div>
                <div style="margin-right:auto;">
                    <span class="forum-category-badge marketing">بازاریابی</span>
                </div>
            </div>
            <div class="forum-post-title">استراتژی‌های موثر برای بازاریابی محتوا</div>
            <div class="forum-post-excerpt">
                سلام! میخوام بدونم چه استراتژی‌هایی برای بازاریابی محتوا در سال ۲۰۲۵ موثر هستن؟ دنبال روش‌های جدید برای تولید محتوا و جذب مخاطب هستم. راهکارهای عملی رو ممنون میشم بگید.
            </div>
            <div class="forum-post-footer">
                <div class="forum-post-stats">
                    <span>💬 ۵ پاسخ</span>
                    <span>👁️ ۴۲ بازدید</span>
                </div>
                <div style="display:flex; gap:var(--space-2); margin-right:auto;">
                    <button class="btn btn-ghost btn-xs">پاسخ</button>
                    <button class="btn btn-ghost btn-xs">ذخیره</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Load More -->
    <div class="text-center mt-8">
        <button class="btn btn-outline btn-lg">بارگذاری بیشتر</button>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>

</body>
</html>