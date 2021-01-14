<?php
require_once APP_ROOT . "/Core/Model.php";
class HostingModel extends Model
{
    function getProducts($id)
    {
        $sql = "SELECT * FROM `tbl_product_description` WHERE prod_id = $id";
        $this->query($sql);
        $result = $this->all();
        if ($result) {
            return $result;
        }
        return false;
    }

    function getCategoryDetails($id)
    {
        $sql = "SELECT prod_name, description FROM `tbl_product` WHERE id = $id";
        $this->query($sql);
        $result = $this->single();
        if ($result) {
            return $result;
        }
        return false;
    }
}
