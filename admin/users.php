<?php
// admin/users.php - مدیریت کاربران

require_once 'header.php';
require_once 'sidebar.php';

// ============ اتصال به دیتابیس ============
require_once '../auth/config.php';

// ============ تعریف متغیرها ============
$search = isset($_GET['search']) ? cleanInput($_GET['search']) : '';
$role_filter = isset($_GET['role']) ? cleanInput($_GET['role']) : '';
$status_filter = isset($_GET['status']) ? cleanInput($_GET['status']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

// ============ توابع (حذف cleanInput چون قبلاً تعریف شده) ============
function getRoleBadge($role) {
    if ($role == 'admin') {
        return '<span class="badge badge-danger">ادمین</span>';
    }
    return '<span class="badge badge-primary">کاربر</span>';
}

function getStatusBadge($status) {
    if ($status == 1) {
        return '<span class="badge badge-success">فعال</span>';
    }
    return '<span class="badge badge-danger">غیرفعال</span>';
}

// ============ دریافت لیست کاربران ============

// ساخت کوئری با فیلترها
$sql = "SELECT * FROM users WHERE 1=1";
$count_sql = "SELECT COUNT(*) as total FROM users WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (fullname LIKE '%$search%' OR username LIKE '%$search%' OR email LIKE '%$search%')";
    $count_sql .= " AND (fullname LIKE '%$search%' OR username LIKE '%$search%' OR email LIKE '%$search%')";
}

if (!empty($role_filter)) {
    $sql .= " AND role = '$role_filter'";
    $count_sql .= " AND role = '$role_filter'";
}

if (!empty($status_filter)) {
    $sql .= " AND status = '$status_filter'";
    $count_sql .= " AND status = '$status_filter'";
}

// مرتب‌سازی
$sql .= " ORDER BY id DESC LIMIT $offset, $per_page";

// دریافت تعداد کل
$total_result = $conn->query($count_sql);
$total_users = $total_result->fetch_assoc()['total'] ?? 0;
$total_pages = ceil($total_users / $per_page);

// دریافت کاربران
$users_result = $conn->query($sql);
?>
<div class="admin-content">
    <!-- نوار بالایی -->
    <div class="admin-topbar">
        <div class="topbar-title">
            <h1>👥 مدیریت کاربران</h1>
            <p>لیست و مدیریت تمام کاربران سیستم</p>
        </div>
        <div class="topbar-actions">
            <button class="mobile-menu-btn" onclick="toggleMobileSidebar()">☰</button>
            <button class="btn btn-primary btn-sm" onclick="openAddUserModal()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                افزودن کاربر
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
    
    <!-- ============ آمار کاربران ============ -->
    <?php
    $total_users_all = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'] ?? 0;
    $active_users_all = $conn->query("SELECT COUNT(*) as total FROM users WHERE status = 1")->fetch_assoc()['total'] ?? 0;
    $inactive_users_all = $conn->query("SELECT COUNT(*) as total FROM users WHERE status = 0")->fetch_assoc()['total'] ?? 0;
    $admin_users_all = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'admin'")->fetch_assoc()['total'] ?? 0;
    ?>
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--space-4); margin-bottom: var(--space-6);">
        <div class="stat-card" style="text-align:center;">
            <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--text-primary);"><?php echo number_format($total_users_all); ?></div>
            <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">کل کاربران</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--color-success-500);"><?php echo number_format($active_users_all); ?></div>
            <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">فعال</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--color-danger-500);"><?php echo number_format($inactive_users_all); ?></div>
            <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">غیرفعال</div>
        </div>
        <div class="stat-card" style="text-align:center;">
            <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--color-warning-500);"><?php echo number_format($admin_users_all); ?></div>
            <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">ادمین</div>
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
                    <input type="text" name="search" class="search-input" placeholder="جستجوی کاربر..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">جستجو</button>
            </form>
        </div>
        <form method="GET" style="display:flex; gap:var(--space-2); flex-wrap:wrap;">
            <?php if (!empty($search)): ?>
                <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <?php endif; ?>
            <select name="role" class="form-select" style="width:auto;padding-left:2rem;" onchange="this.form.submit()">
                <option value="">همه نقش‌ها</option>
                <option value="user" <?php echo $role_filter == 'user' ? 'selected' : ''; ?>>کاربر</option>
                <option value="admin" <?php echo $role_filter == 'admin' ? 'selected' : ''; ?>>ادمین</option>
            </select>
            <select name="status" class="form-select" style="width:auto;padding-left:2rem;" onchange="this.form.submit()">
                <option value="">همه وضعیت‌ها</option>
                <option value="1" <?php echo $status_filter == '1' ? 'selected' : ''; ?>>فعال</option>
                <option value="0" <?php echo $status_filter == '0' ? 'selected' : ''; ?>>غیرفعال</option>
            </select>
            <?php if (!empty($role_filter) || !empty($status_filter) || !empty($search)): ?>
                <a href="users.php" class="btn btn-outline btn-sm">حذف فیلترها</a>
            <?php endif; ?>
        </form>
    </div>
    
    <!-- ============ جدول کاربران ============ -->
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:40px;">
                        <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes()">
                    </th>
                    <th>کاربر</th>
                    <th>ایمیل</th>
                    <th>نقش</th>
                    <th>وضعیت</th>
                    <th>تاریخ ثبت نام</th>
                    <th style="text-align:center;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users_result && $users_result->num_rows > 0): ?>
                    <?php while ($user = $users_result->fetch_assoc()): 
                        $first_letter_user = mb_substr($user['fullname'], 0, 1, 'UTF-8');
                    ?>
                    <tr>
                        <td><input type="checkbox" class="user-checkbox" value="<?php echo $user['id']; ?>"></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:var(--space-2);">
                                <div style="width:2.2rem;height:2.2rem;border-radius:var(--radius-full);background:var(--gradient-brand);display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:var(--font-size-sm);flex-shrink:0;">
                                    <?php echo $first_letter_user; ?>
                                </div>
                                <div>
                                    <div style="font-weight:var(--font-weight-medium);color:var(--text-primary);">
                                        <?php echo htmlspecialchars($user['fullname']); ?>
                                    </div>
                                    <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);">
                                        @<?php echo htmlspecialchars($user['username']); ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo getRoleBadge($user['role']); ?></td>
                        <td><?php echo getStatusBadge($user['status']); ?></td>
                        <td><?php echo date('Y/m/d', strtotime($user['created_at'] ?? $user['registered_at'] ?? 'now')); ?></td>
                        <td style="text-align:center;">
                            <div style="display:flex; gap:var(--space-1); justify-content:center;">
                                <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="مشاهده" onclick="viewUser(<?php echo $user['id']; ?>)">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="ویرایش" onclick="editUser(<?php echo $user['id']; ?>)">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <?php if ($user['status'] == 1): ?>
                                    <button class="btn btn-icon-only btn-sm btn-warning" data-tooltip="غیرفعال کردن" onclick="toggleUserStatus(<?php echo $user['id']; ?>, 0)">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                                        </svg>
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-icon-only btn-sm btn-success" data-tooltip="فعال کردن" onclick="toggleUserStatus(<?php echo $user['id']; ?>, 1)">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polyline points="9 11 12 14 22 4"/>
                                        </svg>
                                    </button>
                                <?php endif; ?>
                                <button class="btn btn-icon-only btn-sm btn-danger" data-tooltip="حذف" onclick="deleteUser(<?php echo $user['id']; ?>)">
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
                        <td colspan="7" style="text-align:center;padding:var(--space-8);color:var(--text-tertiary);">
                            <div style="font-size:3rem;margin-bottom:var(--space-2);">📭</div>
                            <div>هیچ کاربری یافت نشد</div>
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
            نمایش <?php echo min($offset + 1, $total_users); ?> تا <?php echo min($offset + $per_page, $total_users); ?> از <?php echo number_format($total_users); ?> کاربر
        </span>
        <nav class="pagination">
            <a href="?page=<?php echo max(1, $page - 1); ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?><?php echo !empty($role_filter) ? '&role='.urlencode($role_filter) : ''; ?><?php echo !empty($status_filter) ? '&status='.urlencode($status_filter) : ''; ?>" 
               class="pagination-btn <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                ← قبلی
            </a>
            
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="pagination-btn active"><?php echo $i; ?></span>
                <?php elseif ($i == 1 || $i == $total_pages || abs($i - $page) <= 2): ?>
                    <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?><?php echo !empty($role_filter) ? '&role='.urlencode($role_filter) : ''; ?><?php echo !empty($status_filter) ? '&status='.urlencode($status_filter) : ''; ?>" 
                       class="pagination-btn">
                        <?php echo $i; ?>
                    </a>
                <?php elseif ($i == $page - 3 || $i == $page + 3): ?>
                    <span class="pagination-ellipsis">...</span>
                <?php endif; ?>
            <?php endfor; ?>
            
            <a href="?page=<?php echo min($total_pages, $page + 1); ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?><?php echo !empty($role_filter) ? '&role='.urlencode($role_filter) : ''; ?><?php echo !empty($status_filter) ? '&status='.urlencode($status_filter) : ''; ?>" 
               class="pagination-btn <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                بعدی →
            </a>
        </nav>
    </div>
    <?php endif; ?>
</div>

<!-- ============================================
     مودال افزودن کاربر
     ============================================ -->
<div id="addUserModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width: 500px;">
        <div class="modal-header">
            <span class="modal-title">➕ افزودن کاربر جدید</span>
            <button class="modal-close" onclick="closeAddUserModal()">✕</button>
        </div>
        <div class="modal-body">
            <form id="addUserForm" method="POST" action="user_process.php">
                <div class="form-group">
                    <label class="form-label">نام و نام خانوادگی <span class="required">*</span></label>
                    <input type="text" name="fullname" class="form-input" placeholder="مثال: علی رضایی" required>
                </div>
                <div class="form-group">
                    <label class="form-label">نام کاربری <span class="required">*</span></label>
                    <input type="text" name="username" class="form-input" placeholder="مثال: alireza" required>
                </div>
                <div class="form-group">
                    <label class="form-label">ایمیل <span class="required">*</span></label>
                    <input type="email" name="email" class="form-input" placeholder="example@email.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label">رمز عبور <span class="required">*</span></label>
                    <input type="password" name="password" class="form-input" placeholder="حداقل ۸ کاراکتر" required minlength="8">
                </div>
                <div class="form-group">
                    <label class="form-label">نقش</label>
                    <select name="role" class="form-select">
                        <option value="user">کاربر عادی</option>
                        <option value="admin">ادمین</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">وضعیت</label>
                    <select name="status" class="form-select">
                        <option value="1">فعال</option>
                        <option value="0">غیرفعال</option>
                    </select>
                </div>
                <input type="hidden" name="action" value="add">
                <button type="submit" class="btn btn-primary" style="width:100%;">ایجاد کاربر</button>
            </form>
        </div>
    </div>
</div>

<!-- ============================================
     مودال ویرایش کاربر
     ============================================ -->
<div id="editUserModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width: 500px;">
        <div class="modal-header">
            <span class="modal-title">✏️ ویرایش کاربر</span>
            <button class="modal-close" onclick="closeEditUserModal()">✕</button>
        </div>
        <div class="modal-body">
            <form id="editUserForm" method="POST" action="user_process.php">
                <input type="hidden" name="user_id" id="edit_user_id">
                <div class="form-group">
                    <label class="form-label">نام و نام خانوادگی <span class="required">*</span></label>
                    <input type="text" name="fullname" id="edit_fullname" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">نام کاربری <span class="required">*</span></label>
                    <input type="text" name="username" id="edit_username" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">ایمیل <span class="required">*</span></label>
                    <input type="email" name="email" id="edit_email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">رمز عبور جدید (اختیاری)</label>
                    <input type="password" name="password" class="form-input" placeholder="برای تغییر رمز وارد کنید">
                </div>
                <div class="form-group">
                    <label class="form-label">نقش</label>
                    <select name="role" id="edit_role" class="form-select">
                        <option value="user">کاربر عادی</option>
                        <option value="admin">ادمین</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">وضعیت</label>
                    <select name="status" id="edit_status" class="form-select">
                        <option value="1">فعال</option>
                        <option value="0">غیرفعال</option>
                    </select>
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
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
    }
    
    // ============ Add User Modal ============
    function openAddUserModal() {
        document.getElementById('addUserModal').style.display = 'flex';
        document.getElementById('addUserModal').classList.add('active');
    }
    
    function closeAddUserModal() {
        document.getElementById('addUserModal').style.display = 'none';
        document.getElementById('addUserModal').classList.remove('active');
    }
    
    // ============ Edit User Modal ============
    function editUser(id) {
        fetch('user_process.php?action=get&id=' + id)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('edit_user_id').value = data.user.id;
                    document.getElementById('edit_fullname').value = data.user.fullname;
                    document.getElementById('edit_username').value = data.user.username;
                    document.getElementById('edit_email').value = data.user.email;
                    document.getElementById('edit_role').value = data.user.role;
                    document.getElementById('edit_status').value = data.user.status;
                    
                    document.getElementById('editUserModal').style.display = 'flex';
                    document.getElementById('editUserModal').classList.add('active');
                } else {
                    alert('خطا در دریافت اطلاعات کاربر');
                }
            })
            .catch(error => {
                alert('خطا در ارتباط با سرور');
            });
    }
    
    function closeEditUserModal() {
        document.getElementById('editUserModal').style.display = 'none';
        document.getElementById('editUserModal').classList.remove('active');
    }
    
    // ============ View User ============
    function viewUser(id) {
        window.location.href = 'user_view.php?id=' + id;
    }
    
    // ============ Toggle User Status ============
    function toggleUserStatus(id, status) {
        const action = status == 1 ? 'فعال' : 'غیرفعال';
        if (confirm('آیا مطمئن هستید که میخواهید این کاربر را ' + action + ' کنید؟')) {
            fetch('user_process.php', {
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
                    alert('خطا در تغییر وضعیت کاربر');
                }
            })
            .catch(error => {
                alert('خطا در ارتباط با سرور');
            });
        }
    }
    
    // ============ Delete User ============
    function deleteUser(id) {
        if (confirm('آیا مطمئن هستید که میخواهید این کاربر را حذف کنید؟ این عمل غیرقابل بازگشت است!')) {
            if (confirm('تأیید نهایی: آیا واقعاً میخواهید این کاربر را حذف کنید؟')) {
                fetch('user_process.php', {
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
                        alert('خطا در حذف کاربر: ' + data.message);
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