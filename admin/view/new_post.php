<?php
require_once '../model/Post.php';
$postModel = new Post();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $contents = $_POST['contents'];
    $author = $_POST['author'];

    if ($postModel->addPost($title, $image, $contents, $author)) {
        header("Location: ?select=postmanagement");
        exit;
    } else {
        echo "<p style='color:red;'>Lỗi khi thêm bài viết!</p>";
    }
}
?>

<div class="container mt-4">
    <h2>📝 Thêm bài viết mới</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ảnh (tên file)</label>
            <input type="text" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="contents" class="form-control" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label>Tác giả</label>
            <input type="text" name="author" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
