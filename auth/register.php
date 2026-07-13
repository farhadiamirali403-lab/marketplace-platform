<?php
// register.php - صفحه ثبت نام

// استارت سشن
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// تابع تولید توکن CSRF
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

$csrf_token = generateCsrfToken();

// دریافت خطاها از سشن
$errors = $_SESSION['register_errors'] ?? [];
$old_data = $_SESSION['register_data'] ?? [];

// پاک کردن سشن بعد از خواندن
unset($_SESSION['register_errors']);
unset($_SESSION['register_data']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <style>
        /* reset css */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Tahoma, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
        }

        .container {
            background: #ffffff;
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 550px;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            color: #2d3748;
            margin-bottom: 25px;
            font-size: 28px;
        }

        h2 span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .error-box {
            background: #fed7d7;
            border: 2px solid #fc8181;
            color: #c53030;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 0;
            padding-right: 20px;
            list-style: none;
        }

        .error-box li {
            padding: 5px 0;
        }

        .error-box li::before {
            content: "❌ ";
        }

        .form-group {
            margin-bottom: 18px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #2d3748;
            font-size: 14px;
        }

        label .required {
            color: #e53e3e;
        }

        /* استایل اینپوت‌ها */
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            height: 48px;
            padding: 0 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            font-family: Tahoma, Arial, sans-serif;
            transition: all 0.3s ease;
            background: #f7fafc;
            direction: ltr;
            display: block;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
        }

        input[type="text"].error,
        input[type="email"].error,
        input[type="tel"].error,
        input[type="password"].error {
            border-color: #fc8181;
            background: #fff5f5;
        }

        /* wrapper برای رمز عبور */
        .password-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            padding-left: 50px;
            height: 48px;
        }

        .toggle-password {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 22px;
            padding: 0;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
            transition: all 0.2s ease;
            border-radius: 50%;
            user-select: none;
        }

        .toggle-password:hover {
            background: #edf2f7;
            color: #667eea;
            transform: translateY(-50%) scale(1.1);
        }

        .toggle-password:active {
            transform: translateY(-50%) scale(0.9);
        }

        .error-text {
            color: #e53e3e;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .password-hint {
            font-size: 12px;
            color: #718096;
            margin-top: 6px;
        }

        button[type="submit"] {
            width: 100%;
            height: 50px;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 5px;
            font-family: Tahoma, Arial, sans-serif;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .link {
            text-align: center;
            margin-top: 20px;
            color: #4a5568;
            font-size: 15px;
        }

        .link a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }

        .link a:hover {
            text-decoration: underline;
        }

        /* برای صفحه موبایل */
        @media (max-width: 576px) {
            .container {
                padding: 25px 20px;
            }

            h2 {
                font-size: 24px;
            }

            input[type="text"],
            input[type="email"],
            input[type="tel"],
            input[type="password"] {
                height: 44px;
                font-size: 14px;
                padding: 0 12px;
            }

            .password-wrapper input {
                padding-left: 45px;
                height: 44px;
            }

            .toggle-password {
                font-size: 20px;
                width: 30px;
                height: 30px;
                left: 10px;
            }

            button[type="submit"] {
                height: 45px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📝 <span>ثبت نام</span></h2>

        <?php if (!empty($errors)): ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $field => $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="register_process.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

            <div class="form-group">
                <label for="fullname">نام و نام خانوادگی <span class="required">*</span></label>
                <input type="text" id="fullname" name="fullname" 
                       class="<?php echo isset($errors['fullname']) ? 'error' : ''; ?>"
                       placeholder="مثال: علی رضایی" 
                       value="<?php echo htmlspecialchars($old_data['fullname'] ?? ''); ?>" 
                       required>
                <?php if (isset($errors['fullname'])): ?>
                    <span class="error-text"><?php echo htmlspecialchars($errors['fullname']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="username">نام کاربری <span class="required">*</span></label>
                <input type="text" id="username" name="username" 
                       class="<?php echo isset($errors['username']) ? 'error' : ''; ?>"
                       placeholder="فقط حروف انگلیسی و اعداد" 
                       value="<?php echo htmlspecialchars($old_data['username'] ?? ''); ?>" 
                       required>
                <?php if (isset($errors['username'])): ?>
                    <span class="error-text"><?php echo htmlspecialchars($errors['username']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">ایمیل <span class="required">*</span></label>
                <input type="email" id="email" name="email" 
                       class="<?php echo isset($errors['email']) ? 'error' : ''; ?>"
                       placeholder="example@email.com" 
                       value="<?php echo htmlspecialchars($old_data['email'] ?? ''); ?>" 
                       required>
                <?php if (isset($errors['email'])): ?>
                    <span class="error-text"><?php echo htmlspecialchars($errors['email']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="phone">شماره موبایل</label>
                <input type="tel" id="phone" name="phone" 
                       class="<?php echo isset($errors['phone']) ? 'error' : ''; ?>"
                       placeholder="مثال: 09121234567" 
                       value="<?php echo htmlspecialchars($old_data['phone'] ?? ''); ?>">
                <?php if (isset($errors['phone'])): ?>
                    <span class="error-text"><?php echo htmlspecialchars($errors['phone']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">رمز عبور <span class="required">*</span></label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" 
                           class="<?php echo isset($errors['password']) ? 'error' : ''; ?>"
                           placeholder="حداقل ۸ کاراکتر" 
                           required minlength="8">
                    <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                        👁️
                    </button>
                </div>
                <div class="password-hint">
                    🔒 باید شامل حروف بزرگ، کوچک و عدد باشد.
                </div>
                <?php if (isset($errors['password'])): ?>
                    <span class="error-text"><?php echo htmlspecialchars($errors['password']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="confirm_password">تکرار رمز عبور <span class="required">*</span></label>
                <div class="password-wrapper">
                    <input type="password" id="confirm_password" name="confirm_password" 
                           class="<?php echo isset($errors['confirm_password']) ? 'error' : ''; ?>"
                           placeholder="تکرار رمز عبور" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('confirm_password', this)">
                        👁️
                    </button>
                </div>
                <?php if (isset($errors['confirm_password'])): ?>
                    <span class="error-text"><?php echo htmlspecialchars($errors['confirm_password']); ?></span>
                <?php endif; ?>
            </div>

            <button type="submit">ثبت نام</button>
        </form>

        <div class="link">
            قبلاً ثبت نام کردی؟ <a href="login.php">وارد شو</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = '🙈';
                button.style.color = '#667eea';
            } else {
                input.type = 'password';
                button.textContent = '👁️';
                button.style.color = '#718096';
            }
        }
    </script>
</body>
</html>