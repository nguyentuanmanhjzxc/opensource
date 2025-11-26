<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "THE KING - Giỏ hàng";
include 'includes/header.php'; 
?>

    <main>
        <section class="section">
            <div class="container cart-container">
                <h2 class="section-title">Giỏ Hàng Của Bạn</h2>
                
                <div id="cart-items-container">
                    </div>

                <div class="cart-summary" id="cart-summary-box">
                    <h3>Tổng Cộng</h3>
                    <div class="summary-row">
                        <span>Tạm tính:</span>
                        <span id="subtotal-price">0đ</span>
                    </div>
                     <div class="summary-row">
                        <span>Phí vận chuyển:</span>
                        <span>Miễn phí</span>
                    </div>
                     <div class="summary-row total-row">
                        <span>Thành tiền:</span>
                        <span id="total-price">0đ</span>
                    </div>
                    <button class="cta-button checkout-btn">Tiến hành thanh toán</button>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.body.classList.add('cart-page');
    </script>

<?php include 'includes/footer.php'; ?>

    <script src="js/index.js" defer></script> 
</body>
</html>