<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فراموشی رمز عبور</title>
</head>
<body>
    <h2>بازیابی رمز عبور</h2>
    <form action="forgot_password.php" method="POST">
        <div>
            <label for="email">ایمیل خود را وارد کنید:</label><br>
            <input type="email" id="email" name="email" placeholder="ali@email.com" required>
        </div>
        <br>
        <button type="submit">ارسال لینک بازیابی</button>
    </form>
    
    <br>
    <p><a href="login.html">بازگشت به صفحه ورود</a></p>
</body>
</html>