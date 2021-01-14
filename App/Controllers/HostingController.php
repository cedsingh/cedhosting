<?php
require_once APP_ROOT . "/Core/Controller.php";
class HostingController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
    }

    function index()
    {
        $data['title'] = 'Hosting';
        $data['cat_title'] = 'Hosting';
        $data['cat_desc'] = '<ul><li>Reliable hosting plans</li></ul>';
        $data['prod_data'] = [];
        $this->render($data);
    }

    function product()
    {
        if (isset($this->params[0])) {
            $category = $this->model->getCategoryDetails($this->params[0]);
            if ($category) {
                $data['title'] = $category['prod_name'];
                $data['cat_title'] = $category['prod_name'];
                $data['cat_desc'] = $category['description'];
                $products = $this->model->getProducts($this->params[0]);
                if ($products) {
                    $data['prod_data'] = $products;
                } else {
                    $data['prod_data'] = [];
                }
            }
        } else {
            $this->index();
        }
        $this->render($data);
    }
}
