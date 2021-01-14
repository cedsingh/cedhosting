<?php
require_once APP_ROOT . "/Core/Controller.php";
class CustomerController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
    }

    function index()
    {
        $data['title'] = "Customer Dashboard";
        $this->render($data);
    }
}
