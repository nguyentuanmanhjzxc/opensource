<?php
// Bắt đầu session nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem biến $pageTitle có được đặt ở trang chính không, nếu không thì dùng mặc định
if (!isset($pageTitle)) {
    $pageTitle = 'THE KING - Cửa hàng điện thoại';
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="main-header">
        <div class="container">
            <a href="index.php" class="logo">THE KING</a>
            <nav>
                <a href="index.php">Trang chủ</a>
                <a href="iphone.php">iPhone</a>
                <a href="samsung.php">Samsung</a>
                <a href="phukien.php">Phụ kiện</a>
                <a href="sale.php" class="sale">Sale</a>
            </nav>
            <div class="header-icons">
                <div class="search-container">
                    <a href="#" id="search-icon">🔍Search</a>
                    <form action="#" class="search-form">
                        <input type="text" placeholder="🔍Tìm kiếm..." class="search-input">
                    </form>
                </div>

                <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <span>Chào, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</span>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">👤Login</a>
                <?php endif; ?>

                <a href="Giohang.php" class="cart-icon-container">
                    <span>👜</span>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </header>