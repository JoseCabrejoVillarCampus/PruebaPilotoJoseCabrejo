<?php
class thematic_units extends connect
{
    private $queryPost = 'INSERT INTO thematic_units(id,id_route,name_thematics_units,start_date,end_date,description,duration_days) VALUES(:identificacion,:idroute,:namethemunit,:startdate,:enddate,:descript,:days)';
    private $queryGetAll = 'SELECT thematic_units.id, routes.name AS routes_name,  FROM thematic_units, INNER JOIN routes ON thematic_units.id_route = routes.id  WHERE thematic_units.id=:identification ';
    private $queryUpdate = 'UPDATE thematic_units SET id = :identificacion, id_route = :idroute, name_thematics_units = :namethemunit, start_date = :startdate, end_date = :enddate, description = :descript, duration_days = :days WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM thematic_units WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $id_route=1, public $name_thematics_units=1, public $start_date=1, public $end_date=1, public $description=1, public $duration_days=1)
    {
        parent::__construct();
    }
    public function postThematicUnits()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idroute",$this->id_route);
            $res->bindValue("namethemunit",$this->name_thematics_units);
            $res->bindValue("startdate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descript",$this->description);
            $res->bindValue("days",$this->duration_days);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllThematicUnits()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idroute", 1);
            $res->bindValue("namethemunit", 1);
            $res->bindValue("startdate", 1);
            $res->bindValue("enddate", 1);
            $res->bindValue("descript", 1);
            $res->bindValue("days", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putThematicUnits()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idroute",$this->id_route);
            $res->bindValue("namethemunit",$this->name_thematics_units);
            $res->bindValue("startdate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descript",$this->description);
            $res->bindValue("days",$this->duration_days);
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
    public function deleteThematicUnits()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idroute",$this->id_route);
            $res->bindValue("namethemunit",$this->name_thematics_units);
            $res->bindValue("startdate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descript",$this->description);
            $res->bindValue("days",$this->duration_days);
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