<?php
// reset_pass.php
require_once 'includes/db.php';

// Mật khẩu chung muốn đặt lại cho cả 2 tài khoản
$new_pass = '123456';
// Mã hóa mật khẩu chuẩn theo PHP hiện tại
$new_hash = password_hash($new_pass, PASSWORD_DEFAULT);

// Danh sách email cần reset
$emails = [
    'admin@theking.vn',  // Tài khoản Admin
    'khach@gmail.com'    // Tài khoản Khách hàng mẫu
];

try {
    echo "<h2>Đang thực hiện Reset Mật khẩu...</h2>";

    $stmt = $conn->prepare("UPDATE users SET password = :pass WHERE email = :email");

    foreach ($emails as $email) {
        $stmt->execute(['pass' => $new_hash, 'email' => $email]);
        
        // Kiểm tra xem có dòng nào bị ảnh hưởng không (tức là email có tồn tại không)
        if ($stmt->rowCount() > 0) {
            echo "<p style='color: green;'>✔ Đã reset thành công cho: <b>$email</b></p>";
        } else {
            echo "<p style='color: red;'>✖ Không tìm thấy email: <b>$email</b> (Kiểm tra lại xem trong Database bạn nhập email là gì)</p>";
        }
    }

    echo "<hr>";
    echo "Mật khẩu mới cho tất cả là: <b>$new_pass</b><br><br>";
    echo "<a href='login.php' style='font-size: 20px; font-weight: bold;'>➡ Bấm vào đây để Đăng nhập ngay</a>";
    
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>