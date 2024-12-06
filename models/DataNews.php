<?php
require_once 'database/database.php';
class DataNews
{
    private $conn;

    // Constructor để khởi tạo kết nối cơ sở dữ liệu
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy dữ liệu tất cả tin tức
    public function getAllNews()
    {
        $sql = "select news.id,name,title,content,image , news.category_id from news
                inner join categories on categories.id = news.category_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm tin tức
    public function addNews($name , $title, $content, $image)
    {
        try {
            // Lấy ID của danh mục
            $categoryID = $this->getCategoryIDByName($name);
            if (!$categoryID) {
                echo "Danh mục không tồn tại!";
                return;
            }

            // Lấy ngày giờ hiện tại
            $createdAt = date('Y-m-d H:i:s');

            $query = "INSERT INTO news (title, content, image, created_at, category_id) 
                      VALUES (:title, :content, :image, :created_at, :category_id)";
            $stmt = $this->conn->prepare($query);

            // Gán giá trị tham số
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':content', $content);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':created_at', $createdAt);
            $stmt->bindValue(':category_id', $categoryID);
            $stmt->execute();

            echo "Thêm tin tức thành công!";
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Sửa tin tức
    public function editNews($id, $title, $content, $image)
    {
        $sql = "UPDATE news SET title = :title, content = :content, image = :image WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Xóa tin tức
    public function deleteNews($id)
    {
        $sql = "DELETE FROM news WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }




    // Tìm kiếm tin tức
    public function searchNews($keyword)
    {
        $sql = "SELECT * FROM news WHERE title LIKE :keyword OR content LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $likeKeyword = "%$keyword%";
        $stmt->bindParam(':keyword', $likeKeyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy thông tin tin tức theo ID
    public function getNewsById($id)
    {
        $sql = "SELECT * FROM news WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCategoryIDByName($categoryName) {
        try {
            $query = "SELECT id FROM categories WHERE name = :name LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $categoryName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['id'] : null;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }

}