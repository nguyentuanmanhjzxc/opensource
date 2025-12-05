<?php
session_start();
// Kiểm tra quyền admin ở đây...

// 1. Cấu hình trang hiện tại để Sidebar biết đường highlight
$pageTitle = "Dashboard Tổng Quan";
$activePage = "dashboard"; 

// 2. Include các thành phần chung
include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <div class="header-title">
            <h1>Tổng Quan</h1>
            <p style="font-size: 14px; color: #888;">Chào mừng trở lại, Admin!</p>
        </div>
        <div class="header-actions">
            <div class="user-profile" style="display: flex; align-items: center; gap: 10px;">
                <span style="font-weight: 600;">Admin</span>
                <div style="width: 40px; height: 40px; background: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center;">👤</div>
            </div>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="dashboard-cards">
            <div class="card-single">
                <div class="card-info">
                    <span>Tổng Doanh Thu</span>
                    <h3>128.5M</h3>
                    <small style="color: #2ecc71;">+10% so với tháng trước</small>
                </div>
                <div class="card-icon green"><i class="ri-money-dollar-circle-line"></i></div>
            </div>
            <div class="card-single">
                <div class="card-info">
                    <span>Đơn Hàng Mới</span>
                    <h3>45</h3>
                    <small>Đang chờ xử lý</small>
                </div>
                <div class="card-icon"><i class="ri-shopping-cart-2-line"></i></div>
            </div>
             <div class="card-single">
                <div class="card-info">
                    <span>Khách Hàng</span>
                    <h3>1,204</h3>
                    <small style="color: #2ecc71;">+5 khách mới hôm nay</small>
                </div>
                <div class="card-icon yellow"><i class="ri-group-line"></i></div>
            </div>
             <div class="card-single">
                <div class="card-info">
                    <span>Sản Phẩm</span>
                    <h3>58</h3>
                    <small style="color: #e74c3c;">2 sản phẩm sắp hết hàng</small>
                </div>
                <div class="card-icon red"><i class="ri-smartphone-line"></i></div>
            </div>
        </div>

        <div class="dashboard-grid-2">
            <div class="chart-container">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3>Doanh thu 6 tháng qua</h3>
                    <select style="padding: 5px; border-radius: 4px; border: 1px solid #ddd;">
                        <option>Năm nay</option>
                        <option>Năm ngoái</option>
                    </select>
                </div>
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="chart-container">
                <h3>Tỷ trọng sản phẩm</h3>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
</main>

<script>
    const ctx1 = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6'],
            datasets: [{
                label: 'Doanh thu (Triệu đ)',
                data: [65, 59, 80, 81, 156, 125],
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive: true }
    });

    const ctx2 = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['iPhone', 'Samsung', 'Phụ kiện'],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: ['#2c3e50', '#3498db', '#ecf0f1']
            }]
        }
    });
</script>

<?php include 'includes/admin_footer.php'; ?>