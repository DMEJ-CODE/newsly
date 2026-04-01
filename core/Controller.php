<?php
class Controller {
    
    // Render a view using the main layout
    protected function render($view, $data = []) {
        // Extract variables to be available in the view
        extract($data);
        
        // Use output buffering to render the view content
        ob_start();
        $viewPath = 'views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("View not found: " . $viewPath);
        }
        $content = ob_get_clean();
        
        // Render the main layout wrapping the view content
        require 'views/layouts/main.php';
    }

    // Redirect to a specific URL
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit();
    }
    
    // Ensure the current user is authenticated, else redirect to login
    protected function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
    }
    
    // Ensure the current user is an admin
    protected function requireAdmin() {
        $this->requireAuth();
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            $this->redirect('dashboard');
        }
    }
    
    // Ensure the current user is guest (not logged in)
    protected function requireGuest() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }
    }
}
