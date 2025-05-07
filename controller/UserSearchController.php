<?php
class UserSearchController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function searchUserData($userId, $query) {
        try {
            // Search in user's own data
            $stmt = $this->pdo->prepare("
                SELECT user_id, username, first_name, last_name, email, phone, dob, 
                       profile_photo, role, status, created_at 
                FROM user 
                WHERE user_id = :userId 
                AND (
                    username LIKE :query 
                    OR first_name LIKE :query 
                    OR last_name LIKE :query 
                    OR email LIKE :query
                    OR phone LIKE :query
                )
            ");
            
            $searchQuery = "%$query%";
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':query', $searchQuery);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }

    public function getRecentActivity($userId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT activity_type, activity_date, description 
                FROM user_activity 
                WHERE user_id = :userId 
                ORDER BY activity_date DESC 
                LIMIT 5
            ");
            
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }

    public function logActivity($userId, $activityType, $description = '') {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO user_activity (user_id, activity_type, description)
                VALUES (:userId, :activityType, :description)
            ");
            
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':activityType', $activityType);
            $stmt->bindParam(':description', $description);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?> 