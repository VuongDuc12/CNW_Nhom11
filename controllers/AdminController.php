<?php
    require_once("./database/database.php");
    require_once './models/User.php';
class AdminController
{
    public function index()
    {
       
       
        require_once 'views/Admin/dashboard.php';
    } 
    public function login() {
      
    
        $database = new Database();
        $db = $database->getConnection();
       
        $user = new User($db);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userData = $user->getByUsername($username);
        if ($userData && password_verify($password, 
       $userData['password'])) {
        // Xác thực thành công
        $_SESSION['user_id'] = $userData['id'];
        // ... (Lưu thêm thông tin)
        } else {
        // Xác thực thất bại
        }
        }
        
    }
    public function dashboard() {
        
        echo'Đã gọi đến dasboard';
        // Tải giao diện Dashboard
        require_once 'views/Admin/dashboard.php';
    }
   
}