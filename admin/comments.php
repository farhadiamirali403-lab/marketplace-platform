<?php
// admin/comments.php - مدیریت نظرات

require_once 'header.php';
require_once 'sidebar.php';
?>
<div class="admin-content">
    <div class="admin-topbar">
        <div class="topbar-title">
            <h1>💬 مدیریت نظرات</h1>
            <p>لیست و مدیریت نظرات کاربران</p>
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
    
    <!-- جدول نظرات -->
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>کاربر</th>
                    <th>نظر</th>
                    <th>محصول</th>
                    <th>امتیاز</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                    <th style="text-align:center;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>علی رضایی</td>
                    <td>قالب بسیار عالی و حرفه‌ای</td>
                    <td>قالب شرکتی مدرن</td>
                    <td>
                        <div class="rating">
                            <svg class="star filled" width="16" height="16" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <svg class="star filled" width="16" height="16" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <svg class="star filled" width="16" height="16" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <svg class="star filled" width="16" height="16" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <svg class="star filled" width="16" height="16" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                    </td>
                    <td><span class="badge badge-success">تایید شده</span></td>
                    <td>۱۴۰۴/۰۴/۱۵</td>
                    <td style="text-align:center;">
                        <button class="btn btn-icon-only btn-sm btn-secondary" data-tooltip="پاسخ">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                        </button>
                        <button class="btn btn-icon-only btn-sm btn-danger" data-tooltip="حذف">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
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