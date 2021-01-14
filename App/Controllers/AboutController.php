<?php
require_once APP_ROOT. "/Core/Controller.php";
class AboutController extends Controller {
    function __construct()
    {
        $this->setView('about');
    }

    function index() {
        $data['title'] = "About Us";
        $this->render($data);
    }
}
