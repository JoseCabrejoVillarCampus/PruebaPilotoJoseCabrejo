<?php
class campers extends connect
{
    private $queryPost = 'INSERT INTO campers(id_journey_camper,id_level_camper,id_route_camper,id_staff_camper,id_team_schedule_camper,id_trainer_camper) VALUES(:idjourncamper,:idlvlcamp,:idrout,:idstaffcamp,:idteam,:idtrainer)';
    private $queryGetAll = 'SELECT * FROM campers';
    private $queryUpdate = 'UPDATE campers SET id_journey_camper = :idjourncamper, id_level_camper = :idlvlcamp, id_route_camper = :idrout, id_staff_camper = :idstaffcamp, id_team_schedule_camper = :idteam,id_trainer_camper = :idtrainer   WHERE id_journey_camper = :idjourncamper';
    private $queryDelete = 'DELETE FROM campers WHERE id_journey_camper = :idjourncamper';
    private $message;
    use getInstance;
    function __construct(public $id_journey_camper=1, public $id_level_camper=1, private $id_route_camper=1, private $id_staff_camper=1, private $id_team_schedule_camper=1, private $id_trainer_camper=1)
    {
        parent::__construct();
    }
    public function postAdminArea()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("idjourncamper", $this->id_journey_camper);
            $res->bindValue("idlvlcamp", $this->id_level_camper);
            $res->bindValue("idrout", $this->id_route_camper);
            $res->bindValue("idstaffcamp", $this->id_staff_camper);
            $res->bindValue("idteam", $this->id_team_schedule_camper);
            $res->bindValue("idtrainer", $this->id_trainer_camper);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllAdminArea()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("idjourncamper", $this->id_journey_camper);
            $res->bindValue("idlvlcamp", $this->id_level_camper);
            $res->bindValue("idrout", $this->id_route_camper);
            $res->bindValue("idstaffcamp", $this->id_staff_camper);
            $res->bindValue("idteam", $this->id_team_schedule_camper);
            $res->bindValue("idtrainer", $this->id_trainer_camper);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putAdminArea()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("idjourncamper", $this->id_journey_camper);
            $res->bindValue("idlvlcamp", $this->id_level_camper);
            $res->bindValue("idrout", $this->id_route_camper);
            $res->bindValue("idstaffcamp", $this->id_staff_camper);
            $res->bindValue("idteam", $this->id_team_schedule_camper);
            $res->bindValue("idtrainer", $this->id_trainer_camper);
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
    public function deleteAdminArea()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("idjourncamper", $this->id_journey_camper);
            $res->bindValue("idlvlcamp", $this->id_level_camper);
            $res->bindValue("idrout", $this->id_route_camper);
            $res->bindValue("idstaffcamp", $this->id_staff_camper);
            $res->bindValue("idteam", $this->id_team_schedule_camper);
            $res->bindValue("idtrainer", $this->id_trainer_camper);
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