<?php
class personal_ref extends connect
{
    private $queryPost = 'INSERT INTO personal_ref(id,full_name,cel_number,relationship,occupation) VALUES(:identificacion,:name,:phone,:relacion,:ocupacion)';
    private $queryGetAll = 'SELECT * FROM personal_ref';
    private $queryUpdate = 'UPDATE personal_ref SET id = :identificacion, full_name = :name, cel_number = :phone, relationship = :relacion, occupation = :ocupacion  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM personal_ref WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $full_name=1, public $cel_number=1, public $relationship=1, public $occupation=1)
    {
        parent::__construct();
    }
    public function postPersonalRef()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->full_name);
            $res->bindValue("phone",$this->cel_number);
            $res->bindValue("relacion",$this->relationship);
            $res->bindValue("ocupacion",$this->occupation);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllPersonalRef()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("name", 1);
            $res->bindValue("phone", 1);
            $res->bindValue("relacion", 1);
            $res->bindValue("ocupacion", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putPersonalRef()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->full_name);
            $res->bindValue("phone",$this->cel_number);
            $res->bindValue("relacion",$this->relationship);
            $res->bindValue("ocupacion",$this->occupation);
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
    public function deletePersonalRef()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->full_name);
            $res->bindValue("phone",$this->cel_number);
            $res->bindValue("relacion",$this->relationship);
            $res->bindValue("ocupacion",$this->occupation);
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