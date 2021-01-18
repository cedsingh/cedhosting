<?php
require_once APP_ROOT . "/Core/Model.php";
class CheckoutModel extends Model
{
    function getStates()
    {
        $sql = "SELECT `name` FROM `tbl_states`";
        $this->query($sql);
        $result = $this->all();
        if ($result) {
            return $result;
        }
        return [];
    }

    function addAddress()
    {
        $sql = "INSERT INTO `tbl_user_billing_add`
        VALUES(
            :user_id,
            :billing_name,
            :house_no,
            :city,
            :state,
            :country,
            :pincode
        )";
        $this->query($sql);
        if ($this->run()) {
            return true;
        }
        return false;
    }
}
