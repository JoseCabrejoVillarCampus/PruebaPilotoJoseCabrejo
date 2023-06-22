<?php
class softwareskills extends connect
{
    private $queryPost = 'INSERT INTO software_skills(id,id_team_schedule,id_journey,id_trainer,id_location,id_subject) VALUES(:identificacion,:idteam,:idjpurneys,:idtrainer,:location,:subject)';
    private $queryGetAll = 'SELECT * FROM software_skills';
    private $queryUpdate = 'UPDATE software_skills SET id = :identificacion, id_team_schedule = :idteam, id_journey = :idjpurneys,id_trainer = :idtrainer, id_location = :location, id_subject = :subject  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM software_skills WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_team_schedule=1, private $id_journey=1, private $id_trainer=1, private $id_location=1, private $id_subject=1)
    {
        parent::__construct();
    }
    public function postSoftwareSkill()
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
    public function getAllSoftwareSkill()
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
    public function putSoftwareSkill()
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
    public function deleteSoftwareSkill()
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