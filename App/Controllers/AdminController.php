<?php
require_once "./Core/Controller.php";
class AdminController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
    }

    function index()
    {
        $data['title'] = "Admin Dashboard";
        $data['page'] = "index";
        $this->render($data);
    }

    function category()
    {
        if (isset($_POST['submit'])) {
            extract($_POST);
            $data = [
                $parent,
                $name,
                $available,
                $description
            ];
            if ($this->model->addCategory($data)) {
                $data['msg'] = "Category added";
            }
        }
        $data['title'] = "Add Category - Admin Dashboard";
        $data['page'] = "category";
        $this->render($data);
    }

    function product()
    {
        $data['title'] = "Product - Admin Dashboard";
        $data['page'] = "product";
        if (isset($_GET['param'])) {
            if (isset($_POST['submit'])) {
                extract($_POST);
                $prodDescription = json_encode([
                    "name" => $name,
                    "url" => $url,
                    "webspace" => $webspace,
                    "bandwidth" => $bandwidth,
                    "domain" => $domain,
                    "language" => $language,
                    "mailbox" => $mailbox
                ]);
                $productData = [
                    $category,
                    $prodDescription,
                    $monthly_price,
                    $annual_price,
                    $sku
                ];
                if ($this->model->addProduct($productData)) {
                    $data['msg'] = "Product added.";
                } else {
                    $data['msg'] = "Error occured";
                }
            }
            $data['page'] = "product-add";
            $data['tilte'] = "Product - Admin Dashboard";
        }
        $this->render($data);
    }
}
