<?php
// Bắt đầu session nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem biến $pageTitle có được đặt ở trang chính không, nếu không thì dùng mặc định
if (!isset($pageTitle)) {
    $pageTitle = 'THE KING - Cửa hàng điện thoại';
}

// Tính tổng số lượng sản phẩm trong giỏ hàng (Để hiển thị lên icon túi xách)
$total_items = 0;
if (isset($_SESSION['cart'])) {
    // Cộng tổng số lượng các món hàng
    $total_items = array_sum($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="main-header">
        <div class="container">
            <a href="index.php" class="logo">THE KING</a>
            <nav>
                <a href="index.php">Trang chủ</a>
                
                <a href="sale.php" class="sale">Sale</a>
            </nav>
            <div class="header-icons">
                <div class="search-container">
                    <a href="search.php" id="search-icon">🔍Search</a>
                    
                </div>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 14px;">
                        <span>Chào, <b><?php echo htmlspecialchars($_SESSION["user_name"]); ?></b>!</span>
                        
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                            <a href="dashboard.php" style="color: #e74c3c; font-weight: bold;">(Admin)</a>
                        <?php endif; ?>

                        <a href="logout.php" style="color: #555;">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="login.php">👤Login</a>
                <?php endif; ?>

                <a href="Giohang.php" class="cart-icon-container">
                    <span>👜</span>
                    <span class="cart-count"><?php echo $total_items; ?></span>
                </a>
            </div>
        </div>
    </header>