<?php
// admin/view/postManagerView.php
// vars available: $action, $posts, $post, $errors, $success
$action = $action ?? 'list';
$posts = $posts ?? [];
$post = $post ?? null;
$errors = $errors ?? [];
$success = $success ?? null;
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Admin - Quản lý bài viết</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row vh-100">
            <!-- Sidebar -->
            <nav class="col-12 col-md-3 col-lg-2 bg-dark text-white p-3">
                <div class="d-flex align-items-center mb-4">
                    <img src="../upload/image/iconadmin.jpg" alt="" style="width:32px;height:32px;object-fit:cover" class="me-2 rounded">
                    <div>
                        <div class="fw-bold">Administrators</div>
                        <small class="text-muted"><?php echo htmlspecialchars($_SESSION['username']); ?></small>
                    </div>
                </div>

                <div class="nav flex-column nav-pills">
                    <a class="nav-link <?php echo $action === 'add' ? 'active' : 'text-white'; ?>" href="postController.php?action=add"><i class="fa fa-plus-square me-2"></i>Bài viết mới</a>
                    <a class="nav-link <?php echo $action === 'list' ? 'active' : 'text-white'; ?>" href="postController.php?action=list"><i class="fa fa-tasks me-2"></i>Quản lý bài viết</a>
                    <a class="nav-link text-white" href="#"><i class="fa fa-location-arrow me-2"></i>Quản lý địa điểm</a>
                    <a class="nav-link text-white" href="#"><i class="fa fa-comment me-2"></i>Quản lý bình luận</a>
                    <a class="nav-link text-white" href="#"><i class="fa fa-user-cog me-2"></i>Quản lý user</a>
                    <hr class="text-secondary my-3">
                    <a class="nav-link text-white" href="../view/index.php"><i class="fa fa-home me-2"></i>Vào trang web</a>
                    <a class="nav-link text-danger" href="../controller/logout.php"><i class="fa fa-sign-out-alt me-2"></i>Đăng xuất</a>
                </div>
            </nav>

            <!-- Main -->
            <main class="col p-4 overflow-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Quản lý bài viết</h4>
                    <small class="text-muted">Chào, <?php echo htmlspecialchars($_SESSION['username']); ?></small>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                        <?php endif; ?>

                        <?php if ($action === 'list'): ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">📚 Danh sách bài viết</h5>
                                <a class="btn btn-primary" href="postController.php?action=add"><i class="fa fa-plus me-1"></i> Thêm bài viết mới</a>
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
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Chưa có bài viết nào.</td>
                                            </tr>
                                            <?php else: foreach ($posts as $p): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($p['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($p['title']); ?></td>
                                                    <td><?php if (!empty($p['image'])): ?><img src="../upload/image/<?php echo htmlspecialchars($p['image']); ?>" style="width:110px;height:70px;object-fit:cover;border-radius:4px"><?php endif; ?></td>
                                                    <td><?php echo htmlspecialchars($p['author']); ?></td>
                                                    <td><?php echo htmlspecialchars(mb_substr(strip_tags($p['contents'] ?? ''), 0, 120)); ?>...</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning" href="postController.php?action=edit&id=<?php echo $p['id']; ?>"><i class="fa fa-pen"></i> Sửa</a>
                                                        <a class="btn btn-sm btn-danger" href="postController.php?action=delete&id=<?php echo $p['id']; ?>" onclick="return confirm('Xóa bài viết này?')"><i class="fa fa-trash"></i> Xóa</a>
                                                    </td>
                                                </tr>
                                        <?php endforeach;
                                        endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php elseif ($action === 'add'): ?>
                            <!-- Add form -->
                            <h5 class="mb-3">✚ Thêm bài viết mới</h5>
                            <form method="post" enctype="multipart/form-data" action="postController.php?action=add">
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
                                            <input class="form-control" name="author" value="<?php echo htmlspecialchars($_POST['author'] ?? $_SESSION['username']); ?>">
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-danger" type="submit">Tải lên bài viết</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <script>
                                CKEDITOR.replace('editor_add', {
                                    height: 300
                                });
                            </script>

                        <?php elseif ($action === 'edit' && $post): ?>
                            <!-- Edit form -->
                            <h5 class="mb-3">✎ Sửa bài viết</h5>
                            <form method="post" enctype="multipart/form-data" action="postController.php?action=edit&id=<?php echo intval($post['id']); ?>">
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
                                            <input class="form-control" name="author" value="<?php echo htmlspecialchars($post['author'] ?? $_SESSION['username']); ?>">
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-danger" type="submit">Cập nhật</button>
                                            <a class="btn btn-secondary mt-2" href="postController.php?action=list">Quay lại danh sách</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <script>
                                CKEDITOR.replace('editor_edit', {
                                    height: 300
                                });
                            </script>

                        <?php else: ?>
                            <div class="alert alert-warning">Yêu cầu không hợp lệ.</div>
                        <?php endif; ?>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>