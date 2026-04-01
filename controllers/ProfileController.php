<?php

class ProfileController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        $this->requireAuth();
        
        $user = $this->userModel->findById($_SESSION['user_id']);
        if (!$user) {
            session_destroy();
            $this->redirect('auth/login');
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
            $avatar = filter_input(INPUT_POST, 'avatar', FILTER_SANITIZE_URL);

            if (empty($name)) {
                $error = 'Name cannot be empty';
            } else {
                if ($this->userModel->updateProfile($_SESSION['user_id'], $name, $bio, $avatar)) {
                    $success = 'Profile updated successfully!';
                    $_SESSION['user_name'] = $name;
                    if ($avatar) {
                        $_SESSION['user_avatar'] = $avatar;
                    }
                    // Refresh user data
                    $user = $this->userModel->findById($_SESSION['user_id']);
                } else {
                    $error = 'Failed to update profile. Please try again.';
                }
            }
        }

        $this->render('profile/index', [
            'user' => $user,
            'error' => $error,
            'success' => $success
        ]);
    }
}
