<?php
class reviewskills extends connect
{
    private $queryPost = 'INSERT INTO review_skills(id,id_team_schedule,id_journey,id_tutor,id_location) VALUES(:identificacion,:team,:journey,:tutor,:locacion)';
    private $queryGetAll = 'SELECT * FROM review_skills';
    private $queryUpdate = 'UPDATE review_skills SET id = :identificacion, id_team_schedule = :team, id_journey = :journey,id_tutor = :tutor, id_location = :locacion  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM review_skills WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_team_schedule=1, private $id_journey=1, private $id_tutor=1, private $id_location=1)
    {
        parent::__construct();
    }
    public function postReviewSkills()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("team",$this->id_team_schedule);
            $res->bindValue("journey",$this->id_journey);
            $res->bindValue("tutor",$this->id_tutor);
            $res->bindValue("locacion",$this->id_location);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllReviewSkills()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("team", 1);
            $res->bindValue("journey", 1);
            $res->bindValue("tutor", 1);
            $res->bindValue("locacion", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putReviewSkills()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("team",$this->id_team_schedule);
            $res->bindValue("journey",$this->id_journey);
            $res->bindValue("tutor",$this->id_tutor);
            $res->bindValue("locacion",$this->id_location);
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
    public function deleteReviewSkills()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("team",$this->id_team_schedule);
            $res->bindValue("journey",$this->id_journey);
            $res->bindValue("tutor",$this->id_tutor);
            $res->bindValue("locacion",$this->id_location);
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