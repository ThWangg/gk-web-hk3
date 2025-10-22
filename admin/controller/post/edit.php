<?php
require_once __DIR__ . '/../../model/post.php';
$postModel = new Post();

$id = $_GET['id'] ?? 0;
$post = $postModel->getPostById($id);

if (!$post) {
    die("<div class='alert alert-danger'>Không tìm thấy bài viết</div>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $contents = $_POST['contents'] ?? '';
    $author = $_SESSION['username'] ?? 'Admin';

    $imageName = $post['image'];
    if (!empty($_FILES['image']['name'])) {
        $targetDir = __DIR__ . '/../../../uploads/';
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $imageName);
    }

    if ($postModel->updatePost($id, $title, $imageName, $contents, $author)) {
        header('Location: /admin/index.php?page=index.php');
        exit;
    } else {
        $error = $postModel->getLastError();
    }
}

include __DIR__ . '/../../view/post/edit.php';
