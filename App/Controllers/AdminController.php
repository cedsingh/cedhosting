<?php
require_once APP_ROOT . "/Core/Controller.php";
class AdminController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
        if (!Auth::isAdmin()) {
            $this->redirect("login");
        }
    }

    function index()
    {
        $data['title'] = "Admin Dashboard";
        $data['page'] = "index";
        $data['name'] = isset($_SESSION['user']) ? $_SESSION['user']['name'] : "";
        $this->render($data);
    }

    function category()
    {
        if (isset($_POST['submit'])) {
            var_dump($_POST);
            extract($_POST);
            $data = [
                $name,
                $available,
                $description
            ];
            if ($this->model->addCategory($data)) {
                $data['msg'] = "Category added";
            }
        }
        $data['categories'] = $this->model->getAllCategories();
        $data['name'] = isset($_SESSION['user']) ? $_SESSION['user']['name'] : "";
        $data['title'] = "Add Category - Admin Dashboard";
        $data['page'] = "category";
        $this->render($data);
    }

    function product()
    {
        $data['title'] = "Add Product - Admin Dashboard";
        $data['page'] = "product-add";
        if (isset($this->params[0]) && $this->params[0] == "add") {
            if (isset($_POST['submit'])) {
                extract($_POST);
                $prodDescription = json_encode([
                    "url" => $url,
                    "webspace" => $webspace,
                    "bandwidth" => $bandwidth,
                    "domain" => $domain,
                    "language" => $language,
                    "mailbox" => $mailbox
                ]);
                $productData = [
                    $name,
                    $category,
                    $available,
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
            $data['name'] = isset($_SESSION['user']) ? $_SESSION['user']['name'] : "";
            $data['page'] = "product-add";
            $data['tilte'] = "Product - Admin Dashboard";
        }
        $this->render($data);
    }
}
