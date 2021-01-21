<?php
require_once APP_ROOT . "/Core/Model.php";
class RestModel extends Model
{
    public function verifyUser($type = "email")
    {
        $sql = "UPDATE `tbl_user` SET " . $type . "_approved = 1";
        $this->query($sql);
        if ($this->run()) {
            return true;
        }
        return false;
    }

    public function approveUser($email)
    {
        $sql = "UPDATE `tbl_user` SET active = 1 WHERE email = '$email'";
        $this->query($sql);
        if ($this->run()) {
            return true;
        }
        return false;
    }

    function createOrder($data)
    {
        $sql = "INSERT INTO `tbl_orders` (
            user_id,
            user_billing_id,
            status,
            promocode_applied_id,
            discount_amt,
            total_amt_after_dis,
            tax_amt,
            txn_id,
            final_invoice_amt
        ) VALUES(
            {$data['user_id']},
            {$data["user_billing_id"]},
            {$data["status"]},
            {$data["promocode_applied_id"]},
            {$data["discount_amt"]},
            {$data["total_amt_after_dis"]},
            {$data["tax_amt"]},
            '{$data["txn_id"]}',
            {$data["final_invoice_amt"]}
        )";
        $this->query($sql);
        if ($this->run()) {
            return true;
        }
        return false;
    }
}
