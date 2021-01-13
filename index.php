
<?php
if (isset($_GET['action'])) {
    $name = ucfirst(strtolower($_GET['action']));
    require_once "./Controllers/" . $name . "Controller.php";
    $controller = $name . "Controller";
    $ctrl = new $controller();
    if (isset($_GET['method'])) {
        $method = strtolower($_GET['method']);
        if (method_exists($ctrl, $method)) {
            $ctrl->$method();
        } else {
            die("404! Not found");
        }
    } else {
        $ctrl->index();
    }
} else {
    require_once "./Config/config.php";
    $data['title'] = "CedHosting - Most Reliable";
    include_once "./Views/HomeView.php";
}
