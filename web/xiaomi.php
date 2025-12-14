<?php
session_start();
require_once 'includes/db.php';

// CẤU HÌNH: ID danh mục Xiaomi trong CSDL là 3
$category_id = 3; 

try {
    $sql = "SELECT * FROM products WHERE category_id = :cat_id";
    
    $sort = $_GET['sorting'] ?? 'default';
    if ($sort == 'price-asc') {
        $sql .= " ORDER BY price ASC";
    } elseif ($sort == 'price-desc') {
        $sql .= " ORDER BY price DESC";
    } else {
        $sql .= " ORDER BY id DESC";
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute(['cat_id' => $category_id]);
    $products = $stmt->fetchAll();
    
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}

$pageTitle = "THE KING - Điện thoại Xiaomi";
include 'includes/header.php'; 
?>

<main>
    <section class="section">
        <div class="container">
            <h2 class="section-title">ĐIỆN THOẠI XIAOMI</h2>

            <form id="filter-form" method="GET" action="">
                <div class="filter-bar">
                    <div class="filter-options">
                        <span>Dòng máy:</span>
                        <select id="category-filter" name="category">
                            <option value="all">Tất cả</option>
                            <option value="xiaomi_flagship">Xiaomi Series (Cao cấp)</option>
                            <option value="redmi">Redmi Note (Tầm trung)</option>
                            <option value="poco">POCO (Hiệu năng cao)</option>
                        </select>
                    </div>
                    <div class="sort-options">
                        <span>Sắp xếp:</span>
                        <select id="sort-filter" name="sorting" onchange="this.form.submit()">
                            <option value="default" <?= ($sort=='default')?'selected':'' ?>>Mặc định</option>
                            <option value="price-asc" <?= ($sort=='price-asc')?'selected':'' ?>>Giá tăng dần</option>
                            <option value="price-desc" <?= ($sort=='price-desc')?'selected':'' ?>>Giá giảm dần</option>
                        </select>
                    </div>
                </div>
            </form>

            <div id="product-grid" class="grid" style="grid-template-columns: repeat(3, 1fr);">
                <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $row): ?>
                        <div class="product-card" 
                             data-category="<?= htmlspecialchars($row['series']) ?>" 
                             data-price="<?= $row['price'] ?>">
                             
                            <?php if (!empty($row['is_hot'])): ?>
                                <div class="sale-badge">Hot</div>
                            <?php endif; ?>

                            <a href="ProductDetail.php?id=<?= $row['id'] ?>">
                                <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                            </a>
                            <p class="product-name"><?= htmlspecialchars($row['name']) ?></p>
                            
                            <div class="price-container">
                                <span class="product-price"><?= number_format($row['price'], 0, ',', '.') ?>đ</span>
                                <?php if ($row['old_price'] > 0): ?>
                                    <br><small style="text-decoration: line-through; color:#999"><?= number_format($row['old_price'], 0, ',', '.') ?>đ</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="grid-column: 1/-1; text-align: center;">Hiện chưa có sản phẩm Xiaomi nào.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
<script src="js/category-filter.js"></script>