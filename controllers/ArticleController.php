<?php

class ArticleController extends Controller {
    private $articleModel;

    public function __construct() {
        $this->articleModel = new Article();
    }

    public function show($id = null) {
        if (!$id) {
            $this->redirect('dashboard');
        }

        $article = $this->articleModel->getById($id);
        
        if (!$article) {
            die("Article not found.");
        }

        $isBookmarked = false;
        if (isset($_SESSION['user_id'])) {
            require_once 'models/Bookmark.php';
            $bookmarkModel = new Bookmark();
            $isBookmarked = $bookmarkModel->isBookmarked($_SESSION['user_id'], $id);
        }

        $this->render('articles/show', [
            'article' => $article,
            'isBookmarked' => $isBookmarked
        ]);
    }
}
