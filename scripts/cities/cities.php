<?php
class cities extends connect
{
    private $queryPost = 'INSERT INTO cities(id,name_city,id_region) VALUES(:identificacion,:namecity,:idreg)';
    private $queryGetAll = 'SELECT * FROM cities';
    private $queryUpdate = 'UPDATE cities SET id = :identificacion, name_city = :namecity, id_region = :idreg  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM cities WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(public $id = 1, public $name_city = 1, private $id_region = 1)
    {
        parent::__construct();
    }
    public function postCities()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("namecity", $this->name_city);
            $res->bindValue("idreg", $this->id_region);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllCities()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("namecity", $this->name_city);
            $res->bindValue("idreg", $this->id_region);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putCities()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("namecity", $this->name_city);
            $res->bindValue("idreg", $this->id_region);
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
    public function deleteCities()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("namecity", $this->name_city);
            $res->bindValue("idreg", $this->id_region);
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