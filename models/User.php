<?php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function findByVerificationToken($token) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE verification_token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findByResetToken($token) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE reset_token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($name, $email, $password, $verificationToken) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, verification_token) VALUES (:name, :email, :password, :token)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':token', $verificationToken);
        
        return $stmt->execute();
    }

    public function verifyEmail($userId) {
        $stmt = $this->db->prepare("UPDATE users SET email_verified_at = CURRENT_TIMESTAMP, verification_token = NULL WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function setResetToken($email, $token) {
        $stmt = $this->db->prepare("UPDATE users SET reset_token = :token WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        return $stmt->execute();
    }

    public function updatePassword($userId, $newPassword) {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE users SET password = :password, reset_token = NULL WHERE id = :id");
        $stmt->bindParam(':password', $hashed);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
    
    public function updateProfile($userId, $name, $bio, $avatar = null) {
        if ($avatar) {
            $stmt = $this->db->prepare("UPDATE users SET name = :name, bio = :bio, avatar = :avatar WHERE id = :id");
            $stmt->bindParam(':avatar', $avatar);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET name = :name, bio = :bio WHERE id = :id");
        }
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
    public function setRememberToken($userId, $token) {
        $stmt = $this->db->prepare("UPDATE users SET remember_token = :token WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':token', $token);
        return $stmt->execute();
    }

    public function findByRememberToken($token) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE remember_token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch();
    }
}
