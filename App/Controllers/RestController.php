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
}
