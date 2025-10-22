<?php
require_once __DIR__ . '/../../model/tour.php';
$tourModel = new Tour();

$tours = $tourModel->getAllTours();

include __DIR__ . '/../../view/tour/list.php';
?>
