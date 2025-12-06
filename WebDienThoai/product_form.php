<?php
require_once 'includes/admin_protect.php';
require_once 'includes/db.php';

// Khởi tạo biến mặc định (cho trường hợp Thêm mới)
$id = 0;
$name = '';
$category_id = '';
$price = '';
$old_price = '';
$stock = 10;
$series = '';
$description = '';
$image = '';
$is_hot = 0;
$is_edit = false; // Cờ đánh dấu đang là sửa hay thêm

// --- 1. KIỂM TRA: NẾU CÓ ID TRÊN URL => LÀ CHẾ ĐỘ SỬA ---
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();

    if ($product) {
        $is_edit = true;
        // Đổ dữ liệu cũ ra biến
        $name = $product['name'];
        $category_id = $product['category_id'];
        $price = $product['price'];
        $old_price = $product['old_price'];
        $stock = $product['stock'];
        $series = $product['series'];
        $description = $product['description'];
        $image = $product['image']; // Đường dẫn ảnh cũ
        $is_hot = $product['is_hot'];
    }
}

// --- 2. XỬ LÝ LƯU DỮ LIỆU (KHI BẤM SAVE) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $old_price = !empty($_POST['old_price']) ? $_POST['old_price'] : NULL;
    $stock = $_POST['stock'];
    $series = $_POST['series'];
    $description = $_POST['description'];
    $is_hot = isset($_POST['is_hot']) ? 1 : 0;

    // XỬ LÝ UPLOAD ẢNH
    $image_path = $image; // Mặc định giữ ảnh cũ
    
    // Nếu người dùng có chọn file ảnh mới
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
        $target_dir = "img/";
        // Tạo tên file duy nhất để tránh trùng (dùng time)
        $file_extension = pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION);
        $new_file_name = time() . "_" . rand(1000, 9999) . "." . $file_extension;
        $target_file = $target_dir . $new_file_name;

        // Upload file
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            $image_path = $target_file; // Cập nhật đường dẫn mới
        }
    }
    // Nếu người dùng nhập link ảnh online (backup)
    elseif (!empty($_POST['image_url'])) {
        $image_path = $_POST['image_url'];
    }

    // THỰC HIỆN INSERT HOẶC UPDATE
    try {
        if ($is_edit) {
            // UPDATE
            $sql = "UPDATE products SET 
                    name = :name, category_id = :cat_id, price = :price, old_price = :old_price, 
                    stock = :stock, series = :series, description = :desc, image = :img, is_hot = :hot 
                    WHERE id = :id";
            $params = [
                'name' => $name, 'cat_id' => $category_id, 'price' => $price, 'old_price' => $old_price,
                'stock' => $stock, 'series' => $series, 'desc' => $description, 'img' => $image_path,
                'hot' => $is_hot, 'id' => $id
            ];
        } else {
            // INSERT
            $sql = "INSERT INTO products (name, category_id, price, old_price, stock, series, description, image, is_hot) 
                    VALUES (:name, :cat_id, :price, :old_price, :stock, :series, :desc, :img, :hot)";
            $params = [
                'name' => $name, 'cat_id' => $category_id, 'price' => $price, 'old_price' => $old_price,
                'stock' => $stock, 'series' => $series, 'desc' => $description, 'img' => $image_path,
                'hot' => $is_hot
            ];
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // Chuyển hướng về trang danh sách
        header('Location: admin_products.php');
        exit;

    } catch (PDOException $e) {
        $error = "Lỗi: " . $e->getMessage();
    }
}

// LẤY DANH SÁCH DANH MỤC (Để hiện trong select box)
$categories = $conn->query("SELECT * FROM categories")->fetchAll();

$pageTitle = $is_edit ? "Sửa Sản Phẩm" : "Thêm Sản Phẩm Mới";
$activePage = "products";
include 'includes/admin_header.php';
include 'includes/admin_sidebar.php';
?>

<main class="main-content">
    <header class="main-header-admin">
        <h1><?= $pageTitle ?></h1>
        <div class="header-actions">
            <a href="admin_products.php" class="action-btn" style="background: #95a5a6;">Quay lại</a>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="card-form">
            
            <?php if (isset($error)): ?>
                <div style="color: red; background: #fadbd8; padding: 10px; margin-bottom: 15px;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                    <div>
                        <div class="form-group">
                            <label>Tên Sản Phẩm <span style="color:red">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Mô Tả Chi Tiết</label>
                            <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($description ?? '') ?></textarea>
                        </div>

                        <div style="display: flex; gap: 20px;">
                            <div class="form-group" style="flex: 1;">
                                <label>Giá Bán (VNĐ) <span style="color:red">*</span></label>
                                <input type="number" name="price" class="form-control" value="<?= $price ?>" required>
                            </div>
                            <div class="form-group" style="flex: 1;">
                                <label>Giá Gốc (Để gạch ngang - Tùy chọn)</label>
                                <input type="number" name="old_price" class="form-control" value="<?= $old_price ?>">
                            </div>
                        </div>

                         <div class="form-group">
                            <label>Mã Dòng Máy (Series - Để lọc sản phẩm)</label>
                            <input type="text" name="series" class="form-control" value="<?= htmlspecialchars($series) ?>" list="series_list" placeholder="Ví dụ: iphone15, s_series, audio...">
                            <small style="color: #666;">Gợi ý: iphone15, iphone14, s_series, z_series, xiaomi_flagship, redmi, audio, charge, case</small>
                            <datalist id="series_list">
                                <option value="iphone15">
                                <option value="iphone14">
                                <option value="iphone13">
                                <option value="s_series">
                                <option value="z_series">
                                <option value="xiaomi_flagship">
                                <option value="redmi">
                                <option value="audio">
                                <option value="charge">
                                <option value="case">
                            </datalist>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label>Danh Mục <span style="color:red">*</span></label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $category_id) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tồn Kho</label>
                            <input type="number" name="stock" class="form-control" value="<?= $stock ?>">
                        </div>

                        <div class="form-group">
                            <label>Sản Phẩm Hot</label><br>
                            <input type="checkbox" id="is_hot" name="is_hot" value="1" <?= ($is_hot == 1) ? 'checked' : '' ?>>
                            <label for="is_hot" style="font-weight: normal; display: inline;">Hiển thị nhãn HOT</label>
                        </div>

                        <div class="form-group" style="border: 1px solid #eee; padding: 15px; border-radius: 5px;">
                            <label>Hình Ảnh</label>
                            
                            <?php if (!empty($image)): ?>
                                <div style="margin-bottom: 10px; text-align: center;">
                                    <img src="<?= htmlspecialchars($image) ?>" style="max-width: 100px; height: auto; border: 1px solid #ddd;">
                                    <p style="font-size: 12px; color: #888;">Ảnh hiện tại</p>
                                </div>
                            <?php endif; ?>

                            <label style="font-size: 13px;">Tải ảnh mới lên:</label>
                            <input type="file" name="image_file" class="form-control" accept="image/*">
                            
                            <p style="text-align: center; margin: 10px 0;">Hoặc</p>
                            
                            <label style="font-size: 13px;">Nhập link ảnh (Nếu không muốn upload):</label>
                            <input type="text" name="image_url" class="form-control" placeholder="http://..." value="<?= (strpos($image, 'http') === 0) ? htmlspecialchars($image) : '' ?>">
                        </div>

                        <button type="submit" class="btn-save" style="width: 100%; margin-top: 20px;">
                            <i class="ri-save-3-line"></i> <?= $is_edit ? "Cập Nhật" : "Thêm Mới" ?>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>

<?php include 'includes/admin_footer.php'; ?>