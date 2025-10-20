<?php
// admin/controller/post_list.php
// Hiển thị danh sách bài viết (được include trong index.php)

require_once __DIR__ . '/../../model/postAdmin.php';
$postModel = new Post();

// helper: thử nhiều tên method khác nhau
function model_call($obj, $names, ...$args) {
    foreach ((array)$names as $n) {
        if (method_exists($obj, $n)) {
            return $obj->$n(...$args);
        }
    }
    return false;
}

$posts = model_call($postModel, ['getAll','getAllPosts','all','listPosts']) ?: [];
$msg = $_GET['msg'] ?? null;
?>
<?php if ($msg === 'added'): ?>
  <div class="alert alert-success">Thêm bài viết thành công.</div>
<?php elseif ($msg === 'updated'): ?>
  <div class="alert alert-success">Cập nhật bài viết thành công.</div>
<?php elseif ($msg === 'deleted'): ?>
  <div class="alert alert-success">Xóa bài viết thành công.</div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h5 class="mb-0">📚 Danh sách bài viết</h5>
  <a class="btn btn-primary" href="?page=post_new"><i class="fa fa-plus me-1"></i> Thêm bài viết mới</a>
</div>

<div class="table-responsive">
<table class="table table-bordered align-middle">
  <thead class="table-dark">
    <tr>
      <th style="width:70px">ID</th>
      <th>Tiêu đề</th>
      <th style="width:140px">Ảnh</th>
      <th style="width:140px">Tác giả</th>
      <th>Nội dung</th>
      <th style="width:160px">Hành động</th>
    </tr>
  </thead>
  <tbody>
    <?php if (empty($posts)): ?>
      <tr><td colspan="6" class="text-center text-muted">Chưa có bài viết nào.</td></tr>
    <?php else: foreach ($posts as $p): ?>
      <tr>
        <td><?php echo htmlspecialchars($p['id']); ?></td>
        <td><?php echo htmlspecialchars($p['title']); ?></td>
        <td>
          <?php if (!empty($p['image'])): ?>
            <img src="../upload/image/<?php echo htmlspecialchars($p['image']); ?>" style="width:110px;height:70px;object-fit:cover;border-radius:4px">
          <?php endif; ?>
        </td>
        <td><?php echo htmlspecialchars($p['author']); ?></td>
        <td><?php echo htmlspecialchars(mb_substr(strip_tags($p['contents'] ?? ''),0,120)); ?>...</td>
        <td>
          <a class="btn btn-sm btn-warning" href="?page=post_edit&id=<?php echo $p['id']; ?>"><i class="fa fa-pen"></i> Sửa</a>
          <a class="btn btn-sm btn-danger" href="?page=post_delete&id=<?php echo $p['id']; ?>" onclick="return confirm('Xóa bài viết này?')"><i class="fa fa-trash"></i> Xóa</a>
        </td>
      </tr>
    <?php endforeach; endif; ?>
  </tbody>
</table>
</div>
