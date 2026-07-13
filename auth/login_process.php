<?php
// login_process.php - پردازش ورود

// استارت سشن
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// اتصال به دیتابیس
require_once 'config.php';

// تابع پاکسازی ورودی
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
    header('Location: login.php');
    exit;
}

// بررسی توکن CSRF
if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
    $_SESSION['login_error'] = "خطای امنیتی: لطفاً دوباره تلاش کنید.";
    header('Location: login.php');
    exit;
}

// دریافت و پاکسازی داده‌ها
$username = cleanInput($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']) ? 1 : 0;

// آرایه خطاها
$errors = [];

// ============ اعتبارسنجی ============

// 1. بررسی نام کاربری یا ایمیل
if (empty($username)) {
    $errors['username'] = "نام کاربری یا ایمیل الزامی است.";
}

// 2. بررسی رمز عبور
if (empty($password)) {
    $errors['password'] = "رمز عبور الزامی است.";
} elseif (strlen($password) < 8) {
    $errors['password'] = "رمز عبور باید حداقل ۸ کاراکتر باشد.";
}

// ============ اگر خطایی در اعتبارسنجی وجود داشت ============
if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    $_SESSION['login_data'] = ['username' => $username];
    header('Location: login.php');
    exit;
}

// ============ بررسی وجود کاربر در دیتابیس ============

// جستجو با نام کاربری یا ایمیل
$sql = "SELECT id, fullname, username, email, phone, password, role, status, avatar 
        FROM users 
        WHERE (username = ? OR email = ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

// **چک کردن اینکه کاربر وجود دارد یا نه**
if ($result->num_rows === 0) {
    // ❌ کاربر وجود ندارد
    $_SESSION['login_errors'] = ['general' => "❌ کاربری با این اطلاعات یافت نشد. لطفاً ثبت نام کنید."];
    $_SESSION['login_data'] = ['username' => $username];
    $stmt->close();
    $conn->close();
    header('Location: login.php');
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

// ============ بررسی وضعیت کاربر ============

// **چک کردن اینکه کاربر فعال است یا نه**
if ($user['status'] == 0) {
    $_SESSION['login_errors'] = ['general' => "❌ حساب کاربری شما غیرفعال است. با پشتیبانی تماس بگیرید."];
    $_SESSION['login_data'] = ['username' => $username];
    $conn->close();
    header('Location: login.php');
    exit;
}

// ============ بررسی رمز عبور ============

// **چک کردن صحت رمز عبور**
if (!password_verify($password, $user['password'])) {
    // ❌ رمز عبور اشتباه است
    $_SESSION['login_errors'] = ['password' => "❌ رمز عبور وارد شده اشتباه است. دوباره تلاش کنید."];
    $_SESSION['login_data'] = ['username' => $username];
    $conn->close();
    header('Location: login.php');
    exit;
}

// ============ ورود موفق ============

// بروزرسانی آخرین لاگین
$update_sql = "UPDATE users SET last_login = NOW(), ip_address = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$ip = $_SERVER['REMOTE_ADDR'];
$update_stmt->bind_param("si", $ip, $user['id']);
$update_stmt->execute();
$update_stmt->close();

// ریجنریت کردن Session ID برای امنیت
session_regenerate_id(true);

// ذخیره اطلاعات کاربر در سشن
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['fullname'] = $user['fullname'];
$_SESSION['email'] = $user['email'];
$_SESSION['role'] = $user['role'];
$_SESSION['avatar'] = $user['avatar'] ?? 'default.jpg';
$_SESSION['login_time'] = time();

// پاک کردن خطاها
unset($_SESSION['login_errors']);
unset($_SESSION['login_data']);
unset($_SESSION['csrf_token']);

// ============ "مرا به خاطر بسپار" (Remember Me) ============

if ($remember) {
    $token = bin2hex(random_bytes(32));
    $expiry = time() + (86400 * 30); // 30 روز
    
    // ذخیره توکن در دیتابیس
    $token_sql = "UPDATE users SET remember_token = ?, token_expiry = FROM_UNIXTIME(?) WHERE id = ?";
    $token_stmt = $conn->prepare($token_sql);
    $token_stmt->bind_param("sii", $token, $expiry, $user['id']);
    $token_stmt->execute();
    $token_stmt->close();
    
    // تنظیم کوکی
    setcookie('remember_token', $token, $expiry, '/', '', true, true);
    setcookie('user_id', $user['id'], $expiry, '/', '', true, true);
}

// بستن اتصال
$conn->close();

// ============ ریدایرکت بر اساس نقش ============

if ($user['role'] === 'admin') {
    header('Location: admin_dashboard.php');
} else {
    // **ریدایرکت به صفحه اصلی با پیام خوش‌آمدگویی**
    header('Location: ../index.html?welcome=1');
}
exit;
?>