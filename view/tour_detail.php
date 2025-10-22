<?php
require_once '../model/tour.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$tourModel = new Tour();
$tour = $tourModel->getTourById($id);
?>

<?php if (!$tour): ?>
    <p class="text-center mt-5 text-danger">Không tìm thấy tour này.</p>
<?php else: ?>
    <div class="container my-5">
        <h2 class="fw-bold mb-3"><?= htmlspecialchars($tour['name']) ?></h2>
        <img src="../upload/image/<?= htmlspecialchars($tour['image']) ?>" 
             alt="<?= htmlspecialchars($tour['name']) ?>" 
             class="img-fluid rounded mb-3" style="max-height: 400px; object-fit: cover;">
        <p><strong>Giá:</strong> <?= number_format($tour['price'], 0, ',', '.') ?>đ</p>
        <p><strong>Số ngày:</strong> <?= htmlspecialchars($tour['day']) ?> ngày</p>
        <p><strong>Đánh giá:</strong> ⭐ <?= htmlspecialchars($tour['rating']) ?></p>
        <hr>
        <p><?= nl2br(htmlspecialchars($tour['info'])) ?></p>
    </div>
<?php endif; ?>
