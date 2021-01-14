<?php
require_once APP_ROOT . "/Core/Model.php";
class LoginModel extends Model
{
    function login($user, $password)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE (email = :user OR mobile = :user) AND password = :password";
        $this->query($sql);
        $this->set(":user", $user);
        $this->set(":password", md5($password));
        $result = $this->single();
        if ($result) {
            return $result['active'];
        } else {
            return -1;
        }
    }
}
