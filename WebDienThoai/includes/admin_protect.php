<?php
// includes/admin_protect.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra đăng nhập và quyền hạn
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    // Nếu không phải admin, đá về trang chủ hoặc trang login
    header('Location: login.php');
    exit;
}
?>