<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Lấy dữ liệu từ form
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Lưu lại dữ liệu cũ để nếu lỗi thì điền lại vào form cho user đỡ mất công gõ
    $_SESSION['old_data'] = ['fullname' => $fullname, 'email' => $email];

    // 2. Kiểm tra dữ liệu đầu vào (Validation)
    if (empty($fullname) || empty($email) || empty($password) || empty($password_confirm)) {
        $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin!";
        header('Location: register.php');
        exit;
    }

    // if ($password !== $password_confirm) {
    //     $_SESSION['error'] = "Mật khẩu nhập lại không khớp!";
    //     header('Location: register.php');
    //     exit;
    // }

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Mật khẩu phải có ít nhất 6 ký tự!";
        header('Location: register.php');
        exit;
    }

    // 3. Kiểm tra xem Email đã tồn tại chưa
    // $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    // $stmt->execute(['email' => $email]);
    
    // if ($stmt->rowCount() > 0) {
    //     $_SESSION['error'] = "Email này đã được đăng ký, vui lòng dùng email khác!";
    //     header('Location: register.php');
    //     exit;
    // }

    // 4. Mã hóa mật khẩu (BẮT BUỘC)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 5. Thêm người dùng vào Database
    try {
        $sql = "INSERT INTO users (full_name, email, password, role) VALUES (:name, :email, :pass, 'customer')";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            'name' => $fullname,
            'email' => $email,
            'pass' => $hashed_password
        ]);

        if ($result) {
            // Đăng ký thành công
            unset($_SESSION['old_data']); // Xóa dữ liệu cũ
            $_SESSION['success'] = "Đăng ký thành công! Hãy đăng nhập ngay.";
            header('Location: login.php'); // Chuyển sang trang đăng nhập
            exit;
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại!";
            header('Location: register.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Lỗi hệ thống: " . $e->getMessage();
        header('Location: register.php');
        exit;
    }

} else {
    // Không cho truy cập trực tiếp
    header('Location: register.php');
    exit;
}
?>