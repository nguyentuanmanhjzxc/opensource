<?php
session_start();
$pageTitle = "Đặt Hàng Thành Công - THE KING";
include 'includes/header.php';

$order_id = isset($_GET['id']) ? $_GET['id'] : 0;
?>

<main>
    <section class="section">
        <div class="container" style="text-align: center; padding: 50px 0;">
            
            <div style="font-size: 80px; color: #2ecc71; margin-bottom: 20px;">
                <i class="ri-checkbox-circle-fill"></i>
            </div>
            
            <h1 style="margin-bottom: 10px;">ĐẶT HÀNG THÀNH CÔNG!</h1>
            <p style="font-size: 1.1rem; color: #555;">Cảm ơn bạn đã mua sắm tại THE KING.</p>
            
            <?php if($order_id > 0): ?>
                <div style="margin: 30px 0; background: #f9f9f9; display: inline-block; padding: 20px 40px; border-radius: 8px;">
                    <p>Mã đơn hàng của bạn là:</p>
                    <strong style="font-size: 2rem; color: #333;">#<?= htmlspecialchars($order_id) ?></strong>
                    <p style="font-size: 0.9rem; margin-top: 5px;">(Vui lòng ghi nhớ mã này để tra cứu)</p>
                </div>
            <?php endif; ?>

            <div style="margin-top: 20px;">
                <a href="index.php" class="cta-button" style="text-decoration: none; margin-right: 10px;">Tiếp tục mua sắm</a>
                </div>

        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>