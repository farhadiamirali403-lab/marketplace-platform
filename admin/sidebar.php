<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="admin-sidebar" id="adminSidebar">
    <!-- برند -->
    <a href="index.php" class="sidebar-brand">
        <div class="brand-icon">R</div>
        <div>
            <div class="brand-text">R_REX</div>
            <span class="brand-badge">مدیریت</span>
        </div>
    </a>
    
    <!-- منو -->
    <div class="sidebar-section">
        <div class="sidebar-section-title">داشبورد</div>
        <a href="index.php" class="sidebar-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
            <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/>
            </svg>
            <span>داشبورد</span>
        </a>
    </div>
    
    <div class="sidebar-section">
        <div class="sidebar-section-title">مدیریت</div>
        <a href="users.php" class="sidebar-link <?php echo $current_page == 'users.php' ? 'active' : ''; ?>">
            <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            <span>کاربران</span>
            <span class="link-badge">۱۲</span>
        </a>
        <a href="products.php" class="sidebar-link <?php echo $current_page == 'products.php' ? 'active' : ''; ?>">
            <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"/>
                <circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
            </svg>
            <span>محصولات</span>
            <span class="link-badge">۲۴</span>
        </a>
        <a href="orders.php" class="sidebar-link <?php echo $current_page == 'orders.php' ? 'active' : ''; ?>">
            <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
            </svg>
            <span>سفارشات</span>
            <span class="link-badge">۸</span>
        </a>
        <a href="tickets.php" class="sidebar-link <?php echo $current_page == 'tickets.php' ? 'active' : ''; ?>">
            <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
            <span>تیکت‌ها</span>
            <span class="link-badge">۵</span>
        </a>
        <a href="comments.php" class="sidebar-link <?php echo $current_page == 'comments.php' ? 'active' : ''; ?>">
            <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
            </svg>
            <span>نظرات</span>
            <span class="link-badge">۳</span>
        </a>
    </div>
    
    <div class="sidebar-section">
        <div class="sidebar-section-title">سیستم</div>
        <a href="settings.php" class="sidebar-link <?php echo $current_page == 'settings.php' ? 'active' : ''; ?>">
            <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/>
            </svg>
            <span>تنظیمات</span>
        </a>
        <a href="../auth/logout.php" class="sidebar-link">
            <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            <span>خروج</span>
        </a>
    </div>
</div>

<!-- Overlay برای موبایل -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleMobileSidebar()"></div>

<script>
    function toggleMobileSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('mobile-open');
        overlay.classList.toggle('active');
    }
</script>