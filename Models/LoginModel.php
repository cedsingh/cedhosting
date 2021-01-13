<?php
require_once "./Core/Model.php";
class LoginModel extends Model {
    function login($user, $password) {
        $sql = "SELECT * FROM `tbl_user` WHERE (email = :user OR mobile = :user) AND password = :password";
        $this->query($sql);
        $result = $this->single();
        if($result) {
            return $result['active'];
        }
        else {
            return -1;
        }
    }
}
?>