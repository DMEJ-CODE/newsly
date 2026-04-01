<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsly - Premium News Aggregator</title>
    <!-- Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Cormorant+Garamond:ital,wght@0,600;0,700;1,600;1,700&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>public/style.css">
</head>
<body class="font-inter">
    <script>
        (function() {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
            }
        })();
    </script>

    <!-- IF LOGGED IN: SHOW SIDEBAR APP LAYOUT -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="app-wrapper">
            <!-- Left Sidebar Navigation -->
            <aside class="app-sidebar py-4 px-3">
                <a class="text-decoration-none d-flex align-items-center gap-2 mb-5 px-3" href="<?= BASE_URL ?>dashboard">
                    <div class="bg-dark-custom text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="bi bi-nintendo-switch fs-6"></i>
                    </div>
                    <span class="fs-4 fw-extrabold text-dark tracking-tight" style="letter-spacing: -1px;">Newsly</span>
                </a>

                <!-- User Mini Profile -->
                <div class="d-flex align-items-center gap-3 px-3 mb-4 bg-light rounded-4 py-2 border">
                    <?php if (!empty($_SESSION['user_avatar'])): ?>
                        <img src="<?= htmlspecialchars($_SESSION['user_avatar']) ?>" alt="Avatar" class="rounded-circle object-fit-cover" width="40" height="40">
                    <?php else: ?>
                        <div class="rounded-circle bg-warning text-dark fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <?= strtoupper(substr($_SESSION['user_name'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                    <div class="overflow-hidden">
                        <div class="fw-bold fs-6 text-truncate text-dark"><?= htmlspecialchars($_SESSION['user_name']) ?></div>
                        <div class="text-muted" style="font-size: 0.75rem;">Premium Member</div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-1 flex-grow-1">
                    <div class="px-3 text-uppercase text-muted fw-bold mb-2 mt-2" style="font-size: 0.7rem; letter-spacing: 1px;">Menu</div>
                    
                    <a href="<?= BASE_URL ?>dashboard" class="nav-pill <?= (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'active' : '' ?>">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                    
                    <a href="<?= BASE_URL ?>bookmark" class="nav-pill <?= (strpos($_SERVER['REQUEST_URI'], 'bookmark') !== false) ? 'active' : '' ?>">
                        <i class="bi bi-bookmark-star"></i> Saved
                    </a>
                    
                    <!-- We moved categories to top horizontal pills, so we just add Profile here -->
                    <a href="<?= BASE_URL ?>profile" class="nav-pill <?= (strpos($_SERVER['REQUEST_URI'], 'profile') !== false) ? 'active' : '' ?>">
                        <i class="bi bi-person"></i> Setting
                    </a>

                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <div class="px-3 text-uppercase text-muted fw-bold mb-2 mt-4" style="font-size: 0.7rem; letter-spacing: 1px;">Publishing Hub</div>
                    
                    <a href="<?= BASE_URL ?>admin/articles" class="nav-pill <?= (strpos($_SERVER['REQUEST_URI'], 'admin/articles') !== false) ? 'active' : '' ?>">
                        <i class="bi bi-journal-text text-warning"></i> Articles
                    </a>
                    
                    <a href="<?= BASE_URL ?>admin/categories" class="nav-pill <?= (strpos($_SERVER['REQUEST_URI'], 'admin/categories') !== false) ? 'active' : '' ?>">
                        <i class="bi bi-tag text-warning"></i> Categories
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Footer Actions -->
                <div class="mt-auto border-top pt-3">
                    <button id="themeToggleDesktop" class="nav-pill border-0 w-100 text-start bg-transparent mb-2">
                        <i class="bi bi-moon-stars"></i> Theme Toggle
                    </button>
                    <a href="<?= BASE_URL ?>auth/logout" class="nav-pill text-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </aside>

            <!-- Main Workspace -->
            <main class="app-main pb-5">
            <!-- Mobile Topbar (visible only on small screens) -->
                <div class="d-lg-none topbar">
                    <span class="topbar-title">Newsly</span>
                    <div class="d-flex align-items-center gap-2">
                        <button id="sidebarToggleMobile" class="btn btn-link text-dark p-0 border-0" title="Toggle Menu">
                            <i class="bi bi-list fs-5"></i>
                        </button>
                        <button id="themeToggleMobile" class="btn btn-link text-dark p-0 border-0" title="Toggle Theme">
                            <i class="bi bi-moon-stars fs-5"></i>
                        </button>
                        <a href="<?= BASE_URL ?>auth/logout" class="text-danger btn btn-link p-0 border-0" title="Logout">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                        </a>
                    </div>
                </div>

                <?= $content ?>
            </main>
            
            <!-- Mobile Bottom Native Navigation -->
            <nav class="fixed-bottom mobile-bottom-nav d-lg-none z-index-1030">
                <a href="<?= BASE_URL ?>dashboard" class="bottom-nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'active' : '' ?>">
                    <i class="bi <?= (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'bi-house-door-fill' : 'bi-house-door' ?>"></i> Feed
                </a>
                <a href="<?= BASE_URL ?>bookmark" class="bottom-nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'bookmark') !== false) ? 'active' : '' ?>">
                    <i class="bi <?= (strpos($_SERVER['REQUEST_URI'], 'bookmark') !== false) ? 'bi-bookmark-star-fill' : 'bi-bookmark-star' ?>"></i> Saved
                </a>
                <a href="<?= BASE_URL ?>profile" class="bottom-nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'profile') !== false) ? 'active' : '' ?>">
                    <i class="bi <?= (strpos($_SERVER['REQUEST_URI'], 'profile') !== false) ? 'bi-person-fill' : 'bi-person' ?>"></i> Profile
                </a>
            </nav>
        </div>

    <!-- IF GUEST: NO SIDEBAR (Perfect for Landing Page & Split Auth Forms) -->
    <?php else: ?>
        <main class="w-100">
            <?= $content ?>
        </main>
    <?php endif; ?>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
            
            // Mobile Sidebar Toggle
            const sidebarToggleMobileBtn = document.getElementById('sidebarToggleMobile');
            const appSidebar = document.querySelector('.app-sidebar');
            const appMain = document.querySelector('.app-main');
            
            if (sidebarToggleMobileBtn) {
                sidebarToggleMobileBtn.addEventListener('click', () => {
                    appSidebar.classList.toggle('mobile-open');
                    sidebarToggleMobileBtn.classList.toggle('active');
                });
            }
            
            // Close sidebar when a nav link is clicked
            const navPills = document.querySelectorAll('.nav-pill');
            navPills.forEach(pill => {
                pill.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        appSidebar.classList.remove('mobile-open');
                        if (sidebarToggleMobileBtn) {
                            sidebarToggleMobileBtn.classList.remove('active');
                        }
                    }
                });
            });
            
            // Close sidebar when clicking outside on mobile
            if (appMain) {
                appMain.addEventListener('click', () => {
                    if (window.innerWidth < 992 && appSidebar.classList.contains('mobile-open')) {
                        appSidebar.classList.remove('mobile-open');
                        if (sidebarToggleMobileBtn) {
                            sidebarToggleMobileBtn.classList.remove('active');
                        }
                    }
                });
            }
            
            // Theme Toggler Logic
            const themeToggleBtn = document.getElementById('themeToggleDesktop');
            const themeToggleMobileBtn = document.getElementById('themeToggleMobile');
            
            function updateThemeIcons() {
                const isDark = document.body.classList.contains('dark-mode');
                const iconClass = isDark ? 'bi-sun' : 'bi-moon-stars';
                const buttons = [themeToggleBtn, themeToggleMobileBtn].filter(btn => btn);
                buttons.forEach(btn => {
                    const icon = btn.querySelector('i');
                    if(icon) icon.className = `bi ${iconClass} fs-5`;
                });
            }
            
            function toggleTheme() {
                document.body.classList.toggle('dark-mode');
                if (document.body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
                updateThemeIcons();
            }
            
            if(themeToggleBtn) themeToggleBtn.addEventListener('click', toggleTheme);
            if(themeToggleMobileBtn) themeToggleMobileBtn.addEventListener('click', toggleTheme);
            
            // Initialize theme icons
            updateThemeIcons();
            
            // Handle window resize to close sidebar if resizing to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 992) {
                    appSidebar.classList.remove('mobile-open');
                    if (sidebarToggleMobileBtn) {
                        sidebarToggleMobileBtn.classList.remove('active');
                    }
                }
            });
        });
    </script>
</body>
</html>
