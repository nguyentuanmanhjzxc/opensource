<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE KING - Cửa hàng điện thoại</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>

    <header class="main-header">
        <div class="container" >
            <a href="index.php" class="logo">THE KING</a>
            <nav>
                <a href="index.php">Trang chủ</a>
                <a href="sale.php" class="sale">Sale</a>
            </nav>
            <div class="header-icons">
                <div class="search-container">
                    <a href="#" id="search-icon">🔍Search</a>
                    <form action="#" class="search-form">
                        <input type="text" placeholder="🔍Tìm kiếm sản phẩm..." class="search-input">
                    </form>
                </div>

                <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <span>Chào, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</span>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">👤Login</a>
                <?php endif; ?>

                <a href="Giohang.php" class="cart-icon-container">
                    <span>👜</span>
                    <span class="cart-count">0</span>
                </a>
            </div>
    </header>

    <main>
         <section class="hero-banner">
            <div class="slider-wrapper">
                <!-- Slide 1 -->
                <div class="slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('img/13.jpg');">
                    <div class="slide-content">
                        <h1>BỘ SƯU TẬP IPHONE MỚI</h1>
                        <p>Trải nghiệm đỉnh cao công nghệ và thiết kế.</p>
                        <a href="phukien.php" class="cta-button">Mua ngay</a>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('img/27.jpg');">
                     <div class="slide-content">
                        <h1>SAMSUNG GALAXY S25 ULTRA</h1>
                        <p>Sức mạnh nhiếp ảnh trong tầm tay bạn.</p>
                        <a href="phukien.php" class="cta-button">Khám Phá</a>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('img/1.jpg');">
                     <div class="slide-content">
                        <h1>PHỤ KIỆN CHÍNH HÃNG</h1>
                        <p>Ưu đãi đến 30% khi mua kèm điện thoại.</p>
                        <a href="phukien.php" class="cta-button">Xem Phụ Kiện</a>
                    </div>
                </div>
            </div>
            <!-- Các nút điều hướng (chấm tròn) -->
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
                        <img src="img/16.jpg" alt="Điện Thoại Iphone">
                        <h3>Iphone</h3>
                    </div>
                    <div class="category-card" style="text-align: center;">
                        <img src="img/17.jpg" alt="Điện Thoại Xiaomi">
                        <h3>Xiaomi</h3>
                    </div>
                    <div class="category-card" style="text-align: center;">
                        <img src="img/18.jpg" alt="Điện Thoại SamSung">
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
                <h2 class="section-title">Sản Phẩm Bán Chạy Nhất</h2>
                <div class="grid">
                    <div class="product-card">
                        <a href="ProductDetail.php?id=1"><img  src="img/9.jpg" alt="Iphone 13"></a>
                        <p class="product-name">Iphone 13</p>
                        <p class="product-price">12.890.000đ</p>
                    </div>
                    <div class="product-card">
                        <a href="ProductDetail.php?id=2"><img  src="img/19.jpg" alt="Iphone 14"></a>
                        <p class="product-name">Iphone 14</p>
                        <p class="product-price">13.790.000đ</p>
                    </div>
                    <div class="product-card">
                        <a href="ProductDetail.php?id=3"><img  src="img/10.jpg" alt="Iphone 15"></a>
                        <p class="product-name">Iphone 15</p>
                        <p class="product-price">15.390.000</p>
                    </div>
                    <div class="product-card">
                        <a href="ProductDetail.php?id=4"><img  src="img/20.jpg" alt="SamSung S25"></a>
                        <p class="product-name">SamSung S25</p>
                        <p class="product-price">12.500.000đ</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mid-banner">
            <h2>GIẢM GIÁ 30% CHO TẤT CẢ PHỤ KIỆN</h2>
            <p>Sử dụng mã: <strong>MODERN30</strong> khi thanh toán</p>
            <a href="#" class="cta-button" style="background-color: #CDBEA7;">Xem ngay</a>
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

    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h4>VỀ THE KING</h4>
                    <ul>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Hệ thống cửa hàng</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                    </ul>
                </div>
                <div>
                    <h4>HỖ TRỢ KHÁCH HÀNG</h4>
                    <ul>
                        <li><a href="#">Câu hỏi thường gặp (FAQ)</a></li>
                        <li><a href="#">Chính sách vận chuyển</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Hướng dẫn chọn size</a></li>
                    </ul>
                </div>
                <div>
                    <h4>THÔNG TIN PHÁP LÝ</h4>
                    <ul>
                        <li><a href="#">Điều khoản dịch vụ</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                    </ul>
                </div>
                <div>
                    <h4>KẾT NỐI VỚI CHÚNG TÔI</h4>
                    <p>Email: contact@themodernist.vn</p>
                    <p>Hotline: 1900 1234</p>
                    </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 THE KING. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="js/index.js"></script>
</body>
</html>