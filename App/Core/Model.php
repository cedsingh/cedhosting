<?php
include_once APP_ROOT . "/Config/DBConf.php";
class Model extends DBConf
{
    private $stmt;
    protected function query($sql)
    {
        $this->stmt = $this->db->prepare($sql);
        return $this->stmt;
    }

    protected function run()
    {
        return $this->stmt->execute();
    }

    protected function set($param, $value, $type = null)
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

    function all()
    {
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function single()
    {
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    function count()
    {
        return $this->stmt->rowCount();
    }
}
