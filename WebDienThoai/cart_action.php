<?php
session_start();
require_once 'includes/db.php';

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Lấy hành động từ URL (add, delete, update)
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 1. THÊM VÀO GIỎ (ADD)
if ($action == 'add' && $id > 0) {
    // Lấy số lượng từ form (mặc định là 1)
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    
    // Nếu sản phẩm đã có trong giỏ -> cộng dồn
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $quantity;
    } else {
        $_SESSION['cart'][$id] = $quantity;
    }
    
    // Chuyển hướng về trang giỏ hàng hoặc trang cũ
    header('Location: Giohang.php');
    exit();
}

// 2. XÓA SẢN PHẨM (DELETE)
if ($action == 'delete' && $id > 0) {
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header('Location: Giohang.php');
    exit();
}

// 3. CẬP NHẬT SỐ LƯỢNG (UPDATE)
if ($action == 'update') {
    // Nhận mảng số lượng từ form giỏ hàng
    $quantities = $_POST['qty'] ?? [];
    
    foreach ($quantities as $prod_id => $qty) {
        $prod_id = intval($prod_id);
        $qty = intval($qty);
        
        if ($qty > 0) {
            $_SESSION['cart'][$prod_id] = $qty;
        } else {
            // Nếu update số lượng về 0 hoặc âm -> xóa luôn
            unset($_SESSION['cart'][$prod_id]);
        }
    }
    header('Location: Giohang.php');
    exit();
}

// Nếu không có hành động gì, về trang chủ
header('Location: index.php');
?>