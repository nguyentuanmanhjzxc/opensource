<?php
session_start();
// 1. KẾT NỐI CSDL
require_once 'includes/db.php';

// 2. LẤY DỮ LIỆU SẢN PHẨM MỚI NHẤT (Hoặc bán chạy)
// Lấy 4 sản phẩm để hiển thị, sắp xếp theo ID giảm dần (mới nhất lên đầu)
try {
    $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 4");
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch (Exception $e) {
    echo "Lỗi truy vấn: " . $e->getMessage();
}

// Đặt tiêu đề riêng cho trang này TRƯỚC khi gọi header
$pageTitle = "THE KING - Trang Chủ";
include 'includes/header.php'; 
?>

    <main>
        <section class="hero-banner">
            <div class="slider-wrapper">
                <div class="slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('img/13.jpg');">
                    <div class="slide-content">
                        <h1>BỘ SƯU TẬP IPHONE MỚI</h1>
                        <p>Trải nghiệm đỉnh cao công nghệ và thiết kế.</p>
                        <a href="iphone.php" class="cta-button">Mua ngay</a>
                    </div>
                </div>
                <div class="slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('img/27.jpg');">
                     <div class="slide-content">
                        <h1>SAMSUNG GALAXY S25 ULTRA</h1>
                        <p>Sức mạnh nhiếp ảnh trong tầm tay bạn.</p>
                        <a href="samsung.php" class="cta-button">Khám Phá</a>
                    </div>
                </div>
                <div class="slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('img/1.jpg');">
                     <div class="slide-content">
                        <h1>PHỤ KIỆN CHÍNH HÃNG</h1>
                        <p>Ưu đãi đến 30% khi mua kèm điện thoại.</p>
                        <a href="phukien.php" class="cta-button">Xem Phụ Kiện</a>
                    </div>
                </div>
            </div>
            <div class="slider-dots">
                <span class="dot active" data-slide="0"></span>
                <span class="dot" data-slide="1"></span>
                <span class="dot" data-slide="2"></span>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="grid" style="grid-template-columns: repeat(4, 1fr);">
                    <div class="category-card" style="text-align: center;">
                        <a href="iphone.php"><img src="img/16.jpg" alt="Điện Thoại Iphone"></a>
                        <h3>Iphone</h3>
                    </div>
                    <div class="category-card" style="text-align: center;">
                        <a href="xiaomi.php"><img src="img/17.jpg" alt="Điện Thoại Xiaomi"></a>
                        <h3>Xiaomi</h3>
                    </div>
                    <div class="category-card" style="text-align: center;">
                        <a href="samsung.php"><img src="img/18.jpg" alt="Điện Thoại SamSung"></a>
                        <h3>SamSung</h3>
                    </div>
                    <div class="category-card" style="text-align: center;">
                        <a href="phukien.php"><img src="img/14.jpg" alt="Phụ Kiện"></a>
                        <h3>Phụ Kiện</h3>
                    </div>
                </div>
            </div>
        </section>
        
        <hr>

        <section class="section" >
            <div class="container">
                <h2 class="section-title">Sản Phẩm Mới Về</h2>
                
                <div class="grid">
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $row): ?>
                            <div class="product-card">
                                <a href="ProductDetail.php?id=<?= $row['id'] ?>">
                                    <img src="<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                                </a>
                                
                                <p class="product-name"><?= htmlspecialchars($row['name']) ?></p>
                                
                                <p class="product-price"><?= number_format($row['price'], 0, ',', '.') ?>đ</p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Chưa có sản phẩm nào.</p>
                    <?php endif; ?>
                </div>
                </div>
        </section>

        <section class="mid-banner">
            <h2>GIẢM GIÁ 30% CHO TẤT CẢ PHỤ KIỆN</h2>
            <p>Sử dụng mã: <strong>MODERN30</strong> khi thanh toán</p>
            <a href="sale.php" class="cta-button" style="background-color: #CDBEA7;">Xem ngay</a>
        </section>

        <section class="trust-badges">
            <div class="container" style="display: flex; justify-content: space-around;">
                <div>
                    <strong>🚚 Giao hàng miễn phí</strong>
                    <p>Cho đơn hàng từ 500.000đ</p>
                </div>
                <div>
                    <strong>🔄 Đổi trả dễ dàng</strong>
                    <p>Trong vòng 30 ngày</p>
                </div>
                <div>
                    <strong>💳 Thanh toán bảo mật</strong>
                    <p>100% an toàn</p>
                </div>
                <div>
                    <strong>📞 Hỗ trợ 24/7</strong>
                    <p>Luôn sẵn sàng giúp đỡ</p>
                </div>
            </div>
        </section>

        <section class="section newsletter">
            <div class="container">
                <h2 class="section-title">Nhận Ưu Đãi Độc Quyền!</h2>
                <p>Đăng ký để nhận thông tin về sản phẩm mới và khuyến mãi đặc biệt.</p>
                <form style="margin-top: 20px;">
                    <input type="email" placeholder="Nhập địa chỉ email của bạn" style="padding: 15px; width: 300px; border: 1px solid #ccc;">
                    <button type="submit" class="cta-button" style="border: none; cursor: pointer;">Đăng ký</button>
                </form>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

<script src="js/category-filter.js"></script>
<script src="js/index.js"></script>
</body>
</html>