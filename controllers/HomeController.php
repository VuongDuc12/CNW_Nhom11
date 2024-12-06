<?php
// controllers/HomeController.php
// controllers/HomeController.php

require_once __DIR__ . '/../models/News.php';  // Nhúng lớp News
require_once __DIR__ . '/../database/database.php'; // Nhúng lớp Database

class HomeController {
    public function index() {
        // Tạo đối tượng Database để kết nối với cơ sở dữ liệu
        $db = new Database();
        $connection = $db->getConnection();
        
        // Tạo đối tượng News để truy vấn dữ liệu
        $news = new News($connection);
        
        // Lấy tất cả các tin tức (trả về PDOStatement)
        $stmt = $news->getAllNews();  // Lấy PDOStatement

        // Lưu các tin tức vào một mảng
        $newsItems = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $newsItems[] = $row;  // Fetch each row from the PDOStatement
        }
        
        // Truyền các tin tức vào view (index.php)
        include_once(__DIR__ . '/../views/home/index.php');
    }
}

?>
