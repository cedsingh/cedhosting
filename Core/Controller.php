<?php
require_once "./Config/config.php";
class Controller
{
    protected $model;
    protected $view;

    public function __construct($name)
    {
        $name = preg_replace("/Controller/", "", $name);
        $this->setView($name);
        $this->setModel($name);
    }
    public function setModel($name)
    {
        $name = ucfirst(strtolower($name));
        $model =  $name . "Model";
        require_once "./Models/" . $model . ".php";
        $this->model = new $model();
    }
    public function setView($name)
    {
        $name = ucfirst(strtolower($name));
        $this->view = "./Views/" . $name . "View.php";
    }
    public function render($data)
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
