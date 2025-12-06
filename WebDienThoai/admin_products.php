<?php
// admin_products.php
require_once 'includes/admin_protect.php';
require_once 'includes/db.php';

// Xử lý Xóa
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        echo "<script>alert('Đã xóa sản phẩm thành công!'); window.location.href='admin_products.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Lỗi: Không thể xóa sản phẩm này (có thể do đang có trong đơn hàng).'); window.location.href='admin_products.php';</script>";
    }
}

// Xử lý Tìm kiếm
$search = $_GET['search'] ?? '';
$searchParam = "%$search%";

// Lấy danh sách sản phẩm + Tên danh mục
$sql = "SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.name LIKE :search 
        ORDER BY p.id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute(['search' => $searchParam]);
$products = $stmt->fetchAll();

$pageTitle = "Quản Lý Sản Phẩm";
$activePage = "products"; 
include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1>Danh Sách Sản Phẩm</h1>
        <div class="header-actions">
            <form action="" method="GET" style="display: flex; gap: 10px;">
                <input type="text" name="search" placeholder="Tìm tên sản phẩm..." value="<?= htmlspecialchars($search) ?>">
            </form>
            <a href="product_form.php" class="add-new-btn" style="text-decoration:none;">
                <i class="ri-add-line"></i> Thêm Sản Phẩm
            </a>
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
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $row): ?>
                        <tr>
                            <td>
                                <img src="<?= htmlspecialchars($row['image']) ?>" alt="" class="product-thumb" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($row['name']) ?></strong>
                                <br><span style="font-size: 12px; color: #888;">ID: #<?= $row['id'] ?></span>
                            </td>
                            <td><?= htmlspecialchars($row['category_name'] ?? 'Chưa phân loại') ?></td>
                            <td>
                                <?= number_format($row['price'], 0, ',', '.') ?>đ
                                <?php if ($row['old_price'] > 0): ?>
                                    <br><del style="font-size: 11px; color: #999;"><?= number_format($row['old_price'], 0, ',', '.') ?>đ</del>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($row['stock'] > 0): ?>
                                    <span class="badge badge-instock" style="color: green; background: #e8f5e9; padding: 3px 8px; border-radius: 10px; font-size: 12px;">Còn hàng (<?= $row['stock'] ?>)</span>
                                <?php else: ?>
                                    <span class="badge badge-outstock" style="color: red; background: #ffebee; padding: 3px 8px; border-radius: 10px; font-size: 12px;">Hết hàng</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="product_form.php?id=<?= $row['id'] ?>" class="action-btn"><i class="ri-pencil-line"></i> Sửa</a>
                                <a href="admin_products.php?delete_id=<?= $row['id'] ?>" 
                                   class="action-btn" 
                                   style="color: #e74c3c; margin-left: 10px;"
                                   onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');">
                                   <i class="ri-delete-bin-line"></i> Xóa
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Chưa có sản phẩm nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>