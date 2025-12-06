<?php
require_once 'includes/admin_protect.php';
require_once 'includes/db.php';

// Lấy danh sách đơn hàng
$sql = "SELECT o.*, u.full_name 
        FROM orders o 
        LEFT JOIN users u ON o.user_id = u.id 
        ORDER BY o.created_at DESC";
$orders = $conn->query($sql)->fetchAll();

$pageTitle = "Quản Lý Đơn Hàng";
$activePage = "orders";

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1>Danh Sách Đơn Hàng</h1>
    </header>

    <div class="content-wrapper">
        <div class="order-table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Khách Hàng</th>
                        <th>Ngày Đặt</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <?php 
                            // Xử lý màu sắc trạng thái
                            $statusClass = '';
                            $statusText = '';
                            switch($order['status']) {
                                case 'pending': $statusClass = 'status-pending'; $statusText = 'Chờ xử lý'; break;
                                case 'processing': $statusClass = 'status-processing'; $statusText = 'Đang giao'; break;
                                case 'completed': $statusClass = 'status-completed'; $statusText = 'Hoàn thành'; break;
                                case 'cancelled': $statusClass = 'status-cancelled'; $statusText = 'Đã hủy'; break;
                            }
                        ?>
                    <tr>
                        <td>#<?= $order['id'] ?></td>
                        <td>
                            <?= htmlspecialchars($order['customer_name'] ?? $order['full_name']) ?>
                            <br><small><?= htmlspecialchars($order['customer_phone']) ?></small>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                        <td><strong><?= number_format($order['total_money'], 0, ',', '.') ?>đ</strong></td>
                        <td>
                            <span class="status <?= $statusClass ?>" 
                                  style="padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;
                                  background: #eee; color: #333;">
                                <?= $statusText ?>
                            </span>
                        </td>
                        <td>
                            <a href="admin_order_detail.php?id=<?= $order['id'] ?>" class="action-btn">Chi tiết & Xử lý</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include 'includes/admin_footer.php'; ?>