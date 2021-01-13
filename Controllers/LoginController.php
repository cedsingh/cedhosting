<?php
    require_once "./Core/Controller.php";
    class LoginController extends Controller {
        function __construct() {
            Controller::__construct(self::class);
        }

        function index() {
            $data['title'] = "Login";
            $this->render($data);
        }

        function login() {
            if($_POST['submit']) {
                extract($_POST);
                $result = $this->model->login($email, $password);
                if($result == -1) {
                    $data['msg'] = "Incorrect email/password";
                    $this->render($data);
                }
                else if($result == 0) {
                    $data['msg'] = "Not approved";
                    $this->render($data);
                }
                else if($result == 2){
                    $data['msg'] = "Blocked by admin";
                    $this->render($data);
                }
                else {
                    header("Location: index.php?action=customer");
                }
            }
        }
    }
?>