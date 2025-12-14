<?php
session_start();
require_once 'includes/db.php';

// 1. LẤY CÁC THAM SỐ TỪ URL (GET)
$keyword = $_GET['q'] ?? '';
$category_id = $_GET['category'] ?? ''; // Lọc theo hãng
$price_range = $_GET['price'] ?? '';    // Lọc theo tầm giá
$sort = $_GET['sort'] ?? 'newest';      // Sắp xếp

// 2. XÂY DỰNG CÂU SQL ĐỘNG
$sql = "SELECT * FROM products WHERE 1=1"; // 1=1 là mẹo để dễ nối chuỗi AND
$params = [];

// A. Tìm kiếm từ khóa
if (!empty($keyword)) {
    $sql .= " AND (name LIKE :kw OR description LIKE :kw)";
    $params['kw'] = "%$keyword%";
}

// B. Lọc theo hãng (Category)
if (!empty($category_id)) {
    $sql .= " AND category_id = :cat_id";
    $params['cat_id'] = $category_id;
}

// C. Lọc theo tầm giá (Dưới 5tr, 5-15tr, Trên 15tr)
if (!empty($price_range)) {
    switch ($price_range) {
        case 'under_5':
            $sql .= " AND price < 5000000";
            break;
        case '5_15':
            $sql .= " AND price BETWEEN 5000000 AND 15000000";
            break;
        case 'over_15':
            $sql .= " AND price > 15000000";
            break;
    }
}

// D. Sắp xếp (Sorting)
$allowed_sorts = ['price_asc', 'price_desc', 'newest'];
if (!in_array($sort, $allowed_sorts)) $sort = 'newest';

switch ($sort) {
    case 'price_asc':
        $sql .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sql .= " ORDER BY price DESC";
        break;
    default:
        $sql .= " ORDER BY id DESC"; // Mới nhất
        break;
}

// 3. THỰC THI
try {
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

// Lấy danh sách danh mục để hiện vào dropdown lọc
$cats = $conn->query("SELECT * FROM categories")->fetchAll();

$pageTitle = "Tìm kiếm & Lọc sản phẩm";
include 'includes/header.php';
?>

<main class="section">
    <div class="container">
        <h2 class="section-title">KẾT QUẢ TÌM KIẾM</h2>
        
        <div class="filter-box" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
            <form action="" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: end;">
                
                <div style="flex: 2; min-width: 200px;">
                    <label><b>Từ khóa:</b></label>
                    <input type="text" name="q" value="<?= htmlspecialchars($keyword) ?>" placeholder="Nhập tên sản phẩm..." style="width: 100%; padding: 8px;">
                </div>

                <div style="flex: 1; min-width: 150px;">
                    <label><b>Hãng sản xuất:</b></label>
                    <select name="category" style="width: 100%; padding: 8px;">
                        <option value="">-- Tất cả --</option>
                        <?php foreach($cats as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= $category_id == $c['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="flex: 1; min-width: 150px;">
                    <label><b>Mức giá:</b></label>
                    <select name="price" style="width: 100%; padding: 8px;">
                        <option value="">-- Tất cả --</option>
                        <option value="under_5" <?= $price_range == 'under_5' ? 'selected' : '' ?>>Dưới 5 triệu</option>
                        <option value="5_15" <?= $price_range == '5_15' ? 'selected' : '' ?>>Từ 5 - 15 triệu</option>
                        <option value="over_15" <?= $price_range == 'over_15' ? 'selected' : '' ?>>Trên 15 triệu</option>
                    </select>
                </div>

                <div style="flex: 1; min-width: 150px;">
                    <label><b>Sắp xếp:</b></label>
                    <select name="sort" style="width: 100%; padding: 8px;">
                        <option value="newest" <?= $sort == 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                        <option value="price_asc" <?= $sort == 'price_asc' ? 'selected' : '' ?>>Giá tăng dần</option>
                        <option value="price_desc" <?= $sort == 'price_desc' ? 'selected' : '' ?>>Giá giảm dần</option>
                    </select>
                </div>

                <button type="submit" class="cta-button" style="height: 40px; border: none; cursor: pointer;">LỌC & TÌM</button>
            </form>
        </div>

        <?php if(count($products) > 0): ?>
            <div class="grid" style="grid-template-columns: repeat(4, 1fr);">
                <?php foreach ($products as $row): ?>
                    <div class="product-card">
                        <a href="ProductDetail.php?id=<?= $row['id'] ?>">
                            <img src="<?= htmlspecialchars($row['image'] ?? 'img/no-image.jpg') ?>" alt="">
                        </a>
                        <p class="product-name"><?= htmlspecialchars($row['name']) ?></p>
                        
                        <div class="price-container">
                            <span class="product-price"><?= number_format($row['price'], 0, ',', '.') ?>đ</span>
                            <?php if ($row['old_price'] > 0): ?>
                                <br><del style="color:#999; font-size: 0.9rem;"><?= number_format($row['old_price'], 0, ',', '.') ?>đ</del>
                            <?php endif; ?>
                        </div>

                        <?php if($row['stock'] > 0): ?>
                            <small style="color: green;">✔ Còn hàng</small>
                        <?php else: ?>
                            <small style="color: red;">✖ Hết hàng</small>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; font-size: 1.2rem; color: #666;">Không tìm thấy sản phẩm nào phù hợp tiêu chí.</p>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>