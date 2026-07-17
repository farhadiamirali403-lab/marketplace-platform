<?php
// auth/login.php - صفحه ورود

require_once 'config.php';
startSecureSession();

$csrf_token = generateCsrfToken();

$errors = $_SESSION['login_errors'] ?? [];
$old_data = $_SESSION['login_data'] ?? [];

unset($_SESSION['login_errors']);
unset($_SESSION['login_data']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب | R_REX</title>
    
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <button class="theme-toggle auth-theme-toggle" data-tooltip="حالت تاریک"></button>

    <div class="auth-page">
        <!-- Decorative Brand Panel -->
        <div class="auth-brand-panel">
            <div class="auth-shape auth-shape-1"></div>
            <div class="auth-shape auth-shape-2"></div>
            <div class="auth-shape auth-shape-3"></div>
            
            <div class="auth-brand-content">
                <div class="auth-brand-icon">R</div>
                <h2 class="auth-brand-title">بازار R_REX</h2>
                <p class="auth-brand-desc">پلتفرمی برای خرید، فروش و کسب درآمد. به جامعه میلیونی کاربران ما بپیوندید.</p>
                
                <div class="auth-brand-features">
                    <div class="auth-brand-feature">
                        <div class="auth-brand-feature-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <span>امنیت بالا و محافظت از اطلاعات</span>
                    </div>
                    <div class="auth-brand-feature">
                        <div class="auth-brand-feature-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <span>حساب رایگان با امکانات کامل</span>
                    </div>
                    <div class="auth-brand-feature">
                        <div class="auth-brand-feature-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                        </div>
                        <span>تجربه کاربری ساده و لذت‌بخش</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Panel -->
        <div class="auth-form-panel">
            <div class="auth-form-wrapper">
                <a href="../index.php" class="auth-form-logo">
                    <div class="auth-form-logo-icon">R</div>
                    <span class="auth-form-logo-text">R_REX</span>
                </a>

                <h1 class="auth-form-title">خوش آمدید</h1>
                <p class="auth-form-subtitle">برای ادامه وارد حساب خود شوید</p>

                <?php if (!empty($errors)): ?>
                    <div class="auth-alert">
                        <svg class="auth-alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <div>
                            <?php if (isset($errors['general'])): ?>
                                <?php echo htmlspecialchars($errors['general']); ?>
                            <?php else: ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="login_process.php" method="POST" id="loginForm">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                    <div class="auth-field">
                        <label class="auth-field-label" for="username">
                            نام کاربری یا ایمیل <span class="required">*</span>
                        </label>
                        <div class="auth-input-wrapper">
                            <input type="text" id="username" name="username"
                                   class="auth-input <?php echo isset($errors['username']) ? 'input-error' : ''; ?>"
                                   placeholder="نام کاربری یا ایمیل"
                                   value="<?php echo htmlspecialchars($old_data['username'] ?? ''); ?>" required autofocus autocomplete="username">
                            <svg class="auth-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <?php if (isset($errors['username'])): ?>
                            <span class="auth-field-error"><?php echo htmlspecialchars($errors['username']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="auth-field">
                        <label class="auth-field-label" for="password">
                            رمز عبور <span class="required">*</span>
                        </label>
                        <div class="auth-input-wrapper">
                            <input type="password" id="password" name="password"
                                   class="auth-input auth-input-password <?php echo isset($errors['password']) ? 'input-error' : ''; ?>"
                                   placeholder="رمز عبور" required autocomplete="current-password">
                            <svg class="auth-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <button type="button" class="auth-toggle-password" onclick="togglePassword('password', this)" aria-label="نمایش رمز عبور">
                                <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg class="eye-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                    <line x1="1" y1="1" x2="23" y2="23"/>
                                </svg>
                            </button>
                        </div>
                        <?php if (isset($errors['password'])): ?>
                            <span class="auth-field-error"><?php echo htmlspecialchars($errors['password']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="auth-options">
                        <label class="auth-remember">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <span>مرا به خاطر بسپار</span>
                        </label>
                        <a href="forgot_password.php" class="auth-forgot">رمز عبور را فراموش کردید؟</a>
                    </div>

                    <button type="submit" class="auth-submit" id="loginBtn">
                        <span class="submit-text">ورود</span>
                        <svg class="submit-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                </form>

                <div class="auth-divider">
                    <div class="auth-divider-line"></div>
                    <span class="auth-divider-text">یا</span>
                    <div class="auth-divider-line"></div>
                </div>

                <div class="auth-form-footer">
                    حساب ندارید؟ <a href="register.php">همین الان ثبت نام کنید</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
                btn.style.color = 'var(--accent-primary)';
            } else {
                input.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
                btn.style.color = '';
            }
        }

        // Loading state on submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            var btn = document.getElementById('loginBtn');
            btn.classList.add('is-loading');
            btn.querySelector('.submit-arrow').style.display = 'none';
        });
    </script>

    <script src="../js/theme.js"></script>
    <script src="../js/components.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>