<?php
class routes extends connect
{
    private $queryPost = 'INSERT INTO routes(id,name_route,start_date,end_date,description,duration_month) VALUES(:identificacion,:rout,:stardate,:enddate,:descripcion,:duracion)';
    private $queryGetAll = 'SELECT * FROM routes';
    private $queryUpdate = 'UPDATE routes SET id = :identificacion, name_route = :rout, start_date = :stardate,end_date = :enddate, description = :descripcion, duration_month = :duracion  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM routes WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $name_route=1, public $start_date=1, public $end_date=1, public $description=1, public $duration_month=1)
    {
        parent::__construct();
    }
    public function postRoutes()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("rout",$this->name_route);
            $res->bindValue("stardate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descripcion",$this->description);
            $res->bindValue("duracion",$this->duration_month);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllRoutes()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("rout", 1);
            $res->bindValue("stardate", 1);
            $res->bindValue("enddate", 1);
            $res->bindValue("descripcion", 1);
            $res->bindValue("duracion", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putRoutes()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("rout",$this->name_route);
            $res->bindValue("stardate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descripcion",$this->description);
            $res->bindValue("duracion",$this->duration_month);
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
    public function deleteRoutes()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("rout",$this->name_route);
            $res->bindValue("stardate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descripcion",$this->description);
            $res->bindValue("duracion",$this->duration_month);
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