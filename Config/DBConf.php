<?php
class DBConf
{
    private $dbHost = "localhost";
    private $dbName = "cedhosting";
    private $dbUser = "root";
    private $dbPass = "";
    private $db;
    private $stmt;
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

    function query($sql)
    {
        $this->stmt = $this->db->prepare($sql);
        return $this->stmt;
    }

    function run()
    {
        return $this->stmt->execute();
    }

    public function set($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function all()
    {
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function count()
    {
        return $this->stmt->rowCount();
    }
}
