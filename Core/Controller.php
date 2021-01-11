<?php
require_once "./Config/config.php";
class Controller
{

    private $model;
    private $view;
    private $vars = [];

    public function __construct($name)
    {
        $name = preg_replace("/Controller/", "", $name);
        $model = $name . "Model";
        $model = new $model();
        $this->model = $model;
        $this->view = "./Views/" . $name . "View.php";
    }
    public function render()
    {
        if (file_exists($this->view)) {
            include $this->view;
        }
    }

    function __call($function, $args)
    {
        die("Action $function not found.");
    }
}
