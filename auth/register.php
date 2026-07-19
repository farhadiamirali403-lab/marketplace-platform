<?php
// auth/register.php - صفحه ثبت نام

require_once 'config.php';
startSecureSession();

$csrf_token = generateCsrfToken();

$errors = $_SESSION['register_errors'] ?? [];
$old_data = $_SESSION['register_data'] ?? [];

unset($_SESSION['register_errors']);
unset($_SESSION['register_data']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="arctic">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام | R_REX</title>
    
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
                <h2 class="auth-brand-title">به R_REX خوش آمدید</h2>
                <p class="auth-brand-desc">همین الان حساب خود را بسازید و از امکانات بی‌نظیر ما بهره‌مند شوید.</p>
                
                <div class="auth-brand-features">
                    <div class="auth-brand-feature">
                        <div class="auth-brand-feature-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <span>ساخت حساب در کمتر از ۱ دقیقه</span>
                    </div>
                    <div class="auth-brand-feature">
                        <div class="auth-brand-feature-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <span>امنیت کامل اطلاعات شخصی</span>
                    </div>
                    <div class="auth-brand-feature">
                        <div class="auth-brand-feature-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                        </div>
                        <span>دسترسی به هزاران محصول و خدمات</span>
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

                <h1 class="auth-form-title">ایجاد حساب جدید</h1>
                <p class="auth-form-subtitle">اطلاعات خود را برای ثبت نام وارد کنید</p>

                <?php if (!empty($errors)): ?>
                    <div class="auth-alert">
                        <svg class="auth-alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <div>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="register_process.php" method="POST" id="registerForm">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                    <div class="auth-field">
                        <label class="auth-field-label" for="fullname">
                            نام و نام خانوادگی <span class="required">*</span>
                        </label>
                        <div class="auth-input-wrapper">
                            <input type="text" id="fullname" name="fullname"
                                   class="auth-input <?php echo isset($errors['fullname']) ? 'input-error' : ''; ?>"
                                   placeholder="مثال: علی رضایی"
                                   value="<?php echo htmlspecialchars($old_data['fullname'] ?? ''); ?>" required autocomplete="name">
                            <svg class="auth-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <?php if (isset($errors['fullname'])): ?>
                            <span class="auth-field-error"><?php echo htmlspecialchars($errors['fullname']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="auth-field">
                        <label class="auth-field-label" for="username">
                            نام کاربری <span class="required">*</span>
                        </label>
                        <div class="auth-input-wrapper">
                            <input type="text" id="username" name="username"
                                   class="auth-input <?php echo isset($errors['username']) ? 'input-error' : ''; ?>"
                                   placeholder="فقط حروف انگلیسی و اعداد"
                                   value="<?php echo htmlspecialchars($old_data['username'] ?? ''); ?>" required autocomplete="username">
                            <svg class="auth-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="4"/>
                                <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"/>
                            </svg>
                        </div>
                        <?php if (isset($errors['username'])): ?>
                            <span class="auth-field-error"><?php echo htmlspecialchars($errors['username']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="auth-field">
                        <label class="auth-field-label" for="email">
                            ایمیل <span class="required">*</span>
                        </label>
                        <div class="auth-input-wrapper">
                            <input type="email" id="email" name="email"
                                   class="auth-input <?php echo isset($errors['email']) ? 'input-error' : ''; ?>"
                                   placeholder="example@email.com"
                                   value="<?php echo htmlspecialchars($old_data['email'] ?? ''); ?>" required autocomplete="email">
                            <svg class="auth-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <?php if (isset($errors['email'])): ?>
                            <span class="auth-field-error"><?php echo htmlspecialchars($errors['email']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="auth-field">
                        <label class="auth-field-label" for="phone">شماره موبایل</label>
                        <div class="auth-input-wrapper">
                            <input type="tel" id="phone" name="phone"
                                   class="auth-input <?php echo isset($errors['phone']) ? 'input-error' : ''; ?>"
                                   placeholder="مثال: 09121234567"
                                   value="<?php echo htmlspecialchars($old_data['phone'] ?? ''); ?>" autocomplete="tel">
                            <svg class="auth-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                <line x1="12" y1="18" x2="12.01" y2="18"/>
                            </svg>
                        </div>
                        <?php if (isset($errors['phone'])): ?>
                            <span class="auth-field-error"><?php echo htmlspecialchars($errors['phone']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="auth-field-row">
                        <div class="auth-field">
                            <label class="auth-field-label" for="password">
                                رمز عبور <span class="required">*</span>
                            </label>
                            <div class="auth-input-wrapper">
                                <input type="password" id="password" name="password"
                                       class="auth-input auth-input-password <?php echo isset($errors['password']) ? 'input-error' : ''; ?>"
                                       placeholder="حداقل ۸ کاراکتر" required minlength="8" autocomplete="new-password">
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
                            <div class="auth-strength" id="passwordStrength" data-strength="0">
                                <div class="auth-strength-bar"></div>
                                <div class="auth-strength-bar"></div>
                                <div class="auth-strength-bar"></div>
                                <div class="auth-strength-bar"></div>
                            </div>
                            <span class="auth-strength-text" id="passwordStrengthText"></span>
                            <?php if (isset($errors['password'])): ?>
                                <span class="auth-field-error"><?php echo htmlspecialchars($errors['password']); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="auth-field">
                            <label class="auth-field-label" for="confirm_password">
                                تکرار رمز عبور <span class="required">*</span>
                            </label>
                            <div class="auth-input-wrapper">
                                <input type="password" id="confirm_password" name="confirm_password"
                                       class="auth-input auth-input-password <?php echo isset($errors['confirm_password']) ? 'input-error' : ''; ?>"
                                       placeholder="تکرار رمز عبور" required autocomplete="new-password">
                                <svg class="auth-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                                <button type="button" class="auth-toggle-password" onclick="togglePassword('confirm_password', this)" aria-label="نمایش رمز عبور">
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
                            <?php if (isset($errors['confirm_password'])): ?>
                                <span class="auth-field-error"><?php echo htmlspecialchars($errors['confirm_password']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="auth-submit" id="registerBtn">
                        <span class="submit-text">ثبت نام</span>
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
                    قبلاً ثبت نام کرده‌اید؟ <a href="login.php">وارد شوید</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, btn) {
            var input = document.getElementById(inputId);
            var eyeOpen = btn.querySelector('.eye-open');
            var eyeClosed = btn.querySelector('.eye-closed');
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

        // Password strength meter
        var passwordInput = document.getElementById('password');
        var strengthMeter = document.getElementById('passwordStrength');
        var strengthText = document.getElementById('passwordStrengthText');
        var strengthLabels = ['', 'ضعیف', 'متوسط', 'خوب', 'عالی'];

        passwordInput.addEventListener('input', function() {
            var val = this.value;
            var score = 0;
            if (val.length >= 8) score++;
            if (/[a-z]/.test(val) && /[A-Z]/.test(val)) score++;
            if (/\d/.test(val)) score++;
            if (/[^a-zA-Z0-9]/.test(val)) score++;

            strengthMeter.setAttribute('data-strength', score);
            strengthText.textContent = score > 0 ? strengthLabels[score] : '';
        });

        // Loading state on submit
        document.getElementById('registerForm').addEventListener('submit', function() {
            var btn = document.getElementById('registerBtn');
            btn.classList.add('is-loading');
            btn.querySelector('.submit-arrow').style.display = 'none';
        });
    </script>

    <script src="../js/theme.js"></script>
    <script src="../js/components.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>