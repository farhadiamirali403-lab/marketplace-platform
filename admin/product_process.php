<?php
// admin/product_process.php - پردازش عملیات محصولات

require_once '../auth/config.php';
session_start();

// بررسی ادمین بودن
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'دسترسی غیرمجاز']);
    exit;
}

// ============ دریافت اطلاعات محصول (GET) ============
if ($_GET['action'] ?? '' == 'get') {
    $id = (int)$_GET['id'];
    $stmt = $conn->prepare("SELECT id, title, category, description, price, discount_price, status, image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    if ($product) {
        echo json_encode(['success' => true, 'product' => $product]);
    } else {
        echo json_encode(['success' => false, 'message' => 'محصول یافت نشد']);
    }
    $stmt->close();
    exit;
}

// ============ پردازش POST ============
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'متود نامعتبر']);
    exit;
}

$action = $_POST['action'] ?? '';

// ============ افزودن محصول ============
if ($action == 'add') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $discount_price = (float)($_POST['discount_price'] ?? 0);
    $status = (int)($_POST['status'] ?? 1);
    
    // اعتبارسنجی
    $errors = [];
    if (empty($title)) $errors[] = 'عنوان محصول الزامی است';
    if (empty($category)) $errors[] = 'دسته‌بندی الزامی است';
    if ($price <= 0) $errors[] = 'قیمت باید بیشتر از ۰ باشد';
    
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(' | ', $errors)]);
        exit;
    }
    
    // پردازش تصویر
    $image_name = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $image_name = time() . '_' . uniqid() . '.' . $ext;
            $upload_path = '../uploads/products/' . $image_name;
            if (!is_dir('../uploads/products')) {
                mkdir('../uploads/products', 0777, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);
        }
    }
    
    $stmt = $conn->prepare("INSERT INTO products (title, category, description, price, discount_price, status, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssddis", $title, $category, $description, $price, $discount_price, $status, $image_name);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'محصول با موفقیت ایجاد شد']);
    } else {
        echo json_encode(['success' => false, 'message' => 'خطا در ایجاد محصول: ' . $stmt->error]);
    }
    $stmt->close();
    exit;
}

// ============ ویرایش محصول ============
if ($action == 'edit') {
    $id = (int)$_POST['product_id'];
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $discount_price = (float)($_POST['discount_price'] ?? 0);
    $status = (int)($_POST['status'] ?? 1);
    
    // اعتبارسنجی
    $errors = [];
    if (empty($title)) $errors[] = 'عنوان محصول الزامی است';
    if (empty($category)) $errors[] = 'دسته‌بندی الزامی است';
    if ($price <= 0) $errors[] = 'قیمت باید بیشتر از ۰ باشد';
    
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(' | ', $errors)]);
        exit;
    }
    
    // پردازش تصویر جدید
    $image_name = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $image_name = time() . '_' . uniqid() . '.' . $ext;
            $upload_path = '../uploads/products/' . $image_name;
            if (!is_dir('../uploads/products')) {
                mkdir('../uploads/products', 0777, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);
        }
    }
    
    if (!empty($image_name)) {
        $stmt = $conn->prepare("UPDATE products SET title=?, category=?, description=?, price=?, discount_price=?, status=?, image=? WHERE id=?");
        $stmt->bind_param("sssddisi", $title, $category, $description, $price, $discount_price, $status, $image_name, $id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET title=?, category=?, description=?, price=?, discount_price=?, status=? WHERE id=?");
        $stmt->bind_param("sssddii", $title, $category, $description, $price, $discount_price, $status, $id);
    }
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'محصول با موفقیت به‌روزرسانی شد']);
    } else {
        echo json_encode(['success' => false, 'message' => 'خطا در ویرایش محصول: ' . $stmt->error]);
    }
    $stmt->close();
    exit;
}

// ============ تغییر وضعیت محصول ============
if ($action == 'toggle') {
    $id = (int)$_POST['id'];
    $status = (int)$_POST['status'];
    
    $stmt = $conn->prepare("UPDATE products SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'وضعیت محصول تغییر کرد']);
    } else {
        echo json_encode(['success' => false, 'message' => 'خطا در تغییر وضعیت']);
    }
    $stmt->close();
    exit;
}

// ============ حذف محصول ============
if ($action == 'delete') {
    $id = (int)$_POST['id'];
    
    // حذف تصویر محصول
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    if ($product && !empty($product['image'])) {
        $image_path = '../uploads/products/' . $product['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    $stmt->close();
    
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'محصول با موفقیت حذف شد']);
    } else {
        echo json_encode(['success' => false, 'message' => 'خطا در حذف محصول: ' . $stmt->error]);
    }
    $stmt->close();
    exit;
}
?>