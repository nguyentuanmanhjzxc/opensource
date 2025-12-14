<?php
// admin_settings.php
require_once 'includes/admin_protect.php';
require_once 'includes/db.php';

$message = "";

// 1. XỬ LÝ KHI NGƯỜI DÙNG BẤM LƯU (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_title = $_POST['site_title'];
    $hotline = $_POST['hotline'];
    $email_contact = $_POST['email_contact'];
    $admin_email = $_POST['admin_email'];
    $maintenance = intval($_POST['maintenance']);

    // Cập nhật Database (ID = 1 mặc định)
    $sql = "UPDATE settings 
            SET site_title = :site_title, 
                hotline = :hotline, 
                email_contact = :email_contact, 
                admin_email = :admin_email, 
                maintenance_mode = :maintenance 
            WHERE id = 1";
            
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([
        'site_title' => $site_title,
        'hotline' => $hotline,
        'email_contact' => $email_contact,
        'admin_email' => $admin_email,
        'maintenance' => $maintenance
    ])) {
        $message = "<div style='color: green; background: #d4edda; padding: 10px; margin-bottom: 20px;'>✔ Đã lưu cài đặt thành công!</div>";
    } else {
        $message = "<div style='color: red; background: #f8d7da; padding: 10px; margin-bottom: 20px;'>✖ Lỗi khi lưu cài đặt!</div>";
    }
}

// 2. LẤY DỮ LIỆU CÀI ĐẶT HIỆN TẠI
$stmt = $conn->query("SELECT * FROM settings WHERE id = 1");
$setting = $stmt->fetch();

// Nếu chưa có dòng nào trong bảng settings, tạo mặc định để tránh lỗi
if (!$setting) {
    $conn->query("INSERT INTO settings (id) VALUES (1)");
    $setting = $conn->query("SELECT * FROM settings WHERE id = 1")->fetch();
}

$pageTitle = "Cài Đặt Hệ Thống";
$activePage = "settings";

include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1>Cài Đặt Chung</h1>
    </header>

    <div class="content-wrapper">
        <div class="card-form">
            
            <?= $message ?>

            <form action="" method="POST">
                
                <h3 style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Thông Tin Website</h3>
                
                <div class="form-group">
                    <label for="site_title">Tên Cửa Hàng (Tiêu đề trang):</label>
                    <input type="text" id="site_title" name="site_title" class="form-control" 
                           value="<?= htmlspecialchars($setting['site_title'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="hotline">Hotline Liên Hệ:</label>
                    <input type="text" id="hotline" name="hotline" class="form-control" 
                           value="<?= htmlspecialchars($setting['hotline'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="email_contact">Email Liên Hệ:</label>
                    <input type="email" id="email_contact" name="email_contact" class="form-control" 
                           value="<?= htmlspecialchars($setting['email_contact'] ?? '') ?>">
                </div>

                <h3 style="margin-top: 40px; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Cấu Hình Khác</h3>

                <div class="form-group">
                    <label for="admin_email">Email Nhận Thông Báo Đơn Hàng:</label>
                    <input type="email" id="admin_email" name="admin_email" class="form-control" 
                           value="<?= htmlspecialchars($setting['admin_email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Chế độ bảo trì:</label>
                    <div style="margin-top: 10px;">
                        <input type="radio" id="maintenance_off" name="maintenance" value="0" 
                               <?= ($setting['maintenance_mode'] == 0) ? 'checked' : '' ?>>
                        <label for="maintenance_off" style="display:inline; font-weight: normal; margin-right: 15px;">Tắt (Website hoạt động bình thường)</label>
                        
                        <input type="radio" id="maintenance_on" name="maintenance" value="1"
                               <?= ($setting['maintenance_mode'] == 1) ? 'checked' : '' ?>>
                        <label for="maintenance_on" style="display:inline; font-weight: normal;">Bật (Chỉ Admin mới truy cập được)</label>
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn-save" style="cursor: pointer;"><i class="ri-save-3-line"></i> Lưu Cài Đặt</button>
                </div>

            </form>
        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>