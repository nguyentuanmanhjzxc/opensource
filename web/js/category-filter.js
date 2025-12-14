document.addEventListener("DOMContentLoaded", function() {
    // 1. Lấy phần tử dropdown chọn dòng máy
    const filterSelect = document.getElementById("category-filter");
    
    // 2. Lấy tất cả các thẻ sản phẩm đang hiển thị
    const products = document.querySelectorAll(".product-card");

    // Chỉ chạy khi trang web có bộ lọc này
    if (filterSelect) {
        filterSelect.addEventListener("change", function() {
            // Lấy giá trị người dùng vừa chọn (ví dụ: 'iphone15', 's_series', 'all')
            const selectedCategory = this.value;

            // Duyệt qua từng sản phẩm để kiểm tra
            products.forEach(product => {
                // Lấy dòng máy của sản phẩm từ attribute data-category
                const productCategory = product.getAttribute("data-category");

                // Logic lọc:
                // Nếu chọn 'all' (Tất cả) -> Hiển thị hết
                // Hoặc nếu dòng máy của sản phẩm trùng với dòng máy đã chọn -> Hiển thị
                if (selectedCategory === "all" || selectedCategory === productCategory) {
                    product.style.display = "block"; // Hoặc 'flex' tùy vào CSS của bạn, nhưng block thường an toàn
                } else {
                    product.style.display = "none"; // Ẩn đi
                }
            });
        });
    }
});