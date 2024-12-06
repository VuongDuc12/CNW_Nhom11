<?php
// database/Database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'news_website';  // Tên cơ sở dữ liệu
    private $username = 'root';         // Tên người dùng
    private $password = '';             // Mật khẩu
    private $conn;

    // Hàm kết nối đến cơ sở dữ liệu
    public function getConnection() {
        $this->conn = null;
        try {
            // Đổi 'your_database' thành tên cơ sở dữ liệu của bạn
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            // Thiết lập chế độ báo lỗi của PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Hiển thị lỗi nếu kết nối không thành công
            echo 'Kết nối cơ sở dữ liệu không thành công: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
