<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - VietnamTourist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../controller/register.css">
</head>

<body>

    <?php include_once('header.php'); ?>

    <div class="login-wrapper d-flex">
        <!-- Bên trái: Hình ảnh -->
        <div class="col-lg-6 d-none d-lg-block left-side">
            <img src="../upload/image/register.jpg" alt="Travel">
            <h5 class="text-center mb-4 gradient-text">Khám phá thế giới, <br> bắt đầu từ một tài khoản.
            </h5>
        </div>

        <!-- Bên phải: Form đăng ký -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="register-form">
                <h2 class="text-center mb-4 mt-5 align-items-center justify-content-center gradient-text ">Đăng Ký</h2>
                <p class="text-center mb-4">Cùng VietNamTourist, mở cánh cửa trải nghiệm!</p>
                <form action="../controller/registerController.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label"><i class="bi bi-person-fill"></i> Họ và tên</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phonenumber" class="form-label"><i class="bi bi-phone-fill"></i>Số điện thoại</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label"><i class="bi bi-geo-alt-fill"></i> Địa chỉ</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Mật khẩu</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
                </form>
                <p class="text-center mt-3">Bạn đã có tài khoản? <a href="login.php" style="text-decoration:none">Đăng nhập</a>
                </p>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>