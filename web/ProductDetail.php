<?php
session_start();
require_once 'includes/db.php';

// 1. LẤY SẢN PHẨM HIỆN TẠI
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php');
    exit;
}

// 2. LẤY SẢN PHẨM LIÊN QUAN (Cùng Category, trừ sản phẩm đang xem)
$sql_related = "SELECT * FROM products WHERE category_id = :cat_id AND id != :current_id ORDER BY RAND() LIMIT 4";
$stmt_related = $conn->prepare($sql_related);
$stmt_related->execute([
    'cat_id' => $product['category_id'],
    'current_id' => $id
]);
$related_products = $stmt_related->fetchAll();

$pageTitle = htmlspecialchars($product['name']);
include 'includes/header.php';
?>

<main>
    <section class="section product-detail">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px;">
                
                <div class="product-image">
                    <img src="<?= htmlspecialchars($product['image'] ?? 'img/no-image.jpg') ?>" 
                         style="width: 100%; border-radius: 10px; border: 1px solid #eee;">
                </div>

                <div class="product-info">
                    <h1 style="font-size: 2rem; margin-bottom: 10px;"><?= htmlspecialchars($product['name']) ?></h1>
                    
                    <div style="margin-bottom: 20px;">
                        <?php if ($product['stock'] > 0): ?>
                            <span style="background: #e1f7e1; color: #2ecc71; padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                                <i class="ri-check-circle-line"></i> Còn hàng (<?= $product['stock'] ?> sản phẩm)
                            </span>
                        <?php else: ?>
                            <span style="background: #fadbd8; color: #e74c3c; padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                                <i class="ri-close-circle-line"></i> Hết hàng
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="price-box" style="margin-bottom: 20px;">
                        <span style="font-size: 1.8rem; color: #e74c3c; font-weight: bold;">
                            <?= number_format($product['price'], 0, ',', '.') ?>đ
                        </span>
                        <?php if ($product['old_price'] > 0): ?>
                            <del style="color: #999; margin-left: 10px;">
                                <?= number_format($product['old_price'], 0, ',', '.') ?>đ
                            </del>
                        <?php endif; ?>
                    </div>

                    <p style="line-height: 1.6; color: #555; margin-bottom: 30px;">
                        <?= nl2br(htmlspecialchars($product['description'] ?? 'Đang cập nhật...')) ?>
                    </p>

                    <?php if ($product['stock'] > 0): ?>
                        <form action="cart_action.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                                <input type="number" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>" style="width: 60px; padding: 10px; text-align: center;">
                                <button type="submit" name="action" value="add" class="cta-button" style="border: none; cursor: pointer; flex: 1;">
                                    THÊM VÀO GIỎ
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <button disabled style="background: #ccc; color: #fff; padding: 15px; width: 100%; border: none; cursor: not-allowed;">
                            TẠM HẾT HÀNG
                        </button>
                    <?php endif; ?>

                    <div class="specs-table" style="margin-top: 30px; background: #f9f9f9; padding: 20px; border-radius: 8px;">
                        <h3 style="margin-bottom: 15px;">Thông số kỹ thuật</h3>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd; color: #666;">Màn hình:</td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;">OLED, 6.7", Super Retina XDR</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd; color: #666;">Chip:</td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Apple A17 Pro</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd; color: #666;">RAM:</td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;">8 GB</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd; color: #666;">Dung lượng:</td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;">256 GB</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; color: #666;">Pin, Sạc:</td>
                                <td style="padding: 10px;">4422 mAh, 20 W</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php if(count($related_products) > 0): ?>
    <section class="section" style="background: #f8f9fa; margin-top: 50px;">
        <div class="container">
            <h2 class="section-title">CÓ THỂ BẠN THÍCH</h2>
            <div class="grid" style="grid-template-columns: repeat(4, 1fr);">
                <?php foreach ($related_products as $row): ?>
                    <div class="product-card" style="background: #fff;">
                        <a href="ProductDetail.php?id=<?= $row['id'] ?>">
                            <img src="<?= htmlspecialchars($row['image'] ?? 'img/no-image.jpg') ?>" alt="">
                        </a>
                        <p class="product-name"><?= htmlspecialchars($row['name']) ?></p>
                        <p class="product-price"><?= number_format($row['price'], 0, ',', '.') ?>đ</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php include 'includes/footer.php'; ?>