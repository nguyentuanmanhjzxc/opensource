<?php
session_start();
require_once 'includes/db.php';

try {
    // Logic: Lấy sản phẩm có giá cũ (old_price > 0) và giá cũ lớn hơn giá mới
    $sql = "SELECT * FROM products WHERE old_price IS NOT NULL AND old_price > price ORDER BY id DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll();
    
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}

$pageTitle = "Sản Phẩm Khuyến Mãi - THE KING";
include 'includes/header.php'; 
?>
    <main>
        <section class="section">
            <div class="container">
                <h2 class="section-title">🔥 SĂN SALE GIÁ SỐC 🔥</h2>
                
                <?php if (count($products) > 0): ?>
                    <div class="grid" style="grid-template-columns: repeat(3, 1fr);">
                        <?php foreach ($products as $row): ?>
                            <?php 
                                // Tính phần trăm giảm giá
                                $discount = 0;
                                if ($row['old_price'] > 0) {
                                    $discount = round((($row['old_price'] - $row['price']) / $row['old_price']) * 100);
                                }
                            ?>
                            <div class="product-card">
                                <div class="sale-badge" style="background-color: #e74c3c;">-<?= $discount ?>%</div>
                                
                                <a href="ProductDetail.php?id=<?= $row['id'] ?>">
                                    <img class="product-sale" src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                                </a>
                                
                                <p class="product-name"><?= htmlspecialchars($row['name']) ?></p>
                                
                                <div class="price-container">
                                    <span class="original-price" style="text-decoration: line-through; color: #999;">
                                        <?= number_format($row['old_price'], 0, ',', '.') ?>đ
                                    </span>
                                    <span class="sale-price" style="color: #c0392b; font-weight: bold; font-size: 1.1rem; margin-left: 10px;">
                                        <?= number_format($row['price'], 0, ',', '.') ?>đ
                                    </span>
                                </div>
                                
                                <div style="margin-top: 15px; text-align: center;">
                                    <a href="ProductDetail.php?id=<?= $row['id'] ?>" class="cta-button" style="padding: 8px 20px; font-size: 0.9rem;">Xem Ngay</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; padding: 50px;">
                        <p>Hiện chưa có chương trình khuyến mãi nào.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
</body>
</html>