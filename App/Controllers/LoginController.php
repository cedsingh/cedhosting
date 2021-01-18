<?php
require_once APP_ROOT . "/Core/Controller.php";
class LoginController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
    }

    function index()
    {
        $data['title'] = "Login";
        if (isset($_POST['submit'])) {
            extract($_POST);
            $result = $this->model->login($email, $password);
            if ($result['active'] == -1) {
                $data['msg'] = "Incorrect email/password";
                $this->render($data);
            } else if ($result['active'] == 0) {
                $data['msg'] = "Not approved";
                $this->render($data);
            } else if ($result['active'] == 2) {
                $data['msg'] = "Blocked by admin";
                $this->render($data);
            } else {
                $_SESSION['user'] = $result;
                if ($result['is_admin'] == 0) {
                    header("Location: customer");
                } else {
                    header("Location: admin");
                }
            }
        }
        $this->render($data);
    }

    function logout()
    {
        unset($_SESSION['user']);
        $this->redirect("../login");
    }
}
