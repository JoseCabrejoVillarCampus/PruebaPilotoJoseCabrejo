<?php
class chapters extends connect
{
    private $queryPost = 'INSERT INTO chapters(id,id_thematic_units,name_chapter,start_date,end_date,description,duration_days) VALUES(:identificacion,:idthem,:namechap,:startdate,:enddate,:descript,:days)';
    private $queryGetAll = 'SELECT chapters.id, thematic_units.name AS thematic_units_name FROM chapters, INNER JOIN thematic_units ON chapters.id_thematic_units = thematic_units.id  WHERE chapters.id=:identification ';
    private $queryUpdate = 'UPDATE chapters SET id = :identificacion, id_thematic_units = :idthem, name_chapter = :namechap, start_date = :startdate, end_date = :enddate, description = :descript, duration_days =:days  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM chapters WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id = 1, private $id_thematic_units = 1, public $name_chapter = 1, public $start_date = 1, public $end_date = 1, public $description = 1, public $duration_days = 1)
    {
        parent::__construct();
    }
    public function postChapters()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idthem", $this->id_thematic_units);
            $res->bindValue("namechap", $this->name_chapter);
            $res->bindValue("startdate", $this->start_date);
            $res->bindValue("enddate", $this->end_date);
            $res->bindValue("descript", $this->description);
            $res->bindValue("days", $this->duration_days);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllChapters()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", 3);
            $res->bindValue("idthem", 1);
            $res->bindValue("namechap", 1);
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
    public function putChapters()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idthem", $this->id_thematic_units);
            $res->bindValue("namechap", $this->name_chapter);
            $res->bindValue("startdate", $this->start_date);
            $res->bindValue("enddate", $this->end_date);
            $res->bindValue("descript", $this->description);
            $res->bindValue("days", $this->duration_days);
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
    public function deleteChapters()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idthem", $this->id_thematic_units);
            $res->bindValue("namechap", $this->name_chapter);
            $res->bindValue("startdate", $this->start_date);
            $res->bindValue("enddate", $this->end_date);
            $res->bindValue("descript", $this->description);
            $res->bindValue("days", $this->duration_days);
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