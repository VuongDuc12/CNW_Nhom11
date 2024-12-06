<?php
class Database {
    // Database configuration information
    private $host = "localhost";
    private $database_name = "news_website";
    private $username = "root";
    private $password = "";
    public $conn;

    // Connection method
    public function getConnection() {
        $this->conn = null;

        try {
            // PDO connect
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name,$this->username,$this->password);
            // Set UTF-8
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            // Connection error handling
            echo "Database could not be connected: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>