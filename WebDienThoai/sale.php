<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
// Đặt tiêu đề riêng cho trang này TRƯỚC khi gọi header
$pageTitle = "THE KING - Điện thoại iPhone";
include 'includes/header.php'; 
?>
    <main>
        <section class="section">
            <div class="container">
                <h2 class="section-title">Sản Phẩm Khuyến Mãi</h2>
                <div class="grid" style="grid-template-columns: repeat(3, 1fr);">
                    <!-- Product 1 -->
                    <div class="product-card">
                        <div class="sale-badge">Sale</div>
                        <img class="product-sale" src="img/9.jpg" alt="Iphone 13">
                        <p class="product-name">Iphone 13</p>
                        <div class="price-container">
                            <span class="original-price">12.890.000đ</span>
                            <span class="sale-price">11.500.000đ</span>
                        </div>
                    </div>
                    <!-- Product 2 -->
                    <div class="product-card">
                        <div class="sale-badge">Sale</div>
                        <img class="product-sale" src="img/19.jpg" alt="Iphone 14">
                        <p class="product-name">Iphone 14</p>
                        <div class="price-container">
                            <span class="original-price">13.790.000đ</span>
                            <span class="sale-price">12.990.000đ</span>
                        </div>
                    </div>
                    <!-- Product 3 -->
                    <div class="product-card">
                        <div class="sale-badge">Sale</div>
                        <img class="product-sale" src="img/10.jpg" alt="Iphone 15">
                        <p class="product-name">Iphone 15</p>
                        <div class="price-container">
                            <span class="original-price">15.390.000đ</span>
                            <span class="sale-price">14.500.000đ</span>
                        </div>
                    </div>
                    <!-- Product 4 -->
                    <div class="product-card">
                        <div class="sale-badge">Sale</div>
                        <img class="product-sale" src="img/20.jpg" alt="SamSung S25">
                        <p class="product-name">SamSung S25</p>
                        <div class="price-container">
                            <span class="original-price">12.500.000đ</span>
                            <span class="sale-price">11.800.000đ</span>
                        </div>
                    </div>
                    <!-- Product 5 -->
                    <div class="product-card">
                        <div class="sale-badge">Sale</div>
                        <img class="product-sale" src="img/17.jpg" alt="Xiaomi 14 Pro">
                        <p class="product-name">Xiaomi 14 Pro</p>
                        <div class="price-container">
                            <span class="original-price">10.000.000đ</span>
                            <span class="sale-price">8.990.000đ</span>
                        </div>
                    </div>
                    <!-- Product 6 -->
                    <div class="product-card">
                        <div class="sale-badge">Sale</div>
                        <img class="product-sale" src="img/14.jpg" alt="Airpods Pro">
                        <p class="product-name">Airpods Pro</p>
                         <div class="price-container">
                            <span class="original-price">5.000.000đ</span>
                            <span class="sale-price">4.200.000đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    
</body>
</html>
