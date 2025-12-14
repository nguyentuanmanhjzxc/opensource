<?php
session_start();
// Nếu đã đăng nhập thì không cần đăng ký nữa
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản - THE KING</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        /* CSS bổ sung cho thông báo lỗi */
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>

<body>

<div class="login-bg">
    <div class="login-overlay"></div>
</div>

<div class="login-wrapper">
    <form class="login-form" action="xuly_register.php" method="POST">
        <div class="login-header">
            <a href="index.php" class="back-btn-inside">←</a>
            <h1><b>The King</b></h1>
            <p class="form-subtitle"><b>Tạo tài khoản mới</b></p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= $_SESSION['error']; ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="input-group">
            <label for="fullname">Họ và tên</label>
            <input type="text" id="fullname" name="fullname" 
                   value="<?= isset($_SESSION['old_data']['fullname']) ? $_SESSION['old_data']['fullname'] : '' ?>" 
                   placeholder="Nhập họ tên..." >
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" 
                   value="<?= isset($_SESSION['old_data']['email']) ? $_SESSION['old_data']['email'] : '' ?>" 
                   placeholder="Nhập email..." >
        </div>

        <div class="input-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Tạo mật khẩu (tối thiểu 6 ký tự)..." >
        </div>

        <div class="input-group">
            <label for="password_confirm">Nhập lại mật khẩu</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Nhập lại mật khẩu..." >
        </div>

        <button type="submit" class="cta-button">Đăng ký</button>

        <div class="login-links">
            <a href="login.php">Đã có tài khoản? Đăng nhập</a>
        </div>

    </form>
</div>
<?php 
// Xóa dữ liệu cũ sau khi đã hiển thị xong
unset($_SESSION['old_data']); 
?>
</body>
</html>