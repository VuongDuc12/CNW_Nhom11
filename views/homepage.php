<?php


session_start();
include '../model/data.php';
// Kiểm tra nếu session có dữ liệu 'records'
if (!isset($_SESSION['records']) || !is_array($_SESSION['records'])) {
    echo "Error: No flower data found in session.";
    $_SESSION['records'] = [];// Gán giá trị mặc định nếu không có dữ liệu
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <style>
        .flower img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .carousel-image {
            height: 400px; /* Điều chỉnh chiều cao mong muốn */
            object-fit: cover; /* Giữ tỷ lệ và cắt ảnh nếu cần */
            border: 3px solid green; /* Đường viền màu xanh lá cây */
            border-radius: 10px; /* Bo góc nhẹ */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">News</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <!-- Nút đăng nhập -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-light" href="login.php">Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flower Carousel -->
    <div class="container mt-5">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/img/dayenthao.webp" class="d-block w-100 carousel-image" alt="Dạ yến thảo">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/HoaHuynhAnh.webp" class="d-block w-100 carousel-image" alt="Hoa giấy">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/HoaHuynhAnh.webp" class="d-block w-100 carousel-image" alt="Hoa huỳnh anh">
                </div>
            </div>

            <!-- Thêm nút điều khiển nếu cần -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Flower List -->
    <div class="container mt-5">
        <h3 class="mb-4 text-success fs-4 border-bottom">Tin tức hàng ngày</h3>
        <div class="row">
        <?php foreach ($_SESSION['records'] as $index => $flower): ?>
                <div class="col-md-4 d-flex align-items-stretch my-3">
                    <div class="card shadow-sm flower">
                        <img src="<?php echo $flower['image']; ?>" class="card-img-top" alt="<?php echo $flower['name']; ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $flower['name']; ?></h5>
                            <p class="card-text flex-grow-1"><?php echo $flower['description']; ?></p>
                            <a href="flower_detail.php?id=<?php echo $index; ?>" class="btn btn-primary mt-3">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; 2024 News.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
