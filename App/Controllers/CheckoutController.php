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
        $cart = [];
        $addresses = $this->model->getAddressesById(20);
        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
            $cartTotal = array_reduce($cart, function ($total, $item) {
                return $total + $item["price"];
            }, 0);
        }
        if (isset($_POST['billing_name'])) {
            extract($_POST);
            $data = [
                $billing_name,
                $house_no,
                $city,
                $state,
                $country,
                $pincode
            ];
            if ($this->model->addAddress(20, $data)) {

                $msg = "Address added";
            } else {
                $msg = "Failed";
            }
        }
        $this->render([
            "title" => "Checkout",
            "page" => "payment",
            "cart" => $cart,
            "addresses" => $addresses,
            "cart_total" => $cartTotal ?? 0,
            "msg" => $msg ?? ""
        ]);
    }

    function address()
    {
        $states = $this->model->getStates();
        $this->render([
            "title" => "Add Address",
            "page" => "addresses",
            "states" => $states
        ]);
    }
}
