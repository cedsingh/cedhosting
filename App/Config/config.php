<?php
define("ROOT", "http://localhost/cedhosting/");
define("STATIC_ROOT", "http://localhost/cedhosting/Public");
define("APP_ROOT", __DIR__ . "/../../../cedhosting/App");
session_start();
include_once APP_ROOT . "/Helpers/Common.php";
include_once APP_ROOT . "/Helpers/Auth.php";
