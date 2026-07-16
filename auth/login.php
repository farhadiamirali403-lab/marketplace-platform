<?php
// auth/login.php - صفحه ورود با تم دارک

// چون config.php داخل خود auth هست
require_once 'config.php';
startSecureSession();

$csrf_token = generateCsrfToken();

$errors = $_SESSION['login_errors'] ?? [];
$old_data = $_SESSION['login_data'] ?? [];

unset($_SESSION['login_errors']);
unset($_SESSION['login_data']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب | R_REX</title>
    
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/layout.css">
    
    <style>
        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-primary);
            padding: var(--space-6);
            direction: rtl;
        }
        
        .auth-container {
            width: 100%;
            max-width: 440px;
            animation: fadeIn 0.5s ease;
        }
        
        .auth-card {
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            box-shadow: var(--shadow-card-hover);
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: var(--space-8);
        }
        
        .auth-logo {
            display: inline-flex;
            align-items: center;
            gap: var(--space-3);
            text-decoration: none;
            margin-bottom: var(--space-4);
        }
        
        .auth-logo-icon {
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
        
        .auth-logo-text {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
        }
        
        .auth-title {
            font-size: var(--font-size-2xl);
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            margin-bottom: var(--space-2);
        }
        
        .auth-subtitle {
            font-size: var(--font-size-sm);
            color: var(--text-tertiary);
        }
        
        .auth-divider {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            margin: var(--space-6) 0;
            color: var(--text-tertiary);
            font-size: var(--font-size-xs);
        }
        
        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-primary);
        }
        
        .password-wrapper {
            position: relative;
            width: 100%;
        }
        
        .password-wrapper .form-input {
            padding-left: 3rem;
            background: var(--bg-input);
            color: var(--text-primary);
            border-color: var(--border-input);
        }
        
        .password-wrapper .form-input:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            background: var(--bg-primary);
        }
        
        .toggle-password {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0.25rem;
            color: var(--text-tertiary);
            transition: all var(--transition-fast);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
        }
        
        .toggle-password:hover {
            color: var(--text-primary);
            background: var(--bg-hover);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: var(--space-6);
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
        }
        
        .auth-footer a {
            color: var(--text-brand);
            font-weight: var(--font-weight-semibold);
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        .auth-extra {
            text-align: center;
            margin-top: var(--space-4);
        }
        
        .auth-extra a {
            font-size: var(--font-size-sm);
            color: var(--text-tertiary);
        }
        
        .auth-extra a:hover {
            color: var(--text-brand);
        }
        
        .alert {
            margin-bottom: var(--space-4);
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.2);
            color: var(--color-danger-500);
        }
        
        .form-error {
            color: var(--color-danger-500);
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
        
        input[type="checkbox"] {
            accent-color: var(--accent-primary);
            width: 1.125rem;
            height: 1.125rem;
            cursor: pointer;
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
    </style>
</head>
<body>
    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <a href="../index.php" class="auth-logo">
                        <div class="auth-logo-icon">R</div>
                        <span class="auth-logo-text">R_REX</span>
                    </a>
                    <h1 class="auth-title">🔐 ورود به حساب</h1>
                    <p class="auth-subtitle">خوش آمدید! لطفاً اطلاعات خود را وارد کنید</p>
                </div>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <div class="alert-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">خطا در ورود</div>
                            <ul style="margin:0; padding-right:1.25rem; list-style:disc;">
                                <?php foreach ($errors as $field => $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form action="login_process.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    
                    <div class="form-group">
                        <label class="form-label" for="username">
                            نام کاربری یا ایمیل <span class="required">*</span>
                        </label>
                        <input type="text" id="username" name="username" 
                               class="form-input <?php echo isset($errors['username']) ? 'input-error' : ''; ?>"
                               placeholder="نام کاربری یا ایمیل خود را وارد کنید"
                               value="<?php echo htmlspecialchars($old_data['username'] ?? ''); ?>" required autofocus>
                        <?php if (isset($errors['username'])): ?>
                            <span class="form-error"><?php echo htmlspecialchars($errors['username']); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">
                            رمز عبور <span class="required">*</span>
                        </label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" 
                                   class="form-input <?php echo isset($errors['password']) ? 'input-error' : ''; ?>"
                                   placeholder="رمز عبور خود را وارد کنید" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password', this)">👁️</button>
                        </div>
                        <?php if (isset($errors['password'])): ?>
                            <span class="form-error"><?php echo htmlspecialchars($errors['password']); ?></span>
                        <?php endif; ?>
                        <?php if (isset($errors['general'])): ?>
                            <span class="form-error"><?php echo htmlspecialchars($errors['general']); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group" style="flex-direction:row; align-items:center; gap:var(--space-3);">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <label for="remember" style="font-weight:normal; cursor:pointer; font-size:var(--font-size-sm); color:var(--text-secondary);">
                            مرا به خاطر بسپار
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg" style="width:100%;">
                        ورود
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                </form>
                
                <div class="auth-extra">
                    <a href="forgot_password.php">🔑 رمز عبور را فراموش کردی؟</a>
                </div>
                
                <div class="auth-divider">یا</div>
                
                <div class="auth-footer">
                    حساب نداری؟ <a href="register.php">ثبت نام کن</a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = '🙈';
                button.style.color = 'var(--accent-primary)';
            } else {
                input.type = 'password';
                button.textContent = '👁️';
                button.style.color = 'var(--text-tertiary)';
            }
        }
    </script>
</body>
</html>