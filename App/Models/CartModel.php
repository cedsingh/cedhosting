<?php
require_once APP_ROOT . "/Core/Model.php";
class CartModel extends Model
{
    function getCart()
    {
        $cart = [];
        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
        }
        return [
            "cart" => $cart,
            "count" => sizeof($cart)
        ];
    }

    function addToCart($data)
    {
        $cart = [];
        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
            foreach ($cart as $key => $value) {
                if ($data["id"] == $value['id']) {
                    $cart[$key]['qty'] += 1;
                    $present = true;
                }
            }
            if (!isset($present)) {
                array_push($cart, $data);
            }
        } else {
            $cart[0] = $data;
        }
        setcookie("cart", json_encode($cart), time() + 3600, "/", NULL, 0);
        return [
            "cart" => $cart,
            "count" => sizeof($cart)
        ];
    }
}
