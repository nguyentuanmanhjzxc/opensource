<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

<div class="login-bg">
    <div class="login-overlay"></div>
</div>

<div class="login-wrapper">
    <form class="login-form" action="xuly_register.php" method="POST">
        <div class="login-header">
            <h1><b>The King</b></h1>
            <p class="form-subtitle"><b>Tạo tài khoản mới</b></p>
        </div>

        <div class="input-group">
            <label for="fullname">Họ và tên</label>
            <input type="text" id="fullname" name="fullname" placeholder="Nhập họ tên..." required>
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Nhập email..." required>
        </div>

        <div class="input-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Tạo mật khẩu..." required>
        </div>

        <div class="input-group">
            <label for="password2">Nhập lại mật khẩu</label>
            <input type="password" id="password2" name="password2" placeholder="Nhập lại mật khẩu..." required>
        </div>

        <button type="submit" class="cta-button">Đăng ký</button>

        <div class="login-links">
            <a href="login.php">Đã có tài khoản? Đăng nhập</a>
        </div>

    </form>
</div>

</body>
</html>
