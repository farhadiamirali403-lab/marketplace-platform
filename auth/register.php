<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
</head>
<body>
    <h2>فرم ثبت نام</h2>
    <form action="register_process.php" method="POST">
        <div>
            <label for="fullname">نام و نام خانوادگی:</label><br>
            <input type="text" id="fullname" name="fullname" placeholder="علی رضایی" required>
        </div>
        <br>
        
        <div>
            <label for="username">نام کاربری:</label><br>
            <input type="text" id="username" name="username" placeholder="alireza" required>
        </div>
        <br>
        
        <div>
            <label for="email">ایمیل:</label><br>
            <input type="email" id="email" name="email" placeholder="ali@email.com" required>
        </div>
        <br>
        
        <div>
            <label for="phone">شماره موبایل (اختیاری):</label><br>
            <input type="tel" id="phone" name="phone" placeholder="09121234567">
        </div>
        <br>
        
        <div>
            <label for="password">رمز عبور:</label><br>
            <input type="password" id="password" name="password" placeholder="حداقل ۶ کاراکتر" required minlength="6">
        </div>
        <br>
        
        <div>
            <label for="confirm_password">تکرار رمز عبور:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="تکرار رمز عبور" required>
        </div>
        <br>
        
        <button type="submit">ثبت نام</button>
    </form>
    
    <br>
    <p>قبلاً ثبت نام کردی؟ <a href="login.html">وارد شو</a></p>
</body>
</html>