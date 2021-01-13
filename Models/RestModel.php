<?php
require_once "./Core/Model.php";
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

    public function approveUser($email) {
        $sql = "UPDATE `tbl_user` SET active = 1 WHERE email = '$email'";
        $this->query($sql);
        if($this->run()) {
            return true;
        }
        return false;
    }
}
