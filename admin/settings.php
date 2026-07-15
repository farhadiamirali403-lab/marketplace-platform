<?php
// admin/settings.php - تنظیمات

require_once 'header.php';
require_once 'sidebar.php';
?>
<div class="admin-content">
    <div class="admin-topbar">
        <div class="topbar-title">
            <h1>⚙️ تنظیمات</h1>
            <p>تنظیمات عمومی سیستم</p>
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
    
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: var(--space-6);">
        <!-- تنظیمات عمومی -->
        <div class="card">
            <div class="card-header">
                <span class="font-semibold text-sm">🔧 تنظیمات عمومی</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">نام سایت</label>
                    <input type="text" class="form-input" value="R_REX">
                </div>
                <div class="form-group">
                    <label class="form-label">توضیحات سایت</label>
                    <textarea class="form-textarea" rows="3">اکوسیستم دیجیتال ابری ایران</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">ایمیل پشتیبانی</label>
                    <input type="email" class="form-input" value="support@r-rex.com">
                </div>
                <button class="btn btn-primary">ذخیره تغییرات</button>
            </div>
        </div>
        
        <!-- تنظیمات ظاهری -->
        <div class="card">
            <div class="card-header">
                <span class="font-semibold text-sm">🎨 تنظیمات ظاهری</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">تم سایت</label>
                    <select class="form-select">
                        <option>تاریک</option>
                        <option>روشن</option>
                        <option>سیستم</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">رنگ اصلی</label>
                    <input type="color" class="form-input" style="height:3rem;padding:0.25rem;" value="#3b82f6">
                </div>
                <button class="btn btn-primary">ذخیره تغییرات</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/theme.js"></script>
<script src="../js/components.js"></script>
<script src="../js/app.js"></script>
</body>
</html>