<?php
class designarea extends connect
{
    private $queryPost = 'INSERT INTO design_area(id,id_area,id_staff,id_position,id_journey) VALUES(:identificacion,:idarea,:idstaff,:idposicion,:idjpurneys)';
    private $queryGetAll = 'SELECT * FROM design_area';
    private $queryUpdate = 'UPDATE design_area SET id = :identificacion, id_staff = :id_position, id_journeys = :identificacion, idarea = :idstaff, idposicion = :idjpurneys  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM design_area WHERE id = :id_area';
    private $message;
    use getInstance;
    function __construct(public $id=1, public $id_area=1, private $id_staff=1, private $id_position=1, private $id_journeys=1)
    {
        parent::__construct();
    }
    public function postAcademicArea()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("id_area", $this->id);
            $res->bindValue("id_position", $this->id_area);
            $res->bindValue("identificacion", $this->id_staff);
            $res->bindValue("idstaff", $this->id_position);
            $res->bindValue("idjpurneys", $this->id_journeys);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllAcademicArea()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindColumn("id_area", 3);
            $res->bindColumn("id_position", 1);
            $res->bindValue("identificacion", 1);
            $res->bindValue("idstaff", 1);
            $res->bindValue("idjpurneys", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putAcademicArea()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("id_area", $this->id);
            $res->bindValue("id_position", $this->id_area);
            $res->bindValue("identificacion", $this->id_staff);
            $res->bindValue("idstaff", $this->id_position);
            $res->bindValue("idjpurneys", $this->id_journeys);
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
    public function deleteAcademicArea()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("id_area", $this->id);
            $res->bindValue("id_position", $this->id_area);
            $res->bindValue("identificacion", $this->id_staff);
            $res->bindValue("idstaff", $this->id_position);
            $res->bindValue("idjpurneys", $this->id_journeys);
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