<?php
require_once __DIR__.'/../database/database.php';
class User{
    //login
    public static function login($username, $password) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Truy vấn người dùng theo tên đăng nhập
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Nếu có kết quả và mật khẩu trùng khớp
        if ($result && $password === $result['password']) {
            return $result;
        }
        return false;
    }
    
    //Create
    public static function create($username,$password,$role){
        $database = new Database();
        $conn = $database->getConnection();
        //Mã hoá mật khẩu
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('insert into users(username,password,role) values(:username,:password,:role)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPass);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }
}
?>