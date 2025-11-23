<?php
// Đặt tiêu đề riêng cho trang này TRƯỚC khi gọi header
$pageTitle = "THE KING - Điện thoại iPhone";
include 'includes/header.php'; 
?>

    <main>
        <section class="section">
            <div class="container">
                <h2 class="section-title">ĐIỆN THOẠI IPHONE</h2>

                <div class="filter-bar">
                    <div class="filter-options">
                        <span>Dòng máy:</span>
                        <select id="category-filter" name="category">
                            <option value="all">Tất cả</option>
                            <option value="iphone15">iPhone 15 Series</option>
                            <option value="iphone14">iPhone 14 Series</option>
                            <option value="iphone13">iPhone 13 Series</option>
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
                    
                    <div class="product-card" data-category="iphone13" data-price="12890000">
                        <a href="ProductDetail.php?id=1">
                            <img src="img/9.jpg" alt="Iphone 13">
                        </a>
                        <p class="product-name">Iphone 13 128GB</p>
                        <p class="product-price">12.890.000đ</p>
                    </div>

                    <div class="product-card" data-category="iphone14" data-price="13790000">
                        <div class="sale-badge">Hot</div>
                        <a href="ProductDetail.php?id=2">
                            <img src="img/19.jpg" alt="Iphone 14 Pro">
                        </a>
                        <p class="product-name">Iphone 14 Pro</p>
                        <div class="price-container">
                             <span class="product-price">13.790.000đ</span>
                        </div>
                    </div>

                    <div class="product-card" data-category="iphone15" data-price="15390000">
                        <a href="ProductDetail.php?id=3">
                            <img src="img/10.jpg" alt="Iphone 15">
                        </a>
                        <p class="product-name">Iphone 15 Chính Hãng</p>
                        <p class="product-price">15.390.000đ</p>
                    </div>

                    </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

<script src="js/category-filter.js"></script>
<script src="js/index.js"></script>