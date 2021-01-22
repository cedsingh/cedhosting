<?php
require_once APP_ROOT . "/Core/Controller.php";
class RestController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
    }
    function cart()
    {
        $this->setModel('cart');
        if ($this->params[0] == "add") {
            echo json_encode($this->model->addToCart([
                "id" => $_POST['id'],
                "name" => $_POST['name'],
                "qty" => $_POST['qty'],
                "price" => $_POST['price']
            ]));
        } elseif ($this->params[0] == "get") {
            echo json_encode($this->model->getcart());
        } else {
            return false;
        }
    }

    function verify()
    {
        if (isset($_POST['mobileOtp'])) {
            if ($_SESSION['mobileOtp'] == $_POST['mobileOtp']) {
                if ($this->model->verifyUser("phone")) {
                    $_SESSION['verified'] = isset($_SESSION['verified']) && $_SESSION['verified'] == 10 ? 2 : 11;
                    if ($_SESSION['verified'] == 2) {
                        $this->model->approveUser($_POST['email']);
                    }
                    echo json_encode([
                        "verified" => $_SESSION['verified']
                    ]);
                }
                return false;
            }
        } elseif (isset($_POST['emailOtp'])) {
            if ($_SESSION['emailOtp'] == $_POST['emailOtp']) {
                if ($this->model->verifyUser()) {
                    $_SESSION['verified'] = isset($_SESSION['verified']) && $_SESSION['verified'] == 11 ? 2 : 10;
                    return $_SESSION['verified'];
                }
                return false;
            }
        }
    }
    function order()
    {
        if (isset($_COOKIE['cart']) && isset($_POST['txn_id'])) {
            $cart = json_decode($_COOKIE['cart'], true);
            $totalAmount = array_reduce($cart, function ($total, $item) {
                return $total + $item['price'];
            }, 0);
            if ($totalAmount == $_POST['amount']) {
                $data = [
                    "user_id" => 20,
                    "user_billing_id" => 1,
                    "status" => $_POST['is_cod'] == false ? 2 : 1,
                    "promocode_applied_id" => 0,
                    "discount_amt" => 0,
                    "total_amt_after_dis" => 0,
                    "tax_amt" => 0,
                    "txn_id" => $_POST['txn_id'],
                    "final_invoice_amt" => $totalAmount
                ];
                if ($this->model->createOrder($data)) {
                    setcookie("cart", "", time() - 3600, "/", NULL, 0);
                    unset($_COOKIE['cart']);
                    echo json_encode([
                        "success" => true,
                        "cartValue" => 0
                    ]);
                };
            }
        }
    }
}
