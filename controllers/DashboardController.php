<?php

class DashboardController extends Controller {
    private $articleModel;
    private $categoryModel;

    public function __construct() {
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }

    // Displays the news feed, handling pagination and optional category filtering
    public function index($categorySlug = null) {
        $limit = 30; // Increased limit to show 30 articles at once
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        $categoryId = null;
        $activeCategory = null;

        if ($categorySlug) {
            $category = $this->categoryModel->getBySlug($categorySlug);
            if ($category) {
                $categoryId = $category['id'];
                $activeCategory = $category;
            }
        }

        $articles = $this->articleModel->getPaginated($limit, $offset, $categoryId);
        $totalArticles = $this->articleModel->countTotal($categoryId);
        $totalPages = ceil($totalArticles / $limit);
        
        $categories = $this->categoryModel->getAll();

        // Check bookmarks if user is logged in
        $bookmarkedIds = [];
        if (isset($_SESSION['user_id'])) {
            require_once 'models/Bookmark.php';
            $bookmarkModel = new Bookmark();
            // N+1 inefficient here, normally we'd join, but for MVP it's okay, or we can fetch all bookmarked IDs
            foreach ($articles as $art) {
                if ($bookmarkModel->isBookmarked($_SESSION['user_id'], $art['id'])) {
                    $bookmarkedIds[] = $art['id'];
                }
            }
        }

        $this->render('dashboard/index', [
            'articles' => $articles,
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'bookmarkedIds' => $bookmarkedIds
        ]);
    }
}
