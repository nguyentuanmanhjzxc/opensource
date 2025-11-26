<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$pageTitle = "Chi Tiết Sản Phẩm - THE KING";
include 'includes/header.php'; 
?>

    <main>
        <div class="breadcrumb-section">
            <div class="container">
                <a href="index.php">Trang chủ</a> / <span id="breadcrumb-current">Chi tiết sản phẩm</span>
            </div>
        </div>

        <section class="section product-detail-section">
            <div class="container product-detail-container">
                
                <div class="product-gallery">
                    <div class="main-image-frame">
                        <img src="" alt="Đang tải..." id="product-image">
                    </div>
                </div>

                <div class="product-info-col">
                    <h1 id="product-name" class="detail-title">Đang tải tên sản phẩm...</h1>
                    
                    <div class="price-wrapper">
                        <span class="product-price" id="product-price">...</span>
                        </div>
                    
                    <div class="divider"></div>

                    <div class="product-description-box">
                        <h4>Đặc điểm nổi bật</h4>
                        <p id="product-description">Đang tải mô tả...</p>
                    </div>

                    <div class="purchase-actions">
                        <div class="quantity-wrapper">
                            <label for="quantity">Số lượng:</label>
                            <input type="number" id="quantity" value="1" min="1" class="qty-input">
                        </div>
                        
                        <button id="add-to-cart-btn" class="cta-button btn-add-cart">
                            <span>🛒 Thêm vào giỏ hàng</span>
                        </button>
                    </div>

                    <div class="product-policies">
                        <div class="policy-item">
                            <span class="policy-icon">🛡️</span>
                            <div class="policy-text">
                                <strong>Bảo hành chính hãng</strong>
                                <p>12 tháng tại trung tâm ủy quyền</p>
                            </div>
                        </div>
                        <div class="policy-item">
                            <span class="policy-icon">🔄</span>
                            <div class="policy-text">
                                <strong>Đổi trả miễn phí</strong>
                                <p>Trong vòng 30 ngày nếu lỗi</p>
                            </div>
                        </div>
                        <div class="policy-item">
                            <span class="policy-icon">🚚</span>
                            <div class="policy-text">
                                <strong>Giao hàng toàn quốc</strong>
                                <p>Nhận hàng trong 2-3 ngày</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script>
        document.body.classList.add('product-detail-page');

        const observer = new MutationObserver(function(mutations) {
            const name = document.getElementById('product-name').textContent;
            if(name && name !== 'Đang tải tên sản phẩm...') {
                document.getElementById('breadcrumb-current').textContent = name;
            }
        });
        observer.observe(document.getElementById('product-name'), { childList: true });
    </script>

<?php include 'includes/footer.php'; ?>
    
    <script src="js/index.js" defer></script> 
</body>
</html>