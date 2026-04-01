<?php

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        $this->requireGuest();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_avatar'] = $user['avatar'];
                $_SESSION['is_admin'] = $user['is_admin'] ?? 0;

                // Handle "Remember Me"
                if (isset($_POST['remember'])) {
                    $token = bin2hex(random_bytes(32));
                    $this->userModel->setRememberToken($user['id'], $token);
                    // Set cookie for 30 days
                    setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/');
                }

                $this->redirect('dashboard');
            } else {
                $error = 'Invalid email or password.';
            }
        }

        $this->render('auth/login', ['error' => $error]);
    }

    public function register() {
        $this->requireGuest();
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $agreeTerms = isset($_POST['agree_terms']);

            if (!$agreeTerms) {
                $error = 'You must agree to the Terms & Conditions.';
            } elseif ($this->userModel->findByEmail($email)) {
                $error = 'Email already exists. Log in instead.';
            } else {
                $token = bin2hex(random_bytes(32));
                if ($this->userModel->create($name, $email, $password, $token)) {
                    // Log the user in immediately after registration
                    $newUser = $this->userModel->findByEmail($email);
                    $_SESSION['user_id'] = $newUser['id'];
                    $_SESSION['user_name'] = $newUser['name'];
                    $_SESSION['user_avatar'] = $newUser['avatar'];
                    $_SESSION['is_admin'] = $newUser['is_admin'] ?? 0;
                    $this->redirect('dashboard');
                } else {
                    $error = 'Registration failed. Try again later.';
                }
            }
        }

        $this->render('auth/register', ['error' => $error, 'success' => $success]);
    }

    public function verify($token = '') {
        $this->requireGuest();
        if (empty($token)) {
            $this->redirect('auth/login');
        }

        $user = $this->userModel->findByVerificationToken($token);
        if ($user) {
            $this->userModel->verifyEmail($user['id']);
            $this->render('auth/verify', ['success' => true]);
        } else {
            $this->render('auth/verify', ['success' => false]);
        }
    }

    public function forgot() {
        $this->requireGuest();
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $user = $this->userModel->findByEmail($email);
            
            if ($user) {
                $token = bin2hex(random_bytes(32));
                $this->userModel->setResetToken($email, $token);
                // Mock sending email
                $success = "A password reset link has been generated. <a href='" . BASE_URL . "auth/reset/" . $token . "' class='fw-bold'>Click here to reset your password.</a>";
            } else {
                // Return success anyway to prevent email enumeration
                $success = "If an account exists with that email, a reset link has been sent.";
            }
        }
        
        $this->render('auth/forgot', ['error' => $error, 'success' => $success]);
    }

    public function reset($token = null) {
        $this->requireGuest();
        $error = '';
        $success = '';
        
        if (empty($token)) {
            $this->redirect('auth/login');
        }

        $user = $this->userModel->findByResetToken($token);
        if (!$user) {
            $error = 'Invalid or expired reset token.';
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['password_confirm'] ?? '';

            if(strlen($password) < 6) {
                 $error = "Password must be at least 6 characters.";
            } elseif ($password !== $confirm) {
                $error = 'Passwords do not match.';
            } else {
                $this->userModel->updatePassword($user['id'], $password);
                $success = 'Password successfully reset! You can now login.';
            }
        }

        $this->render('auth/reset', ['token' => $token, 'error' => $error, 'success' => $success, 'user' => $user]);
    }

    public function logout() {
        // Clear remember token
        if (isset($_SESSION['user_id'])) {
            $this->userModel->setRememberToken($_SESSION['user_id'], null);
        }
        setcookie('remember_token', '', time() - 3600, '/');
        
        session_destroy();
        $this->redirect('auth/login');
    }
}
