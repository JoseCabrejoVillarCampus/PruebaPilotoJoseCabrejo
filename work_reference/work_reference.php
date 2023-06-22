<?php
class workreference extends connect
{
    private $queryPost = 'INSERT INTO work_reference(id,full_name,cel_number, position, company) VALUES(:identificacion,:name,:phone,:ocupacion, :comp)';
    private $queryGetAll = 'SELECT * FROM work_reference';
    private $queryUpdate = 'UPDATE work_reference SET id = :identificacion, full_name = :name, cel_number = :phone, position = :ocupacion, company = :comp WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM work_reference WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $full_name=1, public $cel_number=1, public $position=1,public $company=1)
    {
        parent::__construct();
    }
    public function postWorkRef()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->full_name);
            $res->bindValue("phone",$this->cel_number);
            $res->bindValue("ocupacion",$this->position);
            $res->bindValue("comp", $this->company);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllWorkRef()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("name", 1);
            $res->bindValue("phone", 1);
            $res->bindValue("ocupacion", 1);
            $res->bindValue("comp", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putWorkRef()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->full_name);
            $res->bindValue("phone",$this->cel_number);
            $res->bindValue("ocupacion",$this->position);
            $res->bindValue("comp", $this->company);
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
    public function deleteWorkRef()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->full_name);
            $res->bindValue("phone",$this->cel_number);
            $res->bindValue("ocupacion",$this->position);
            $res->bindValue("comp", $this->company);
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