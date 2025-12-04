<?php
session_start();
// Kiểm tra quyền admin...

$pageTitle = "Quản Lý Khách Hàng";
$activePage = "customers"; // Highlight menu Khách hàng

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1>Danh Sách Khách Hàng</h1>
        <div class="header-actions">
            <input type="text" placeholder="Tìm tên, email, sđt...">
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
                        <th>Đã Mua</th>
                        <th>Tổng Chi Tiêu</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#KH01</td>
                        <td><strong>Nguyễn Văn An</strong></td>
                        <td>
                            email@example.com<br>
                            0901234567
                        </td>
                        <td>5 đơn hàng</td>
                        <td style="color: var(--accent-color); font-weight: bold;">45.000.000đ</td>
                        <td><a href="#" class="action-btn">Xem lịch sử</a></td>
                    </tr>
                    <tr>
                        <td>#KH02</td>
                        <td><strong>Trần Thị Bích</strong></td>
                        <td>
                            bich.tran@gmail.com<br>
                            0987654321
                        </td>
                        <td>2 đơn hàng</td>
                        <td style="color: var(--accent-color); font-weight: bold;">15.390.000đ</td>
                        <td><a href="#" class="action-btn">Xem lịch sử</a></td>
                    </tr>
                    <tr>
                        <td>#KH03</td>
                        <td><strong>Lê Hoàng Cường</strong></td>
                        <td>
                            cuongle@yahoo.com<br>
                            0912345678
                        </td>
                        <td>1 đơn hàng</td>
                        <td style="color: var(--accent-color); font-weight: bold;">12.500.000đ</td>
                        <td><a href="#" class="action-btn">Xem lịch sử</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>