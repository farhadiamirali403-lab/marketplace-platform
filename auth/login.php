<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب</title>
</head>
<body>
    <h2>فرم ورود</h2>
    <form action="login_process.php" method="POST">
        <div>
            <label for="username">نام کاربری یا ایمیل:</label><br>
            <input type="text" id="username" name="username" placeholder="alireza یا ali@email.com" required>
        </div>
        <br>
        
        <div>
            <label for="password">رمز عبور:</label><br>
            <input type="password" id="password" name="password" placeholder="رمز عبور خود را وارد کنید" required>
        </div>
        <br>
        
        <div>
            <input type="checkbox" id="remember" name="remember" value="1">
            <label for="remember">مرا به خاطر بسپار</label>
        </div>
        <br>
        
        <button type="submit">ورود</button>
    </form>
    
    <br>
    <p><a href="forgot_password.html">رمز عبور را فراموش کردی؟</a></p>
    <p>حساب نداری؟ <a href="register.html">ثبت نام کن</a></p>
</body>
</html>