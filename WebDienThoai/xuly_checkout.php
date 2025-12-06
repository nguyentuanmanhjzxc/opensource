<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Kiểm tra đăng nhập & Giỏ hàng
    if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
        header('Location: index.php');
        exit;
    }

    // 2. Lấy dữ liệu từ form
    $user_id = $_SESSION['user_id'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method']; // Lưu ý: Database mẫu chưa có cột này, có thể bỏ qua hoặc thêm vào note

    // 3. Tính toán lại tổng tiền (Bảo mật: Tính từ DB, không tin tưởng client)
    $cart = $_SESSION['cart'];
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    
    $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total_money = 0;
    foreach ($products as $p) {
        $qty = $cart[$p['id']];
        $total_money += $p['price'] * $qty;
    }

    // --- BẮT ĐẦU TRANSACTION (QUAN TRỌNG) ---
    try {
        $conn->beginTransaction();

        // Bước 4: Insert vào bảng ORDERS
        $sql_order = "INSERT INTO orders (user_id, customer_name, customer_phone, customer_address, total_money, status, created_at) 
                      VALUES (:uid, :name, :phone, :addr, :total, 'pending', NOW())";
        $stmt = $conn->prepare($sql_order);
        $stmt->execute([
            'uid' => $user_id,
            'name' => $fullname,
            'phone' => $phone,
            'addr' => $address,
            'total' => $total_money
        ]);
        
        // Lấy ID đơn hàng vừa tạo
        $order_id = $conn->lastInsertId();

        // Bước 5: Insert vào bảng ORDER_DETAILS và TRỪ TỒN KHO
        $sql_detail = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt_detail = $conn->prepare($sql_detail);

        $sql_stock = "UPDATE products SET stock = stock - ? WHERE id = ?";
        $stmt_stock = $conn->prepare($sql_stock);

        foreach ($products as $p) {
            $qty = $cart[$p['id']];
            
            // Thêm chi tiết đơn
            $stmt_detail->execute([$order_id, $p['id'], $qty, $p['price']]);

            // Trừ kho
            $stmt_stock->execute([$qty, $p['id']]);
        }

        // Bước 6: Commit (Lưu chính thức)
        $conn->commit();

        // Xóa giỏ hàng
        unset($_SESSION['cart']);

        // Chuyển hướng đến trang thành công
        header('Location: order_success.php?id=' . $order_id);
        exit;

    } catch (Exception $e) {
        // Nếu có lỗi, Rollback (Hủy toàn bộ thao tác)
        $conn->rollBack();
        echo "Lỗi xử lý đơn hàng: " . $e->getMessage();
    }

} else {
    header('Location: index.php');
}
?>