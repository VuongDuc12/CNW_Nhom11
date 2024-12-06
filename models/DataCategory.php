<?php
require_once 'database/database.php';
class DataCaTefory
{
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    public function addCategory($ten)
    {
        $sql = "insert into categories(name) value (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $ten);
        return $stmt->execute();
    }

    public function editCategory($id, $newName)
    {
        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $newName);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}