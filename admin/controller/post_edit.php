<?php
// admin/controller/post_edit.php
// Show edit form + xử lý POST update

require_once __DIR__ . '/../../model/postAdmin.php';
$postModel = new Post();

function model_call($obj, $names, ...$args) {
    foreach ((array)$names as $n) {
        if (method_exists($obj, $n)) return $obj->$n(...$args);
    }
    return false;
}

$id = (int)($_GET['id'] ?? 0);
$post = model_call($postModel, ['getById','getPostById','find','findById'], $id);
if (!$post) {
    echo '<div class="alert alert-danger">Bài viết không tồn tại.</div>';
    return;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $contents = $_POST['contents'] ?? '';
    $author = trim($_POST['author'] ?? ($_SESSION['username'] ?? 'Admin'));

    $uploadDir = __DIR__ . '/../../upload/image/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $imageName = $post['image'] ?? '';
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '_', basename($_FILES['image']['name']));
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName)) {
            $errors[] = 'Không thể upload ảnh mới.';
        }
    }

    if ($title === '') $errors[] = 'Tiêu đề không được để trống.';

    if (empty($errors)) {
        // Một vài model update signature khác nhau; thử các tên
        $ok = false;
        if (method_exists($postModel, 'update')) {
            $ok = $postModel->update($id, $title, $imageName, $contents, $author);
        } else if (method_exists($postModel, 'updatePost')) {
            $ok = $postModel->updatePost($id, $title, $imageName, $contents, $author);
        // } else if (method_exists($postModel, 'save')) {
        //     // some save($id, ...) signature — unlikely; skip
        //     $ok = $postModel->save($id, $title, $imageName, $contents, $author);
        } else {
            $ok = false;
        }

        if ($ok) {
            header('Location: ?page=post_list&msg=updated');
            exit();
        } else {
            $errors[] = 'Cập nhật thất bại.';
        }
    }
}
?>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger">
    <?php foreach ($errors as $e) echo '<div>'.htmlspecialchars($e).'</div>'; ?>
  </div>
<?php endif; ?>

<h5 class="mb-3">✎ Sửa bài viết</h5>
<form method="post" enctype="multipart/form-data" action="?page=post_edit&id=<?php echo $id; ?>">
  <div class="row">
    <div class="col-lg-8 mb-3">
      <label class="form-label">Nội dung bài viết</label>
      <textarea name="contents" id="editor_edit" rows="12" class="form-control"><?php echo htmlspecialchars($post['contents'] ?? ''); ?></textarea>
    </div>
    <div class="col-lg-4">
      <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input class="form-control" name="title" value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Ảnh đại diện</label>
        <?php if (!empty($post['image'])): ?>
          <div class="mb-2"><img src="../upload/image/<?php echo htmlspecialchars($post['image']); ?>" style="width:100%;object-fit:cover;border-radius:4px"></div>
        <?php endif; ?>
        <input type="file" name="image" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Tác giả</label>
        <input class="form-control" name="author" value="<?php echo htmlspecialchars($post['author'] ?? ($_SESSION['username'] ?? '')); ?>">
      </div>
      <div class="d-grid">
        <button class="btn btn-danger" type="submit">Cập nhật</button>
        <a class="btn btn-secondary mt-2" href="?page=post_list">Quay lại danh sách</a>
      </div>
    </div>
  </div>
</form>

<script>CKEDITOR.replace('editor_edit',{height:300});</script>
