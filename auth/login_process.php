<?php
// auth/login_process.php - پردازش ورود

// چون config.php داخل خود auth هست
require_once 'config.php';
startSecureSession();

// بررسی اینکه فرم ارسال شده
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// بررسی توکن CSRF
if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
    $_SESSION['login_errors'] = ['general' => 'خطای امنیتی! لطفاً دوباره تلاش کنید.'];
    header('Location: login.php');
    exit;
}

// دریافت و پاکسازی داده‌ها
$username = cleanInput($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']) ? 1 : 0;

$errors = [];

// ============ اعتبارسنجی ============

if (empty($username)) {
    $errors['username'] = "نام کاربری یا ایمیل الزامی است.";
}

if (empty($password)) {
    $errors['password'] = "رمز عبور الزامی است.";
} elseif (strlen($password) < 8) {
    $errors['password'] = "رمز عبور باید حداقل ۸ کاراکتر باشد.";
}

if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    $_SESSION['login_data'] = ['username' => $username];
    header('Location: login.php');
    exit;
}

// ============ بررسی وجود کاربر ============

$sql = "SELECT id, fullname, username, email, phone, password, role, status, avatar 
        FROM users 
        WHERE (username = ? OR email = ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['login_errors'] = ['general' => "❌ کاربری با این اطلاعات یافت نشد."];
    $_SESSION['login_data'] = ['username' => $username];
    $stmt->close();
    $conn->close();
    header('Location: login.php');
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

// ============ بررسی وضعیت کاربر ============

if ($user['status'] == 0) {
    $_SESSION['login_errors'] = ['general' => "❌ حساب کاربری شما غیرفعال است."];
    $_SESSION['login_data'] = ['username' => $username];
    $conn->close();
    header('Location: login.php');
    exit;
}

// ============ بررسی رمز عبور ============

if (!password_verify($password, $user['password'])) {
    $_SESSION['login_errors'] = ['password' => "❌ رمز عبور وارد شده اشتباه است."];
    $_SESSION['login_data'] = ['username' => $username];
    $conn->close();
    header('Location: login.php');
    exit;
}

// ============ ورود موفق ============

// بروزرسانی آخرین لاگین
$update_sql = "UPDATE users SET last_login = NOW(), ip_address = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$ip = getRealIP();
$update_stmt->bind_param("si", $ip, $user['id']);
$update_stmt->execute();
$update_stmt->close();

// ریجنریت کردن Session ID
session_regenerate_id(true);

// ============ ذخیره اطلاعات در سشن ============
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['fullname'] = $user['fullname'];
$_SESSION['email'] = $user['email'];
$_SESSION['role'] = $user['role'];
$_SESSION['avatar'] = $user['avatar'] ?? 'default.jpg';
$_SESSION['login_time'] = time();
$_SESSION['is_logged_in'] = true;

// پاک کردن خطاها
unset($_SESSION['login_errors']);
unset($_SESSION['login_data']);
unset($_SESSION['csrf_token']);

// ============ Remember Me ============

if ($remember) {
    $token = bin2hex(random_bytes(32));
    $expiry = time() + (86400 * 30);
    
    $token_sql = "UPDATE users SET remember_token = ?, token_expiry = FROM_UNIXTIME(?) WHERE id = ?";
    $token_stmt = $conn->prepare($token_sql);
    $token_stmt->bind_param("sii", $token, $expiry, $user['id']);
    $token_stmt->execute();
    $token_stmt->close();
    
    setcookie('remember_token', $token, $expiry, '/', '', false, true);
    setcookie('user_id', $user['id'], $expiry, '/', '', false, true);
}

$conn->close();

// ============ ریدایرکت ============

if ($user['role'] === 'admin') {
    header('Location: ../admin/dashboard.php');
} else {
    header('Location: ../index.php?welcome=1');
}
exit;
?>