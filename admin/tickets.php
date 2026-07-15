<?php
// admin/tickets.php - مدیریت تیکت‌ها

require_once 'header.php';
require_once 'sidebar.php';
?>
<div class="admin-content">
    <div class="admin-topbar">
        <div class="topbar-title">
            <h1>🎫 مدیریت تیکت‌ها</h1>
            <p>لیست و مدیریت تیکت‌های پشتیبانی</p>
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
    
    <!-- جدول تیکت‌ها -->
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>شماره تیکت</th>
                    <th>موضوع</th>
                    <th>کاربر</th>
                    <th>دسته‌بندی</th>
                    <th>اولویت</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                    <th style="text-align:center;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>#T-۱۰۲۴</strong></td>
                    <td>مشکل در دانلود محصول</td>
                    <td>علی رضایی</td>
                    <td><span class="badge badge-primary">فنی</span></td>
                    <td><span class="badge badge-danger">فوری</span></td>
                    <td><span class="badge badge-success">باز</span></td>
                    <td>۱۴۰۴/۰۴/۱۵</td>
                    <td style="text-align:center;">
                        <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="پاسخ">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                        </button>
                        <button class="btn btn-icon-only btn-sm btn-success" data-tooltip="بستن">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><strong>#T-۱۰۲۳</strong></td>
                    <td>سوال درباره پرداخت</td>
                    <td>سارا احمدی</td>
                    <td><span class="badge badge-warning">پرداخت</span></td>
                    <td><span class="badge badge-warning">متوسط</span></td>
                    <td><span class="badge badge-warning">در انتظار</span></td>
                    <td>۱۴۰۴/۰۴/۱۴</td>
                    <td style="text-align:center;">
                        <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="پاسخ">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>
</body>
</html>