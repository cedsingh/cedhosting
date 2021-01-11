<?php
include_once("./Config/DBConf.php");
class AccountModel
{
    private $db;
    function __construct()
    {
        $this->db = new DBConf();
    }
    function isUser($email, $mobile)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE email = :email OR mobile= :mobile";
        $this->db->query($sql);
        $this->db->set(":email", $email);
        $this->db->set(":mobile", $mobile);
        $result = $this->db->single();
        if ($result) {
            return true;
        }
        return false;
    }
    function isAdmin($id)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE id = $id AND is_admin = 1";
        $this->db->query($sql);
        $result = $this->db->single();
        if ($result) {
            return true;
        }
        return false;
    }
    function addUser()
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
        $this->db->query($sql);
        if ($this->db->run()) {
            return true;
        }
        return false;
    }

    function getUserById($id)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE id = $id";
        $this->db->query($sql);
        $result = $this->db->single();
        if ($result) {
            return $result;
        }
        return false;
    }
}
