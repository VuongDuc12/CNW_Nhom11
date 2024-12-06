<?php
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controller = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . $controller . ".php";

// Hàm xử lý lỗi
function handleError($message) {
    http_response_code(404); // Trả về lỗi 404
    echo $message;
    exit;
}

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controller)) {
        $controllerObj = new $controller();
        if (method_exists($controllerObj, $action)) {
            $id = $_GET['id'] ?? null; // Tham số bổ sung
            $controllerObj->$action($id);
        } else {
            handleError("Action không tồn tại.");
        }
    } else {
        handleError("Lớp controller không tồn tại.");
    }
} else {
    handleError("Tệp controller không tồn tại.");
}
?>
