<?php
require_once "./App/Config/config.php";
$routes = trim(strtolower($_SERVER['REQUEST_URI']), " /");
$routes = explode("/", $routes);

if (array_key_exists(1, $routes)) {
    $name = ucfirst(strtolower($routes[1]));
    if (file_exists(APP_ROOT . "/Controllers/" . $name . "Controller.php")) {
        require_once APP_ROOT . "/Controllers/" . $name . "Controller.php";
        $controller = $name . "Controller";
        $ctrl = new $controller();
        if (sizeof($routes) > 3) {
            $ctrl->params = array_slice($routes, 3);
        }
        if (array_key_exists(2, $routes)) {
            $method = strtolower($routes[2]);
            if (method_exists($ctrl, $method)) {
                $ctrl->$method();
            } else {
                die("404! Not found");
            }
        } else {
            $ctrl->index();
        }
    } else {
        if ($name == "Index.php") {
            $data['title'] = "CedHosting - Most Reliable";
            include_once APP_ROOT . "/Views/HomeView.php";
        } else {
            die("404! Not found.");
        }
    }
} else {
    $data['title'] = "CedHosting - Most Reliable";
    include_once APP_ROOT . "/Views/HomeView.php";
}
