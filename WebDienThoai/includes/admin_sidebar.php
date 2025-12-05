<aside class="sidebar">
    <div class="sidebar-header">
        <h2>THE KING <span style="font-size: 12px; font-weight: 400; display: block; color: #bdc3c7;">Admin Control</span></h2>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="<?php echo ($activePage === 'dashboard') ? 'active' : ''; ?>">
                <a href="dashboard.php"><i class="ri-dashboard-line"></i> Dashboard</a>
            </li>
            
            <li class="<?php echo ($activePage === 'orders') ? 'active' : ''; ?>">
                <a href="admin_orders.php"><i class="ri-file-list-3-line"></i> Quản Lý Đơn Hàng</a>
            </li>
            
            <li class="<?php echo ($activePage === 'products') ? 'active' : ''; ?>">
                <a href="admin_products.php"><i class="ri-smartphone-line"></i> Quản Lý Sản Phẩm</a>
            </li>
            
            <li class="<?php echo ($activePage === 'customers') ? 'active' : ''; ?>">
                <a href="admin_customers.php"><i class="ri-user-3-line"></i> Khách Hàng</a>
            </li>

            <li class="<?php echo ($activePage === 'settings') ? 'active' : ''; ?>">
                <a href="admin_settings.php"><i class="ri-settings-3-line"></i> Cài Đặt</a>
            </li>

            <li style="margin-top: 20px; border-top: 1px solid #34495e;">
                <a href="index.php"><i class="ri-store-2-line"></i> Về Trang Bán Hàng</a>
            </li>
            <li>
                <a href="logout.php" style="color: #e74c3c;"><i class="ri-logout-box-line"></i> Đăng xuất</a>
            </li>
        </ul>
    </nav>
</aside>