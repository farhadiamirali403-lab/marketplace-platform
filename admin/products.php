<?php
// admin/products.php - مدیریت محصولات (اصلاح شده با خطاگیری)

require_once 'header.php';
require_once 'sidebar.php';

// ============ اتصال به دیتابیس ============
require_once '../auth/config.php';

// ============ تعریف متغیرها ============
$search = isset($_GET['search']) ? cleanInput($_GET['search']) : '';
$category_filter = isset($_GET['category']) ? cleanInput($_GET['category']) : '';
$status_filter = isset($_GET['status']) ? cleanInput($_GET['status']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

// ============ توابع کمکی ============
function getStatusBadge($status) {
    if ($status == 1) {
        return '<span class="badge badge-success">فعال</span>';
    }
    return '<span class="badge badge-danger">غیرفعال</span>';
}

function getCategoryBadge($category) {
    $colors = [
        'قالب وب‌سایت' => 'badge-primary',
        'قالب اپلیکیشن' => 'badge-info',
        'طراحی UI/UX' => 'badge-purple',
        'ابزار توسعه' => 'badge-warning',
        'گرافیک' => 'badge-pink'
    ];
    $color = $colors[$category] ?? 'badge-secondary';
    return '<span class="badge ' . $color . '">' . htmlspecialchars($category) . '</span>';
}

// ============ بررسی وجود جدول products ============
$table_check = $conn->query("SHOW TABLES LIKE 'products'");
if ($table_check->num_rows == 0) {
    // جدول وجود ندارد - نمایش پیام خطا
    ?>
    <div class="admin-content">
        <div class="admin-topbar">
            <div class="topbar-title">
                <h1>📦 مدیریت محصولات</h1>
                <p>لیست و مدیریت تمام محصولات دیجیتال</p>
            </div>
            <div class="topbar-actions">
                <button class="mobile-menu-btn" onclick="toggleMobileSidebar()">☰</button>
                <div class="topbar-user">
                    <div class="user-avatar"><?php echo $first_letter; ?></div>
                    <div>
                        <div class="user-name"><?php echo htmlspecialchars($user_fullname); ?></div>
                        <div class="user-role">مدیر سیستم</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="text-align:center;padding:var(--space-16);">
            <div style="font-size:4rem;margin-bottom:var(--space-4);">📭</div>
            <h2 style="font-size:var(--font-size-2xl);color:var(--text-primary);margin-bottom:var(--space-2);">جدول محصولات وجود ندارد!</h2>
            <p style="color:var(--text-secondary);margin-bottom:var(--space-6);">
                لطفاً ابتدا جدول products را در دیتابیس ایجاد کنید.
            </p>
            <div style="background:var(--bg-secondary);padding:var(--space-4);border-radius:var(--radius-lg);text-align:right;max-width:500px;margin:0 auto;">
                <code style="font-size:var(--font-size-xs);color:var(--text-secondary);display:block;white-space:pre-wrap;word-break:break-all;">
CREATE TABLE products (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) DEFAULT 'متفرقه',
    description TEXT,
    price DECIMAL(15,2) NOT NULL,
    discount_price DECIMAL(15,2) DEFAULT 0,
    image VARCHAR(255) DEFAULT NULL,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
                </code>
            </div>
            <div style="margin-top:var(--space-4);">
                <a href="../install/create_products_table.php" class="btn btn-primary">ایجاد جدول به صورت خودکار</a>
            </div>
        </div>
    </div>
    <?php
    include_once '../js/theme.js';
    exit;
}

// ============ دریافت لیست محصولات ============

// ساخت کوئری با فیلترها
$sql = "SELECT * FROM products WHERE 1=1";
$count_sql = "SELECT COUNT(*) as total FROM products WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (title LIKE '%$search%' OR category LIKE '%$search%' OR description LIKE '%$search%')";
    $count_sql .= " AND (title LIKE '%$search%' OR category LIKE '%$search%' OR description LIKE '%$search%')";
}

if (!empty($category_filter)) {
    $sql .= " AND category = '$category_filter'";
    $count_sql .= " AND category = '$category_filter'";
}

if (!empty($status_filter)) {
    $sql .= " AND status = '$status_filter'";
    $count_sql .= " AND status = '$status_filter'";
}

// مرتب‌سازی
$sql .= " ORDER BY id DESC LIMIT $offset, $per_page";

// دریافت تعداد کل
$total_result = $conn->query($count_sql);
$total_products = $total_result ? ($total_result->fetch_assoc()['total'] ?? 0) : 0;
$total_pages = $total_products > 0 ? ceil($total_products / $per_page) : 1;

// دریافت محصولات
$products_result = $conn->query($sql);

// دریافت لیست دسته‌بندی‌ها برای فیلتر
$categories = [];
$categories_result = $conn->query("SELECT DISTINCT category FROM products ORDER BY category");
if ($categories_result && $categories_result->num_rows > 0) {
    while ($row = $categories_result->fetch_assoc()) {
        if (!empty($row['category'])) {
            $categories[] = $row['category'];
        }
    }
}

// ============ آمار محصولات ============
$total_products_all = 0;
$active_products = 0;
$inactive_products = 0;
$discount_products = 0;

$result = $conn->query("SELECT COUNT(*) as total FROM products");
if ($result) $total_products_all = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT COUNT(*) as total FROM products WHERE status = 1");
if ($result) $active_products = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT COUNT(*) as total FROM products WHERE status = 0");
if ($result) $inactive_products = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT COUNT(*) as total FROM products WHERE discount_price IS NOT NULL AND discount_price > 0");
if ($result) $discount_products = $result->fetch_assoc()['total'] ?? 0;
?>
<div class="admin-content">
    <!-- نوار بالایی -->
    <div class="admin-topbar">
        <div class="topbar-title">
            <h1>📦 مدیریت محصولات</h1>
            <p>لیست و مدیریت تمام محصولات دیجیتال</p>
        </div>
        <div class="topbar-actions">
            <button class="mobile-menu-btn" onclick="toggleMobileSidebar()">☰</button>
            <button class="btn btn-primary btn-sm" onclick="openAddProductModal()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                افزودن محصول
            </button>
            <div class="topbar-user">
                <div class="user-avatar"><?php echo $first_letter; ?></div>
                <div>
                    <div class="user-name"><?php echo htmlspecialchars($user_fullname); ?></div>
                    <div class="user-role">مدیر سیستم</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============ آمار محصولات ============ -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--space-4); margin-bottom: var(--space-6);">
        <div class="stat-card" style="text-align:center;">
            <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--text-primary);"><?php echo number_format($total_products_all); ?></div>
            <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">کل محصولات</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--color-success-500);"><?php echo number_format($active_products); ?></div>
            <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">فعال</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--color-danger-500);"><?php echo number_format($inactive_products); ?></div>
            <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">غیرفعال</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--color-warning-500);"><?php echo number_format($discount_products); ?></div>
            <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">تخفیف‌دار</div>
        </div>
    </div>
    
    <!-- ============ فیلترها و جستجو ============ -->
    <div style="display:flex; gap:var(--space-3); margin-bottom:var(--space-4); flex-wrap:wrap; align-items:center;">
        <div style="flex:1; min-width:200px;">
            <form method="GET" style="display:flex; gap:var(--space-2);">
                <div class="search-bar" style="flex:1;">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="text" name="search" class="search-input" placeholder="جستجوی محصول..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">جستجو</button>
            </form>
        </div>
        <form method="GET" style="display:flex; gap:var(--space-2); flex-wrap:wrap;">
            <?php if (!empty($search)): ?>
                <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <?php endif; ?>
            <select name="category" class="form-select" style="width:auto;padding-left:2rem;" onchange="this.form.submit()">
                <option value="">همه دسته‌بندی‌ها</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $category_filter == $cat ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="status" class="form-select" style="width:auto;padding-left:2rem;" onchange="this.form.submit()">
                <option value="">همه وضعیت‌ها</option>
                <option value="1" <?php echo $status_filter == '1' ? 'selected' : ''; ?>>فعال</option>
                <option value="0" <?php echo $status_filter == '0' ? 'selected' : ''; ?>>غیرفعال</option>
            </select>
            <?php if (!empty($category_filter) || !empty($status_filter) || !empty($search)): ?>
                <a href="products.php" class="btn btn-outline btn-sm">حذف فیلترها</a>
            <?php endif; ?>
        </form>
    </div>
    
    <!-- ============ جدول محصولات ============ -->
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:40px;">
                        <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes()">
                    </th>
                    <th>محصول</th>
                    <th>دسته‌بندی</th>
                    <th>قیمت</th>
                    <th>تخفیف</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                    <th style="text-align:center;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products_result && $products_result->num_rows > 0): ?>
                    <?php while ($product = $products_result->fetch_assoc()): 
                        $image_emoji = ['📝','🎨','⚡','📊','🖼️','📱','💻','🎯','🔧','📚'][rand(0,9)];
                    ?>
                    <tr>
                        <td><input type="checkbox" class="product-checkbox" value="<?php echo $product['id']; ?>"></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:var(--space-2);">
                                <div style="width:2.5rem;height:2.5rem;border-radius:var(--radius-lg);background:var(--gradient-brand);display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0;">
                                    <?php echo $image_emoji; ?>
                                </div>
                                <div>
                                    <div style="font-weight:var(--font-weight-medium);color:var(--text-primary);">
                                        <?php echo htmlspecialchars($product['title']); ?>
                                    </div>
                                    <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);">
                                        شناسه: #P-<?php echo str_pad($product['id'], 4, '0', STR_PAD_LEFT); ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo getCategoryBadge($product['category'] ?? 'متفرقه'); ?></td>
                        <td>
                            <div style="font-weight:var(--font-weight-bold);color:var(--text-primary);">
                                <?php echo number_format($product['price']); ?> تومان
                            </div>
                            <?php if (!empty($product['discount_price']) && $product['discount_price'] > 0): ?>
                                <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);text-decoration:line-through;">
                                    <?php echo number_format($product['discount_price']); ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($product['discount_price']) && $product['discount_price'] > 0): 
                                $discount_percent = round((1 - ($product['price'] / $product['discount_price'])) * 100);
                            ?>
                                <span class="badge badge-danger"><?php echo $discount_percent; ?>% تخفیف</span>
                            <?php else: ?>
                                <span class="badge badge-neutral">بدون تخفیف</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo getStatusBadge($product['status']); ?></td>
                        <td><?php echo date('Y/m/d', strtotime($product['created_at'] ?? 'now')); ?></td>
                        <td style="text-align:center;">
                            <div style="display:flex; gap:var(--space-1); justify-content:center;">
                                <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="مشاهده" onclick="viewProduct(<?php echo $product['id']; ?>)">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="ویرایش" onclick="editProduct(<?php echo $product['id']; ?>)">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <?php if ($product['status'] == 1): ?>
                                    <button class="btn btn-icon-only btn-sm btn-warning" data-tooltip="غیرفعال کردن" onclick="toggleProductStatus(<?php echo $product['id']; ?>, 0)">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                                        </svg>
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-icon-only btn-sm btn-success" data-tooltip="فعال کردن" onclick="toggleProductStatus(<?php echo $product['id']; ?>, 1)">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polyline points="9 11 12 14 22 4"/>
                                        </svg>
                                    </button>
                                <?php endif; ?>
                                <button class="btn btn-icon-only btn-sm btn-danger" data-tooltip="حذف" onclick="deleteProduct(<?php echo $product['id']; ?>)">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center;padding:var(--space-8);color:var(--text-tertiary);">
                            <div style="font-size:3rem;margin-bottom:var(--space-2);">📭</div>
                            <div>هیچ محصولی یافت نشد</div>
                            <div style="margin-top:var(--space-2);">
                                <button class="btn btn-primary btn-sm" onclick="openAddProductModal()">افزودن اولین محصول</button>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- ============ Pagination ============ -->
    <?php if ($total_pages > 1): ?>
    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:var(--space-4); flex-wrap:wrap; gap:var(--space-2);">
        <span style="font-size:var(--font-size-sm);color:var(--text-tertiary);">
            نمایش <?php echo min($offset + 1, $total_products); ?> تا <?php echo min($offset + $per_page, $total_products); ?> از <?php echo number_format($total_products); ?> محصول
        </span>
        <nav class="pagination">
            <a href="?page=<?php echo max(1, $page - 1); ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?><?php echo !empty($category_filter) ? '&category='.urlencode($category_filter) : ''; ?><?php echo !empty($status_filter) ? '&status='.urlencode($status_filter) : ''; ?>" 
               class="pagination-btn <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                ← قبلی
            </a>
            
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="pagination-btn active"><?php echo $i; ?></span>
                <?php elseif ($i == 1 || $i == $total_pages || abs($i - $page) <= 2): ?>
                    <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?><?php echo !empty($category_filter) ? '&category='.urlencode($category_filter) : ''; ?><?php echo !empty($status_filter) ? '&status='.urlencode($status_filter) : ''; ?>" 
                       class="pagination-btn">
                        <?php echo $i; ?>
                    </a>
                <?php elseif ($i == $page - 3 || $i == $page + 3): ?>
                    <span class="pagination-ellipsis">...</span>
                <?php endif; ?>
            <?php endfor; ?>
            
            <a href="?page=<?php echo min($total_pages, $page + 1); ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?><?php echo !empty($category_filter) ? '&category='.urlencode($category_filter) : ''; ?><?php echo !empty($status_filter) ? '&status='.urlencode($status_filter) : ''; ?>" 
               class="pagination-btn <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                بعدی →
            </a>
        </nav>
    </div>
    <?php endif; ?>
</div>

<!-- ============================================
     مودال افزودن محصول
     ============================================ -->
<div id="addProductModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width: 600px;">
        <div class="modal-header">
            <span class="modal-title">➕ افزودن محصول جدید</span>
            <button class="modal-close" onclick="closeAddProductModal()">✕</button>
        </div>
        <div class="modal-body">
            <form id="addProductForm" method="POST" action="product_process.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">عنوان محصول <span class="required">*</span></label>
                    <input type="text" name="title" class="form-input" placeholder="عنوان محصول را وارد کنید" required>
                </div>
                <div class="form-group">
                    <label class="form-label">دسته‌بندی <span class="required">*</span></label>
                    <select name="category" class="form-select" required>
                        <option value="">انتخاب دسته‌بندی...</option>
                        <option value="قالب وب‌سایت">قالب وب‌سایت</option>
                        <option value="قالب اپلیکیشن">قالب اپلیکیشن</option>
                        <option value="طراحی UI/UX">طراحی UI/UX</option>
                        <option value="ابزار توسعه">ابزار توسعه</option>
                        <option value="گرافیک">گرافیک</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">توضیحات</label>
                    <textarea name="description" class="form-textarea" rows="3" placeholder="توضیحات محصول..."></textarea>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:var(--space-3);">
                    <div class="form-group">
                        <label class="form-label">قیمت (تومان) <span class="required">*</span></label>
                        <input type="number" name="price" class="form-input" placeholder="مثال: 349000" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">قیمت اصلی (برای تخفیف)</label>
                        <input type="number" name="discount_price" class="form-input" placeholder="مثال: 465000">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">وضعیت</label>
                    <select name="status" class="form-select">
                        <option value="1">فعال</option>
                        <option value="0">غیرفعال</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">تصویر محصول</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                    <span class="form-help">فرمت‌های مجاز: jpg, png, gif - حداکثر ۲ مگابایت</span>
                </div>
                <input type="hidden" name="action" value="add">
                <button type="submit" class="btn btn-primary" style="width:100%;">ایجاد محصول</button>
            </form>
        </div>
    </div>
</div>

<!-- ============================================
     مودال ویرایش محصول
     ============================================ -->
<div id="editProductModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width: 600px;">
        <div class="modal-header">
            <span class="modal-title">✏️ ویرایش محصول</span>
            <button class="modal-close" onclick="closeEditProductModal()">✕</button>
        </div>
        <div class="modal-body">
            <form id="editProductForm" method="POST" action="product_process.php" enctype="multipart/form-data">
                <input type="hidden" name="product_id" id="edit_product_id">
                <div class="form-group">
                    <label class="form-label">عنوان محصول <span class="required">*</span></label>
                    <input type="text" name="title" id="edit_title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">دسته‌بندی <span class="required">*</span></label>
                    <select name="category" id="edit_category" class="form-select" required>
                        <option value="">انتخاب دسته‌بندی...</option>
                        <option value="قالب وب‌سایت">قالب وب‌سایت</option>
                        <option value="قالب اپلیکیشن">قالب اپلیکیشن</option>
                        <option value="طراحی UI/UX">طراحی UI/UX</option>
                        <option value="ابزار توسعه">ابزار توسعه</option>
                        <option value="گرافیک">گرافیک</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">توضیحات</label>
                    <textarea name="description" id="edit_description" class="form-textarea" rows="3"></textarea>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:var(--space-3);">
                    <div class="form-group">
                        <label class="form-label">قیمت (تومان) <span class="required">*</span></label>
                        <input type="number" name="price" id="edit_price" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">قیمت اصلی (برای تخفیف)</label>
                        <input type="number" name="discount_price" id="edit_discount_price" class="form-input">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">وضعیت</label>
                    <select name="status" id="edit_status" class="form-select">
                        <option value="1">فعال</option>
                        <option value="0">غیرفعال</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">تصویر محصول (اختیاری)</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                    <span class="form-help">برای تغییر تصویر، فایل جدید انتخاب کنید</span>
                </div>
                <input type="hidden" name="action" value="edit">
                <button type="submit" class="btn btn-primary" style="width:100%;">ذخیره تغییرات</button>
            </form>
        </div>
    </div>
</div>

<!-- ============================================
     اسکریپت‌های جاوااسکریپت
     ============================================ -->
<script>
    // ============ Select All ============
    function toggleAllCheckboxes() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
    }
    
    // ============ Add Product Modal ============
    function openAddProductModal() {
        document.getElementById('addProductModal').style.display = 'flex';
        document.getElementById('addProductModal').classList.add('active');
    }
    
    function closeAddProductModal() {
        document.getElementById('addProductModal').style.display = 'none';
        document.getElementById('addProductModal').classList.remove('active');
    }
    
    // ============ Edit Product Modal ============
    function editProduct(id) {
        fetch('product_process.php?action=get&id=' + id)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('edit_product_id').value = data.product.id;
                    document.getElementById('edit_title').value = data.product.title;
                    document.getElementById('edit_category').value = data.product.category;
                    document.getElementById('edit_description').value = data.product.description;
                    document.getElementById('edit_price').value = data.product.price;
                    document.getElementById('edit_discount_price').value = data.product.discount_price;
                    document.getElementById('edit_status').value = data.product.status;
                    
                    document.getElementById('editProductModal').style.display = 'flex';
                    document.getElementById('editProductModal').classList.add('active');
                } else {
                    alert('خطا در دریافت اطلاعات محصول');
                }
            })
            .catch(error => {
                alert('خطا در ارتباط با سرور');
            });
    }
    
    function closeEditProductModal() {
        document.getElementById('editProductModal').style.display = 'none';
        document.getElementById('editProductModal').classList.remove('active');
    }
    
    // ============ View Product ============
    function viewProduct(id) {
        window.location.href = 'product_view.php?id=' + id;
    }
    
    // ============ Toggle Product Status ============
    function toggleProductStatus(id, status) {
        const action = status == 1 ? 'فعال' : 'غیرفعال';
        if (confirm('آیا مطمئن هستید که میخواهید این محصول را ' + action + ' کنید؟')) {
            fetch('product_process.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=toggle&id=' + id + '&status=' + status
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('خطا در تغییر وضعیت محصول');
                }
            })
            .catch(error => {
                alert('خطا در ارتباط با سرور');
            });
        }
    }
    
    // ============ Delete Product ============
    function deleteProduct(id) {
        if (confirm('آیا مطمئن هستید که میخواهید این محصول را حذف کنید؟ این عمل غیرقابل بازگشت است!')) {
            if (confirm('تأیید نهایی: آیا واقعاً میخواهید این محصول را حذف کنید؟')) {
                fetch('product_process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=delete&id=' + id
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('خطا در حذف محصول: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('خطا در ارتباط با سرور');
                });
            }
        }
    }
    
    // ============ بستن مودال با کلیک روی overlay ============
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
                this.classList.remove('active');
            }
        });
    });
</script>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>
</body>
</html>