<?php
require_once __DIR__ . '/../../model/tour.php';
$tourModel = new Tour();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $day = $_POST['day'];
    $rating = $_POST['rating'];
    $info = $_POST['info'];

    if ($tourModel->addTour($name, $price, $day, $rating, $info)) {
        header('Location: /admin/index.php?page=index.php');
        exit;
    } else {
        $error = "Thêm tour thất bại!";
    }
}

include __DIR__ . '/../../view/tour/add.php';
?>
