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
    <title>THE KING - Phụ Kiện</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="main-header">
        <div class="container">
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
        </div>
    </header>

    <main>
        <section class="section">
            <div class="container">
                <h2 class="section-title">PHỤ KIỆN</h2>

                <div class="filter-bar">
                    <div class="filter-options">
                        <span>Lọc theo:</span>
                        <select id="category-filter" name="category">
                            <option value="all">Tất cả</option>
                            <option value="tainghe">Tai Nghe</option>
                            <option value="oplung">Ốp Lưng</option>
                            <option value="daysac">Dây Sạc</option>
                        </select>
                    </div>
                    <div class="sort-options">
                        <span>Sắp xếp:</span>
                        <select id="sort-filter" name="sorting">
                            <option value="default">Mặc định</option>
                            <option value="price-asc">Giá tăng dần</option>
                            <option value="price-desc">Giá giảm dần</option>
                        </select>
                    </div>
                </div>

                <div id="product-grid" class="grid" style="grid-template-columns: repeat(3, 1fr);">
                    <div class="product-card" data-category="tainghe" data-price="6790000">
                        <img src="img/11.jpg" alt="Airpods Pro 3">
                        <p class="product-name">Airpods Pro 3</p>
                        <p class="product-price">6.790.000đ</p>
                    </div>
                    <div class="product-card" data-category="tainghe" data-price="12990000">
                        <div class="sale-badge">Sale</div>
                        <img src="img/12.jpg" alt="AirPods Max cổng USB C">
                        <p class="product-name">AirPods Max USB C</p>
                        <div class="price-container">
                            <span class="original-price">13.790.000đ</span>
                            <span class="sale-price">12.990.000đ</span>
                        </div>
                    </div>
                    <div class="product-card" data-category="tainghe" data-price="3190000">
                        <img src="img/14.jpg" alt="Airpods 4">
                        <p class="product-name">Airpods 4</p>
                        <p class="product-price">3.190.000đ</p>
                    </div>
                    <div class="product-card" data-category="oplung" data-price="550000">
                        <img src="img/21.jpg" alt="Ốp lưng MagSafe JINYA">
                        <p class="product-name">Ốp lưng MagSafe JINYA</p>
                        <p class="product-price">550.000đ</p>
                    </div>
                    <div class="product-card" data-category="oplung" data-price="738000">
                        <div class="sale-badge">Sale</div>
                        <img src="img/22.jpg" alt="Ốp lưng Nylon">
                        <p class="product-name">Ốp lưng Nylon PC TPU </p>
                        <div class="price-container">
                            <span class="original-price">820.000đ</span>
                            <span class="sale-price">738.000đ</span>
                        </div>
                    </div>
                    <div class="product-card" data-category="oplung" data-price="1071000">
                        <img src="img/23.jpg" alt="Ốp lưng MagSafe">
                        <p class="product-name">Ốp lưng MagSafe</p>
                        <p class="product-price">1.071.000đ</p>
                    </div>
                     <div class="product-card" data-category="daysac" data-price="1290000">
                        <img src="img/24.jpg" alt="Bộ Adapter Sạc 4 cổng">
                        <p class="product-name">Bộ Adapter Sạc 4 cổng</p>
                        <p class="product-price">1.290.000đ</p>
                    </div>
                     <div class="product-card" data-category="daysac" data-price="990000">
                        <img src="img/25.jpg" alt="Adapter Sạc đa năng">
                        <p class="product-name">Adapter Sạc đa năng</p>
                        <p class="product-price">990.000đ</p>
                    </div>
                     <div class="product-card" data-category="daysac" data-price="200000">
                        <div class="sale-badge">Sale</div>
                        <img src="img/26.jpg" alt="Cáp Type C">
                        <p class="product-name">Cáp Type C</p>
                        <div class="price-container">
                            <span class="original-price">220.000đ</span>
                            <span class="sale-price">200.000đ</span>
                        </div>
                    </div>
                </div>
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
    
    <script src="js/phukien.js"></script>
</body>
</html>