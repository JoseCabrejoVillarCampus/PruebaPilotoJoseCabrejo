<?php
class psychologist extends connect
{
    private $queryPost = 'INSERT INTO psychologist(id,id_staff,id_route,id_academic_area_psycologist,id_position,id_team_educator) VALUES(:identificacion,:idstaff,:idrout,:areapsyco,:posicion,:teameducator)';
    private $queryGetAll = 'SELECT * FROM psychologist';
    private $queryUpdate = 'UPDATE psychologist SET id = :identificacion, id_staff = :idstaff, id_route = :idrout,id_academic_area_psycologist = :areapsyco, id_position = :posicion, id_team_educator = :teameducator  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM psychologist WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, private $id_route=1, private $id_academic_area_psycologist=1, private $id_position=1, private $id_team_educator=1)
    {
        parent::__construct();
    }
    public function postPsychologist()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("idrout",$this->id_route);
            $res->bindValue("areapsyco", $this->id_academic_area_psycologist);
            $res->bindValue("posicion",$this->id_position);
            $res->bindValue("teameducator",$this->id_team_educator);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllPsychologist()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idstaff", 1);
            $res->bindValue("idrout", 1);
            $res->bindValue("areapsyco", 1);
            $res->bindValue("posicion",1);
            $res->bindValue("teameducator",1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putPsychologist()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("idrout",$this->id_route);
            $res->bindValue("areapsyco", $this->id_academic_area_psycologist);
            $res->bindValue("posicion",$this->id_position);
            $res->bindValue("teameducator",$this->id_team_educator);
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
    public function deletePsychologist()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("idrout",$this->id_route);
            $res->bindValue("areapsyco", $this->id_academic_area_psycologist);
            $res->bindValue("posicion",$this->id_position);
            $res->bindValue("teameducator",$this->id_team_educator);
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