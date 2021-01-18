<?php
require_once APP_ROOT . "/Core/Model.php";
class HostingModel extends Model
{
    function getProducts($id)
    {
        $sql = "SELECT * 
                FROM `tbl_product` p 
                JOIN `tbl_product_description` pd
                ON p.id = pd.prod_id 
                WHERE p.prod_parent_id = $id";
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
