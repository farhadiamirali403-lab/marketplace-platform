<?php
// auth/logout.php - خروج از حساب

// چون config.php داخل خود auth هست
require_once 'config.php';
startSecureSession();

// پاک کردن کوکی Remember Me
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/', '', false, true);
    setcookie('user_id', '', time() - 3600, '/', '', false, true);
}

// پاک کردن همه متغیرهای سشن
$_SESSION = array();

// پاک کردن کوکی سشن
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// نابود کردن سشن
session_destroy();

// ریدایرکت به صفحه اصلی
header('Location: ../index.php?message=شما با موفقیت خارج شدید');
exit;
?>