<?php
// auth/header.php - فایل شامل نوار بالا برای همه صفحات

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
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Vazirmatn Font -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    
    <!-- R_REX Styles -->
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="stylesheet" href="../css/responsive.css">
    
    <style>
        /* استایل‌های نوار بالا */
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
        
        /* پیام‌ها */
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
        <a href="../index.php" class="navbar-brand">
            <div class="navbar-logo">R</div>
            <span class="navbar-brand-text">R_REX</span>
        </a>

        <!-- Nav Links -->
        <div class="navbar-nav hide-md">
            <a href="../index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">خانه</a>
            <a href="../pages/shop.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">فروشگاه</a>
            <a href="../pages/community.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'community.php' ? 'active' : ''; ?>">انجمن</a>
            <a href="../pages/pricing.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pricing.php' ? 'active' : ''; ?>">اشتراک‌ها</a>
        </div>

        <!-- Actions -->
        <div class="navbar-actions">
            <!-- Search -->
            <button class="navbar-search-btn hide-md" data-search>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <span>جستجو...</span>
            </button>

            <!-- ============ بخش کاربر ============ -->
            <?php if ($is_logged_in === true): ?>
                <!-- کاربر وارد شده -->
                <div class="navbar-user" onclick="window.location.href='../pages/dashboard.php'" style="cursor:pointer;">
                    <div class="navbar-user-avatar">
                        <?php echo htmlspecialchars($first_letter); ?>
                    </div>
                    <div class="navbar-user-info hide-md">
                        <span class="navbar-user-name"><?php echo htmlspecialchars($user_fullname); ?></span>
                        <span class="navbar-user-role"><?php echo $role_persian; ?></span>
                    </div>
                </div>
                
                <a href="../auth/logout.php" class="btn-outline-sm">🚪 خروج</a>
                
            <?php else: ?>
                <!-- کاربر وارد نشده -->
                <div class="auth-buttons">
                    <a href="../auth/login.php" class="btn btn-outline btn-sm">ورود</a>
                    <a href="../auth/register.php" class="btn btn-primary btn-sm">ثبت نام</a>
                </div>
            <?php endif; ?>

            <!-- Theme Toggle -->
            <button class="theme-toggle" data-tooltip="حالت تاریک"></button>

            <!-- Notifications -->
            <div class="notification-bell">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                <span class="notification-count">۲</span>
            </div>

            <!-- Mobile Menu -->
            <button class="mobile-menu-toggle">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
        </div>
    </div>
</nav>