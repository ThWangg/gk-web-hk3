<?php
require_once __DIR__ . '/../../model/post.php';
$postModel = new Post();

$id = $_GET['id'] ?? 0;

if ($id && $postModel->deletePost($id)) {
    header('Location: /admin/index.php?page=index.php');
    exit;
} else {
    echo "<div class='alert alert-danger'>Lỗi khi xóa: " . htmlspecialchars($postModel->getLastError()) . "</div>";
}
