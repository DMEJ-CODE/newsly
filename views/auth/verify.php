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
    <div class="col-12 col-md-6 col-lg-5 col-xl-4 z-1 text-center">
        <div class="auth-card p-4 p-md-5">
            <?php if (isset($success) && $success): ?>
                <div class="text-success mb-4">
                    <i class="bi bi-patch-check-fill" style="font-size: 4rem;"></i>
                </div>
                <h3 class="fw-bold mt-2">Email Verified!</h3>
                <p class="text-muted mb-4">Your email address has been successfully verified. You now have full access to Newsly.</p>
                
                <div class="d-grid mt-4">
                    <a href="<?= BASE_URL ?>auth/login" class="btn btn-primary-custom py-2 fw-semibold rounded-3 shadow-sm">
                        Continue to Login <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            <?php else: ?>
                <div class="text-danger mb-4">
                    <i class="bi bi-x-circle-fill" style="font-size: 4rem;"></i>
                </div>
                <h3 class="fw-bold mt-2">Verification Failed</h3>
                <p class="text-muted mb-4">The verification link is invalid or has expired.</p>
                
                <div class="d-grid mt-4">
                    <a href="<?= BASE_URL ?>auth/login" class="btn btn-outline-secondary py-2 fw-semibold rounded-3 shadow-sm">
                        Back to Login
                    </a>
                </div>
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