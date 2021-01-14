<?php
class DBConf
{
    private $dbHost = "localhost";
    private $dbName = "cedhosting";
    private $dbUser = "root";
    private $dbPass = "";
    public $db;
    function __construct()
    {
        $dsn = "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {

            $this->db = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
        } catch (Exception $e) {
            die("Exception:" . $e->getMessage());
        }
    }
}
