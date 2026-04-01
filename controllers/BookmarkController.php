<?php

class BookmarkController extends Controller {
    private $bookmarkModel;

    public function __construct() {
        $this->bookmarkModel = new Bookmark();
    }

    // Toggle bookmark status using Auth requirements
    public function toggle() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleId = isset($_POST['article_id']) ? (int)$_POST['article_id'] : null;
            $redirectUrl = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : 'dashboard';

            if ($articleId) {
                if ($this->bookmarkModel->isBookmarked($_SESSION['user_id'], $articleId)) {
                    $this->bookmarkModel->remove($_SESSION['user_id'], $articleId);
                } else {
                    $this->bookmarkModel->add($_SESSION['user_id'], $articleId);
                }
            }
            
            // Redirect back to where they were, or back to the referral URL
            if (isset($_SERVER['HTTP_REFERER'])) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->redirect($redirectUrl);
            }
        }
    }

    // Displays the user's saved items (like a dashboard feed but only bookmarked)
    public function index() {
        $this->requireAuth();
        
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        require_once 'models/Article.php';
        $articleModel = new Article();
        
        $articles = $articleModel->getBookmarksPaginated($_SESSION['user_id'], $limit, $offset);
        $totalArticles = $articleModel->countBookmarksTotal($_SESSION['user_id']);
        $totalPages = ceil($totalArticles / $limit);

        // All of these are by definition bookmarked
        $bookmarkedIds = array_column($articles, 'id');

        $this->render('bookmarks/index', [
            'articles' => $articles,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'bookmarkedIds' => $bookmarkedIds
        ]);
    }
}
