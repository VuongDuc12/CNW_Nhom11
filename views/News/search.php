<!-- views/news/search.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm Tin Tức</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="mb-4">Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($keyword); ?>"</h3>
    
    <div class="row">
        <?php if (!empty($searchResults)): ?>
            <?php foreach ($searchResults as $news): ?>
                <div class="col-md-4 d-flex align-items-stretch my-3">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/800x300" alt="<?php echo htmlspecialchars($news['title']); ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($news['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($news['content']); ?></p>
                            <a href="index.php?action=viewNews&id=<?php echo $news['id']; ?>" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có kết quả tìm kiếm nào.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
