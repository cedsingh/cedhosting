<?php
require_once "./Core/Model.php";
class AccountModel extends Model
{

    function isUser($email, $mobile)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE email = :email OR mobile= :mobile";
        $this->query($sql);
        $this->set(":email", $email);
        $this->set(":mobile", $mobile);
        $result = $this->single();
        if ($result) {
            return true;
        }
        return false;
    }
    function isAdmin($id)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE id = $id AND is_admin = 1";
        $this->query($sql);
        $result = $this->single();
        if ($result) {
            return true;
        }
        return false;
    }
    function addUser($data)
    {
        $sql = "INSERT INTO `tbl_user` (
            `email`,
            `name`,
            `mobile`,
            `password`,
            `security_question`,
            `security_answer`
        ) VALUES(
            :email,
            :name,
            :mobile,
            :password,
            :security_question,
            :security_answer
        )";
        $this->query($sql);
        $this->set(":email", $data[0]);
        $this->set(":name", $data[1]);
        $this->set(":mobile", $data[2]);
        $this->set(":password", md5($data[3]));
        $this->set(":security_question", $data[4]);
        $this->set(":security_answer", $data[5]);
        if ($this->run()) {
            return true;
        }
        return false;
    }

    function getUserById($id)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE id = $id";
        $this->query($sql);
        $result = $this->single();
        if ($result) {
            return $result;
        }
        return false;
    }
}
