<?php
session_start();
require_once '../model/post.php';
require_once '../model/comment.php';

$postModel = new Post();
$commentModel = new Comment();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$post = $postModel->getPostById($id);
$comments = $commentModel->getCmtByPostId($id);

if (!$post) {
    echo "<p class='text-center mt-5 text-danger'>Bài viết không tồn tại.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php require_once('header.php'); ?>

<div class="container my-5">
    <div class="p-4 bg-white shadow-sm">
        <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" class="img-fluid mb-3" alt="">
        <h2 class="fw-bold text-primary mb-3"><?php echo htmlspecialchars($post['title']); ?></h2>
        <p class="text-muted small mb-4">Đăng bởi: <strong><?php echo htmlspecialchars($post['author'] ?? 'Admin'); ?></strong></p>
        <div class="mb-5">
            <?php echo nl2br(htmlspecialchars($post['contents'])); ?>
        </div>

        <hr>

        <h5 class="fw-bold">Bình luận</h5>
        <?php if (isset($_SESSION['user'])): ?>
            <form action="add_comment.php" method="POST" class="mt-3">
                <input type="hidden" name="post_id" value="<?php echo $id; ?>">
                <textarea name="content" class="form-control mb-2" rows="3" placeholder="Nhập bình luận của bạn..." required></textarea>
                <button type="submit" class="btn btn-success btn-sm">Đăng bình luận</button>
            </form>
        <?php else: ?>
            <p class="text-muted mt-3 fst-italic">Bạn phải đăng nhập để comment.</p>
        <?php endif; ?>

        <div class="mt-4">
            <?php if (empty($comments)): ?>
                <p class="text-muted">Chưa có bình luận nào.</p>
            <?php else: ?>
                <?php foreach ($comments as $c): ?>
                    <div class="border p-2 mb-2 bg-light">
                        <strong><?php echo htmlspecialchars($c['username']); ?></strong><br>
                        <span class="small text-muted"><?php echo htmlspecialchars($c['created_at']); ?></span>
                        <p class="mb-0 mt-1"><?php echo htmlspecialchars($c['contents']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
