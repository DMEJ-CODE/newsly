<style>
    :root {
        --primary-color: #facc15;
        --primary-hover: #eab308;
        --primary-light: #fef3c7;
        --dark-color: #1e293b;
        --dark-hover: #0f172a;
        --light-bg: #f8fafc;
        --card-bg: #ffffff;
        --input-bg: #f3f4f6;
        --accent-color: #eab308;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --text-primary: #1e293b;
    }

    body.dark-mode {
        --dark-color: #f8fafc;
        --dark-hover: #ffffff;
        --light-bg: #0f172a;
        --card-bg: #1e293b;
        --input-bg: #334155;
        --text-muted: #94a3b8;
        --border-color: #334155;
        --text-primary: #f8fafc;
    }

    body.dark-mode .bg-light {
        background-color: var(--light-bg) !important;
    }

    body.dark-mode .text-dark {
        color: var(--dark-color) !important;
    }

    body.dark-mode .text-muted {
        color: var(--text-muted) !important;
    }

    body.dark-mode .btn-outline-pill {
        border-color: var(--border-color);
        color: var(--dark-color);
    }

    body.dark-mode .btn-outline-pill:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--dark-color);
    }
</style>
<div class="row justify-content-center align-items-center min-vh-75 px-responsive py-responsive">
    <!-- Theme Toggle -->
    <button id="themeToggleAuth" class="position-absolute top-0 end-0 m-4 btn btn-link text-dark p-0 border-0 z-3">
        <i class="bi bi-moon-stars fs-5"></i>
    </button>
    <div class="col-12 col-sm-10 col-md-6 col-lg-5 col-xl-4 z-1">
        <div class="auth-card p-4 p-md-5">
            <div class="text-center mb-5">
                <div class="bg-primary-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-shield-lock text-primary-custom fs-1"></i>
                </div>
                <h2 class="fw-extrabold mt-3" style="font-size: clamp(1.5rem, 3vw, 2rem);">Reset Password</h2>
                <p class="text-muted" style="font-size: clamp(0.85rem, 1.5vw, 0.95rem);">Enter your email and we'll send you a link to reset it.</p>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger border-0 rounded-3 px-3 px-md-4 py-3 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="alert alert-success border-0 rounded-3 px-3 px-md-4 py-3 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= $success ?>
                </div>
            <?php else: ?>
                <form action="<?= BASE_URL ?>auth/forgot" method="POST">
                    <div class="mb-4">
                        <label for="email" class="form-label small fw-bold text-uppercase">Registered Email</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" class="form-control form-control-custom border-start-0 ps-0" id="email" name="email" placeholder="you@example.com" required autofocus>
                        </div>
                    </div>
                    
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary-custom py-3 fw-semibold">
                            Send Reset Link <i class="bi bi-envelope-paper ms-2"></i>
                        </button>
                    </div>
                </form>
            <?php endif; ?>
            
            <div class="text-center pt-3 border-top">
                <a href="<?= BASE_URL ?>auth/login" class="text-primary-custom text-decoration-none fw-semibold small d-inline-flex align-items-center gap-1">
                    <i class="bi bi-chevron-left"></i> Back to Login
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Theme toggle functionality
    const themeToggleAuth = document.getElementById('themeToggleAuth');
    if(themeToggleAuth) {
        themeToggleAuth.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                icon.className = 'bi bi-sun fs-5';
            } else {
                localStorage.setItem('theme', 'light');
                icon.className = 'bi bi-moon-stars fs-5';
            }
        });
    }

    // Initialize theme on page load
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        const icon = document.querySelector('#themeToggleAuth i');
        if(icon) icon.className = 'bi bi-sun fs-5';
    }
</script>