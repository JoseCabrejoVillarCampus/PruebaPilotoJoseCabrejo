<?php
class contact_info extends connect
{
    private $queryPost = 'INSERT INTO contact_info(id,id_staff,whatsapp,instagram,linkedin,email,address,cel_number) VALUES(:identificacion,:idstaff,:whats,:inst,:link,:email, :dir, :phon)';
    private $queryGetAll = 'SELECT * FROM contact_info';
    private $queryUpdate = 'UPDATE contact_info SET id = :identificacion, id_staff = :idstaff, whatsapp = :whats, instagram = :inst, linkedin = :link, email = :email, address =:dir, cel_number =:phon  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM contact_info WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id = 1, private $id_staff = 1, public $whatsapp = 1, public $instagram = 1, public $linkedin = 1, public $email = 1,private $address = 1, public $cel_number = 1)
    {
        parent::__construct();
    }
    public function postContacInfo()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("whats", $this->whatsapp);
            $res->bindValue("inst", $this->instagram);
            $res->bindValue("link", $this->linkedin);
            $res->bindValue("email", $this->email);
            $res->bindValue("dir", $this->address);
            $res->bindValue("phon", $this->cel_number);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllContacInfo()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("whats", $this->whatsapp);
            $res->bindValue("inst", $this->instagram);
            $res->bindValue("link", $this->linkedin);
            $res->bindValue("email", $this->email);
            $res->bindValue("dir", $this->address);
            $res->bindValue("phon", $this->cel_number);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putContacInfo()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("whats", $this->whatsapp);
            $res->bindValue("inst", $this->instagram);
            $res->bindValue("link", $this->linkedin);
            $res->bindValue("email", $this->email);
            $res->bindValue("dir", $this->address);
            $res->bindValue("phon", $this->cel_number);
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
    public function deleteContacInfo()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("whats", $this->whatsapp);
            $res->bindValue("inst", $this->instagram);
            $res->bindValue("link", $this->linkedin);
            $res->bindValue("email", $this->email);
            $res->bindValue("dir", $this->address);
            $res->bindValue("phon", $this->cel_number);
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