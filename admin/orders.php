<?php
// admin/orders.php - مدیریت سفارشات

require_once 'header.php';
require_once 'sidebar.php';
?>
<div class="admin-content">
    <div class="admin-topbar">
        <div class="topbar-title">
            <h1>📋 مدیریت سفارشات</h1>
            <p>لیست و مدیریت تمام سفارشات</p>
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
    
    <!-- فیلترها -->
    <div style="display:flex; gap:var(--space-3); margin-bottom:var(--space-4); flex-wrap:wrap;">
        <select class="form-select" style="width:auto;padding-left:2rem;">
            <option>همه وضعیت‌ها</option>
            <option>در انتظار پرداخت</option>
            <option>پرداخت شده</option>
            <option>در حال ارسال</option>
            <option>تحویل شده</option>
            <option>لغو شده</option>
        </select>
        <input type="date" class="form-input" style="width:auto;" placeholder="از تاریخ">
        <input type="date" class="form-input" style="width:auto;" placeholder="تا تاریخ">
    </div>
    
    <!-- جدول سفارشات -->
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>شماره سفارش</th>
                    <th>مشتری</th>
                    <th>محصول</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                    <th style="text-align:center;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>#ORD-۱۰۲۴</strong></td>
                    <td>علی رضایی</td>
                    <td>قالب شرکتی مدرن</td>
                    <td>۳۴۹,۰۰۰ تومان</td>
                    <td><span class="badge badge-warning">در انتظار</span></td>
                    <td>۱۴۰۴/۰۴/۱۵</td>
                    <td style="text-align:center;">
                        <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="مشاهده">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                        <button class="btn btn-icon-only btn-sm btn-success" data-tooltip="تایید">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><strong>#ORD-۱۰۲۳</strong></td>
                    <td>سارا احمدی</td>
                    <td>کیت طراحی اپلیکیشن</td>
                    <td>۵۹۰,۰۰۰ تومان</td>
                    <td><span class="badge badge-success">پرداخت شده</span></td>
                    <td>۱۴۰۴/۰۴/۱۴</td>
                    <td style="text-align:center;">
                        <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="مشاهده">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><strong>#ORD-۱۰۲۲</strong></td>
                    <td>محمد کریمی</td>
                    <td>پلاگین VS Code</td>
                    <td>۱۹۹,۰۰۰ تومان</td>
                    <td><span class="badge badge-danger">لغو شده</span></td>
                    <td>۱۴۰۴/۰۴/۱۳</td>
                    <td style="text-align:center;">
                        <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="مشاهده">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:var(--space-4);">
        <span style="font-size:var(--font-size-sm);color:var(--text-tertiary);">نمایش ۱-۳ از ۳۴۵ سفارش</span>
        <nav class="pagination">
            <button class="pagination-btn" disabled>← قبلی</button>
            <button class="pagination-btn active">۱</button>
            <button class="pagination-btn">۲</button>
            <button class="pagination-btn">۳</button>
            <span class="pagination-ellipsis">...</span>
            <button class="pagination-btn">۱۲</button>
            <button class="pagination-btn">بعدی →</button>
        </nav>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>
</body>
</html>