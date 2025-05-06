<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Condidats.php');

class CondidatsC
{
    public function listCondidats()
    {
        $sql = "SELECT * FROM Condidats";
        $db = config::getConnexion();
        try {
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error fetching candidates: ' . $e->getMessage());
        }
    }

    public function deleteCondidats($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception('Invalid candidate ID');
        }

        $sql = "DELETE FROM Condidats WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error deleting candidate: ' . $e->getMessage());
        }
    }

    public function addCondidats($Condidats)
    {
        // Validate required fields
        if (
            empty($Condidats->getNom()) ||
            empty($Condidats->getPrenom()) ||
            empty($Condidats->getEmail()) ||
            empty($Condidats->getTelephone())
        ) {
            throw new Exception('Required fields (nom, prenom, email, telephone) cannot be empty');
        }

        $sql = "INSERT INTO Condidats 
                (nom, prenom, email, telephone, linkedin, portfolio, lettre_motivation, cv, date_creation)
                VALUES 
                (:nom, :prenom, :email, :telephone, :linkedin, :portfolio, :lettre_motivation, :cv, :date_creation)";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $Condidats->getNom(),
                'prenom' => $Condidats->getPrenom(),
                'email' => $Condidats->getEmail(),
                'telephone' => $Condidats->getTelephone(),
                'linkedin' => $Condidats->getLinkedin() ?: null,
                'portfolio' => $Condidats->getPortfolio() ?: null,
                'lettre_motivation' => $Condidats->getLettreMotivation() ?: null,
                'cv' => $Condidats->getCv() ?: null,
                'date_creation' => $Condidats->getDateCreation()->format('Y-m-d H:i:s')
            ]);
            return $db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception('Error adding candidate: ' . $e->getMessage());
        }
    }

    public function getCondidatById($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception('Invalid candidate ID');
        }

        $sql = "SELECT * FROM Condidats WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
        } catch (PDOException $e) {
            throw new Exception('Error fetching candidate: ' . $e->getMessage());
        }
    }

    public function updateCondidat($id, $data)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception('Invalid candidate ID');
        }

        // Validate required fields
        if (
            empty($data['nom']) ||
            empty($data['prenom']) ||
            empty($data['email']) ||
            empty($data['telephone'])
        ) {
            throw new Exception('Required fields (nom, prenom, email, telephone) cannot be empty');
        }

        $sql = "UPDATE Condidats 
                SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, 
                    linkedin = :linkedin, portfolio = :portfolio, lettre_motivation = :lettre_motivation, cv = :cv 
                WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute([
                'id' => $id,
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'linkedin' => $data['linkedin'] ?: null,
                'portfolio' => $data['portfolio'] ?: null,
                'lettre_motivation' => $data['lettre_motivation'] ?: null,
                'cv' => $data['cv'] ?: null
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error updating candidate: ' . $e->getMessage());
        }
    }

    public function showCondidats($id)
    {
        return $this->getCondidatById($id);
    }
}
?>