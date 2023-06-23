<?php
class modules extends connect
{
    private $queryPost = 'INSERT INTO modules(id,name_module,start_date,end_date,description,duration_days,id_theme) VALUES(:identificacion,:namemodul,:stardate,:enddate,:descripcion,:duracion,:idtheme)';
    private $queryGetAll = 'SELECT modules.id, themes.name AS themes_name, FROM modules, INNER JOIN themes ON modules.id_theme = themes.id WHERE modules.id=:identification ';
    private $queryUpdate = 'UPDATE modules SET id = :identificacion, name_module = :namemodul, start_date = :stardate, end_date = :enddate, description = :descripcion, duration_days = :duracion, id_theme = :idtheme  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM modules WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $name_module=1, public $start_date=1, public $end_date=1, public $description=1, public $duration_days=1, private $id_theme=1)
    {
        parent::__construct();
    }
    public function postModules()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("namemodul",$this->name_module);
            $res->bindValue("stardate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descripcion",$this->description);
            $res->bindValue("duracion",$this->duration_days);
            $res->bindValue("idtheme",$this->id_theme);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllModules()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("namemodul", 1);
            $res->bindValue("stardate", 1);
            $res->bindValue("enddate", 1);
            $res->bindValue("descripcion", 1);
            $res->bindValue("duracion", 1);
            $res->bindValue("idtheme", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putModules()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("namemodul",$this->name_module);
            $res->bindValue("stardate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descripcion",$this->description);
            $res->bindValue("duracion",$this->duration_days);
            $res->bindValue("idtheme",$this->id_theme);
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
    public function deleteModules()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("namemodul",$this->name_module);
            $res->bindValue("stardate",$this->start_date);
            $res->bindValue("enddate",$this->end_date);
            $res->bindValue("descripcion",$this->description);
            $res->bindValue("duracion",$this->duration_days);
            $res->bindValue("idtheme",$this->id_theme);
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