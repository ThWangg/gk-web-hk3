<?php
require_once __DIR__ . '/../../model/post.php';
$postModel = new Post();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $contents = $_POST['contents'] ?? '';
    $author = $_SESSION['username'] ?? 'Admin';

    $imageName = '';
    if (!empty($_FILES['image']['name'])) {
        $targetDir = __DIR__ . '/../../../uploads/';
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $imageName);
    }

    if ($postModel->addPost($title, $imageName, $contents, $author)) {
        header('Location: /admin/index.php?page=index.php');
        exit;
    } else {
        $error = $postModel->getLastError();
    }
}

include __DIR__ . '/../../view/post/add.php';