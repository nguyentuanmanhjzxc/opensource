<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // 1. Kiểm tra dữ liệu nhập vào
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Vui lòng nhập đầy đủ email và mật khẩu!";
        header('Location: login.php');
        exit;
    }

    // 2. Truy vấn tìm User theo Email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // 3. Kiểm tra mật khẩu (đã mã hóa hash)
    if ($user && password_verify($password, $user['password'])) {
        // --- ĐĂNG NHẬP THÀNH CÔNG ---
        
        // Lưu thông tin vào Session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_role'] = $user['role']; // 'admin' hoặc 'customer'
        
        // Xóa thông báo lỗi cũ (nếu có)
        unset($_SESSION['error']);

        // Chuyển hướng dựa trên quyền hạn (Role)
        if ($user['role'] === 'admin') {
            header('Location: dashboard.php');
        } else {
            header('Location: index.php');
        }
        exit;
    } else {
        // --- ĐĂNG NHẬP THẤT BẠI ---
        $_SESSION['error'] = "Email hoặc mật khẩu không chính xác!";
        header('Location: login.php');
        exit;
    }
} else {
    // Nếu ai đó cố truy cập trực tiếp file này mà không submit form
    header('Location: login.php');
    exit;
}
?>