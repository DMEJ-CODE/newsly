<?php

class Bookmark {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function add($userId, $articleId) {
        try {
            $stmt = $this->db->prepare("INSERT INTO bookmarks (user_id, article_id) VALUES (:user_id, :article_id)");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Probably a duplicate key error due to UNIQUE constraint
            return false;
        }
    }

    public function remove($userId, $articleId) {
        $stmt = $this->db->prepare("DELETE FROM bookmarks WHERE user_id = :user_id AND article_id = :article_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function isBookmarked($userId, $articleId) {
        $stmt = $this->db->prepare("SELECT id FROM bookmarks WHERE user_id = :user_id AND article_id = :article_id LIMIT 1");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch() !== false;
    }
}
