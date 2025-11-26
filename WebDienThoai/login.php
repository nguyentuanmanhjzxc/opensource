<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>

    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

<div class="login-bg">
    <div class="login-overlay"></div>
</div>

<div class="login-wrapper">
    <form class="login-form" action="xuly_login.php" method="POST">
     
        <div class="login-header">
            <a href="index.php" class="back-btn-inside">←</a>
            <h1><b>The King</b></h1>
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Nhập email..." required>
        </div>

        <div class="input-group">
            <label for="password">Mật khẩu</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..." required>
                <span class="toggle-password" onclick="togglePass()">👁</span>
            </div>
        </div>

        <div class="extra-options">
            <label><input type="checkbox" name="remember"> Lưu đăng nhập</label>
            <a href="forgot.php">Quên mật khẩu?</a>
        </div>

        <button type="submit" class="cta-button">Đăng nhập</button>

        <div class="login-links">
            <a href="register.php">Tạo tài khoản mới</a>
        </div>

    </form>
</div>

<script>
function togglePass() {
    let pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>
