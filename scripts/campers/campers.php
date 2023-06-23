<?php
class campers extends connect
{
    private $queryPost = 'INSERT INTO campers(id,id_team_schedule,id_route,id_trainer,id_psycologist,id_teacher,id_level,id_journey,id_staff) VALUES(:identificacion,:idteam,:idrout,:idtrainer,:idpsy,:idteacher, :idlvl, :idjourney, :idstaff)';
    private $queryGetAll = 'SELECT campers.id, team_schedules.name AS team_schedule_name, routes.name AS routes_name, trainers.name AS trainers_name, psychologist.name AS psychologist_name, teachers.name AS teachers_name, levels.name AS levels_name, journeys.name AS journeyss_name FROM campers, INNER JOIN team_schedules ON campers.id_team_schedule = team_schedules.id INNER JOIN routes ON campers.id_route = route.id INNER JOIN trainers ON campers.id_trainer = trainers.id INNER JOIN psychologist ON campers.id_psycologist = psychologist.id INNER JOIN teachers ON campers.id_teacher = teacher.id INNER JOIN levels ON campers.id_level = level.id INNER JOIN journeys ON campers.id_journey = journey.id INNER JOIN staff ON campers.id_staff = staff.id WHERE campers.id=:identification ';
    private $queryUpdate = 'UPDATE campers SET id = :identificacion, id_team_schedule = :idteam, id_route = :idrout, id_trainer = :idtrainer, id_psycologist = :idpsy, id_teacher = :idteacher, id_level =:idlvl, id_journey =:idjourney, id_staff=:idstaff  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM campers WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id = 1, private $id_team_schedule = 1, private $id_route = 1, private $id_trainer = 1, private $id_psycologist = 1, private $id_teacher = 1,private $id_level = 1, private $id_journey = 1, private $id_staff = 1)
    {
        parent::__construct();
    }
    public function postCamper()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idrout", $this->id_route);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idpsy", $this->id_psycologist);
            $res->bindValue("idteacher", $this->id_teacher);
            $res->bindValue("idlvl", $this->id_level);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idstaff", $this->id_staff);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllCamper()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idteam", 1);
            $res->bindValue("idrout", 1);
            $res->bindValue("idtrainer", 1);
            $res->bindValue("idpsy", 1);
            $res->bindValue("idteacher", 1);
            $res->bindValue("idlvl", 1);
            $res->bindValue("idjourney", 1);
            $res->bindValue("idstaff", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putCamper()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idrout", $this->id_route);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idpsy", $this->id_psycologist);
            $res->bindValue("idteacher", $this->id_teacher);
            $res->bindValue("idlvl", $this->id_level);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idstaff", $this->id_staff);
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
    public function deleteCamper()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idrout", $this->id_route);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idpsy", $this->id_psycologist);
            $res->bindValue("idteacher", $this->id_teacher);
            $res->bindValue("idlvl", $this->id_level);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idstaff", $this->id_staff);
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