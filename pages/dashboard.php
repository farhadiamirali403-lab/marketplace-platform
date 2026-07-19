<?php
// pages/dashboard.php - داشبورد کاربر

require_once 'header.php';

// اگر کاربر لاگین نبود، به صفحه ورود ببر
if (!$is_logged_in) {
    header('Location: ../auth/login.php');
    exit;
}

$page_title = "داشبورد | R_REX";
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="stylesheet" href="../css/responsive.css">
    
    <style>
        .dashboard-header {
            margin-bottom: var(--space-8);
        }
        
        .dashboard-header h1 {
            font-size: var(--font-size-3xl);
            margin-bottom: var(--space-2);
        }
        
        .dashboard-header p {
            color: var(--text-secondary);
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-4);
            margin-bottom: var(--space-8);
        }
        
        .dashboard-stat {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-xl);
            padding: var(--space-5);
            transition: all var(--transition-base);
        }
        
        .dashboard-stat:hover {
            box-shadow: var(--shadow-card-hover);
        }
        
        .dashboard-stat .stat-icon {
            font-size: var(--font-size-2xl);
            margin-bottom: var(--space-2);
        }
        
        .dashboard-stat .stat-value {
            font-size: var(--font-size-2xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
        }
        
        .dashboard-stat .stat-label {
            font-size: var(--font-size-sm);
            color: var(--text-tertiary);
        }
        
        .dashboard-stat .stat-change {
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-medium);
            padding: 0.125rem 0.5rem;
            border-radius: var(--radius-full);
            display: inline-block;
            margin-top: var(--space-1);
        }
        
        .dashboard-stat .stat-change.positive {
            color: var(--color-success-500);
            background: rgba(16, 185, 129, 0.1);
        }
        
        .dashboard-stat .stat-change.negative {
            color: var(--color-danger-500);
            background: rgba(239, 68, 68, 0.1);
        }
        
        .dashboard-section-title {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-semibold);
            color: var(--text-primary);
            margin-bottom: var(--space-4);
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-3);
        }
        
        .quick-action {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-xl);
            padding: var(--space-4);
            text-align: center;
            cursor: pointer;
            transition: all var(--transition-base);
            text-decoration: none;
            color: var(--text-primary);
        }
        
        .quick-action:hover {
            box-shadow: var(--shadow-card-hover);
            border-color: var(--accent-primary);
            transform: translateY(-2px);
        }
        
        .quick-action .action-icon {
            font-size: var(--font-size-2xl);
            margin-bottom: var(--space-2);
        }
        
        .quick-action .action-label {
            font-size: var(--font-size-sm);
            font-weight: var(--font-weight-medium);
        }
        
        .quick-action .action-desc {
            font-size: var(--font-size-xs);
            color: var(--text-tertiary);
        }
        
        .recent-activity {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-3) 0;
            border-bottom: 1px solid var(--border-secondary);
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: var(--radius-lg);
            background: var(--bg-tertiary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-lg);
            flex-shrink: 0;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-text {
            font-size: var(--font-size-sm);
            color: var(--text-primary);
        }
        
        .activity-text strong {
            font-weight: var(--font-weight-semibold);
        }
        
        .activity-time {
            font-size: var(--font-size-xs);
            color: var(--text-tertiary);
        }
        
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div style="padding-top: var(--navbar-height);">
    <div class="page-container">
        
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>👋 سلام <?php echo htmlspecialchars($user_fullname); ?>!</h1>
            <p>به داشبورد خود خوش آمدید. اینجا می‌توانید فعالیت‌های خود را مدیریت کنید.</p>
            <div style="margin-top: var(--space-2); display: flex; gap: var(--space-2); flex-wrap:wrap;">
                <span class="badge badge-primary"><?php echo $role_persian; ?></span>
                <span class="badge badge-success">عضویت از <?php echo date('Y/m/d'); ?></span>
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="dashboard-grid">
            <div class="dashboard-stat">
                <div class="stat-icon">🛒</div>
                <div class="stat-value">۱۲</div>
                <div class="stat-label">سفارشات</div>
                <div class="stat-change positive">↑ ۲۴٪ نسبت به ماه قبل</div>
            </div>
            <div class="dashboard-stat">
                <div class="stat-icon">💼</div>
                <div class="stat-value">۵</div>
                <div class="stat-label">پروژه‌های فعال</div>
                <div class="stat-change positive">↑ ۱۲٪ نسبت به ماه قبل</div>
            </div>
            <div class="dashboard-stat">
                <div class="stat-icon">💰</div>
                <div class="stat-value">۱,۲۰۰,۰۰۰</div>
                <div class="stat-label">موجودی کیف پول</div>
                <div class="stat-change positive">↑ ۸٪ نسبت به ماه قبل</div>
            </div>
            <div class="dashboard-stat">
                <div class="stat-icon">⭐</div>
                <div class="stat-value">۲,۴۵۰</div>
                <div class="stat-label">امتیاز باشگاه</div>
                <div class="stat-change positive">↑ ۱۵٪ نسبت به ماه قبل</div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <h2 class="dashboard-section-title">دسترسی سریع</h2>
        <div class="quick-actions">
            <a href="../pages/shop.php" class="quick-action">
                <div class="action-icon">🛒</div>
                <div class="action-label">فروشگاه</div>
                <div class="action-desc">خرید محصولات جدید</div>
            </a>
            <a href="../pages/freelance.php" class="quick-action">
                <div class="action-icon">💼</div>
                <div class="action-label">فریلنسری</div>
                <div class="action-desc">ثبت پروژه جدید</div>
            </a>
            <a href="../pages/community.php" class="quick-action">
                <div class="action-icon">💬</div>
                <div class="action-label">انجمن</div>
                <div class="action-desc">مشارکت در بحث‌ها</div>
            </a>
        </div>
        
        <!-- Recent Activity -->
        <div style="margin-top: var(--space-8);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: var(--space-4);">
                <h2 class="dashboard-section-title" style="margin-bottom:0;">فعالیت‌های اخیر</h2>
                <a href="#" class="btn btn-ghost btn-sm">مشاهده همه</a>
            </div>
            
            <div class="recent-activity">
                <div class="activity-item">
                    <div class="activity-icon">🛒</div>
                    <div class="activity-content">
                        <div class="activity-text">شما محصول <strong>قالب شرکتی مدرن</strong> را خریداری کردید</div>
                        <div class="activity-time">۲ ساعت پیش</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">💼</div>
                    <div class="activity-content">
                        <div class="activity-text">پروژه <strong>طراحی UI اپلیکیشن</strong> تایید شد</div>
                        <div class="activity-time">۵ ساعت پیش</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">⭐</div>
                    <div class="activity-content">
                        <div class="activity-text">شما <strong>۱۰۰ امتیاز</strong> جدید دریافت کردید</div>
                        <div class="activity-time">۱ روز پیش</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">💰</div>
                    <div class="activity-content">
                        <div class="activity-text">مبلغ <strong>۵۰۰,۰۰۰ تومان</strong> به کیف پول اضافه شد</div>
                        <div class="activity-time">۳ روز پیش</div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>

</body>
</html>