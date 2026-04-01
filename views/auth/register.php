<!-- Split Screen Register Layout -->
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
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light py-5">
    <!-- Logo Corner (Floating) -->
    <a href="<?= BASE_URL ?>" class="position-absolute top-0 start-0 m-4 btn btn-outline-pill bg-white shadow-sm text-decoration-none px-4 py-2 z-3">
        <i class="bi bi-arrow-left me-2"></i>Back to Home
    </a>

    <!-- Theme Toggle -->
    <button id="themeToggleAuth" class="position-absolute top-0 end-0 m-4 btn btn-link text-dark p-0 border-0 z-3">
        <i class="bi bi-moon-stars fs-5"></i>
    </button>

    <div class="auth-card w-100 shadow-lg" style="max-width: 520px; transition: all 0.4s ease;">
        <div class="p-4 p-md-5">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <div class="nav-logo justify-content-center mb-3">
                    <div class="nav-logo-dot"></div>
                    <span class="fs-3 fw-bold">Newsly<sup>+</sup></span>
                </div>
                <h1 class="fw-extrabold mb-2" style="font-size: clamp(1.8rem, 4vw, 2.2rem);">Create account</h1>
                <p class="text-muted fw-medium small">Join millions of readers and get personalized news content.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger px-4 py-3 border-0 rounded-4 fw-medium mb-4" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>auth/register" method="POST" id="registerForm">
                
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="name" class="form-label small fw-bold text-uppercase text-muted">Full Name</label>
                        <input type="text" class="form-control form-control-custom w-100" id="name" name="name" placeholder="John Doe" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label small fw-bold text-uppercase text-muted">Email Address</label>
                    <input type="email" class="form-control form-control-custom w-100" id="email" name="email" placeholder="you@example.com" required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label small fw-bold text-uppercase text-muted">Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control form-control-custom w-100 pe-5" id="password" name="password" placeholder="••••••••••••••••" required minlength="6">
                        <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y border-0 text-muted p-0 me-3" id="toggleRegPassword">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                    <small class="text-muted d-block mt-2">At least 6 characters long</small>
                </div>
                
                <div class="mb-5">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" name="agree_terms" required>
                        <label class="form-check-label text-muted small" for="agreeTerms">
                            I agree to the <a href="#" class="text-primary-custom fw-bold text-decoration-none">Terms & Conditions</a>
                        </label>
                    </div>
                </div>
                
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary-custom py-3 fw-semibold shadow-sm">
                        Create Your Free Account
                    </button>
                </div>

                <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1 border-muted opacity-25">
                    <span class="px-3 text-muted small fw-medium">Or sign up with</span>
                    <hr class="flex-grow-1 border-muted opacity-25">
                </div>

                <div class="d-flex justify-content-between gap-3 mb-5">
                    <button type="button" class="btn btn-outline-pill flex-grow-1 fw-medium d-flex align-items-center justify-content-center gap-2 py-2">
                        <i class="bi bi-apple fs-5"></i><span>Apple</span>
                    </button>
                    <button type="button" class="btn btn-outline-pill flex-grow-1 fw-medium d-flex align-items-center justify-content-center gap-2 py-2">
                        <i class="bi bi-google fs-5"></i><span>Google</span>
                    </button>
                </div>

                <div class="text-center pt-4 border-top">
                    <p class="text-muted small fw-medium mb-0">
                        Already have an account? <a href="<?= BASE_URL ?>auth/login" class="text-primary-custom fw-bold text-decoration-none ms-1">Sign In instead</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#toggleRegPassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye');
        this.querySelector('i').classList.toggle('bi-eye-slash');
    });

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
