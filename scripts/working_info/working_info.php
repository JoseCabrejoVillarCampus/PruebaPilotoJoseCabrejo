<?php
class working_info extends connect
{
    private $queryPost = 'INSERT INTO working_info(id,id_staff,years_exp,months_exp, id_work_reference,id_personal_ref,start_contract,end_contract) VALUES(:identificacion,:idstaff,:yearsexp,:monthsexp, :idworkreference,:idpersonal,:startcontract,:endcontract)';
    private $queryGetAll = 'SELECT working_info.id, staff.name AS staff_name, work_reference.name AS work_reference_name, personal_ref.name AS personal_ref_name FROM working_info, INNER JOIN staff ON working_info.id_staff = staff.id INNER JOIN work_reference ON working_info.id_work_reference = work_reference.id INNER JOIN personal_ref ON working_info.id_personal_reference = personal_ref.id  WHERE working_info.id=:identification ';
    private $queryUpdate = 'UPDATE working_info SET id = :identificacion, id_staff = :idstaff, years_exp = :yearsexp, months_exp = :monthsexp, id_work_reference = :idworkreference, id_personal_ref = :idpersonal, start_contract = :startcontract, end_contract = :endcontract WHERE id = :identificacion';
    private $queryDelete = 'DELETE FROM working_info WHERE id = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, public $years_exp=1, public $months_exp=1,private $id_work_reference=1, private $id_personal_ref=1, public $start_contract=1, public $end_contract=1)
    {
        parent::__construct();
    }
    public function postWorkingInfo()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("yearsexp",$this->years_exp);
            $res->bindValue("monthsexp",$this->months_exp);
            $res->bindValue("idworkreference", $this->id_work_reference);
            $res->bindValue("idpersonal",$this->id_personal_ref);
            $res->bindValue("startcontract",$this->start_contract);
            $res->bindValue("endcontract",$this->end_contract);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllWorkingInfo()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("idstaff", 1);
            $res->bindValue("yearsexp", 1);
            $res->bindValue("monthsexp", 1);
            $res->bindValue("idworkreference", 1);
            $res->bindValue("idpersonal", 1);
            $res->bindValue("startcontract", 1);
            $res->bindValue("endcontract", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putWorkingInfo()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("yearsexp",$this->years_exp);
            $res->bindValue("monthsexp",$this->months_exp);
            $res->bindValue("idworkreference", $this->id_work_reference);
            $res->bindValue("idpersonal",$this->id_personal_ref);
            $res->bindValue("startcontract",$this->start_contract);
            $res->bindValue("endcontract",$this->end_contract);
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
    public function deleteWorkingInfo()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->id);
            $res->bindValue("idstaff",$this->id_staff);
            $res->bindValue("yearsexp",$this->years_exp);
            $res->bindValue("monthsexp",$this->months_exp);
            $res->bindValue("idworkreference", $this->id_work_reference);
            $res->bindValue("idpersonal",$this->id_personal_ref);
            $res->bindValue("startcontract",$this->start_contract);
            $res->bindValue("endcontract",$this->end_contract);
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