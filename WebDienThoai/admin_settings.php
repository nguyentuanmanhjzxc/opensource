<?php
session_start();
// Kiểm tra quyền admin...

$pageTitle = "Cài Đặt Hệ Thống";
$activePage = "settings"; // Highlight menu Cài đặt

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1>Cài Đặt Chung</h1>
    </header>

    <div class="content-wrapper">
        <div class="card-form">
            <form action="" method="POST">
                
                <h3 style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Thông Tin Website</h3>
                
                <div class="form-group">
                    <label for="site_title">Tên Cửa Hàng (Tiêu đề trang):</label>
                    <input type="text" id="site_title" name="site_title" class="form-control" value="THE KING - Cửa hàng điện thoại">
                </div>

                <div class="form-group">
                    <label for="hotline">Hotline Liên Hệ:</label>
                    <input type="text" id="hotline" name="hotline" class="form-control" value="1900 1234">
                </div>

                <div class="form-group">
                    <label for="email_contact">Email Liên Hệ:</label>
                    <input type="email" id="email_contact" name="email_contact" class="form-control" value="contact@themodernist.vn">
                </div>

                <h3 style="margin-top: 40px; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Cấu Hình Khác</h3>

                <div class="form-group">
                    <label for="admin_email">Email Nhận Thông Báo Đơn Hàng:</label>
                    <input type="email" id="admin_email" name="admin_email" class="form-control" value="admin@theking.vn">
                </div>

                <div class="form-group">
                    <label>Chế độ bảo trì:</label>
                    <div style="margin-top: 10px;">
                        <input type="radio" id="maintenance_off" name="maintenance" value="0" checked>
                        <label for="maintenance_off" style="display:inline; font-weight: normal; margin-right: 15px;">Tắt (Website hoạt động bình thường)</label>
                        
                        <input type="radio" id="maintenance_on" name="maintenance" value="1">
                        <label for="maintenance_on" style="display:inline; font-weight: normal;">Bật (Chỉ Admin mới truy cập được)</label>
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn-save"><i class="ri-save-3-line"></i> Lưu Cài Đặt</button>
                </div>

            </form>
        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>