<?php
class SearchController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function searchUsers($query) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT user_id, username, first_name, last_name, email, status, role, created_at 
                FROM user 
                WHERE username LIKE :query 
                OR first_name LIKE :query 
                OR last_name LIKE :query 
                OR email LIKE :query
                ORDER BY created_at DESC
                LIMIT 10
            ");
            
            $searchQuery = "%$query%";
            $stmt->bindParam(':query', $searchQuery);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }
}
?> 