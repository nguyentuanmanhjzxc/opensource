<?php
require_once 'includes/admin_protect.php';
require_once 'includes/db.php';

// 1. KIỂM TRA ID ĐƠN HÀNG
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: admin_orders.php');
    exit;
}
$order_id = intval($_GET['id']);

// 2. XỬ LÝ CẬP NHẬT TRẠNG THÁI
// Thêm điều kiện !empty() để đảm bảo không cập nhật trạng thái rỗng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status']) && !empty($_POST['status'])) {
    $new_status = $_POST['status'];
    
    // Cập nhật vào CSDL
    $stmt = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
    $stmt->execute(['status' => $new_status, 'id' => $order_id]);
    
    // Refresh lại trang để thấy kết quả mới
    echo "<script>alert('Đã cập nhật trạng thái thành công!'); window.location.href='admin_order_detail.php?id=$order_id';</script>";
}

// 3. LẤY THÔNG TIN ĐƠN HÀNG
$sql_order = "SELECT o.*, u.email as user_email, u.full_name as user_account_name 
              FROM orders o 
              LEFT JOIN users u ON o.user_id = u.id 
              WHERE o.id = :id";
$stmt = $conn->prepare($sql_order);
$stmt->execute(['id' => $order_id]);
$order = $stmt->fetch();

if (!$order) {
    echo "<h3>Đơn hàng không tồn tại hoặc đã bị xóa.</h3>";
    echo "<a href='admin_orders.php'>Quay lại danh sách</a>";
    exit;
}

// 4. LẤY CHI TIẾT SẢN PHẨM
$sql_details = "SELECT d.*, p.name as product_name, p.image as product_image 
                FROM order_details d 
                LEFT JOIN products p ON d.product_id = p.id 
                WHERE d.order_id = :id";
$stmt_details = $conn->prepare($sql_details);
$stmt_details->execute(['id' => $order_id]);
$order_items = $stmt_details->fetchAll();

$pageTitle = "Chi Tiết Đơn Hàng #" . $order_id;
$activePage = "orders";

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <div style="display: flex; align-items: center; gap: 15px;">
            <a href="admin_orders.php" class="action-btn" style="background: #95a5a6;">&larr; Quay lại</a>
            <h1>Chi Tiết Đơn Hàng #<?= $order_id ?></h1>
        </div>
    </header>

    <div class="content-wrapper">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            
            <div class="card-form">
                <h3 style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Danh sách sản phẩm</h3>
                <table class="order-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_items as $item): ?>
                        <tr>
                            <td style="display: flex; align-items: center; gap: 10px;">
                                <img src="<?= htmlspecialchars($item['product_image'] ?? 'img/no-image.jpg') ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                
                                <span><?= htmlspecialchars($item['product_name'] ?? 'Sản phẩm đã bị xóa') ?></span>
                            </td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                            <td style="text-align: center;">x<?= $item['quantity'] ?></td>
                            <td style="font-weight: bold;"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right; padding-top: 20px;"><strong>Tổng tiền đơn hàng:</strong></td>
                            <td style="padding-top: 20px; font-size: 1.2rem; color: #e74c3c; font-weight: bold;">
                                <?= number_format($order['total_money'], 0, ',', '.') ?>đ
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div>
                <div class="card-form" style="margin-bottom: 20px; background: #eef2f3;">
                    <h3 style="margin-bottom: 15px;">Xử Lý Đơn Hàng</h3>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Trạng thái hiện tại:</label>
                            <select name="status" class="form-control" style="font-weight: bold;">
                                <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>Đang giao hàng</option>
                                <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Đã hoàn thành</option>
                                <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-save" style="width: 100%;">Cập Nhật Trạng Thái</button>
                    </form>
                </div>

                <div class="card-form">
                    <h3 style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Thông Tin Giao Hàng</h3>
                    
                    <p style="margin-bottom: 10px;">
                        <strong>Người nhận:</strong><br> 
                        <?= htmlspecialchars($order['customer_name'] ?? 'Không tên') ?>
                    </p>
                    <p style="margin-bottom: 10px;">
                        <strong>Số điện thoại:</strong><br> 
                        <?= htmlspecialchars($order['customer_phone'] ?? 'Không có SĐT') ?>
                    </p>
                    <p style="margin-bottom: 10px;">
                        <strong>Địa chỉ:</strong><br> 
                        <?= nl2br(htmlspecialchars($order['customer_address'] ?? 'Không có địa chỉ')) ?>
                    </p>
                    <p style="margin-bottom: 10px;">
                        <strong>Ngày đặt:</strong><br> 
                        <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                    </p>

                    <hr style="margin: 15px 0; border: 0; border-top: 1px solid #eee;">
                    
                    <p style="font-size: 0.9rem; color: #666;">
                        <strong>Tài khoản đặt:</strong> 
                        <?= htmlspecialchars($order['user_account_name'] ?? 'Khách vãng lai') ?> 
                        (<?= htmlspecialchars($order['user_email'] ?? 'Không có email') ?>)
                    </p>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>