<?php
// Tự động tải các file controller
require_once 'controllers/HomeController.php';
require_once 'controllers/NewsController.php';
require_once 'controllers/AdminController.php';

// Lấy tham số từ URL
$action = isset($_GET['action']) ? $_GET['action'] : 'home'; // Mặc định là trang chủ
$id = isset($_GET['id']) ? $_GET['id'] : null;              // ID cho các hành động cần tham số ID
$search = isset($_GET['search']) ? $_GET['search'] : null;  // Từ khóa tìm kiếm

// Tạo đối tượng controller tương ứng và gọi phương thức phù hợp
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

    case 'admin':  // Hiển thị trang đăng nhập
        $controller = new AdminController();
        $controller->login();
        break;

   

    case 'home':  // Trang chủ
    default:
        $controller = new HomeController();
        $controller->index();  // Hiển thị danh sách tin tức trên trang chủ
        break;
}
?>
