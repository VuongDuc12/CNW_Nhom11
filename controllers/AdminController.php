<?php
require_once __DIR__.'/../models/User.php';

require_once __DIR__.'/../models/Datanews.php';

require_once __DIR__ . '/../models/DataCaTegory.php';
class AdminController{
    private $dataNews;
    private $dataCategory;
    public function __construct()
    {
        $this->dataNews = new DataNews();
        $this->dataCategory = new DataCaTefory();
    }
    public function index(){
        $dataNews = new DataNews();
        $newList = $dataNews->getAllNews();
        include __DIR__.'/../views/Admin/news/newAdmin.php';
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


   public function addTinTuc()
{
    require_once __DIR__ . '/../views/Admin/news/add.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['news_name'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        $fileName = $_FILES['fileToUpload']['name'];
        $fileType = $_FILES['fileToUpload']['type'];
        $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
        $fileError = $_FILES['fileToUpload']['error'];
        $fileSize = $_FILES['fileToUpload']['size'];

        // Cắt đuôi file
        $fileExt = explode('.', $fileName);
        $fileActuaExt = strtolower(end($fileExt));

        // Các đuôi file hợp lệ
        $listImgExt = array('jpg', 'jpeg', 'png', 'pdf', 'gif');

        if (in_array($fileActuaExt, $listImgExt)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {
                    // Tạo tên file duy nhất
                    $fileNameNew = uniqid('', true) . "." . $fileActuaExt;

                    // Đường dẫn lưu trữ file
                    $uploadDir = __DIR__ . '/../../assets/images/uploads/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
                    }

                    $fileDestination = $uploadDir . $fileNameNew;
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        echo "File đã được tải lên: $fileDestination";
                    } else {
                        echo "Lỗi khi lưu file.";
                    }
                } else {
                    echo "Kích thước file quá lớn. Tối đa 5MB.";
                }
            } else {
                echo "Có lỗi khi tải file.";
            }
        } else {
            echo "Định dạng file không hợp lệ.";
        }

        // Lưu thông tin vào cơ sở dữ liệu
        $relativePath = "../../assets/images/uploads/" . $fileNameNew; // Đường dẫn tương đối để lưu vào DB
        $this->dataCategory->addCategory($name);
        $this->dataNews->addNews($name, $title, $content, $relativePath);

        header("Location: index.php?controller=Admin&action=index");
        exit();
    }
}

    public function editTinTuc()
    {
        require_once __DIR__ . '/../views/Admin/news/edit.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $editIndex = $_POST['edit_index'] ?? null;
            $category_id = $_POST['category_id'] ?? null;
            $name = trim($_POST['news_name'] ?? '');
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');

            if ($editIndex !== null) {
                $editIndex = (int) $editIndex;
                $old_image = $_POST['old_image']; // Đường dẫn ảnh cũ

                $image = $old_image; // Mặc định giữ lại ảnh cũ nếu không tải ảnh mới

                $fileName = $_FILES['fileToUpload']['name'];
                $fileType = $_FILES['fileToUpload']['type'];
                $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
                $fileError = $_FILES['fileToUpload']['error'];
                $fileSize = $_FILES['fileToUpload']['size'];

                // cắt đuôi file
                $fileExt = explode('.', $fileName);
                $fileActuaExt = strtolower(end($fileExt));


                $listImgExt = array('jpg', 'jpeg', 'png', 'pdf', 'gif');

                if (in_array($fileActuaExt, $listImgExt)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActuaExt;
                            $fileDestination = './config/images/' . $fileNameNew;
                            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                                echo "File đã được tải lên: $fileDestination";
                                $image = $fileDestination;

                                // Xóa ảnh cũ nếu ảnh mới tải lên thành công
                                if (file_exists($old_image)) {
                                    unlink($old_image);
                                }
                            } else {
                                echo "Lỗi khi lưu file.";
                            }
                        } else {
                            echo "Lỗi";
                        }
                    } else {
                        echo "Lỗi";
                    }
                } else {
                    echo "Lỗi";
                }
                $this->dataCategory->editCategory($category_id , $name);
                $this->dataNews->editNews($editIndex , $title, $content, $image );
                header('Location: index.php?controller=Admin&action=index');
                exit();
            }
        }
    }



    // Xóa tin tức
    public function deleteTinTuc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idNews = $_POST['idNews'] ?? null; // Lấy chỉ số cần xóa nếu có
            $idCategory = $_POST['idCategory'] ?? null;
            if ($idNews !== null && is_numeric($idNews)) {
                // Xóa phần tử khỏi danh sách
                $this->dataNews->deleteNews($idNews);
                $this->dataCategory->deleteCategory($idCategory);
            }
            header('Location: index.php?controller=Admin&action=index');
            exit();
        }
    }


}
?>