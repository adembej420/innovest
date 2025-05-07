<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Register new user
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    // Get user by email (for login)
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Update user profile
    public function updateUser($id, $username, $email) {
        // Change 'name' to 'username' for consistency
        $stmt = $this->pdo->prepare("UPDATE user SET username = ?, email = ? WHERE id = ?");
        return $stmt->execute([$username, $email, $id]);
    }

    // Delete a user
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Get all users (for dashboard, maybe admin only)
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM user");
        return $stmt->fetchAll();
    }

    // Get user by ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Update user photo path
    public function updateUserPhoto($id, $photoPath) {
        $stmt = $this->pdo->prepare("UPDATE user SET photo = ? WHERE id = ?");
        return $stmt->execute([$photoPath, $id]);
    }
}
