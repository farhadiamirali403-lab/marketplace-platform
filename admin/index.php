<?php
// admin/index.php - داشبورد ادمین

require_once 'header.php';
require_once 'sidebar.php';

// ============ اتصال به دیتابیس ============
require_once '../auth/config.php';

// ============ تعریف متغیرها با مقدار پیش‌فرض ============
$users_count = 0;
$active_users = 0;
$orders_count = 0;
$total_revenue = 0;
$products_count = 0;
$tickets_count = 0;
$comments_count = 0;
$growth_percent = 0;

// ============ دریافت آمار واقعی از دیتابیس ============

// 1. تعداد کل کاربران
$result = $conn->query("SELECT COUNT(*) as total FROM users");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $users_count = $row['total'] ?? 0;
}

// 2. تعداد کاربران فعال
$result = $conn->query("SELECT COUNT(*) as total FROM users WHERE status = 1");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $active_users = $row['total'] ?? 0;
}

// 3. تعداد کل سفارشات
$result = $conn->query("SELECT COUNT(*) as total FROM orders");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $orders_count = $row['total'] ?? 0;
}

// 4. درآمد کل
$result = $conn->query("SELECT SUM(total_price) as total FROM orders WHERE status = 'paid'");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_revenue = $row['total'] ?? 0;
}

// 5. تعداد محصولات
$result = $conn->query("SELECT COUNT(*) as total FROM products");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $products_count = $row['total'] ?? 0;
}

// 6. تعداد تیکت‌های باز
$result = $conn->query("SELECT COUNT(*) as total FROM tickets WHERE status = 'open'");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tickets_count = $row['total'] ?? 0;
}

// 7. تعداد نظرات جدید
$result = $conn->query("SELECT COUNT(*) as total FROM comments WHERE status = 'pending'");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $comments_count = $row['total'] ?? 0;
}

// 8. محاسبه درصد رشد (مثلاً نسبت به ماه قبل)
// اینجا میتونی کوئری بزنی و محاسبه کنی
$growth_percent = 12; // مقدار پیش‌فرض

// ============ توابع کمکی برای فرمت کردن اعداد ============
function formatNumber($num) {
    if ($num >= 1000000) {
        return number_format($num / 1000000, 1) . 'M';
    } elseif ($num >= 1000) {
        return number_format($num / 1000, 1) . 'K';
    }
    return number_format($num);
}

function formatPrice($price) {
    if ($price >= 1000000) {
        return number_format($price / 1000000, 1) . 'M';
    } elseif ($price >= 1000) {
        return number_format($price / 1000, 1) . 'K';
    }
    return number_format($price);
}
?>
<!-- محتوای اصلی -->
<div class="admin-content">
    <!-- نوار بالایی -->
    <div class="admin-topbar">
        <div class="topbar-title">
            <h1>📊 داشبورد مدیریت</h1>
            <p>خلاصه فعالیت‌های سیستم</p>
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
    
    <!-- ============ آمار واقعی ============ -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--space-4); margin-bottom: var(--space-6);">
        <!-- کاربران -->
        <div class="stat-card">
            <div style="display:flex; align-items:center; gap:var(--space-3);">
                <div style="width:3rem;height:3rem;border-radius:var(--radius-lg);background:rgba(59,130,246,0.15);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">👥</div>
                <div>
                    <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--text-primary);"><?php echo number_format($users_count); ?></div>
                    <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">کاربران کل</div>
                </div>
            </div>
            <div style="margin-top:var(--space-2);font-size:var(--font-size-xs);color:var(--color-success-500);">
                ✅ <?php echo number_format($active_users); ?> کاربر فعال
            </div>
        </div>
        
        <!-- سفارشات -->
        <div class="stat-card">
            <div style="display:flex; align-items:center; gap:var(--space-3);">
                <div style="width:3rem;height:3rem;border-radius:var(--radius-lg);background:rgba(16,185,129,0.15);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🛒</div>
                <div>
                    <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--text-primary);"><?php echo number_format($orders_count); ?></div>
                    <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">سفارشات</div>
                </div>
            </div>
            <div style="margin-top:var(--space-2);font-size:var(--font-size-xs);color:var(--text-tertiary);">
                📦 سفارشات ثبت شده
            </div>
        </div>
        
        <!-- درآمد -->
        <div class="stat-card">
            <div style="display:flex; align-items:center; gap:var(--space-3);">
                <div style="width:3rem;height:3rem;border-radius:var(--radius-lg);background:rgba(245,158,11,0.15);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">💰</div>
                <div>
                    <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--text-primary);"><?php echo formatPrice($total_revenue); ?></div>
                    <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">درآمد کل</div>
                </div>
            </div>
            <div style="margin-top:var(--space-2);font-size:var(--font-size-xs);color:var(--color-success-500);">
                💳 از سفارشات پرداخت شده
            </div>
        </div>
        
        <!-- محصولات + تیکت‌ها -->
        <div class="stat-card">
            <div style="display:flex; align-items:center; gap:var(--space-3);">
                <div style="width:3rem;height:3rem;border-radius:var(--radius-lg);background:rgba(139,92,246,0.15);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">⭐</div>
                <div>
                    <div style="font-size:var(--font-size-2xl);font-weight:var(--font-weight-bold);color:var(--text-primary);"><?php echo number_format($products_count); ?></div>
                    <div style="font-size:var(--font-size-sm);color:var(--text-tertiary);">محصولات</div>
                </div>
            </div>
            <div style="margin-top:var(--space-2);font-size:var(--font-size-xs);color:var(--color-warning-500);">
                🎫 <?php echo number_format($tickets_count); ?> تیکت باز
            </div>
        </div>
    </div>
    
    <!-- ============ بقیه محتوای داشبورد ============ -->
    <!-- نمودار و فعالیت‌ها -->
    <div style="display:grid; grid-template-columns: 2fr 1fr; gap: var(--space-6);">
        <!-- نمودار -->
        <div class="chart-container">
            <div class="chart-header">
                <div class="chart-title">📈 آمار فروش ماهانه</div>
                <select class="form-select" style="width:auto;padding-left:2rem;font-size:var(--font-size-xs);">
                    <option>۶ ماه اخیر</option>
                    <option>۱۲ ماه اخیر</option>
                    <option>۳ ماه اخیر</option>
                </select>
            </div>
            <div class="chart-body">
                <div style="display:flex; align-items:flex-end; justify-content:space-between; height:200px; padding-top:var(--space-4); gap:var(--space-2);">
                    <div style="display:flex; flex-direction:column; align-items:center; flex:1;">
                        <div style="height:80px; width:100%; background:var(--accent-primary); border-radius:var(--radius-sm) var(--radius-sm) 0 0; opacity:0.7;"></div>
                        <span style="font-size:var(--font-size-xs);color:var(--text-tertiary);margin-top:var(--space-1);">فروردین</span>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:center; flex:1;">
                        <div style="height:120px; width:100%; background:var(--accent-primary); border-radius:var(--radius-sm) var(--radius-sm) 0 0; opacity:0.8;"></div>
                        <span style="font-size:var(--font-size-xs);color:var(--text-tertiary);margin-top:var(--space-1);">اردیبهشت</span>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:center; flex:1;">
                        <div style="height:100px; width:100%; background:var(--accent-primary); border-radius:var(--radius-sm) var(--radius-sm) 0 0; opacity:0.9;"></div>
                        <span style="font-size:var(--font-size-xs);color:var(--text-tertiary);margin-top:var(--space-1);">خرداد</span>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:center; flex:1;">
                        <div style="height:160px; width:100%; background:var(--accent-primary); border-radius:var(--radius-sm) var(--radius-sm) 0 0;"></div>
                        <span style="font-size:var(--font-size-xs);color:var(--text-tertiary);margin-top:var(--space-1);">تیر</span>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:center; flex:1;">
                        <div style="height:140px; width:100%; background:var(--accent-primary); border-radius:var(--radius-sm) var(--radius-sm) 0 0; opacity:0.95;"></div>
                        <span style="font-size:var(--font-size-xs);color:var(--text-tertiary);margin-top:var(--space-1);">مرداد</span>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:center; flex:1;">
                        <div style="height:180px; width:100%; background:var(--accent-primary); border-radius:var(--radius-sm) var(--radius-sm) 0 0; opacity:0.85;"></div>
                        <span style="font-size:var(--font-size-xs);color:var(--text-tertiary);margin-top:var(--space-1);">شهریور</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- فعالیت‌های اخیر -->
        <div class="card">
            <div class="card-header">
                <span class="font-semibold text-sm">🕐 فعالیت‌های اخیر</span>
            </div>
            <div class="card-body" style="padding:var(--space-4);">
                <div style="display:flex;flex-direction:column;gap:var(--space-3);">
                    <div style="display:flex;align-items:center;gap:var(--space-2);padding:var(--space-2) 0;border-bottom:1px solid var(--border-secondary);">
                        <span style="font-size:1.25rem;">👤</span>
                        <div style="flex:1;">
                            <div style="font-size:var(--font-size-sm);color:var(--text-primary);">کاربر جدید ثبت نام کرد</div>
                            <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);">۵ دقیقه پیش</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:var(--space-2);padding:var(--space-2) 0;border-bottom:1px solid var(--border-secondary);">
                        <span style="font-size:1.25rem;">🛒</span>
                        <div style="flex:1;">
                            <div style="font-size:var(--font-size-sm);color:var(--text-primary);">سفارش جدید ثبت شد</div>
                            <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);">۱۵ دقیقه پیش</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:var(--space-2);padding:var(--space-2) 0;border-bottom:1px solid var(--border-secondary);">
                        <span style="font-size:1.25rem;">💬</span>
                        <div style="flex:1;">
                            <div style="font-size:var(--font-size-sm);color:var(--text-primary);">تیکت جدید دریافت شد</div>
                            <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);">۳۰ دقیقه پیش</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:var(--space-2);padding:var(--space-2) 0;border-bottom:1px solid var(--border-secondary);">
                        <span style="font-size:1.25rem;">💰</span>
                        <div style="flex:1;">
                            <div style="font-size:var(--font-size-sm);color:var(--text-primary);">پرداخت موفق انجام شد</div>
                            <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);">۱ ساعت پیش</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:var(--space-2);padding:var(--space-2) 0;">
                        <span style="font-size:1.25rem;">⭐</span>
                        <div style="flex:1;">
                            <div style="font-size:var(--font-size-sm);color:var(--text-primary);">نظر جدید ثبت شد</div>
                            <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);">۲ ساعت پیش</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- جدول آخرین کاربران -->
    <div style="margin-top:var(--space-6);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-4);">
            <h3 style="font-size:var(--font-size-lg);font-weight:var(--font-weight-semibold);color:var(--text-primary);">👥 آخرین کاربران ثبت نام شده</h3>
            <a href="users.php" class="btn btn-ghost btn-sm">مشاهده همه</a>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>کاربر</th>
                        <th>ایمیل</th>
                        <th>نقش</th>
                        <th>تاریخ ثبت نام</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // دریافت آخرین کاربران از دیتابیس
                    $result = $conn->query("SELECT id, fullname, username, email, role, status, created_at FROM users ORDER BY id DESC LIMIT 5");
                    if ($result && $result->num_rows > 0) {
                        while ($user = $result->fetch_assoc()) {
                            $role_badge = ($user['role'] == 'admin') ? 'badge-danger' : 'badge-primary';
                            $status_badge = ($user['status'] == 1) ? 'badge-success' : 'badge-danger';
                            $status_text = ($user['status'] == 1) ? 'فعال' : 'غیرفعال';
                            $first_letter_user = mb_substr($user['fullname'], 0, 1, 'UTF-8');
                            ?>
                            <tr>
                                <td>
                                    <div style="display:flex; align-items:center; gap:var(--space-2);">
                                        <div style="width:2rem;height:2rem;border-radius:var(--radius-full);background:var(--gradient-brand);display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:var(--font-size-sm);"><?php echo $first_letter_user; ?></div>
                                        <div>
                                            <div style="font-weight:var(--font-weight-medium);color:var(--text-primary);"><?php echo htmlspecialchars($user['fullname']); ?></div>
                                            <div style="font-size:var(--font-size-xs);color:var(--text-tertiary);">@<?php echo htmlspecialchars($user['username']); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><span class="badge <?php echo $role_badge; ?>"><?php echo ($user['role'] == 'admin') ? 'ادمین' : 'کاربر'; ?></span></td>
                                <td><?php echo date('Y/m/d', strtotime($user['created_at'])); ?></td>
                                <td><span class="badge <?php echo $status_badge; ?>"><?php echo $status_text; ?></span></td>
                                <td>
                                    <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="ویرایش">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>
                                    <button class="btn btn-icon-only btn-sm btn-danger" data-tooltip="حذف">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" style="text-align:center;color:var(--text-tertiary);">هیچ کاربری یافت نشد</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>
</body>
</html>