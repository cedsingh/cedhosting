<?php
require_once APP_ROOT . "/Core/Controller.php";
class ServicesController extends Controller
{
    function __construct()
    {
        $this->setView('services');
    }

    function index()
    {
        $data['title'] = "Services";
        $this->render($data);
    }
}
