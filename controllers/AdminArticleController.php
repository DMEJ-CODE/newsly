<?php

class AdminArticleController extends Controller {
    private $articleModel;
    private $categoryModel;

    public function __construct() {
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }

    public function index() {
        $this->requireAdmin();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $articles = $this->articleModel->getPaginated($limit, $offset);
        $totalArticles = $this->articleModel->countTotal();
        $totalPages = ceil($totalArticles / $limit);

        $success = $_SESSION['admin_success'] ?? '';
        $error = $_SESSION['admin_error'] ?? '';
        unset($_SESSION['admin_success'], $_SESSION['admin_error']);

        $this->render('admin/articles/index', [
            'articles' => $articles,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'success' => $success,
            'error' => $error
        ]);
    }

    public function create() {
        $this->requireAdmin();
        $error = '';
        $categories = $this->categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            // Allow basic HTML for content using typical basic sanitize logic or pure POST with prepared statements (PDO protects against SQLi, XSS is handled on output typically, but for admin we allow HTML)
            $content = $_POST['content'] ?? ''; 
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
            $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);
            $source_name = filter_input(INPUT_POST, 'source_name', FILTER_SANITIZE_STRING);
            $source_url = filter_input(INPUT_POST, 'source_url', FILTER_SANITIZE_URL);
            $published_at = $_POST['published_at'] ?? date('Y-m-d H:i:s');

            if (empty($title) || empty($content) || empty($category_id)) {
                $error = 'Title, Content, and Category are required.';
            } else {
                if ($this->articleModel->create($title, $content, $category_id, $image_url, $source_name, $source_url, $published_at)) {
                    $_SESSION['admin_success'] = 'Article published successfully.';
                    $this->redirect('admin/articles');
                } else {
                    $error = 'Failed to publish article.';
                }
            }
        }

        $this->render('admin/articles/form', [
            'categories' => $categories,
            'error' => $error
        ]);
    }

    public function edit($id) {
        $this->requireAdmin();
        $error = '';
        $article = $this->articleModel->getById($id);
        $categories = $this->categoryModel->getAll();

        if (!$article) {
            $_SESSION['admin_error'] = 'Article not found.';
            $this->redirect('admin/articles');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $content = $_POST['content'] ?? '';
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
            $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);
            $source_name = filter_input(INPUT_POST, 'source_name', FILTER_SANITIZE_STRING);
            $source_url = filter_input(INPUT_POST, 'source_url', FILTER_SANITIZE_URL);
            $published_at = $_POST['published_at'] ?? date('Y-m-d H:i:s');

            if (empty($title) || empty($content) || empty($category_id)) {
                $error = 'Title, Content, and Category are required.';
            } else {
                if ($this->articleModel->update($id, $title, $content, $category_id, $image_url, $source_name, $source_url, $published_at)) {
                    $_SESSION['admin_success'] = 'Article updated successfully.';
                    $this->redirect('admin/articles');
                } else {
                    $error = 'Failed to update article.';
                }
            }
        }

        $this->render('admin/articles/form', [
            'article' => $article,
            'categories' => $categories,
            'error' => $error
        ]);
    }

    public function delete($id) {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->articleModel->delete($id)) {
                $_SESSION['admin_success'] = 'Article deleted successfully.';
            } else {
                $_SESSION['admin_error'] = 'Failed to delete article.';
            }
        }

        $this->redirect('admin/articles');
    }
}
