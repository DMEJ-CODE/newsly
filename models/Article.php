<?php

class Article {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getPaginated($limit, $offset, $categoryId = null) {
        $query = "SELECT a.*, c.name as category_name, c.slug as category_slug 
                  FROM articles a 
                  LEFT JOIN categories c ON a.category_id = c.id";
        
        if ($categoryId) {
            $query .= " WHERE a.category_id = :category_id";
        }
        
        $query .= " ORDER BY a.published_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($query);
        
        if ($categoryId) {
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function countTotal($categoryId = null) {
        $query = "SELECT COUNT(id) FROM articles";
        
        if ($categoryId) {
            $query .= " WHERE category_id = :category_id";
        }
        
        $stmt = $this->db->prepare($query);
        
        if ($categoryId) {
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        }
        $stmt->execute();
        
        return $stmt->fetchColumn();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT a.*, c.name as category_name, c.slug as category_slug 
                                    FROM articles a 
                                    LEFT JOIN categories c ON a.category_id = c.id 
                                    WHERE a.id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getBookmarksPaginated($userId, $limit, $offset) {
        $stmt = $this->db->prepare("
            SELECT a.*, c.name as category_name, b.created_at as bookmarked_at
            FROM articles a
            INNER JOIN bookmarks b ON a.id = b.article_id
            LEFT JOIN categories c ON a.category_id = c.id
            WHERE b.user_id = :user_id
            ORDER BY b.created_at DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countBookmarksTotal($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(id) FROM bookmarks WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function create($title, $content, $category_id, $image_url, $source_name, $source_url, $published_at) {
        $query = "INSERT INTO articles (title, content, category_id, image_url, source_name, source_url, published_at) 
                  VALUES (:title, :content, :category_id, :image_url, :source_name, :source_url, :published_at)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':source_name', $source_name);
        $stmt->bindParam(':source_url', $source_url);
        $stmt->bindParam(':published_at', $published_at);
        return $stmt->execute();
    }

    public function update($id, $title, $content, $category_id, $image_url, $source_name, $source_url, $published_at) {
        $query = "UPDATE articles SET 
                    title = :title, 
                    content = :content, 
                    category_id = :category_id, 
                    image_url = :image_url, 
                    source_name = :source_name, 
                    source_url = :source_url, 
                    published_at = :published_at 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':source_name', $source_name);
        $stmt->bindParam(':source_url', $source_url);
        $stmt->bindParam(':published_at', $published_at);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM articles WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function existsBySourceUrl($url) {
        $stmt = $this->db->prepare("SELECT COUNT(id) FROM articles WHERE source_url = :url");
        $stmt->bindParam(':url', $url);
        $stmt->execute();
        return (int)$stmt->fetchColumn() > 0;
    }
}
