<?php
// Đặt tiêu đề riêng cho trang này TRƯỚC khi gọi header
$pageTitle = "THE KING - Điện thoại iPhone";
include 'includes/header.php'; 
?>
    <main>
        <section class="section">
            <div class="container">
                <h2 class="section-title">ĐIỆN THOẠI SAMSUNG</h2>

                <div class="filter-bar">
                    <div class="filter-options">
                        <span>Dòng máy:</span>
                        <select id="category-filter" name="category">
                            <option value="all">Tất cả</option>
                            <option value="s_series">Galaxy S Series</option>
                            <option value="a_series">Galaxy A Series</option>
                            <option value="z_series">Galaxy Z (Gập)</option>
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
                    
                    <div class="product-card" data-category="s_series" data-price="12500000">
                        <a href="ProductDetail.php?id=4">
                            <img src="img/20.jpg" alt="Samsung S25">
                        </a>
                        <p class="product-name">Samsung Galaxy S25 Ultra</p>
                        <p class="product-price">12.500.000đ</p>
                    </div>

                     <div class="product-card" data-category="z_series" data-price="19000000">
                        
                        <a href="ProductDetail.php?id=18">
                            <img src="img/18.jpg" alt="Samsung Z Flip">
                        </a>
                        <p class="product-name">Samsung Galaxy Z Flip 5</p>
                        <p class="product-price">19.000.000đ</p>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

<script src="js/category-filter.js"></script>
<script src="js/index.js"></script>