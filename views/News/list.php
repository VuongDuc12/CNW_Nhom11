<!-- views/news/list.php -->

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Tin Tức</title>
    <!-- Thêm Bootstrap hoặc CSS tùy chỉnh của bạn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4 text-success">Danh Sách Tin Tức</h3>
        
        <!-- Kiểm tra nếu có tin tức để hiển thị -->
        <?php if (!empty($allNews)): ?>
            <div class="row">
                <?php foreach ($allNews as $news): ?>
                    <div class="col-md-4 d-flex align-items-stretch my-3">
                        <div class="card shadow-sm">
                            <img src="../assets/img/<?php echo htmlspecialchars($news['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($news['title']); ?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($news['title']); ?></h5>
                                <p class="card-text"><?php echo substr($news['content'], 0, 100) . '...'; ?></p>
                                <a href="index.php?action=viewNews&id=<?php echo $news['id']; ?>" class="btn btn-primary mt-3">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Không có tin tức để hiển thị.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
