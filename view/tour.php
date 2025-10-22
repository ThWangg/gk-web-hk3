<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="../controller/login.css">
</head>
<?php
require_once '../view/header.php';
?>

<body>
  <section class="ticket-section py-5">
  <div class="container text-center mb-4">
    <h2 class="section-title">Tất cả các Tour du lịch</h2>
  </div>

  <?php
  require_once '../model/tour.php';
  $tourModel = new Tour();
  $tours = $tourModel->getAllTours();
  ?>

  <div class="container">
    <div class="row g-4">
      <?php foreach ($tours as $tour): ?>
        <div class="col-md-4">
          <div class="ticket-card position-relative overflow-hidden">
            <a href="tour_detail.php?id=<?= $tour['id'] ?>" class="text-decoration-none text-white">
              <img src="../upload/image/<?= htmlspecialchars($tour['image']) ?>"
                alt="<?= htmlspecialchars($tour['name']) ?>"
                class="ticket-img w-100 rounded"
                style="height: 230px; object-fit: cover;">
              <div class="ticket-overlay position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-50">
                <p class="text-left mb-1 fw-bold"><?= htmlspecialchars($tour['name']) ?></p>
                <p class="text-right mb-0">Giá từ <?= number_format($tour['price'], 0, ',', '.') ?>đ</p>
              </div>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</body>