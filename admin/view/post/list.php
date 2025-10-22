<h5 class="mb-3">Danh sách bài viết</h5>

<a href="?page=post_add" class="btn btn-success mb-3">
    <i class="fa fa-plus"></i> Thêm bài viết
</a>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr class="text-center">
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Ảnh</th>
            <th>Tác giả</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($posts)): ?>
            <tr><td colspan="6" class="text-center text-muted">Chưa có bài viết nào</td></tr>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td class="text-center"><?= $post['id']; ?></td>
                    <td><?= htmlspecialchars($post['title']); ?></td>
                    <td class="text-center">
                        <img src="../uploads/<?= htmlspecialchars($post['image'] ?? 'default.jpg'); ?>" width="100" height="70" style="object-fit:cover;">
                    </td>
                    <td class="text-center"><?= htmlspecialchars($post['author'] ?? 'Admin'); ?></td>
                    <td class="text-center"><?= $post['created'] ?? ''; ?></td>
                    <td class="text-center">
                        <a href="?page=post_edit&id=<?= $post['id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="?page=post_delete&id=<?= $post['id']; ?>" onclick="return confirm('Xóa bài viết này?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
