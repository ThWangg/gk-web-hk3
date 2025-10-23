<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

</body>

</html>
<?php
require_once '../model/tour.php';
require_once '../view/header.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$tourModel = new Tour();
$tour = $tourModel->getTourById($id);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tour ? htmlspecialchars($tour['name']) : 'Chi tiết tour' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include 'header.php'; ?>

<div class="container py-5">
    <?php if (!$tour): ?>
        <div class="alert alert-danger text-center mt-5 shadow-sm">
            <i class="bi bi-exclamation-triangle-fill"></i> Không tìm thấy tour này.
        </div>
    <?php else: ?>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="tour.php" class="text-decoration-none text-primary">Tour du lịch</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($tour['name']) ?></li>
            </ol>
        </nav>

        <!-- Thông tin tour -->
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <img src="../upload/image/<?= htmlspecialchars($tour['image']) ?>" 
                alt="<?= htmlspecialchars($tour['name']) ?>" 
                class="img-fluid w-100" style="max-height: 450px; object-fit: cover;">

            <div class="card-body p-4">
                <h2 class="card-title fw-bold mb-3 text-primary"><?= htmlspecialchars($tour['name']) ?></h2>
                
                <div class="mb-3">
                    <p class="mb-1"><strong>Giá:</strong> <span class="text-danger fs-5 fw-bold"><?= number_format($tour['price'], 0, ',', '.') ?>đ</span></p>
                    <p class="mb-1"><strong>Thời gian:</strong> <?= htmlspecialchars($tour['day']) ?> ngày</p>
                    <p class="mb-1"><strong>Đánh giá:</strong> 
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="bi <?= $i <= $tour['rating'] ? 'bi-star-fill text-warning' : 'bi-star text-secondary' ?>"></i>
                        <?php endfor; ?>
                        <span class="ms-1">(<?= htmlspecialchars($tour['rating']) ?>/5)</span>
                    </p>
                </div>

                <hr>

                <div class="mt-3">
                    <h5 class="fw-bold text-secondary">Thông tin chi tiết</h5>
                    <p class="mt-2" style="white-space: pre-line;"><?= nl2br(htmlspecialchars($tour['info'])) ?></p>
                </div>

                <div class="mt-4 text-end">
                    <a href="tour.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Quay lại danh sách</a>
                    <a href="#" class="btn btn-primary"><i class="bi bi-cart-plus"></i> Đặt tour ngay</a>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
