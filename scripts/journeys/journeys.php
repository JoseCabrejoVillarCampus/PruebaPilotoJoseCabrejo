<?php
class journeys extends connect
{
    private $queryPost = 'INSERT INTO journeys(id,name_journey,check_in,check_out) VALUES(:identificacion,:name,:checkin,:checkout)';
    private $queryGetAll = 'SELECT * FROM journeys';
    private $queryUpdate = 'UPDATE journeys SET id = :identificacion, name_journey = :name, check_in = :checkin, check_out = :checkout  WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM journeys WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $name_journey=1, private $check_in=1, private $check_out=1)
    {
        parent::__construct();
    }
    public function postJourney()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->name_journey);
            $res->bindValue("checkin", $this->check_in);
            $res->bindValue("checkout",$this->check_out);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllJourney()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("name", 1);
            $res->bindValue("checkin", 1);
            $res->bindValue("checkout", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putJourney()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->name_journey);
            $res->bindValue("checkin", $this->check_in);
            $res->bindValue("checkout",$this->check_out);
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
    public function deleteJourney()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("name",$this->name_journey);
            $res->bindValue("checkin", $this->check_in);
            $res->bindValue("checkout",$this->check_out);
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