<?php
session_start();
// Kiểm tra quyền admin...

// Cấu hình trang
$pageTitle = "Quản Lý Đơn Hàng";
$activePage = "orders"; // Biến này sẽ làm sáng mục "Quản Lý Đơn Hàng" ở sidebar

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1>Danh Sách Đơn Hàng</h1>
        <div class="header-actions">
            <input type="text" placeholder="Tìm mã đơn, tên khách...">
            <button class="add-new-btn"><i class="ri-add-line"></i> Tạo Đơn Mới</button>
        </div>
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
                    <tr>
                        <td>#1205</td>
                        <td>Nguyễn Văn An</td>
                        <td>14/10/2025</td>
                        <td>12.890.000đ</td>
                        <td><span class="status status-completed">Hoàn thành</span></td>
                        <td><a href="#" class="action-btn">Chi tiết</a></td>
                    </tr>
                    <tr>
                        <td>#1204</td>
                        <td>Trần Thị Bích</td>
                        <td>13/10/2025</td>
                        <td>15.390.000đ</td>
                        <td><span class="status status-processing">Đang xử lý</span></td>
                        <td><a href="#" class="action-btn">Chi tiết</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>