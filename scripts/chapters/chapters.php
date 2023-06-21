<?php
class chapters extends connect
{
    private $queryPost = 'INSERT INTO chapters(id,id_thematic_units,name_chapter,start_date,end_date,description,duration_days) VALUES(:identificacion,:idthem,:namechap,:startdate,:enddate,:descript,:days)';
    private $queryGetAll = 'SELECT * FROM chapters';
    private $queryUpdate = 'UPDATE chapters SET id = :identificacion, id_thematic_units = :idthem, name_chapter = :namechap, start_date = :startdate, end_date = :enddate, description = :descript, duration_days =:days  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM chapters WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(public $id = 1, public $id_thematic_units = 1, private $name_chapter = 1, private $start_date = 1, private $end_date = 1, private $description = 1,private $duration_days = 1)
    {
        parent::__construct();
    }
    public function postChapters()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("id", $this->id);
            $res->bindValue("id_thematic_units", $this->id_team_schedule);
            $res->bindValue("name_chapter", $this->id_route);
            $res->bindValue("start_date", $this->id_trainer);
            $res->bindValue("end_date", $this->id_psycologist);
            $res->bindValue("description", $this->id_teacher);
            $res->bindValue("duration_days", $this->id_level);
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
            $res->bindValue("id", $this->id);
            $res->bindValue("id_thematic_units", $this->id_team_schedule);
            $res->bindValue("name_chapter", $this->id_route);
            $res->bindValue("start_date", $this->id_trainer);
            $res->bindValue("end_date", $this->id_psycologist);
            $res->bindValue("description", $this->id_teacher);
            $res->bindValue("duration_days", $this->id_level);
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
            $res->bindValue("id", $this->id);
            $res->bindValue("id_thematic_units", $this->id_team_schedule);
            $res->bindValue("name_chapter", $this->id_route);
            $res->bindValue("start_date", $this->id_trainer);
            $res->bindValue("end_date", $this->id_psycologist);
            $res->bindValue("description", $this->id_teacher);
            $res->bindValue("duration_days", $this->id_level);
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
            $res->bindValue("id", $this->id);
            $res->bindValue("id_thematic_units", $this->id_team_schedule);
            $res->bindValue("name_chapter", $this->id_route);
            $res->bindValue("start_date", $this->id_trainer);
            $res->bindValue("end_date", $this->id_psycologist);
            $res->bindValue("description", $this->id_teacher);
            $res->bindValue("duration_days", $this->id_level);
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