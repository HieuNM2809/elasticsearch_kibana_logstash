<?php
$page = $_GET['page'] ?? '';

$menuitems = [
    'manageindex' => 'Quản lý Index',
    'document' => 'Cập nhật Document',
    'search' => 'Tìm kiếm',
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elasticsearch với PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!--
    /                    trang index.php
    /?page=manageindex   quan ly ES index
    /?page=document      luu cap nhat Document
    /?page=search        tim kiem tren ES
-->

<nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
    <a class="navbar-brand" href="/">Elasticsearch</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Trang chủ</a>
            </li>
            <?php foreach ($menuitems as $url => $label): ?>
                <?php $activeclass = ($page == $url) ? 'active' : ''; ?>
                <li class="nav-item">
                    <a class="nav-link <?= $activeclass ?>" href="/?page=<?= $url ?>"><?= $label ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>

<div class="container content">
    <?php if ($page == ''): ?>
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">Thực hành Elasticsearch</h4>
            <p>Chào mừng bạn đến với trang thực hành Elasticsearch với PHP. Vui lòng chọn một mục từ menu để bắt đầu.</p>
        </div>
    <?php else: ?>
        <?php include $page . '.php'; ?>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
