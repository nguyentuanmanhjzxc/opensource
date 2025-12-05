<?php
session_start();
// Kiểm tra quyền admin...

$pageTitle = "Quản Lý Sản Phẩm";
$activePage = "products"; // Highlight menu Sản phẩm

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1>Danh Sách Sản Phẩm</h1>
        <div class="header-actions">
            <input type="text" placeholder="Tìm tên sản phẩm...">
            <button class="add-new-btn"><i class="ri-add-line"></i> Thêm Sản Phẩm</button>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="order-table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Danh Mục</th>
                        <th>Giá Bán</th>
                        <th>Kho Hàng</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="img/9.jpg" alt="iPhone 13" class="product-thumb"></td>
                        <td>
                            <strong>iPhone 13 128GB</strong>
                            <br><span style="font-size: 12px; color: #888;">ID: #SP001</span>
                        </td>
                        <td>iPhone</td>
                        <td>12.890.000đ</td>
                        <td><span class="badge badge-instock">Còn hàng (50)</span></td>
                        <td>
                            <a href="#" class="action-btn"><i class="ri-pencil-line"></i> Sửa</a>
                            <a href="#" class="action-btn" style="color: #e74c3c; margin-left: 10px;"><i class="ri-delete-bin-line"></i> Xóa</a>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/20.jpg" alt="Samsung S25" class="product-thumb"></td>
                        <td>
                            <strong>Samsung Galaxy S25 Ultra</strong>
                            <br><span style="font-size: 12px; color: #888;">ID: #SP004</span>
                        </td>
                        <td>Samsung</td>
                        <td>12.500.000đ</td>
                        <td><span class="badge badge-instock">Còn hàng (20)</span></td>
                        <td>
                            <a href="#" class="action-btn"><i class="ri-pencil-line"></i> Sửa</a>
                            <a href="#" class="action-btn" style="color: #e74c3c; margin-left: 10px;"><i class="ri-delete-bin-line"></i> Xóa</a>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/11.jpg" alt="Airpods" class="product-thumb"></td>
                        <td>
                            <strong>Airpods Pro 3</strong>
                            <br><span style="font-size: 12px; color: #888;">ID: #PK011</span>
                        </td>
                        <td>Phụ kiện</td>
                        <td>6.790.000đ</td>
                        <td><span class="badge badge-outstock">Hết hàng</span></td>
                        <td>
                            <a href="#" class="action-btn"><i class="ri-pencil-line"></i> Sửa</a>
                            <a href="#" class="action-btn" style="color: #e74c3c; margin-left: 10px;"><i class="ri-delete-bin-line"></i> Xóa</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>