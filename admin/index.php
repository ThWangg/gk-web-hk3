<?php
session_start();
// chỉ admin được truy cập
if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? 0) != 1) {
    header('Location: ../view/login.php');
    exit();
}

$page = $_GET['page'] ?? 'post_list';
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Admin - VietNamTourist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- CKEditor -->
    <script src="https://cdn.jsdelivr.net/npm/ckeditor4@4.25.1/ckeditor.js"></script>
</head>

<body>
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
                    <a class="nav-link <?= $page === 'post_new' ? 'active' : 'text-white' ?>" href="?page=post_new"><i class="fa fa-plus-square me-2"></i>Bài viết mới</a>
                    <a class="nav-link <?= $page === 'post_list' ? 'active' : 'text-white' ?>" href="?page=post_list"><i class="fa fa-tasks me-2"></i>Quản lý bài viết</a>
                    <a class="nav-link <?= $page === 'travel_list' ? 'active' : 'text-white' ?>" href="?page=travel_list"><i class="fa fa-location-arrow me-2"></i>Quản lý địa điểm</a>
                    <a class="nav-link <?= $page === 'comment_list' ? 'active' : 'text-white' ?>" href="?page=comment_list"><i class="fa fa-comment me-2"></i>Quản lý bình luận</a>
                    <a class="nav-link <?= $page === 'user_list' ? 'active' : 'text-white' ?>" href="?page=user_list"><i class="fa fa-user-cog me-2"></i>Quản lý user</a>

                    <hr class="text-secondary my-3">
                    <a class="nav-link text-white" href="../view/index.php"><i class="fa fa-home me-2"></i>Vào trang web</a>
                    <a class="nav-link text-danger" href="../controller/logout.php"><i class="fa fa-sign-out-alt me-2"></i>Đăng xuất</a>
                </div>
            </nav>

            <!-- Main -->
            <main class="col p-4 overflow-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Admin Panel</h4>
                    <small class="text-muted">Chào, <?php echo htmlspecialchars($_SESSION['username']); ?></small>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php
                        // Router: include controller files (controllers reside in admin/controller/)
                        $ctrl_base = __DIR__ . '/controller/';
                        switch ($page) {
                            case 'post_new':
                                include $ctrl_base . 'post_new.php';
                                break;
                            case 'post_edit':
                                include $ctrl_base . 'post_edit.php';
                                break;
                            case 'post_delete':
                                include $ctrl_base . 'post_delete.php';
                                break;
                            case 'post_list':
                            default:
                                include $ctrl_base . 'post_list.php';
                                break;
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>