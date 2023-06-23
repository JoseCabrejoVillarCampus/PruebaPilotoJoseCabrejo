<?php
class trainers extends connect
{
    private $queryPost = 'INSERT INTO trainers(id,id_staff,id_level,id_route,id_academic_area,id_position,id_team_educator) VALUES(:identificacion,:idstaff,:idlvl,:idroute,:idacademicarea,:posicion,:teameducator)';
    private $queryGetAll = 'SELECT trainers.id, staff.name AS staff_name, levels.name AS levels_name, routes.name AS routes_name, academic_area.name AS academic_area_name, position.name AS position_name, team_educators.name AS team_educators_name FROM trainers, INNER JOIN staff ON trainers.id_staff = staff.id INNER JOIN levels ON trainers.id_level = levels.id INNER JOIN routes ON trainers.id_route = routes.id INNER JOIN academic_area ON trainers.id_academic_area = academic_area.id INNER JOIN position ON trainers.id_position = position.id INNER JOIN team_educators ON trainers.id_team_educator = team_educator.id WHERE trainers.id=:identification ';
    private $queryUpdate = 'UPDATE trainers SET id = :identificacion, id_staff = :idstaff, id_level = :idlvl, id_route = :idroute, id_academic_area = :idacademicarea, id_position = :posicion, id_team_educator = :teameducator WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM trainers WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_module=1, public $name_topic=1, public $start_date=1, public $end_date=1, public $description=1, public $duration_days=1)
    {
        parent::__construct();
    }
    public function postTrainers()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_module);
            $res->bindValue("idlvl",$this->name_topic);
            $res->bindValue("idroute",$this->start_date);
            $res->bindValue("idacademicarea",$this->end_date);
            $res->bindValue("posicion",$this->description);
            $res->bindValue("teameducator",$this->duration_days);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllTrainers()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idstaff", 1);
            $res->bindValue("idlvl", 1);
            $res->bindValue("idroute", 1);
            $res->bindValue("idacademicarea", 1);
            $res->bindValue("posicion", 1);
            $res->bindValue("teameducator", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putTrainers()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_module);
            $res->bindValue("idlvl",$this->name_topic);
            $res->bindValue("idroute",$this->start_date);
            $res->bindValue("idacademicarea",$this->end_date);
            $res->bindValue("posicion",$this->description);
            $res->bindValue("teameducator",$this->duration_days);
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
    public function deleteTrainers()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_module);
            $res->bindValue("idlvl",$this->name_topic);
            $res->bindValue("idroute",$this->start_date);
            $res->bindValue("idacademicarea",$this->end_date);
            $res->bindValue("posicion",$this->description);
            $res->bindValue("teameducator",$this->duration_days);
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