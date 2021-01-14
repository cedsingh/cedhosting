<?php
require_once APP_ROOT . "/Core/Controller.php";

class AccountController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
    }

    function index()
    {
        $data['title'] = "Register";
        $this->render($data);
    }

    function create()
    {
        $ques = [
            "What was your childhood nickname?",
            "What is the name of your favourite childhood friend?",
            "What was your favourite place to visit as a child?",
            "What was your dream job as a child?",
            "What is your favourite teacher's nickname?"
        ];
        if (isset($_POST['submit'])) {
            extract($_POST);
            $data = [
                $email,
                $name,
                $mobile,
                $password,
                $ques[$security_ques],
                $security_ans,
            ];

            if ($this->model->addUser($data)) {
                session_start();
                $_SESSION['emailOtp'] = rand(1000, 9999);
                $_SESSION['mobileOtp'] = rand(1000, 9999);
                Common::sendOtpMail($email, $_SESSION['emailOtp']);
                Common::sendOtpMobile($mobile, $_SESSION['mobileOtp']);
                $data = [
                    "email" => $email,
                    "mobile" => $mobile,
                    "title" => "Verify Signup",
                    "page" => "confirm"
                ];
                $this->render($data);
            }
        } else {
            $this->render(['title' => "Register"]);
        }
    }
}
