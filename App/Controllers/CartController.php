<?php
require_once APP_ROOT . "/Core/Controller.php";
class CartController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
    }

    function index()
    {
        $data['title'] = "Cart";
        $data['cart'] = $this->model->getCart();
        $this->render($data);
    }

    function checkout()
    {
        $data['title'] = "Checkout";
    }
}
