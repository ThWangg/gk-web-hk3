<?php
require_once __DIR__ . '/../../model/tour.php';
$tourModel = new Tour();

$id = $_GET['id'] ?? null;
$tour = $tourModel->getTourById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $day = $_POST['day'];
    $rating = $_POST['rating'];
    $info = $_POST['info'];

    if ($tourModel->updateTour($id, $name, $price, $day, $rating, $info)) {
        header('Location: /admin/index.php?page=index.php');
        exit;
    } else {
        $error = "Cập nhật thất bại!";
    }
}

include __DIR__ . '/../../view/tour/edit.php';
?>
