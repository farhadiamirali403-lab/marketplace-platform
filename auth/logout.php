<?php
// logout.php - خروج از حساب

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// پاک کردن کوکی Remember Me
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/', '', true, true);
    setcookie('user_id', '', time() - 3600, '/', '', true, true);
}

// پاک کردن سشن
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

// ریدایرکت به صفحه لاگین
header('Location: login.html');
exit;
?>