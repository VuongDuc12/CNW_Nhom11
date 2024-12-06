
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <style>
        .carousel-image { height: 400px; object-fit: cover; border: 3px solid green; border-radius: 10px; }
        #login {
            padding: 10px 20px; /* Tăng kích thước nút */
            margin: 60px
            background-color: #007bff; /* Màu nền */
            color: white; /* Màu chữ */
            font-weight: bold;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .d-flex{
            margin: 0px 20px;
        }
        .navbar-brand{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">News</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="index.php">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="index.php">Contact</a></li>
                </ul>
                <?php
                        $keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '';
                ?>
                <form class="d-flex" method="GET">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." value="<?php echo $keyword; ?>" name="keyword">
                <button class="btn btn-primary" type="submit" name="action" value="searchNews">Tìm kiếm</button>
                </form>
                

                <a href="index.php?controller=Admin&action=login" class="btn btn-primary" id = 'login' >Đăng nhập</a>
                
            </div>
        </div>
    </nav>

    <!-- Flower Carousel -->
    <div class="container mt-5">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active"><img src="assets/img/dayenthao.webp" class="d-block w-100 carousel-image"></div>
                <div class="carousel-item"><img src="assets/img/HoaGiay.webp" class="d-block w-100 carousel-image"></div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>


    <!-- Danh sách tin tức -->
    <div class="container mt-5">
    <h3 class="mb-4 text-success fs-4 border-bottom">Tin tức hàng ngày</h3>
    <div class="row">
        <?php if (!empty($newsItems)): ?>
            <?php foreach ($newsItems as $news): ?>
                <div class="col-md-4 d-flex align-items-stretch my-3">
                    <div class="card shadow-sm">
                    <img src="<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['image']) ?>" class="card-img-top" >

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($news['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($news['content']); ?></p>
                            <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($news['category_id']); ?></p> <!-- Hoặc xử lý danh mục -->
                            <p><small><em>Ngày tạo: <?php echo htmlspecialchars($news['created_at']); ?></em></small></p>
                            <a href="index.php?controller=News&action=viewNews&id=<?php echo $news['id']; ?>" class="btn btn-primary mt-3">Chi tiết</a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Không có tin tức nào để hiển thị.</p>
        <?php endif; ?>
    </div>
</div>



    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; 2024 News.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
