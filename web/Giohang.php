<?php
session_start();
require_once 'includes/db.php';

$pageTitle = "THE KING - Giỏ hàng của bạn";
include 'includes/header.php';

// Lấy danh sách ID sản phẩm trong giỏ hàng
$cart = $_SESSION['cart'] ?? [];
$product_ids = array_keys($cart);
$cart_items = [];
$total_price = 0;

if (!empty($product_ids)) {
    // Tạo chuỗi placeholder cho query IN (?,?,?)
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    
    // Truy vấn thông tin các sản phẩm có trong giỏ
    $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($product_ids);
    $products_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Tính toán tổng tiền và sắp xếp dữ liệu
    foreach ($products_db as $prod) {
        $id = $prod['id'];
        $qty = $cart[$id];
        $subtotal = $prod['price'] * $qty;
        $total_price += $subtotal;

        // Gán thêm thông tin số lượng và thành tiền vào mảng sản phẩm
        $prod['qty'] = $qty;
        $prod['subtotal'] = $subtotal;
        $cart_items[] = $prod;
    }
}
?>

<main>
    <section class="section">
        <div class="container cart-container">
            <h2 class="section-title">Giỏ Hàng Của Bạn</h2>
            
            <?php if (empty($cart_items)): ?>
                <div style="text-align: center; padding: 50px;">
                    <p>Giỏ hàng của bạn đang trống.</p>
                    <a href="index.php" class="cta-button">Tiếp tục mua sắm</a>
                </div>
            <?php else: ?>
                
                <form action="cart_action.php?action=update" method="POST">
                    <div class="cart-table-wrapper">
                        <table class="cart-table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <thead>
                                <tr style="border-bottom: 2px solid #ddd; text-align: left;">
                                    <th style="padding: 10px;">Sản phẩm</th>
                                    <th style="padding: 10px;">Giá</th>
                                    <th style="padding: 10px;">Số lượng</th>
                                    <th style="padding: 10px;">Tạm tính</th>
                                    <th style="padding: 10px;">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart_items as $item): ?>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <td style="padding: 15px; display: flex; align-items: center; gap: 15px;">
                                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                            <div>
                                                <strong><?= htmlspecialchars($item['name']) ?></strong>
                                            </div>
                                        </td>
                                        <td style="padding: 10px;"><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                                        <td style="padding: 10px;">
                                            <input type="number" name="qty[<?= $item['id'] ?>]" value="<?= $item['qty'] ?>" min="1" style="width: 50px; padding: 5px;">
                                        </td>
                                        <td style="padding: 10px; color: #c0392b; font-weight: bold;">
                                            <?= number_format($item['subtotal'], 0, ',', '.') ?>đ
                                        </td>
                                        <td style="padding: 10px;">
                                            <a href="cart_action.php?action=delete&id=<?= $item['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')" style="color: red; text-decoration: none;">🗑️</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <div style="text-align: right; margin-bottom: 20px;">
                            <button type="submit" class="cta-button" style="background-color: #7f8c8d;">Cập nhật giỏ hàng</button>
                        </div>
                    </div>
                </form>

                <div class="cart-summary" id="cart-summary-box">
                    <h3>Tổng Cộng</h3>
                    <div class="summary-row">
                        <span>Tổng tiền hàng:</span>
                        <span id="subtotal-price" style="font-weight: bold; font-size: 1.2rem; color: #c0392b;">
                            <?= number_format($total_price, 0, ',', '.') ?>đ
                        </span>
                    </div>
                    <?php if(isset($_SESSION['user_id'])): ?>
                         <a href="checkout.php" class="cta-button checkout-btn" style="display: block; text-align: center; text-decoration: none;">Tiến hành thanh toán</a>
                    <?php else: ?>
                         <a href="login.php" class="cta-button checkout-btn" style="display: block; text-align: center; text-decoration: none;">Đăng nhập để thanh toán</a>
                    <?php endif; ?>
                </div>

            <?php endif; ?>
        </div>
    </section>
</main>

<script>
    document.body.classList.add('cart-page');
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>