<?php
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controller = ucfirst($controller) . 'Controller';
$controllerFile = "controllers/$controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerObj = new $controller();
    if (method_exists($controllerObj, $action)) {
        $controllerObj->$action();
    } else {
        echo "Action không tồn tại.";
    }
} else {
    echo "Controller không tồn tại.";
}