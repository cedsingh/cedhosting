<?php
require_once "./Core/Model.php";
class RestModel extends Model
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
            array_push($cart, $data);
        } else {
            setcookie("cart", json_decode($data), time() + 3600, "/", NULL, 0);
        }
        return [
            "cart" => $cart,
            "count" => sizeof($cart)
        ];
    }
}
