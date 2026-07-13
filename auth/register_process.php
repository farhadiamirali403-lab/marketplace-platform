<?php
// register_process.php - ثبت نام کاربر جدید

// استارت سشن
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// اتصال به دیتابیس
require_once 'config.php';

// تابع برای پاکسازی ورودی‌ها
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// تابع تولید توکن CSRF
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// تابع验证 CSRF
function verifyCsrfToken($token) {
    if (!isset($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

// تولید توکن CSRF جدید
$csrf_token = generateCsrfToken();

// بررسی اینکه فرم ارسال شده
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.html');
    exit;
}

// بررسی توکن CSRF
if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
    die("خطای امنیتی: درخواست نامعتبر است. لطفاً دوباره تلاش کنید.");
}

// پاکسازی و دریافت داده‌ها
$fullname = cleanInput($_POST['fullname'] ?? '');
$username = cleanInput($_POST['username'] ?? '');
$email = cleanInput($_POST['email'] ?? '');
$phone = cleanInput($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// آرایه برای ذخیره خطاها
$errors = [];

// ============ اعتبارسنجی ============

// 1. بررسی نام و نام خانوادگی
if (empty($fullname)) {
    $errors[] = "نام و نام خانوادگی الزامی است.";
} elseif (strlen($fullname) < 3 || strlen($fullname) > 100) {
    $errors[] = "نام و نام خانوادگی باید بین 3 تا 100 کاراکتر باشد.";
} elseif (!preg_match('/^[\p{L}\s]+$/u', $fullname)) {
    $errors[] = "نام و نام خانوادگی فقط باید شامل حروف فارسی یا انگلیسی باشد.";
}

// 2. بررسی نام کاربری
if (empty($username)) {
    $errors[] = "نام کاربری الزامی است.";
} elseif (!preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $username)) {
    $errors[] = "نام کاربری باید شامل حروف انگلیسی، اعداد، خط تیره و بین 3 تا 20 کاراکتر باشد.";
} else {
    // بررسی تکراری نبودن نام کاربری
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        $errors[] = "این نام کاربری قبلاً ثبت شده است.";
    }
    $check_stmt->close();
}

// 3. بررسی ایمیل
if (empty($email)) {
    $errors[] = "ایمیل الزامی است.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "فرمت ایمیل نامعتبر است.";
} elseif (strlen($email) > 100) {
    $errors[] = "ایمیل نباید بیشتر از 100 کاراکتر باشد.";
} else {
    // بررسی تکراری نبودن ایمیل
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        $errors[] = "این ایمیل قبلاً ثبت شده است.";
    }
    $check_stmt->close();
}

// 4. بررسی شماره موبایل (اختیاری)
if (!empty($phone)) {
    if (!preg_match('/^09[0-9]{9}$/', $phone)) {
        $errors[] = "شماره موبایل نامعتبر است (مثال: 09121234567).";
    } else {
        // بررسی تکراری نبودن موبایل
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");
        $check_stmt->bind_param("s", $phone);
        $check_stmt->execute();
        $check_stmt->store_result();
        if ($check_stmt->num_rows > 0) {
            $errors[] = "این شماره موبایل قبلاً ثبت شده است.";
        }
        $check_stmt->close();
    }
}

// 5. بررسی رمز عبور
if (empty($password)) {
    $errors[] = "رمز عبور الزامی است.";
} elseif (strlen($password) < 8) {
    $errors[] = "رمز عبور باید حداقل 8 کاراکتر باشد.";
} elseif (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "رمز عبور باید حداقل یک حرف بزرگ داشته باشد.";
} elseif (!preg_match('/[a-z]/', $password)) {
    $errors[] = "رمز عبور باید حداقل یک حرف کوچک داشته باشد.";
} elseif (!preg_match('/[0-9]/', $password)) {
    $errors[] = "رمز عبور باید حداقل یک عدد داشته باشد.";
} elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
    $errors[] = "رمز عبور باید حداقل یک کاراکتر خاص داشته باشد (!@#$%^&*).";
}

// 6. بررسی تکرار رمز عبور
if ($password !== $confirm_password) {
    $errors[] = "رمز عبور و تکرار آن مطابقت ندارند.";
}

// ============ اگر خطایی وجود داشت ============
if (!empty($errors)) {
    // ذخیره خطاها در سشن
    $_SESSION['register_errors'] = $errors;
    
    // ذخیره داده‌های وارد شده برای پر کردن مجدد فرم
    $_SESSION['register_data'] = [
        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
        'phone' => $phone
    ];
    
    // ریدایرکت به صفحه ثبت نام
    header('Location: register.html');
    exit;
}

// ============ ثبت نام کاربر ============

// هش کردن رمز عبور با BCRYPT (قوی‌ترین روش)
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
    
    // ریدایرکت به پروفایل
    header('Location: profile.php?success=ثبت نام با موفقیت انجام شد');
    exit;
    
} else {
    // خطا در ثبت نام
    logError("Register error: " . $conn->error);
    
    $_SESSION['register_errors'] = ["خطا در ثبت نام. لطفاً دوباره تلاش کنید."];
    $_SESSION['register_data'] = [
        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
        'phone' => $phone
    ];
    
    $stmt->close();
    $conn->close();
    
    header('Location: register.html');
    exit;
}

// تابع لاگ خطا (اختیاری)
function logError($message) {
    $logFile = 'logs/error.log';
    $date = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $log = "[$date] [IP: $ip] $message" . PHP_EOL;
    error_log($log, 3, $logFile);
}
?>