<?php
require_once __DIR__ . '/../database/database.php';
// models/News.php
// models/News.php
class News {
    private $pdo;

    // Khởi tạo kết nối PDO
    public function __construct($pdo)
    {
        $this->pdo = $pdo; // Sử dụng PDO đã được truyền vào từ controller
    }

    // Phương thức lấy chi tiết tin tức theo ID
    public function getNewsById($id)
    {
        if ($this->pdo) {
            $sql = "SELECT * FROM news WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } else {
            echo "Không có kết nối cơ sở dữ liệu!";
            return null;
        }
    }

    // Phương thức lấy tất cả tin tức
    public function getAllNews() {
        $sql = "SELECT * FROM news ORDER BY created_at DESC";  // Câu lệnh SQL lấy tin tức
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();  // Thực thi truy vấn
        return $stmt;  // Trả về PDOStatement
    }
    public function searchNews($keyword)
    {
        $sql = "SELECT * FROM news WHERE title LIKE :keyword OR content LIKE :keyword";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll();
    }
}

?>

