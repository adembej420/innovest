<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Model/CondidatsSkills.php';

class CondidatsSkillsC
{
    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }

    // CREATE - Add a new skill
    public function addCondidatsSkills($condidatsSkills)
    {
        if (!$this->validateSkill($condidatsSkills)) {
            throw new Exception("Invalid skill data provided");
        }

        $sql = "INSERT INTO condidats_skills (condidats_id, skill_name, skill_level) 
                VALUES (:condidats_id, :skill_name, :skill_level)";
        
        try {
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                'condidats_id' => $condidatsSkills->getCondidatsId(),
                'skill_name' => $condidatsSkills->getSkillName(),
                'skill_level' => $condidatsSkills->getSkillLevel()
            ]);
            
            return $result ? $this->db->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("Error in addCondidatsSkills: " . $e->getMessage());
            throw new Exception('Error adding skill: ' . $e->getMessage());
        }
    }

    // READ - Get all skills with candidate information
    public function listCondidatsSkills()
    {
        $sql = "SELECT cs.skill_id, cs.condidats_id, cs.skill_name, cs.skill_level, c.nom, c.prenom 
                FROM condidats_skills cs 
                LEFT JOIN condidats c ON cs.condidats_id = c.id 
                ORDER BY cs.skill_id DESC";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in listCondidatsSkills: " . $e->getMessage());
            throw new Exception('Error retrieving skills: ' . $e->getMessage());
        }
    }

    // READ - Get single skill
    public function getSkillById($skill_id)
    {
        if (!is_numeric($skill_id) || $skill_id <= 0) {
            throw new Exception("Invalid skill ID");
        }

        $sql = "SELECT * FROM condidats_skills WHERE skill_id = :skill_id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['skill_id' => $skill_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log("Error in getSkillById: " . $e->getMessage());
            throw new Exception('Error retrieving skill: ' . $e->getMessage());
        }
    }

    // READ - Get skills by candidate ID
    public function getSkillsByCondidatsId($condidats_id)
    {
        if (!is_numeric($condidats_id) || $condidats_id <= 0) {
            throw new Exception("Invalid candidate ID");
        }

        $sql = "SELECT * FROM condidats_skills WHERE condidats_id = :condidats_id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['condidats_id' => $condidats_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getSkillsByCondidatsId: " . $e->getMessage());
            throw new Exception('Error retrieving candidate skills: ' . $e->getMessage());
        }
    }

    // UPDATE - Update skill
    public function updateSkill($skill_id, $data) {
        $query = "UPDATE condidats_skills SET skill_name = :skill_name, skill_level = :skill_level WHERE skill_id = :skill_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':skill_id', $skill_id, PDO::PARAM_INT);
        $stmt->bindParam(':skill_name', $data['skill_name'], PDO::PARAM_STR);
        $stmt->bindParam(':skill_level', $data['skill_level'], PDO::PARAM_STR);
        $result = $stmt->execute();
        if (!$result) {
            error_log("Update failed: " . print_r($stmt->errorInfo(), true));
        }
        return $result;
    }

    // DELETE - Delete skill
    public function deleteCondidatsSkills($skill_id)
    {
        if (!is_numeric($skill_id) || $skill_id <= 0) {
            throw new Exception("Invalid skill ID");
        }

        $sql = "DELETE FROM condidats_skills WHERE skill_id = :skill_id";
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(['skill_id' => $skill_id]);
        } catch (PDOException $e) {
            error_log("Error in deleteCondidatsSkills: " . $e->getMessage());
            throw new Exception('Error deleting skill: ' . $e->getMessage());
        }
    }

    // Validation helper method
    private function validateSkill($condidatsSkills)
    {
        return is_numeric($condidatsSkills->getCondidatsId()) &&
               !empty($condidatsSkills->getSkillName()) &&
               strlen($condidatsSkills->getSkillName()) <= 100 &&
               in_array($condidatsSkills->getSkillLevel(), ['Beginner', 'Intermediate', 'Advanced', 'Expert']);
    }
}