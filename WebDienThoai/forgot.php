<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

<div class="login-bg">
    <div class="login-overlay"></div>
</div>

<div class="login-wrapper">
    <form class="login-form" action="xuly_forgot.php" method="POST">
        

        <div class="login-header">
            <h1><b>The King</b></h1>
            <p class="form-subtitle"><b>Khôi phục mật khẩu</b></p>
        </div>

        <div class="input-group">
            <label for="email">Nhập email đã đăng ký</label>
            <input type="email" id="email" name="email" placeholder="Nhập email..." required>
        </div>

        <button type="submit" class="cta-button">Gửi yêu cầu</button>

        <div class="login-links">
            <a href="login.php">Quay lại đăng nhập</a>
        </div>

    </form>
</div>

</body>
</html>
