<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Tin Tức</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-img-top {
            max-height: 300px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .card-text p {
            line-height: 1.6;
            color: #555;
        }

        .text-muted {
            font-size: 0.9rem;
            color: #777;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-sm">
        <img src="https://via.placeholder.com/800x300" alt="Ảnh tin tức" class="card-img-top">
        <div class="card-body">
            <h1 class="card-title text-center mb-3">Tiêu đề tin tức</h1>
            <p class="text-muted text-center">Ngày tạo: 2024-12-04</p>
            <div class="card-text">
                <p>
                    Đây là nội dung chi tiết của tin tức. Nội dung có thể bao gồm nhiều đoạn văn bản mô tả đầy đủ thông tin về tin tức này. 
                    Độc giả có thể xem thông tin chi tiết, ảnh minh họa và các thông tin liên quan khác.
                </p>
                <p>
                    Nội dung có thể chứa các trích dẫn, số liệu thống kê hoặc bất kỳ thông tin bổ sung nào giúp tin tức hấp dẫn hơn.
                </p>
            </div>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-primary px-4">Quay lại</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>