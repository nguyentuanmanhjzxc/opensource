document.addEventListener('DOMContentLoaded', function() {
    
    // ===================================
    // DATABASE SẢN PHẨM (GIẢ LẬP)
    // ===================================
    const allProducts = {
        // --- ĐIỆN THOẠI ---
        1: { id: 1, name: 'Iphone 13', price: 12890000, image: 'img/9.jpg', description: 'Hiệu năng mạnh mẽ với chip A15 Bionic, màn hình Super Retina XDR sắc nét.' },
        2: { id: 2, name: 'Iphone 14 Pro', price: 13790000, image: 'img/19.jpg', description: 'Trải nghiệm Dynamic Island độc đáo, camera chính 48MP đột phá.' },
        3: { id: 3, name: 'Iphone 15', price: 15390000, image: 'img/10.jpg', description: 'Thiết kế bo tròn mềm mại, cổng sạc USB-C tiện lợi.' },
        4: { id: 4, name: 'Samsung S25 Ultra', price: 12500000, image: 'img/20.jpg', description: 'Vua nhiếp ảnh di động với hệ thống camera zoom quang học ấn tượng.' },
        18: { id: 18, name: 'Samsung Z Flip', price: 12500000, image: 'img/18.jpg', description: 'Vua nhiếp ảnh di động với hệ thống camera zoom quang học ấn tượng.' },
        
        // --- PHỤ KIỆN (Tai nghe) ---
        11: { id: 11, name: 'Airpods Pro 3', price: 6790000, image: 'img/11.jpg', description: 'Chất âm đỉnh cao, chống ồn chủ động.' },
        12: { id: 12, name: 'AirPods Max USB C', price: 12990000, image: 'img/12.jpg', description: 'Âm thanh không gian sống động, thiết kế sang trọng.' },
        14: { id: 14, name: 'Airpods 4', price: 3190000, image: 'img/14.jpg', description: 'Thiết kế open-ear thoải mái, chất âm cải tiến.' },

        // --- PHỤ KIỆN (Ốp lưng & Sạc) ---
        21: { id: 21, name: 'Ốp lưng MagSafe JINYA', price: 550000, image: 'img/21.jpg', description: 'Bảo vệ tối đa, hỗ trợ sạc không dây.' },
        22: { id: 22, name: 'Ốp lưng Nylon PC TPU', price: 738000, image: 'img/22.jpg', description: 'Chất liệu bền bỉ, chống sốc tốt.' },
        23: { id: 23, name: 'Ốp lưng MagSafe', price: 1071000, image: 'img/23.jpg', description: 'Chính hãng Apple, tích hợp nam châm mạnh mẽ.' },
        24: { id: 24, name: 'Bộ Adapter Sạc 4 cổng', price: 1290000, image: 'img/24.jpg', description: 'Sạc nhanh nhiều thiết bị cùng lúc.' },
        25: { id: 25, name: 'Adapter Sạc đa năng', price: 990000, image: 'img/25.jpg', description: 'Nhỏ gọn, tiện lợi khi đi du lịch.' },
        26: { id: 26, name: 'Cáp Type C', price: 200000, image: 'img/26.jpg', description: 'Truyền dữ liệu tốc độ cao, bọc dù siêu bền.' }
    };
    // ===================================
    // LOGIC GIỎ HÀNG (Sử dụng localStorage)
    // ===================================
    // Lấy giỏ hàng từ localStorage, nếu không có thì tạo mảng rỗng
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Lưu giỏ hàng vào localStorage
    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Cập nhật số lượng trên icon giỏ hàng
    function updateCartIcon() {
        const totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = totalQuantity;
        });
    }

    // Thêm sản phẩm vào giỏ hàng
    function addToCart(productId, quantity) {
        const productData = allProducts[productId];
        if (!productData) {
            console.error('Sản phẩm không tồn tại!');
            return;
        }

        const existingItem = cart.find(item => item.id === productId);
        if (existingItem) {
            // Nếu sản phẩm đã có, tăng số lượng
            existingItem.quantity += quantity;
        } else {
            // Nếu chưa có, thêm sản phẩm mới vào giỏ
            cart.push({ ...productData, quantity: quantity });
        }
        saveCart();
        updateCartIcon();
        alert('Sản phẩm đã được thêm vào giỏ hàng!');
    }

    // ===================================
    // CHỨC NĂNG TRANG CHỦ (SLIDER)
    // ===================================
    const sliderWrapper = document.querySelector('.slider-wrapper');
    if (sliderWrapper) { // Chỉ chạy nếu có slider trên trang
        const dots = document.querySelectorAll('.dot');
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;
        const slideCount = slides.length;
        const slideInterval = 5000;

        function goToSlide(slideIndex) {
            sliderWrapper.style.transform = `translateX(-${slideIndex * (100 / slideCount)}%)`;
            dots.forEach(dot => dot.classList.remove('active'));
            dots[slideIndex].classList.add('active');
            currentSlide = slideIndex;
        }

        function nextSlide() {
            let nextIndex = (currentSlide + 1) % slideCount;
            goToSlide(nextIndex);
        }

        let slideTimer = setInterval(nextSlide, slideInterval);

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const slideIndex = parseInt(dot.dataset.slide);
                goToSlide(slideIndex);
                clearInterval(slideTimer);
                slideTimer = setInterval(nextSlide, slideInterval);
            });
        });
    }

    // ===================================
    // CHỨC NĂNG TRANG CHI TIẾT SẢN PHẨM
    // ===================================
    if (document.body.classList.contains('product-detail-page')) {
        const urlParams = new URLSearchParams(window.location.search);
        const productId = parseInt(urlParams.get('id')); // Lấy 'id' từ URL
        const product = allProducts[productId]; // Tìm sản phẩm trong "database"

        if (product) {
            // Cập nhật thông tin sản phẩm lên trang
            document.getElementById('product-image').src = product.image;
            document.getElementById('product-image').alt = product.name;
            document.getElementById('product-name').textContent = product.name;
            document.getElementById('product-price').textContent = `${product.price.toLocaleString('vi-VN')}đ`;
            document.getElementById('product-description').textContent = product.description;
            
            // Gắn sự kiện cho nút "Thêm vào giỏ hàng"
            document.getElementById('add-to-cart-btn').addEventListener('click', () => {
                const quantity = parseInt(document.getElementById('quantity').value);
                if (quantity > 0) {
                    addToCart(product.id, quantity);
                } else {
                    alert('Số lượng phải lớn hơn 0');
                }
            });
        } else {
            // Nếu không tìm thấy sản phẩm, hiển thị thông báo lỗi
            document.querySelector('.product-detail-container').innerHTML = '<h1>Sản phẩm không tồn tại hoặc đã bị xóa.</h1>';
        }
    }

    // ===================================
    // CHỨC NĂNG TRANG GIỎ HÀNG
    // ===================================
  if (document.body.classList.contains('cart-page')) {
        const cartItemsContainer = document.getElementById('cart-items-container');
        const cartSummaryBox = document.getElementById('cart-summary-box'); // Lấy khung tính tiền
        const subtotalPriceEl = document.getElementById('subtotal-price');
        const totalPriceEl = document.getElementById('total-price');

      function displayCartItems() {
            cartItemsContainer.innerHTML = ''; // Xóa các item cũ
            
            // KIỂM TRA GIỎ HÀNG RỖNG (Giữ nguyên đoạn này)
            if (cart.length === 0) {
                if(cartSummaryBox) cartSummaryBox.style.display = 'none';
                cartItemsContainer.innerHTML = `
                    <div style="text-align: center; padding: 50px 0;">
                        <div style="font-size: 60px; margin-bottom: 20px;">🛒</div>
                        <h3>Giỏ hàng của bạn đang trống!</h3>
                        <p style="margin-bottom: 30px; color: #666;">Hãy chọn thêm sản phẩm để mua sắm nhé.</p>
                        <a href="index.php" class="cta-button">Quay lại mua sắm</a>
                    </div>
                `;
                if(subtotalPriceEl) subtotalPriceEl.textContent = '0đ';
                if(totalPriceEl) totalPriceEl.textContent = '0đ';
                return;
            }

            // NẾU CÓ SẢN PHẨM (Sửa đoạn này)
            if(cartSummaryBox) cartSummaryBox.style.display = 'block';

            let subtotal = 0;
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                // --- ĐÂY LÀ ĐOẠN CẦN SỬA ---
                const cartItemHTML = `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}">
                        
                        <div class="cart-item-details">
                            <p class="product-name">${item.name}</p>
                            <p class="product-price">Đơn giá: ${item.price.toLocaleString('vi-VN')}đ</p>
                        </div>

                        <div class="quantity-selector">
                            <input type="number" value="${item.quantity}" min="1" data-id="${item.id}" class="cart-quantity-input">
                        </div>
                        
                        <p class="item-total-price">${itemTotal.toLocaleString('vi-VN')}đ</p>
                        
                        <button class="remove-item-btn" data-id="${item.id}" title="Xóa sản phẩm">×</button>
                    </div>`;
                // -----------------------------

                cartItemsContainer.insertAdjacentHTML('beforeend', cartItemHTML);
            });
            
            // Cập nhật tổng tiền (Giữ nguyên)
            if(subtotalPriceEl) subtotalPriceEl.textContent = `${subtotal.toLocaleString('vi-VN')}đ`;
            if(totalPriceEl) totalPriceEl.textContent = `${subtotal.toLocaleString('vi-VN')}đ`;
        }

        // ... (Phần xử lý sự kiện handleCartActions giữ nguyên) ...
        function handleCartActions(event) {
            // Thay đổi số lượng
            if (event.target.classList.contains('cart-quantity-input')) {
                const productId = parseInt(event.target.dataset.id);
                const newQuantity = parseInt(event.target.value);
                const itemInCart = cart.find(item => item.id === productId);
                if (itemInCart && newQuantity > 0) {
                    itemInCart.quantity = newQuantity;
                    saveCart();
                    displayCartItems(); 
                    updateCartIcon();
                }
            }
            // Xóa sản phẩm
            if (event.target.classList.contains('remove-item-btn')) {
                const productId = parseInt(event.target.dataset.id);
                cart = cart.filter(item => item.id !== productId); 
                saveCart();
                displayCartItems(); 
                updateCartIcon();
            }
        }
        
        cartItemsContainer.addEventListener('change', handleCartActions);
        cartItemsContainer.addEventListener('click', handleCartActions);
        
        displayCartItems();
    }
    // Luôn cập nhật icon giỏ hàng trên mọi trang khi tải xong
    updateCartIcon();
});