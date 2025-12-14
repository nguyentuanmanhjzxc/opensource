<?php
require_once 'includes/admin_protect.php'; // Bảo vệ trang
require_once 'includes/db.php'; // Kết nối CSDL

// 1. Thống kê DOANH THU (Chỉ tính đơn đã hoàn thành)
$stmt = $conn->query("SELECT SUM(total_money) as total FROM orders WHERE status = 'completed'");
$revenue = $stmt->fetch()['total'] ?? 0;

// 2. Thống kê ĐƠN HÀNG MỚI (Trạng thái pending)
$stmt = $conn->query("SELECT COUNT(*) as count FROM orders WHERE status = 'pending'");
$new_orders = $stmt->fetch()['count'];

// 3. Thống kê KHÁCH HÀNG
$stmt = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'customer'");
$total_customers = $stmt->fetch()['count'];

// 4. Thống kê SẢN PHẨM SẮP HẾT HÀNG (Stock < 5)
$stmt = $conn->query("SELECT COUNT(*) as count FROM products WHERE stock < 5");
$low_stock = $stmt->fetch()['count'];

// Cấu hình trang
$pageTitle = "Dashboard Tổng Quan";
$activePage = "dashboard"; 

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <div class="header-title">
            <h1>Tổng Quan</h1>
            <p>Chào mừng trở lại, <?= htmlspecialchars($_SESSION['user_name']) ?>!</p>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="dashboard-cards">
            <div class="card-single">
                <div class="card-info">
                    <span>Tổng Doanh Thu (Đã xong)</span>
                    <h3><?= number_format($revenue, 0, ',', '.') ?>đ</h3>
                </div>
                <div class="card-icon green"><i class="ri-money-dollar-circle-line"></i></div>
            </div>

            <div class="card-single">
                <div class="card-info">
                    <span>Đơn Mới Cần Xử Lý</span>
                    <h3><?= $new_orders ?></h3>
                </div>
                <div class="card-icon"><i class="ri-shopping-cart-2-line"></i></div>
            </div>

             <div class="card-single">
                <div class="card-info">
                    <span>Tổng Khách Hàng</span>
                    <h3><?= $total_customers ?></h3>
                </div>
                <div class="card-icon yellow"><i class="ri-group-line"></i></div>
            </div>

             <div class="card-single">
                <div class="card-info">
                    <span>Cảnh Báo Kho</span>
                    <h3><?= $low_stock ?></h3>
                    <small style="color: #e74c3c;">Sản phẩm sắp hết hàng</small>
                </div>
                <div class="card-icon red"><i class="ri-smartphone-line"></i></div>
            </div>
        </div>
    </div>
</main>
<?php include 'includes/admin_footer.php'; ?>