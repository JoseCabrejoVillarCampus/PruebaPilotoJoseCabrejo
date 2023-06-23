<?php
class topics extends connect
{
    private $queryPost = 'INSERT INTO topics(id,id_module,name_topic,start_date,end_date,description,duration_days) VALUES(:identificacion,:idmodule,:nametopic,:startdate,:enddate,:descript,:days)';
    private $queryGetAll = 'SELECT topics.id, modules.name AS modules_name,  FROM topics, INNER JOIN moduless ON topics.id_module = modules.id  WHERE topics.id=:identification ';
    private $queryUpdate = 'UPDATE topics SET id = :identificacion, id_module = :idmodule, name_topic = :nametopic, start_date = :startdate, end_date = :enddate, description = :descript, duration_days = :days WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM topics WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_module=1, public $name_topic=1, public $start_date=1, public $end_date=1, public $description=1, public $duration_days=1)
    {
        parent::__construct();
    }
    public function postTopics()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idmodule",$this->id_module);
            $res->bindValue("nametopic",$this->name_topic);
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
    public function getAllTopics()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idmodule", 1);
            $res->bindValue("nametopic", 1);
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
    public function putTopics()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idmodule",$this->id_module);
            $res->bindValue("nametopic",$this->name_topic);
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
    public function deleteTopics()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idmodule",$this->id_module);
            $res->bindValue("nametopic",$this->name_topic);
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