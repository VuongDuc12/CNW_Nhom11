<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tin tức</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #495057;
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
        }

        .modal-footer {
            background-color: #f1f1f1;
        }

        #add-news {
            margin-top: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .flower-image {
            width: 100px;
            /* Chiều rộng tối đa của ảnh */
            height: 100px;
            /* Chiều cao tối đa của ảnh */
            object-fit: cover;
            /* Đảm bảo ảnh không bị méo */
            border-radius: 8px;
            /* Bo góc nhẹ cho ảnh */
            border: 1px solid #ccc;
            /* Thêm viền cho ảnh */
        }
    </style>
</head>

<body>

<div class="container">
    <h1>News</h1>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name News</th>
            <th>Title </th>
            <th>Content</th>
            <th>Images</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Dynamic news rows will be injected here -->
        <?php

        foreach ($newList as $index => $value):
            ?>
            <tr data-index="<?= $value['id'] ?>">
                <td><?= htmlspecialchars($value['name']) ?></td>
                <td><?= htmlspecialchars($value['title']) ?></td>
                <td><?= htmlspecialchars($value['content']) ?></td>
                <td><img src="<?= htmlspecialchars($value['image']) ?>" alt="<?= htmlspecialchars($value['image']) ?>" class="flower-image">
                <td>
                    <!-- Nút Sửa -->
                    <a href="index.php?controller=Admin&action=editTinTuc&id=<?= $value['id'] ?>&name=<?= urlencode($value['name']) ?>&title=<?= urlencode($value['title']) ?>&content=<?= urlencode($value['content']) ?>&image=<?= urlencode($value['image']) ?>&category_id=<?= urlencode($value['category_id']) ?>" class="btn btn-edit">
                        <button type="submit" class="btn btn-delete" style="background-color: #dfc2c4"> <i class="fa-solid fa-pen-to-square" ></i> Sửa</button>
                    </a>

                    <!-- Nút Xóa -->
                    <form action="index.php?controller=Admin&action=deleteTinTuc" method="POST" style="display: inline-block;">
                        <input type="hidden" name="idNews" value="<?= $value['id'] ?>">
                        <input type="hidden" name="idCategory" value="<?= $value['category_id'] ?>">
                        <button type="submit" class="btn btn-delete" style="background-color: #0dcaf0">
                            <i class="fa-solid fa-trash"></i> Xóa
                        </button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?controller=Admin&action=AddTinTuc"><button id="add-news" class="btn btn-primary">Thêm tin tức</button></a>
</div>


</body>

</html>