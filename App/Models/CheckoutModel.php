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

    function addAddress($userId, $data)
    {
        $sql = "INSERT INTO `tbl_user_billing_add`
        VALUES(
            NULL,
            :user_id,
            :billing_name,
            :house_no,
            :city,
            :state,
            :country,
            :pincode
        )";
        $this->query($sql);
        $this->set(":user_id", $userId);
        $this->set(":billing_name", $data[0]);
        $this->set(":house_no", $data[1]);
        $this->set(":city", $data[2]);
        $this->set(":state", $data[3]);
        $this->set(":country", $data[4]);
        $this->set(":pincode", $data[5]);
        if ($this->run()) {
            return true;
        }
        return false;
    }

    function getAddressesById($id)
    {
        $sql = "SELECT * FROM `tbl_user_billing_add` WHERE user_id = $id";
        $this->query($sql);
        $result = $this->all();
        if ($result) {
            return $result;
        }
        return [];
    }
}
