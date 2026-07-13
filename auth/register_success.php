<?php
// register_success.php - صفحه موفقیت ثبت نام

// استارت سشن
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// بررسی اینکه کاربر لاگین هست
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// دریافت اطلاعات کاربر
$fullname = $_SESSION['fullname'] ?? 'کاربر عزیز';
$username = $_SESSION['username'] ?? '';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام با موفقیت انجام شد</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 500px;
            width: 100%;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .success-icon {
            font-size: 80px;
            margin-bottom: 20px;
            animation: bounce 1s ease;
        }
        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        h1 {
            color: #2d3748;
            margin-bottom: 10px;
        }
        .message {
            color: #4a5568;
            font-size: 18px;
            line-height: 1.8;
            margin: 20px 0;
        }
        .username {
            color: #667eea;
            font-weight: bold;
            font-size: 20px;
        }
        .btn-primary {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .info-box {
            background: #f7fafc;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: right;
        }
        .info-box p {
            margin: 8px 0;
            color: #4a5568;
        }
        .info-box strong {
            color: #2d3748;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✅</div>
        
        <h1>ثبت نام با موفقیت انجام شد! 🎉</h1>
        
        <div class="message">
            سلام <span class="username"><?php echo htmlspecialchars($fullname); ?></span> عزیز!<br>
            به خانواده ما خوش آمدی! 🥳
        </div>
        
        <div class="info-box">
            <p><strong>👤 نام کاربری:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>📅 تاریخ ثبت نام:</strong> <?php echo date('Y/m/d - H:i'); ?></p>
            <p><strong>🎯 نقش:</strong> کاربر عادی</p>
        </div>
        
        <p style="color: #718096; font-size: 14px;">
            حساب کاربری شما با موفقیت ساخته شد.<br>
            اکنون میتوانید از تمام امکانات سایت استفاده کنید.
        </p>
        
        <a href="../index.html" class="btn-primary">
            🏠 رفتن به صفحه اصلی
        </a>
        
        <br><br>
        <a href="profile.php" style="color: #667eea; text-decoration: none; font-size: 14px;">
            📝 رفتن به پروفایل
        </a>
    </div>
</body>
</html>