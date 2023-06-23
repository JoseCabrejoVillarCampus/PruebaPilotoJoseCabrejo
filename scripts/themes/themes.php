<?php
class themes extends connect
{
    private $queryPost = 'INSERT INTO themes(id,id_chapter,name_theme,start_date,end_date,description,duration_days) VALUES(:identificacion,:idchapter,:namethem,:startdate,:enddate,:descript,:days)';
    private $queryGetAll = 'SELECT themes.id, chapters.name AS chapters_name,  FROM themes, INNER JOIN chapters ON themes.id_chapter = chapters.id  WHERE themes.id=:identification ';
    private $queryUpdate = 'UPDATE themes SET id = :identificacion, id_chapter = :idchapter, name_theme = :namethem, start_date = :startdate, end_date = :enddate, description = :descript, duration_days = :days WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM themes WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_chapter=1, public $name_theme=1, public $start_date=1, public $end_date=1, public $description=1, public $duration_days=1)
    {
        parent::__construct();
    }
    public function postThems()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idchapter",$this->id_chapter);
            $res->bindValue("namethem",$this->name_theme);
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
    public function getAllThems()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idchapter", 1);
            $res->bindValue("namethem", 1);
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
    public function putThems()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idchapter",$this->id_chapter);
            $res->bindValue("namethem",$this->name_theme);
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
    public function deleteThems()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idchapter",$this->id_chapter);
            $res->bindValue("namethem",$this->name_theme);
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