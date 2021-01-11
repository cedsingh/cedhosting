
<?php
if (isset($_GET['action'])) {
    $name = ucfirst($_GET['action']);
    loader($name);
    $controller = $name . "Controller";
    $ctrl = new $controller();
    $ctrl->index();
}

function loader($class)
{
    require_once "./Models/" . $class . "Model.php";
    require_once "./Controllers/" . $class . "Controller.php";
}
?>