<?php
class soft_skills extends connect
{
    private $queryPost = 'INSERT INTO soft_skills(id,id_team_schedule,id_journey,id_trainer,id_location,id_subject) VALUES(:identificacion,:idteam,:idjpurneys,:idtrainer,:location,:subject)';
    private $queryGetAll = 'SELECT soft_skills.id, team_schedules.name AS team_schedule_name, journeys.name AS journey_name, trainers.name AS trainer_name, locations.name AS location_name, subjects.name AS subject_name FROM soft_skills, INNER JOIN team_schedules ON soft_skills.id_team_schedule = team_schedules.id INNER JOIN journeys ON soft_skills.id_journey = journeys.id INNER JOIN trainers ON soft_skills.id_trainer = trainers.id INNER JOIN locations ON soft_skills.id_location = locations.id INNER JOIN subjects ON soft_skills.id_subject = subjects.id WHERE soft_skills.id=:identification ';
    private $queryUpdate = 'UPDATE soft_skills SET id = :identificacion, id_team_schedule = :idteam, id_journey = :idjpurneys,id_trainer = :idtrainer, id_location = :location, id_subject = :subject  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM soft_skills WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_team_schedule=1, private $id_journey=1, private $id_trainer=1, private $id_location=1, private $id_subject=1)
    {
        parent::__construct();
    }
    public function postSoftSkill()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idteam",$this->id_team_schedule);
            $res->bindValue("idjpurneys",$this->id_journey);
            $res->bindValue("idtrainer",$this->id_trainer);
            $res->bindValue("location",$this->id_location);
            $res->bindValue("subject",$this->id_subject);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllSoftSkill()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idteam", 1);
            $res->bindValue("idjpurneys", 1);
            $res->bindValue("idtrainer", 1);
            $res->bindValue("location", 1);
            $res->bindValue("subject", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putSoftSkill()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idteam",$this->id_team_schedule);
            $res->bindValue("idjpurneys",$this->id_journey);
            $res->bindValue("idtrainer",$this->id_trainer);
            $res->bindValue("location",$this->id_location);
            $res->bindValue("subject",$this->id_subject);
            $res->execute();

            if ($res->rowCount() > 0) {
                $this->message = ["Code" => 200, "Message" => "Data updated"];
            } else {
                $this->message = ["Code" => 404, "Message" => "No matching record found"];
            }
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function deleteSoftSkill()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idteam",$this->id_team_schedule);
            $res->bindValue("idjpurneys",$this->id_journey);
            $res->bindValue("idtrainer",$this->id_trainer);
            $res->bindValue("location",$this->id_location);
            $res->bindValue("subject",$this->id_subject);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
?>