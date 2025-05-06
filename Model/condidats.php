<?php
class Condidats
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $linkedin;
    private $portfolio;
    private $lettre_motivation;
    private $cv;
    private $date_creation;

    public function __construct(
        $id,
        $nom,
        $prenom,
        $email,
        $telephone,
        $linkedin,
        $portfolio,
        $lettre_motivation,
        $cv,
        DateTime $date_creation
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->linkedin = $linkedin;
        $this->portfolio = $portfolio;
        $this->lettre_motivation = $lettre_motivation;
        $this->cv = $cv;
        $this->date_creation = $date_creation;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getLinkedin()
    {
        return $this->linkedin;
    }

    public function getPortfolio()
    {
        return $this->portfolio;
    }

    public function getLettreMotivation()
    {
        return $this->lettre_motivation;
    }

    public function getCv()
    {
        return $this->cv;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }
}
?>
</x