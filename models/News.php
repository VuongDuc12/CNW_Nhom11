<?php
require_once __DIR__ . '/../database/database.php';

class News
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllNews()
    {
        $sql = "SELECT news.*, categories.name AS category_name 
                FROM news 
                LEFT JOIN categories ON news.category_id = categories.id
                ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id)
    {
        $sql = "SELECT news.*, categories.name AS category_name 
                FROM news 
                LEFT JOIN categories ON news.category_id = categories.id
                WHERE news.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchNews($keyword)
    {
        $sql = "SELECT news.*, categories.name AS category_name 
                FROM news 
                LEFT JOIN categories ON news.category_id = categories.id
                WHERE news.title LIKE :keyword
                ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':keyword', "%$keyword%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}