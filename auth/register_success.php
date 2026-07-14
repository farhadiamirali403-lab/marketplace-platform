<?php
// auth/register_success.php - صفحه موفقیت ثبت نام با تم دارک

// چون config.php داخل خود auth هست
require_once 'config.php';
startSecureSession();

// بررسی اینکه کاربر لاگین هست
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
    header('Location: login.php');
    exit;
}

$fullname = $_SESSION['fullname'] ?? 'کاربر عزیز';
$username = $_SESSION['username'] ?? '';
$email = $_SESSION['email'] ?? '';
$role = $_SESSION['role'] ?? 'user';
$role_persian = ($role === 'admin') ? 'مدیر' : 'کاربر عادی';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام با موفقیت انجام شد | R_REX</title>
    
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/layout.css">
    
    <style>
        .success-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-primary);
            padding: var(--space-6);
            direction: rtl;
        }
        
        .success-container {
            width: 100%;
            max-width: 480px;
            animation: fadeIn 0.6s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .success-card {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-2xl);
            padding: var(--space-10);
            text-align: center;
            box-shadow: var(--shadow-card-hover);
            position: relative;
            overflow: hidden;
        }
        
        .success-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 50% 0%, rgba(59, 130, 246, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .success-icon {
            width: 5rem;
            height: 5rem;
            margin: 0 auto var(--space-6);
            background: rgba(16, 185, 129, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--color-success-500);
            animation: pulse 2s infinite;
            position: relative;
            z-index: 1;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
        
        .success-title {
            font-size: var(--font-size-2xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            margin-bottom: var(--space-3);
            position: relative;
            z-index: 1;
        }
        
        .success-message {
            font-size: var(--font-size-md);
            color: var(--text-secondary);
            line-height: var(--line-height-relaxed);
            margin-bottom: var(--space-6);
            position: relative;
            z-index: 1;
        }
        
        .success-message .highlight {
            color: var(--text-brand);
            font-weight: var(--font-weight-semibold);
        }
        
        .success-info {
            background: var(--bg-secondary);
            border-radius: var(--radius-xl);
            padding: var(--space-4);
            margin-bottom: var(--space-6);
            text-align: right;
            border: 1px solid var(--border-secondary);
            position: relative;
            z-index: 1;
        }
        
        .success-info-item {
            display: flex;
            justify-content: space-between;
            padding: var(--space-2) 0;
            font-size: var(--font-size-sm);
            border-bottom: 1px solid var(--border-secondary);
        }
        
        .success-info-item:last-child {
            border-bottom: none;
        }
        
        .success-info-label {
            color: var(--text-tertiary);
        }
        
        .success-info-value {
            color: var(--text-primary);
            font-weight: var(--font-weight-medium);
        }
        
        .success-actions {
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
            position: relative;
            z-index: 1;
        }
        
        .success-actions .btn {
            width: 100%;
            padding: 0.75rem 1.75rem;
            font-size: var(--font-size-md);
            border-radius: var(--radius-xl);
            transition: all var(--transition-base);
        }
        
        .btn-primary {
            background: var(--gradient-brand);
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--text-primary);
            border: 1px solid var(--border-primary);
        }
        
        .btn-outline:hover {
            background: var(--bg-hover);
            border-color: var(--text-tertiary);
        }
        
        .btn-success {
            background: var(--color-success-500);
            color: white;
            border: none;
        }
        
        .btn-success:hover {
            background: var(--color-success-600);
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: var(--space-6);
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            position: relative;
            z-index: 1;
        }
        
        .auth-footer a {
            color: var(--text-brand);
            font-weight: var(--font-weight-semibold);
            text-decoration: none;
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        .back-home {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            margin-top: var(--space-4);
            font-size: var(--font-size-sm);
            color: var(--text-tertiary);
            text-decoration: none;
            position: relative;
            z-index: 1;
        }
        
        .back-home:hover {
            color: var(--text-brand);
        }
        
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: var(--radius-full);
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--scrollbar-thumb-hover);
        }
        
        @media (max-width: 480px) {
            .success-card { padding: var(--space-6); }
            .success-icon { width: 4rem; height: 4rem; font-size: 2.5rem; }
            .success-title { font-size: var(--font-size-xl); }
            .success-message { font-size: var(--font-size-sm); }
            .success-info-item { font-size: var(--font-size-xs); padding: var(--space-1) 0; }
        }
    </style>
</head>
<body>
    <div class="success-page">
        <div class="success-container">
            <div class="success-card">
                <div class="success-icon">✅</div>
                
                <h1 class="success-title">ثبت نام با موفقیت انجام شد! 🎉</h1>
                
                <p class="success-message">
                    سلام <span class="highlight"><?php echo htmlspecialchars($fullname); ?></span> عزیز!<br>
                    به خانواده R_REX خوش آمدی! 🥳
                </p>
                
                <div class="success-info">
                    <div class="success-info-item">
                        <span class="success-info-label">👤 نام و نام خانوادگی</span>
                        <span class="success-info-value"><?php echo htmlspecialchars($fullname); ?></span>
                    </div>
                    <div class="success-info-item">
                        <span class="success-info-label">🔑 نام کاربری</span>
                        <span class="success-info-value"><?php echo htmlspecialchars($username); ?></span>
                    </div>
                    <div class="success-info-item">
                        <span class="success-info-label">📧 ایمیل</span>
                        <span class="success-info-value"><?php echo htmlspecialchars($email); ?></span>
                    </div>
                    <div class="success-info-item">
                        <span class="success-info-label">📅 تاریخ ثبت نام</span>
                        <span class="success-info-value"><?php echo date('Y/m/d - H:i'); ?></span>
                    </div>
                    <div class="success-info-item">
                        <span class="success-info-label">🎯 نقش</span>
                        <span class="success-info-value"><?php echo $role_persian; ?></span>
                    </div>
                </div>
                
                <div class="success-actions">
                    <a href="../index.php" class="btn btn-primary btn-lg">🏠 رفتن به صفحه اصلی</a>
                    <a href="../pages/dashboard.php" class="btn btn-outline btn-lg">📊 رفتن به داشبورد</a>
                    <a href="../pages/shop.php" class="btn btn-success btn-lg">🛒 شروع خرید</a>
                </div>
                
                <div class="auth-footer">
                    <a href="logout.php">🚪 خروج از حساب</a>
                    <span style="color: var(--text-tertiary); margin: 0 var(--space-2);">|</span>
                    <a href="../pages/profile.php">👤 پروفایل</a>
                </div>
                
                <a href="javascript:history.back()" class="back-home">← بازگشت به صفحه قبل</a>
            </div>
        </div>
    </div>
</body>
</html>