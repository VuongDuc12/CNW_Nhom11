<?php
require_once './database/database.php';

 // Tạo class User
 class User {
    private $conn;
    public function __construct($db){
    $this->conn = $db;
    }
    public function getByUsername($username){
    $query = "SELECT * FROM users WHERE username =
    :username";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // ... (Các phương thức khác)
    
}
?>
