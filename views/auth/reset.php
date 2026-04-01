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
<div class="row justify-content-center align-items-center min-vh-75">
    <!-- Theme Toggle -->
    <button id="themeToggleAuth" class="position-absolute top-0 end-0 m-4 btn btn-link text-dark p-0 border-0 z-3">
        <i class="bi bi-moon-stars fs-5"></i>
    </button>
    <div class="col-12 col-md-6 col-lg-5 col-xl-4 z-1">
        <div class="auth-card p-4 p-md-5">
            <div class="text-center mb-4">
                <i class="bi bi-key text-primary-custom fs-1"></i>
                <h3 class="fw-bold mt-2">Reset Password</h3>
                <p class="text-muted small">Create a new secure password.</p>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger rounded-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= $success ?>
                </div>
                <div class="d-grid mt-4">
                    <a href="<?= BASE_URL ?>auth/login" class="btn btn-primary-custom py-2 fw-semibold rounded-3 shadow-sm">
                        Go to Login <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            <?php elseif (isset($user) && $user): ?>
                <form action="<?= BASE_URL ?>auth/reset/<?= htmlspecialchars($token) ?>" method="POST">
                    <div class="mb-3">
                        <label for="password" class="form-label fw-medium text-secondary">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                            <input type="password" class="form-control form-control-custom border-start-0 ps-0" id="password" name="password" placeholder="Min 6 characters" required minlength="6" autofocus>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password_confirm" class="form-label fw-medium text-secondary">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-muted"></i></span>
                            <input type="password" class="form-control form-control-custom border-start-0 ps-0" id="password_confirm" name="password_confirm" placeholder="Match new password" required minlength="6">
                        </div>
                    </div>
                    
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary-custom py-2 fw-semibold rounded-3 shadow-sm">
                            Save Password <i class="bi bi-check-lg ms-2"></i>
                        </button>
                    </div>
                </form>
            <?php endif; ?>
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