<?php
// includes/db.php

// 1. Gọi file cấu hình vào (Lưu ý đường dẫn ../config/...)
// Dùng __DIR__ để lấy đường dẫn tuyệt đối, tránh lỗi không tìm thấy file
require_once __DIR__ . '/../config/Database.php'; 
// (Lưu ý: Nếu bạn đã đổi tên file như mình khuyên ở mục 2 thì sửa tên ở đây nhé)

try {
    // 2. Sử dụng các hằng số đã define trong file config
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    
    $conn = new PDO($dsn, DB_USER, DB_PASS);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    echo "Lỗi kết nối CSDL: " . $e->getMessage();
    die();
}
?>