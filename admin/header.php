<?php
// admin/header.php - هدر پنل ادمین

// استارت سشن
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// بررسی لاگین بودن و ادمین بودن
$is_logged_in = isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
$user_role = $_SESSION['role'] ?? 'user';
$user_fullname = $_SESSION['fullname'] ?? '';

// اگر لاگین نبود یا ادمین نبود، به صفحه اصلی بره
if (!$is_logged_in || $user_role !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

// تنظیمات کاربر ادمین
$first_letter = !empty($user_fullname) ? mb_substr($user_fullname, 0, 1, 'UTF-8') : '؟';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت | R_REX</title>
    
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/layout.css">
    
    <style>
        /* استایل پنل ادمین */
        .admin-body {
            background: var(--bg-primary);
            min-height: 100vh;
            display: flex;
            direction: rtl;
        }
        
        /* سایدبار */
        .admin-sidebar {
            width: 260px;
            background: var(--surface-sidebar);
            border-left: 1px solid var(--border-primary);
            min-height: 100vh;
            padding: var(--space-4);
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: var(--z-fixed);
            transition: all var(--transition-base);
        }
        
        .admin-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        
        .admin-sidebar .sidebar-brand {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-3) var(--space-2);
            margin-bottom: var(--space-6);
            text-decoration: none;
        }
        
        .admin-sidebar .sidebar-brand .brand-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: var(--gradient-brand);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: var(--font-weight-bold);
            font-size: var(--font-size-lg);
        }
        
        .admin-sidebar .sidebar-brand .brand-text {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
        }
        
        .admin-sidebar .sidebar-brand .brand-badge {
            font-size: var(--font-size-xs);
            background: var(--accent-primary);
            color: white;
            padding: 0.125rem 0.5rem;
            border-radius: var(--radius-full);
        }
        
        .admin-sidebar .sidebar-section {
            margin-bottom: var(--space-4);
        }
        
        .admin-sidebar .sidebar-section-title {
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-semibold);
            color: var(--text-tertiary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 var(--space-3);
            margin-bottom: var(--space-2);
        }
        
        .admin-sidebar .sidebar-link {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-2) var(--space-3);
            border-radius: var(--radius-lg);
            color: var(--text-secondary);
            text-decoration: none;
            transition: all var(--transition-fast);
            font-size: var(--font-size-sm);
            margin-bottom: var(--space-1);
        }
        
        .admin-sidebar .sidebar-link:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }
        
        .admin-sidebar .sidebar-link.active {
            background: var(--bg-brand);
            color: var(--text-brand);
            font-weight: var(--font-weight-medium);
        }
        
        .admin-sidebar .sidebar-link .link-icon {
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
        }
        
        .admin-sidebar .sidebar-link .link-badge {
            margin-right: auto;
            padding: 0.125rem 0.5rem;
            font-size: 0.625rem;
            font-weight: var(--font-weight-bold);
            background: var(--color-danger-500);
            color: white;
            border-radius: var(--radius-full);
        }
        
        /* محتوای اصلی */
        .admin-content {
            margin-right: 260px;
            flex: 1;
            min-height: 100vh;
            padding: var(--space-4);
        }
        
        /* هدر بالایی */
        .admin-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4);
            background: var(--surface-card);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-card);
            margin-bottom: var(--space-6);
        }
        
        .admin-topbar .topbar-title h1 {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            margin: 0;
        }
        
        .admin-topbar .topbar-title p {
            font-size: var(--font-size-sm);
            color: var(--text-tertiary);
            margin: 0;
        }
        
        .admin-topbar .topbar-actions {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .admin-topbar .topbar-user {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            background: var(--bg-tertiary);
        }
        
        .admin-topbar .topbar-user .user-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: var(--radius-full);
            background: var(--gradient-brand);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: var(--font-weight-bold);
            font-size: var(--font-size-sm);
        }
        
        .admin-topbar .topbar-user .user-name {
            font-size: var(--font-size-sm);
            font-weight: var(--font-weight-medium);
            color: var(--text-primary);
        }
        
        .admin-topbar .topbar-user .user-role {
            font-size: var(--font-size-xs);
            color: var(--text-tertiary);
        }
        
        /* ریسپانسیو */
        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(100%);
                width: 280px;
            }
            
            .admin-sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .admin-content {
                margin-right: 0;
            }
        }
        
        @media (max-width: 768px) {
            .admin-topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--space-3);
            }
            
            .admin-topbar .topbar-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
        
        /* دکمه منو موبایل */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: var(--font-size-xl);
            cursor: pointer;
            padding: var(--space-2);
        }
        
        @media (max-width: 1024px) {
            .mobile-menu-btn {
                display: block;
            }
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: var(--bg-overlay);
            z-index: calc(var(--z-fixed) - 1);
        }
        
        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body>