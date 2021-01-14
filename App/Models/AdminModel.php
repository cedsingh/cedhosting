<?php
include_once "./Core/Model.php";
class AdminModel extends Model
{
    function addCategory($data)
    {
        $sql = "INSERT INTO `tbl_product` (
            prod_name,
            prod_available,
            description
        ) VALUES(
            :prod_name,
            :prod_available,
            :prod_description
        )";
        
        $this->query($sql);
        $this->set(":prod_name", $data[1]);
        $this->set(":prod_available", $data[2], PDO::PARAM_INT);
        $this->set(":prod_description", $data[3]);
        if ($this->run()) {
            return true;
        }
        return false;
    }

    function addProduct($data)
    {
        $sql = "INSERT INTO `tbl_product_description` (
            prod_id,
            description,
            mon_price,
            annual_price,
            sku
        ) VALUES (
            :prod_id,
            :description,
            :mon_price,
            :annual_price,
            :sku
        )";
        $this->query($sql);
        $this->set(":prod_id", $data[0]);
        $this->set(":description", $data[1]);
        $this->set(":mon_price", $data[2]);
        $this->set(":annual_price", $data[3]);
        $this->set(":sku", $data[4]);
        if ($this->run()) {
            return true;
        }
        return false;
    }
}
