<?php
// auth/register_process.php - پردازش ثبت نام

// چون config.php داخل خود auth هست
require_once 'config.php';
startSecureSession();

// بررسی اینکه فرم ارسال شده
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

// بررسی توکن CSRF
if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
    $_SESSION['register_errors'] = ['general' => 'خطای امنیتی! لطفاً دوباره تلاش کنید.'];
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

$errors = [];

// ============ اعتبارسنجی ============

// 1. نام و نام خانوادگی
if (empty($fullname)) {
    $errors['fullname'] = "نام و نام خانوادگی الزامی است.";
} elseif (strlen($fullname) < 3) {
    $errors['fullname'] = "نام و نام خانوادگی باید حداقل ۳ کاراکتر باشد.";
}

// 2. نام کاربری
if (empty($username)) {
    $errors['username'] = "نام کاربری الزامی است.";
} elseif (!preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $username)) {
    $errors['username'] = "نام کاربری باید شامل حروف انگلیسی، اعداد و بین ۳ تا ۲۰ کاراکتر باشد.";
} else {
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        $errors['username'] = "❌ این نام کاربری قبلاً ثبت شده است.";
    }
    $check_stmt->close();
}

// 3. ایمیل
if (empty($email)) {
    $errors['email'] = "ایمیل الزامی است.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "فرمت ایمیل نامعتبر است.";
} else {
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        $errors['email'] = "❌ این ایمیل قبلاً ثبت شده است.";
    }
    $check_stmt->close();
}

// 4. موبایل
if (!empty($phone)) {
    if (!preg_match('/^09[0-9]{9}$/', $phone)) {
        $errors['phone'] = "شماره موبایل نامعتبر است.";
    } else {
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

// 5. رمز عبور
if (empty($password)) {
    $errors['password'] = "رمز عبور الزامی است.";
} elseif (strlen($password) < 8) {
    $errors['password'] = "رمز عبور باید حداقل ۸ کاراکتر باشد.";
} elseif (!preg_match('/[A-Z]/', $password)) {
    $errors['password'] = "رمز عبور باید حداقل یک حرف بزرگ داشته باشد.";
} elseif (!preg_match('/[a-z]/', $password)) {
    $errors['password'] = "رمز عبور باید حداقل یک حرف کوچک داشته باشد.";
} elseif (!preg_match('/[0-9]/', $password)) {
    $errors['password'] = "رمز عبور باید حداقل یک عدد داشته باشد.";
}

// 6. تکرار رمز عبور
if (empty($confirm_password)) {
    $errors['confirm_password'] = "تکرار رمز عبور الزامی است.";
} elseif ($password !== $confirm_password) {
    $errors['confirm_password'] = "رمز عبور و تکرار آن مطابقت ندارند.";
}

// ============ اگر خطایی وجود داشت ============
if (!empty($errors)) {
    $_SESSION['register_errors'] = $errors;
    $_SESSION['register_data'] = [
        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
        'phone' => $phone
    ];
    header('Location: register.php');
    exit;
}

// ============ ثبت نام کاربر ============

$hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
$ip_address = getRealIP();

$sql = "INSERT INTO users (fullname, username, email, phone, password, ip_address, registered_at, status) 
        VALUES (?, ?, ?, ?, ?, ?, NOW(), 1)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $fullname, $username, $email, $phone, $hashed_password, $ip_address);

if ($stmt->execute()) {
    $user_id = $conn->insert_id;
    
    // ============ ذخیره اطلاعات در سشن ============
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['email'] = $email;
    $_SESSION['role'] = 'user';
    $_SESSION['avatar'] = 'default.jpg';
    $_SESSION['login_time'] = time();
    $_SESSION['is_logged_in'] = true;
    
    // پاک کردن داده‌های سشن
    unset($_SESSION['register_errors']);
    unset($_SESSION['register_data']);
    unset($_SESSION['csrf_token']);
    
    $stmt->close();
    $conn->close();
    
    // ریدایرکت به صفحه موفقیت
    header('Location: register_success.php');
    exit;
    
} else {
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