<?php

// Fix for PHP built-in web server routing
if (php_sapi_name() === 'cli-server') {
    // If the requested resource is a real file (like public/style.css, images, etc.), let PHP serve it normally
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if ($path && is_file($path)) {
        return false; 
    }
}

// Start session for auth
session_start();
 
// Entry Point - Front Controller
// Define base URL for absolute linking in views
$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];

if (php_sapi_name() === 'cli-server') {
    // For PHP built-in server (php -S), base URL is simply root
    define('BASE_URL', '/');
} else {
    // For Apache, base URL should correctly extract the subdirectory
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $base_dir = rtrim(dirname($scriptName), '/\\');
    if ($base_dir === '/') $base_dir = '';
    define('BASE_URL', $scheme . '://' . $host . $base_dir . '/');
}

// Simple Autoloader
spl_autoload_register(function ($class) {
    if (file_exists('core/' . $class . '.php')) {
        require_once 'core/' . $class . '.php';
    } elseif (file_exists('controllers/' . $class . '.php')) {
        require_once 'controllers/' . $class . '.php';
    } elseif (file_exists('models/' . $class . '.php')) {
        require_once 'models/' . $class . '.php';
    }
});

// Automatic login from "Remember Me" cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $userModel = new User();
    $user = $userModel->findByRememberToken($_COOKIE['remember_token']);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_avatar'] = $user['avatar'];
        $_SESSION['is_admin'] = $user['is_admin'] ?? 0;
    }
}

// Load the router
$router = new Router();

/* =========================================
 * DEFINE APPLICATION ROUTES HERE
 * ========================================= */

// Landing Page
$router->get('/', 'HomeController', 'index');

// Authentication Routes
$router->any('/auth/login', 'AuthController', 'login');
$router->any('/auth/register', 'AuthController', 'register');
$router->get('/auth/logout', 'AuthController', 'logout');
$router->any('/auth/forgot', 'AuthController', 'forgot');
$router->any('/auth/reset/{token}', 'AuthController', 'reset');
$router->get('/auth/verify/{token}', 'AuthController', 'verify');

// Dashboard & Feed
$router->get('/dashboard', 'DashboardController', 'index');
$router->get('/dashboard/index/{slug}', 'DashboardController', 'index');

// Articles
$router->get('/article/show/{id}', 'ArticleController', 'show');

// Bookmarks
$router->get('/bookmark', 'BookmarkController', 'index');
$router->get('/bookmark/index', 'BookmarkController', 'index');
$router->post('/bookmark/toggle', 'BookmarkController', 'toggle');

// Profile
$router->any('/profile', 'ProfileController', 'index');

// Admin Articles
$router->get('/admin/articles', 'AdminArticleController', 'index');
$router->any('/admin/articles/create', 'AdminArticleController', 'create');
$router->any('/admin/articles/edit/{id}', 'AdminArticleController', 'edit');
$router->any('/admin/articles/sync', 'AdminSyncController', 'sync');
$router->post('/admin/articles/delete/{id}', 'AdminArticleController', 'delete');

// Admin Categories
$router->get('/admin/categories', 'AdminCategoryController', 'index');
$router->any('/admin/categories/create', 'AdminCategoryController', 'create');
$router->any('/admin/categories/edit/{id}', 'AdminCategoryController', 'edit');
$router->post('/admin/categories/delete/{id}', 'AdminCategoryController', 'delete');

/* ========================================= */

// Dispatch the incoming request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
