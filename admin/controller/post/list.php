<?php
require_once __DIR__ . '/../../model/post.php';
$postModel = new Post();

$posts = $postModel->getAllPosts();

// truyền dữ liệu sang view
include __DIR__ . '/../../view/post/list.php';
