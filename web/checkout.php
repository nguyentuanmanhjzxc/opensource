<?php
session_start();
require_once 'includes/db.php';

// 1. Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Vui lòng đăng nhập để thanh toán!";
    header('Location: login.php');
    exit;
}

// 2. Kiểm tra giỏ hàng có trống không
if (empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

// 3. Lấy thông tin user để điền sẵn vào form
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

// 4. Lấy thông tin sản phẩm trong giỏ để tính tiền
$cart = $_SESSION['cart'];
$ids = array_keys($cart);
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
$stmt->execute($ids);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_money = 0;
?>

<?php $pageTitle = "Thanh Toán - THE KING"; include 'includes/header.php'; ?>

<main>
    <section class="section">
        <div class="container">
            <h2 class="section-title">Thanh Toán</h2>
            
            <form action="xuly_checkout.php" method="POST" class="checkout-form">
                <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px;">
                    
                    <div>
                        <h3 style="margin-bottom: 15px;">Thông tin giao hàng</h3>
                        
                        <div class="input-group">
                            <label>Họ và tên người nhận (*)</label>
                            <input type="text" name="fullname" value="<?= htmlspecialchars($user['full_name']) ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
                        </div>

                        <div class="input-group">
                            <label>Số điện thoại (*)</label>
                            <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
                        </div>

                        <div class="input-group">
                            <label>Địa chỉ giao hàng (*)</label>
                            <textarea name="address" rows="3" required style="width: 100%; padding: 10px; margin-bottom: 15px;"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                        </div>

                        <div class="input-group">
                            <label>Ghi chú đơn hàng (Tùy chọn)</label>
                            <textarea name="note" rows="2" style="width: 100%; padding: 10px; margin-bottom: 15px;"></textarea>
                        </div>

                        <div class="input-group">
                            <label>Phương thức thanh toán</label>
                            <select name="payment_method" style="width: 100%; padding: 10px;">
                                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                <option value="banking">Chuyển khoản ngân hàng (QR Code)</option>
                            </select>
                        </div>
                    </div>

                    <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; height: fit-content;">
                        <h3 style="margin-bottom: 15px;">Đơn hàng của bạn</h3>
                        
                        <div class="order-summary-list" style="margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                            <?php foreach ($products as $p): ?>
                                <?php 
                                    $qty = $cart[$p['id']];
                                    $subtotal = $p['price'] * $qty;
                                    $total_money += $subtotal;
                                ?>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <div>
                                        <strong><?= htmlspecialchars($p['name']) ?></strong>
                                        <br><small>x<?= $qty ?></small>
                                    </div>
                                    <span><?= number_format($subtotal, 0, ',', '.') ?>đ</span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: bold; margin-bottom: 20px;">
                            <span>Tổng cộng:</span>
                            <span style="color: #e74c3c;"><?= number_format($total_money, 0, ',', '.') ?>đ</span>
                        </div>

                        <button type="submit" class="cta-button" style="width: 100%; border: none; cursor: pointer;">ĐẶT HÀNG NGAY</button>
                        <p style="text-align: center; margin-top: 10px; font-size: 12px; color: #666;">Cam kết bảo mật thông tin</p>
                    </div>

                </div>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>