<?php
class tutors extends connect
{
    private $queryPost = 'INSERT INTO tutors(id,id_staff,id_academic_area,id_position) VALUES(:identificacion,:idstaff,:idacademicarea,:posicion)';
    private $queryGetAll = 'SELECT tutors.id, staff.name AS staff_name, academic_area.name AS academic_area_name, position.name AS position_name FROM tutors, INNER JOIN staff ON tutors.id_staff = staff.id INNER JOIN academic_area ON soft_skills.id_academic_area = academic_area.id INNER JOIN position ON tutors.id_position = position.id WHERE tutors.id=:identification ';
    private $queryUpdate = 'UPDATE tutors SET id = :identificacion, id_staff = :idstaff, id_academic_area = :idacademicarea, id_position = :posicion WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM tutors WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, private $id_academic_area=1, private $id_position=1)
    {
        parent::__construct();
    }
    public function postTutors()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("idacademicarea",$this->id_academic_area);
            $res->bindValue("posicion",$this->id_position);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllTutors()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idstaff", 1);
            $res->bindValue("idacademicarea", 1);
            $res->bindValue("posicion", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putTutors()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("idacademicarea",$this->id_academic_area);
            $res->bindValue("posicion",$this->id_position);
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
    public function deleteTutors()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("idacademicarea",$this->id_academic_area);
            $res->bindValue("posicion",$this->id_position);
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