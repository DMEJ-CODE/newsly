<?php

class AdminCategoryController extends Controller {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    public function index() {
        $this->requireAdmin();
        $categories = $this->categoryModel->getAll();
        
        $success = $_SESSION['admin_success'] ?? '';
        $error = $_SESSION['admin_error'] ?? '';
        unset($_SESSION['admin_success'], $_SESSION['admin_error']);

        $this->render('admin/categories/index', [
            'categories' => $categories,
            'success' => $success,
            'error' => $error
        ]);
    }

    public function create() {
        $this->requireAdmin();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $slug = filter_input(INPUT_POST, 'slug', FILTER_SANITIZE_STRING);
            
            if (empty($slug)) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
            }

            try {
                $this->categoryModel->create($name, $slug);
                $_SESSION['admin_success'] = 'Category created successfully.';
                $this->redirect('admin/categories');
            } catch (PDOException $e) {
                $error = 'Failed to create category. Ensure the slug is unique.';
            }
        }

        $this->render('admin/categories/form', ['error' => $error]);
    }

    public function edit($id) {
        $this->requireAdmin();
        $error = '';
        $category = $this->categoryModel->getById($id);

        if (!$category) {
            $_SESSION['admin_error'] = 'Category not found.';
            $this->redirect('admin/categories');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $slug = filter_input(INPUT_POST, 'slug', FILTER_SANITIZE_STRING);

            if (empty($slug)) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
            }

            try {
                $this->categoryModel->update($id, $name, $slug);
                $_SESSION['admin_success'] = 'Category updated successfully.';
                $this->redirect('admin/categories');
            } catch (PDOException $e) {
                $error = 'Failed to update category. Slug may already exist.';
            }
        }

        $this->render('admin/categories/form', ['category' => $category, 'error' => $error]);
    }

    public function delete($id) {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $this->categoryModel->delete($id);
                $_SESSION['admin_success'] = 'Category deleted successfully.';
            } catch (PDOException $e) {
                $_SESSION['admin_error'] = 'Failed to delete category (it may be linked to articles).';
            }
        }

        $this->redirect('admin/categories');
    }
}
