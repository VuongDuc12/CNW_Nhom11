<?php
require_once './models/News.php';
require_once './database/Database.php';

class NewsController
{
    private $news;

    public function __construct()
    {
        // Tạo kết nối PDO từ lớp Database
        $database = new Database();
        $pdo = $database->getConnection();
        
        if ($pdo) {
            // Tạo đối tượng News với PDO đã kết nối
            $this->news = new News($pdo);
        } else {
            echo "Không thể kết nối tới cơ sở dữ liệu.";
        }
    }
    public function listNews()
    {
        $allNews = $this->news->getAllNews();  // Lấy tất cả tin tức
        include 'views/News/list.php';  // Hiển thị danh sách tin tức trong view
    }
    public function viewNews($id)
    {
        $newsItem = $this->news->getNewsById($id);
        include 'views/News/detail.php';
    }
    public function searchNews($keyword)
    {
        $searchResults = $this->news->searchNews($keyword);
        include 'views/News/search.php';  // Hiển thị kết quả tìm kiếm trong view
    }
}

?>
