<?php
require_once __DIR__ . '/../../model/tour.php';
$tourModel = new Tour();

$id = $_GET['id'] ?? null;

if ($id) {
    $tourModel->deleteTour($id);
}

header('Location: /admin/index.php?page=index.php');
exit;
?>
