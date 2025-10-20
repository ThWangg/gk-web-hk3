<?php
// admin/controller/post_new.php
// Đây là file include trong admin/index.php
// DEBUG toggle:
$DEBUG = true; // set false sau khi fix

if ($DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require_once __DIR__ . '/../../model/post.php';
$postModel = new Post();

$errors = [];
// xử lý POST khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($DEBUG) {
        echo '<pre style="background:#f8f9fa;padding:10px;border:1px solid #ddd;">$_POST='; var_export($_POST);
        echo "\n\n\$_FILES="; var_export($_FILES);
        echo "</pre>";
    }

    $title = trim($_POST['title'] ?? '');
    $contents = $_POST['contents'] ?? '';
    $author = trim($_POST['author'] ?? ($_SESSION['username'] ?? 'Admin'));

    // upload dir: admin/controller -> ../../upload/image/
    $uploadDir = __DIR__ . '/../../upload/image/';
    if (!is_dir($uploadDir)) {
        if (!@mkdir($uploadDir, 0755, true)) {
            $errors[] = 'Không thể tạo thư mục upload: ' . $uploadDir;
        }
    }
    if (!is_writable($uploadDir)) {
        $errors[] = 'Thư mục upload không có quyền ghi: ' . $uploadDir;
    }

    // xử lý file upload
    $imageName = '';
    if (!empty($_FILES['image']['name'])) {
        if (!empty($_FILES['image']['error']) && $_FILES['image']['error'] !== 0) {
            $errors[] = 'Upload file lỗi (code): ' . $_FILES['image']['error'];
        } else {
            $imageBase = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '_', basename($_FILES['image']['name']));
            $target = $uploadDir . $imageBase;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $errors[] = 'move_uploaded_file thất bại. Kiểm tra quyền và php.ini (file_uploads, upload_max_filesize).';
                $errors[] = 'is_uploaded_file: ' . (is_uploaded_file($_FILES['image']['tmp_name']) ? 'yes' : 'no');
                $errors[] = 'tmp_name exists: ' . (file_exists($_FILES['image']['tmp_name']) ? 'yes' : 'no');
            } else {
                $imageName = $imageBase;
            }
        }
    }

    if ($title === '') $errors[] = 'Tiêu đề không được để trống.';

    if (empty($errors)) {
        // gọi model.insert
        if (!method_exists($postModel, 'insert')) {
            $errors[] = 'Model chưa có method insert(). Hãy thay file model/post.php bằng bản chuẩn.';
        } else {
            $ok = $postModel->insert($title, $imageName, $contents, $author);
            if ($ok) {
                header('Location: ?page=post_list&msg=added');
                exit();
            } else {
                $dbErr = $postModel->getLastError();
                $errors[] = 'Lưu bài viết thất bại. DB error: ' . $dbErr;
                @file_put_contents(__DIR__ . '/../../admin_insert_error.log', date('c') . " | INSERT FAIL | " . $dbErr . PHP_EOL, FILE_APPEND);
            }
        }
    }
}

// hiển thị lỗi nếu có
if (!empty($errors)): ?>
  <div class="alert alert-danger">
    <?php foreach ($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
  </div>
<?php endif; ?>

<!-- FORM -->
<h5 class="mb-3">✚ Thêm bài viết mới</h5>
<form method="post" enctype="multipart/form-data" action="?page=post_new">
  <div class="row">
    <div class="col-lg-8 mb-3">
      <label class="form-label">Nội dung bài viết</label>
      <textarea name="contents" id="editor_add" rows="12" class="form-control"><?php echo htmlspecialchars($_POST['contents'] ?? ''); ?></textarea>
    </div>
    <div class="col-lg-4">
      <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input class="form-control" name="title" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" placeholder="enter post title">
      </div>
      <div class="mb-3">
        <label class="form-label">Ảnh đại diện</label>
        <input type="file" name="image" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Tác giả</label>
        <input class="form-control" name="author" value="<?php echo htmlspecialchars($_POST['author'] ?? ($_SESSION['username'] ?? '')); ?>">
      </div>
      <div class="d-grid">
        <button class="btn btn-danger" type="submit">Tải lên bài viết</button>
      </div>
    </div>
  </div>
</form>

<script>CKEDITOR.replace('editor_add',{height:300});</script>
