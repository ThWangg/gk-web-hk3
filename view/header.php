<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="../controller/header.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&display=swap" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../upload/image/logo(1).png" alt="logo" width="40" height="40" class="me-2">
            <h1 class="h5 mb-0">VietnamTour</h1>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Trang Chủ</a></li>
                <li class="nav-item"><a class="nav-link " href="tour.php">Tour Du lịch</a></li>
                <!-- dropdown -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tuor Du Lịch
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Tour Du lịch Bà Nà Hill</a></li>
                        <li><a class="dropdown-item" href="#">Tour Du lịch Vịnh Hạ Long</a></li>
                        <li><a class="dropdown-item" href="#">Tour Du lịch Phú Quốc</a></li>
                    </ul>
                </li> -->
                <li class="nav-item"><a class="nav-link" href="about.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">Giới Thiệu</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Liên Hệ</a></li>
            </ul>

            <div class="d-flex">
                <?php if (isset($_SESSION['username'])) : ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Chào, <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="../view/profile.php">Tài khoản của tôi</a></li>

                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                                <li><a class="dropdown-item" href="../admin/index.php">Quản lý admin</a></li>
                            <?php endif; ?>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="../controller/logout.php">Đăng xuất</a></li>

                        </ul>
                    </div>
                <?php else : ?>
                    <a href="login.php" class="btn btn-outline-light me-2"><i class="bi bi-box-arrow-in-down-right"></i>Đăng
                        Nhập</a>
                    <a href="register.php" class="btn btn-primary"><i class="bi bi-pencil-square"></i>Đăng Ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>