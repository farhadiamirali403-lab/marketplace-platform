<?php
// register_process.php - پردازش ثبت نام

// استارت سشن امن
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// اتصال به دیتابیس
require_once 'config.php';

// تابع پاکسازی ورودی‌ها
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// تابع بررسی CSRF
function verifyCsrfToken($token) {
    if (!isset($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

// بررسی اینکه فرم ارسال شده
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

// بررسی توکن CSRF
if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
    $_SESSION['register_errors'] = ["خطای امنیتی: لطفاً دوباره تلاش کنید."];
    header('Location: register.php');
    exit;
}

// دریافت و پاکسازی داده‌ها
$fullname = cleanInput($_POST['fullname'] ?? '');
$username = cleanInput($_POST['username'] ?? '');
$email = cleanInput($_POST['email'] ?? '');
$phone = cleanInput($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// آرایه خطاها
$errors = [];

// ============ اعتبارسنجی کامل ============

// 1. بررسی نام و نام خانوادگی
if (empty($fullname)) {
    $errors['fullname'] = "نام و نام خانوادگی الزامی است.";
} elseif (strlen($fullname) < 3) {
    $errors['fullname'] = "نام و نام خانوادگی باید حداقل ۳ کاراکتر باشد.";
} elseif (strlen($fullname) > 100) {
    $errors['fullname'] = "نام و نام خانوادگی نباید بیشتر از ۱۰۰ کاراکتر باشد.";
}

// 2. بررسی نام کاربری
if (empty($username)) {
    $errors['username'] = "نام کاربری الزامی است.";
} elseif (!preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $username)) {
    $errors['username'] = "نام کاربری باید شامل حروف انگلیسی، اعداد، خط تیره و بین ۳ تا ۲۰ کاراکتر باشد.";
} else {
    // **چک کردن وجود نام کاربری در دیتابیس**
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        $errors['username'] = "❌ این نام کاربری قبلاً ثبت شده است. لطفاً نام دیگری انتخاب کنید.";
    }
    $check_stmt->close();
}

// 3. بررسی ایمیل
if (empty($email)) {
    $errors['email'] = "ایمیل الزامی است.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "فرمت ایمیل نامعتبر است.";
} elseif (strlen($email) > 100) {
    $errors['email'] = "ایمیل نباید بیشتر از ۱۰۰ کاراکتر باشد.";
} else {
    // **چک کردن وجود ایمیل در دیتابیس**
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        $errors['email'] = "❌ این ایمیل قبلاً ثبت شده است. لطفاً با ایمیل دیگری ثبت نام کنید.";
    }
    $check_stmt->close();
}

// 4. بررسی شماره موبایل (اختیاری ولی اگر وارد شده چک شود)
if (!empty($phone)) {
    if (!preg_match('/^09[0-9]{9}$/', $phone)) {
        $errors['phone'] = "شماره موبایل نامعتبر است (مثال: 09121234567).";
    } else {
        // **چک کردن وجود موبایل در دیتابیس**
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");
        $check_stmt->bind_param("s", $phone);
        $check_stmt->execute();
        $check_stmt->store_result();
        if ($check_stmt->num_rows > 0) {
            $errors['phone'] = "❌ این شماره موبایل قبلاً ثبت شده است.";
        }
        $check_stmt->close();
    }
}

// 5. بررسی رمز عبور
if (empty($password)) {
    $errors['password'] = "رمز عبور الزامی است.";
} elseif (strlen($password) < 8) {
    $errors['password'] = "رمز عبور باید حداقل ۸ کاراکتر باشد.";
} elseif (!preg_match('/[A-Z]/', $password)) {
    $errors['password'] = "رمز عبور باید حداقل یک حرف بزرگ (A-Z) داشته باشد.";
} elseif (!preg_match('/[a-z]/', $password)) {
    $errors['password'] = "رمز عبور باید حداقل یک حرف کوچک (a-z) داشته باشد.";
} elseif (!preg_match('/[0-9]/', $password)) {
    $errors['password'] = "رمز عبور باید حداقل یک عدد (0-9) داشته باشد.";
}

// 6. بررسی تکرار رمز عبور
if (empty($confirm_password)) {
    $errors['confirm_password'] = "تکرار رمز عبور الزامی است.";
} elseif ($password !== $confirm_password) {
    $errors['confirm_password'] = "رمز عبور و تکرار آن مطابقت ندارند.";
}

// ============ اگر خطایی وجود داشت ============
if (!empty($errors)) {
    // ذخیره خطاها در سشن (با کلیدهای مشخص)
    $_SESSION['register_errors'] = $errors;
    
    // ذخیره داده‌های وارد شده برای پر کردن مجدد فرم
    $_SESSION['register_data'] = [
        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
        'phone' => $phone
    ];
    
    // ریدایرکت به صفحه ثبت نام با خطاها
    header('Location: register.php');
    exit;
}

// ============ ثبت نام کاربر ============

// هش کردن رمز عبور با BCRYPT
$hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

// دریافت IP کاربر
$ip_address = $_SERVER['REMOTE_ADDR'];

// آماده‌سازی کوئری
$sql = "INSERT INTO users (fullname, username, email, phone, password, ip_address, registered_at, status) 
        VALUES (?, ?, ?, ?, ?, ?, NOW(), 1)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $fullname, $username, $email, $phone, $hashed_password, $ip_address);

if ($stmt->execute()) {
    // ثبت نام موفق
    $user_id = $conn->insert_id;
    
    // شروع سشن کاربر
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['role'] = 'user';
    $_SESSION['login_time'] = time();
    
    // پاک کردن داده‌های سشن
    unset($_SESSION['register_errors']);
    unset($_SESSION['register_data']);
    unset($_SESSION['csrf_token']);
    
    // بستن اتصال
    $stmt->close();
    $conn->close();
    
    // **ریدایرکت به صفحه موفقیت**
    header('Location: register_success.php');
    exit;
    
} else {
    // خطا در ثبت نام
    $_SESSION['register_errors'] = ['general' => "❌ خطا در ثبت نام. لطفاً دوباره تلاش کنید."];
    $_SESSION['register_data'] = [
        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
        'phone' => $phone
    ];
    
    $stmt->close();
    $conn->close();
    
    header('Location: register.php');
    exit;
}
?>