<?php
class CondidatsSkills
{
    private $skill_id;
    private $condidats_id;
    private $skill_name;
    private $skill_level;

    public function __construct($skill_id = null, $condidats_id = null, $skill_name = null, $skill_level = null)
    {
        $this->skill_id = $skill_id;
        $this->condidats_id = $condidats_id;
        $this->skill_name = $skill_name;
        $this->skill_level = $skill_level;
    }

    public function getSkillId() { return $this->skill_id; }
    public function setSkillId($skill_id) { $this->skill_id = $skill_id; }
    public function getCondidatsId() { return $this->condidats_id; }
    public function setCondidatsId($condidats_id) { $this->condidats_id = $condidats_id; }
    public function getSkillName() { return $this->skill_name; }
    public function setSkillName($skill_name) { $this->skill_name = $skill_name; }
    public function getSkillLevel() { return $this->skill_level; }
    public function setSkillLevel($skill_level) { $this->skill_level = $skill_level; }
}
?>