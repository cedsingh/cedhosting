<?php
require_once APP_ROOT . "/Core/Model.php";
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
        $this->set(":prod_name", $data[0]);
        $this->set(":prod_available", $data[1], PDO::PARAM_INT);
        $this->set(":prod_description", $data[2]);
        if ($this->run()) {
            return true;
        }
        return false;
    }

    function addProduct($data)
    {
        $sql = "INSERT INTO `tbl_product` (
            prod_name,
            prod_parent_id,
            prod_available
        ) VALUES (
            :prod_name,
            :prod_parent_id,
            :prod_available
        )";
        $this->query($sql);
        $this->set(":prod_name", $data[0]);
        $this->set(":prod_parent_id", $data[1]);
        $this->set(":prod_available", $data[2]);
        if ($this->run()) {
            $sql = "INSERT INTO `tbl_product_description` (
                prod_id,
                description,
                mon_price,
                annual_price,
                sku
            ) VALUES (
                LAST_INSERT_ID(),
                :description,
                :mon_price,
                :annual_price,
                :sku
            )";
            $this->query($sql);
            $this->set(":description", $data[3]);
            $this->set(":mon_price", $data[4]);
            $this->set(":annual_price", $data[5]);
            $this->set(":sku", $data[6]);
            if ($this->run()) {
                return true;
            }
        }
        return false;
    }

    function getAllCategories()
    {
        $sql = "SELECT * FROM `tbl_product` WHERE prod_parent_id = 1";
        $this->query($sql);
        $result = $this->all();
        if ($result) {
            return $result;
        }
        return false;
    }

    function getSingleProduct($id)
    {
        $sql = "SELECT p.prod_name, p.prod_parent_id, p.id, pd.description, pd.mon_price, pd.annual_price, pd.sku FROM `tbl_product` p JOIN `tbl_product_description` pd ON p.id = pd.prod_id WHERE p.id = $id";
        $this->query($sql);
        $result = $this->single();
        if ($result) {
            return $result;
        }
        return false;
    }

    function getSingleCategory($id)
    {
        $sql = "SELECT p.prod_name, p.id, p.prod_parent_id, pd.description FROM `tbl_product` p JOIN `tbl_product_description` pd ON p.id = pd.prod_id WHERE p.id = $id";
        $this->query($sql);
        $result = $this->single();
        if ($result) {
            return $result;
        }
        return false;
    }
}
