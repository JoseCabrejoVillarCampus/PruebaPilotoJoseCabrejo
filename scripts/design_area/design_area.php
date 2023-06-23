<?php
class design_area extends connect
{
    private $queryPost = 'INSERT INTO design_area(id,id_area,id_staff,id_position,id_journey) VALUES(:identificacion,:idarea,:idstaff,:idposicion,:idjpurneys)';
    private $queryGetAll = 'SELECT design_area.id, areas.name AS areas_name, staff.name AS staff_name, position.name AS position_name, journeys.name AS journeys_name, INNER JOIN areas ON design_area.id_area = area.id INNER JOIN staff ON design_area.id_staff = satff.id INNER JOIN position ON design_area.id_position = position.id INNER JOIN journeys ON design_area.id_journey = journey.id  WHERE design_area.id=:identification ';
    private $queryUpdate = 'UPDATE design_area SET id = :identificacion, id_area = :idarea, id_staff = :idstaff, id_position = :idposicion, id_journey = :idjpurneys  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM design_area WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_area=1, private $id_staff=1, private $id_position=1, private $id_journeys=1)
    {
        parent::__construct();
    }
    public function postAcademicArea()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idposicion", $this->id_position);
            $res->bindValue("idjpurneys", $this->id_journey);
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
            $res->bindValue("identificacion", 3);
            $res->bindValue("idarea", 1);
            $res->bindValue("idstaff", 1);
            $res->bindValue("idposicion", 1);
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
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idposicion", $this->id_position);
            $res->bindValue("idjpurneys", $this->id_journey);
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
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idposicion", $this->id_position);
            $res->bindValue("idjpurneys", $this->id_journey);
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