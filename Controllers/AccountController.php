<?php
require_once "./Core/Controller.php";

class AccountController extends Controller
{
    function __construct()
    {
        Controller::__construct(self::class);
    }

    function index()
    {
        $this->render();
    }
}
