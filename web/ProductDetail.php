<?php
session_start();
// 1. KẾT NỐI CSDL
require_once 'includes/db.php';

// 2. LẤY ID SẢN PHẨM TỪ URL
// Kiểm tra xem có id không, nếu không có thì gán mặc định = 0
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. TRUY VẤN DỮ LIỆU TỪ DATABASE
// Dùng prepare statement để chống SQL Injection
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

// Nếu không tìm thấy sản phẩm trong DB -> Chuyển hướng về trang chủ
if (!$product) {
    echo "<script>alert('Sản phẩm không tồn tại!'); window.location.href='index.php';</script>";
    exit;
}

// 4. CẤU HÌNH SEO CƠ BẢN
$pageTitle = htmlspecialchars($product['name']) . " - THE KING";
include 'includes/header.php'; 
?>

<main>
    <div class="breadcrumb-section">
        <div class="container">
            <a href="index.php">Trang chủ</a> / <span id="breadcrumb-current"><?= htmlspecialchars($product['name']) ?></span>
        </div>
    </div>

    <section class="section product-detail-section">
        <div class="container product-detail-container">
            
            <div class="product-gallery">
                <div class="main-image-frame">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" id="product-image">
                </div>
            </div>

            <div class="product-info-col">
                <h1 id="product-name" class="detail-title"><?= htmlspecialchars($product['name']) ?></h1>
                
                <div class="price-wrapper">
                    <span class="product-price" id="product-price">
                        <?= number_format($product['price'], 0, ',', '.') ?>đ
                    </span>
                    
                    <?php if ($product['old_price'] > 0 && $product['old_price'] > $product['price']): ?>
                        <span class="original-price" style="text-decoration: line-through; color: #888; margin-left: 10px; font-size: 1.1rem;">
                            <?= number_format($product['old_price'], 0, ',', '.') ?>đ
                        </span>
                        <?php 
                            // Tính % giảm giá
                            $discount = round((($product['old_price'] - $product['price']) / $product['old_price']) * 100);
                        ?>
                        <span class="badge-discount" style="background: #e74c3c; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 0.9rem; margin-left: 10px;">
                            -<?= $discount ?>%
                        </span>
                    <?php endif; ?>
                </div>

                <div class="stock-status" style="margin-top: 15px; margin-bottom: 15px;">
                    <?php if ($product['stock'] > 0): ?>
                        <span style="color: #27ae60; font-weight: bold; font-size: 1.1rem;">
                            <i class="ri-check-circle-line"></i> Còn hàng
                        </span>
                    <?php else: ?>
                        <span style="color: #e74c3c; font-weight: bold; font-size: 1.1rem;">
                            <i class="ri-close-circle-line"></i> Hết hàng
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="divider"></div>

                <div class="product-description-box">
                    <h4>Đặc điểm nổi bật</h4>
                    <div style="line-height: 1.6; color: #555;">
                        <?php 
                            // Nếu có mô tả thì hiển thị, xuống dòng bằng nl2br
                            if (!empty($product['description'])) {
                                echo nl2br(htmlspecialchars($product['description']));
                            } else {
                                echo "Đang cập nhật thông tin chi tiết sản phẩm...";
                            }
                        ?>
                    </div>
                </div>

                <?php if ($product['stock'] > 0): ?>
                    <form action="cart_action.php?action=add&id=<?= $product['id'] ?>" method="POST">
                        <div class="purchase-actions">
                            <div class="quantity-wrapper">
                                <label for="quantity">Số lượng:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>" class="qty-input">
                            </div>
                            
                            <button type="submit" class="cta-button btn-add-cart" style="border: none; cursor: pointer;">
                                <span>🛒 Thêm vào giỏ hàng</span>
                            </button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="purchase-actions">
                        <button class="cta-button" style="background: #95a5a6; cursor: not-allowed;" disabled>
                            Tạm hết hàng
                        </button>
                    </div>
                <?php endif; ?>

                <div class="product-policies">
                    <div class="policy-item">
                        <span class="policy-icon">🛡️</span>
                        <div class="policy-text">
                            <strong>Bảo hành chính hãng</strong>
                            <p>12 tháng tại trung tâm ủy quyền</p>
                        </div>
                    </div>
                    <div class="policy-item">
                        <span class="policy-icon">🔄</span>
                        <div class="policy-text">
                            <strong>Đổi trả miễn phí</strong>
                            <p>Trong vòng 30 ngày nếu lỗi</p>
                        </div>
                    </div>
                    <div class="policy-item">
                        <span class="policy-icon">🚚</span>
                        <div class="policy-text">
                            <strong>Giao hàng toàn quốc</strong>
                            <p>Nhận hàng trong 2-3 ngày</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php
        // Lấy 4 sản phẩm cùng category (trừ sản phẩm đang xem)
        $cat_id = $product['category_id'];
        $stmt_rel = $conn->prepare("SELECT * FROM products WHERE category_id = ? AND id != ? LIMIT 4");
        $stmt_rel->execute([$cat_id, $id]);
        $related_products = $stmt_rel->fetchAll();
    ?>
    
    <?php if (count($related_products) > 0): ?>
    <section class="section">
        <div class="container">
            <h3 class="section-title">Sản Phẩm Tương Tự</h3>
            <div class="grid" style="grid-template-columns: repeat(4, 1fr);">
                <?php foreach ($related_products as $rel): ?>
                    <div class="product-card">
                        <a href="ProductDetail.php?id=<?= $rel['id'] ?>">
                            <img src="<?= htmlspecialchars($rel['image']) ?>" alt="<?= htmlspecialchars($rel['name']) ?>">
                        </a>
                        <p class="product-name"><?= htmlspecialchars($rel['name']) ?></p>
                        <p class="product-price"><?= number_format($rel['price'], 0, ',', '.') ?>đ</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<script>
    // Thêm class vào body để CSS (nếu cần)
    document.body.classList.add('product-detail-page');
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>