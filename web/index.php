<?php
require_once("includes.php");

$action = "";
//echo $_GET["action"];
if (isset($_GET["controller"])) {
    $controller = $_GET["controller"] . "Controller";
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
    }
    error_log("index.php => action => ".$action." controller => ".$controller);
} else {
    error_log("index.php => controller not defined");
    $controller = "indexController";
    // new View("404", "Controlador no trobat")->render();
    //echo "No autoritzat!";
}
 
// :: vol dir funcio estatica
$controllerObj = Controller::LoadController($controller, $action);
if ($controllerObj) {
    $isAuth = Controller::isUserAnthorized($controllerObj);
    if ($isAuth) {
        $controllerObj->loadDB();
        $controllerObj->doAction();
        $controllerObj->render();
    } else {
        // new View("403", "No autoritzat")->render();
        echo "no autoritzat";
    }
} else {
    View::render("404", ["msg" => "No trobat, controllerObj no definit".$controller]);
    //echo "no trobat";
}
