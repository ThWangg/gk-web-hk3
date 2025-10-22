<h5 class="mb-3">Thêm bài viết mới</h5>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Ảnh</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Nội dung</label>
        <textarea name="contents" class="form-control" rows="8"></textarea>
        <script>CKEDITOR.replace('contents');</script>
    </div>

    <button type="submit" class="btn btn-primary">Đăng bài</button>
    <a href="?page=post_list" class="btn btn-secondary">Hủy</a>
</form>
