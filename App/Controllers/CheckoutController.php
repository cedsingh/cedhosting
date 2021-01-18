<?php
require_once APP_ROOT . "/Core/Controller.php";
class CheckoutController extends Controller
{
    function __construct()
    {
        parent::__construct(self::class);
        if (Auth::isCustomer()) {
            $this->redirect("login");
        }
    }

    function index()
    {
        $states = $this->model->getStates();
        $cart = [];
        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
            $cartTotal = array_reduce($cart, function ($total, $item) {
                return $total + $item["price"];
            }, 0);
        }
        $this->render([
            "title" => "Checkout",
            "page" => "checkout",
            "states" => $states,
            "cart" => $cart,
            "cart_total" => $cartTotal
        ]);
    }

    function payment()
    {
        $this->render([
            "title" => "Payment",
            "page" => "payment",
        ]);
    }
}
