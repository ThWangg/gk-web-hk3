<h5 class="mb-3">Chỉnh sửa bài viết</h5>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['title']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Ảnh hiện tại</label><br>
        <img src="../uploads/<?= htmlspecialchars($post['image']); ?>" width="150" class="mb-2"><br>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Nội dung</label>
        <textarea name="contents" class="form-control" rows="8"><?= htmlspecialchars($post['contents']); ?></textarea>
        <script>CKEDITOR.replace('contents');</script>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="?page=post_list" class="btn btn-secondary">Quay lại</a>
</form>
