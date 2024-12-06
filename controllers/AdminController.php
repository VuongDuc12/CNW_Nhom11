<?php
require_once __DIR__.'/../models/User.php';
class AdminController{
    public function index(){
        include __DIR__.'/../views/Admin/dashboard.php';
    }
    //Login
    public function login(){
        include __DIR__.'/../views/Admin/login.php';
    }
    public function handleLogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['signIn']) && $_POST['signIn'] === 'login') {
                if (isset($_POST['username'], $_POST['password'])) {
                  
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    echo $username;
                    // Gọi phương thức login để kiểm tra thông tin người dùng
                    $result = User::login($username, $password);
                    
                    if ($result) {
                        // Đăng nhập thành công, lưu thông tin người dùng vào session
                        session_start();
                        $_SESSION['user'] = $result['username']; // Lưu thông tin người dùng vào session
                        
                        // Kiểm tra quyền của người dùng
                        if ($result['role'] == 1) { 
                            echo 'Quản trị viên';// Quản trị viên
                            header("Location: index.php?controller=Admin&action=index");
                        } else {
                            echo header("khách");
                            header("Location: index.php?controller=News&action=index");
                        }
                    } else {
                        echo "Invalid username or password";
                    }
                }
            }
            }
        }
    
    //Log out
    public static function logout(){
        session_start();//Khởi tạo session=>khởi động trước khi thực hiện làm việc với session
        session_destroy();
        header("Location: index.php?controller=Home&action=index");
    }
    //Create
    public function register(){
        include __DIR__.'/../views/Admin/register.php';
    }
    public function handleRegister(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['register'])&&$_POST['register']==='register'){
                if (isset($_POST['username'], $_POST['password'],$_POST['role'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $role = $_POST['role'];
                    $result = User::create($username,$password,$role);
                    if ($result)
                        header("Location: index.php?controller=Admin&action=login");
                    else echo "Register failed";   
                }
            }
        }   
    }
}
?>