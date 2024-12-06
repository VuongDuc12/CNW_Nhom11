<?php
require_once 'controllers/HomeController.php';
require_once 'controllers/NewsController.php';

// Lấy tham số từ URL
$action = isset($_GET['action']) ? $_GET['action'] : 'home'; // Mặc định là trang chủ
$id = isset($_GET['id']) ? $_GET['id'] : null; // Nếu có id, sẽ hiển thị chi tiết tin tức
$search = isset($_GET['search']) ? $_GET['search'] : null; // Nếu có từ khóa tìm kiếm

// Tạo đối tượng controller tương ứng
switch ($action) {
    case 'viewNews':  // Xem chi tiết tin tức
        $controller = new NewsController();
        if ($id) {
            $controller->viewNews($id);  // Gọi phương thức xem chi tiết
        } else {
            echo "ID không hợp lệ!";
        }
        break;

    case 'search':  // Xử lý tìm kiếm
        $controller = new NewsController();
        if ($search) {
            $controller->search($search);  // Gọi phương thức tìm kiếm
        } else {
            echo "Vui lòng nhập từ khóa tìm kiếm!";
        }
        break;

    case 'home':  // Trang chủ
    default:
        $controller = new HomeController();  // Tạo đối tượng HomeController
        $controller->index();  // Hiển thị danh sách tin tức trên trang chủ
        break;
}
?>
