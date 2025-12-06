<?php
// admin_customers.php
require_once 'includes/admin_protect.php'; 
require_once 'includes/db.php';

// Xử lý tìm kiếm
$search = $_GET['search'] ?? '';
$searchParam = "%$search%";

$sql = "SELECT u.*, 
               COUNT(o.id) as total_orders, 
               COALESCE(SUM(o.total_money), 0) as total_spent 
        FROM users u 
        LEFT JOIN orders o ON u.id = o.user_id AND o.status = 'completed'
        WHERE u.role = 'customer' 
        AND (u.full_name LIKE :search OR u.email LIKE :search OR u.phone LIKE :search)
        GROUP BY u.id
        ORDER BY u.id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute(['search' => $searchParam]);
$customers = $stmt->fetchAll();

$pageTitle = "Quản Lý Khách Hàng";
$activePage = "customers";

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1>Danh Sách Khách Hàng</h1>
        <div class="header-actions">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Tìm tên, email, sđt..." value="<?= htmlspecialchars($search) ?>">
            </form>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="order-table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ và Tên</th>
                        <th>Thông Tin Liên Hệ</th>
                        <th>Đã Mua (Thành công)</th>
                        <th>Tổng Chi Tiêu</th>
                        <th>Ngày Đăng Ký</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($customers) > 0): ?>
                        <?php foreach ($customers as $row): ?>
                        <tr>
                            <td>#<?= $row['id'] ?></td>
                            <td><strong><?= htmlspecialchars($row['full_name'] ?? 'Không tên') ?></strong></td>
                            <td>
                                <?= htmlspecialchars($row['email'] ?? '') ?><br>
                                <small><?= htmlspecialchars($row['phone'] ?? 'Chưa có SĐT') ?></small>
                            </td>
                            <td style="text-align: center;"><?= $row['total_orders'] ?> đơn</td>
                            <td style="color: #2ecc71; font-weight: bold;">
                                <?= number_format($row['total_spent'], 0, ',', '.') ?>đ
                            </td>
                            <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Không tìm thấy khách hàng nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>