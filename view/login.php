<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng Nhập - VietnamTourist</title>
  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="../controller/login.css">
</head>

<body class="bg-light">

  <?php include_once('header.php'); ?>

  <div class="login-wrapper">
    <form class=" login-form p-4 shadow mx-auto mt-5" style="max-width: 400px;"
      action="../controller/loginController.php" method="POST">
      <div class="text-center mb-4 icon-login"><i class="bi bi-geo-alt-fill"></i></div>
      <h2 class="text-center mb-4 gradient-text">Travel Explorer</h2>
      <p class="text-center mb-4">Đăng nhập để khám phá thế giới</p>

      <div class="form-group floating-label">
        <input type="email" class="form-control" id="email" name="email" placeholder=" " required>
        <label for="email">Email</label>
      </div>

      <div class="form-group floating-label">
        <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
        <label for="password">Mật khẩu</label>
      </div>

      <div class="form-group form-check d-flex justify-content-between">
        <div>
          <input type="checkbox" class="form-check-input" id="remember">
          <label class="form-check-label" for="remember">Nhớ mật khẩu</label>
        </div>
        <a href="#" style="text-decoration: none;">Quên mật khẩu?</a>
      </div>

      <div class="text-center mt-3">
        <button type="submit" name="login" class="btn btn-primary w-100">Đăng nhập</button>
      </div>

      <div class="d-flex align-items-center mb-3">
        <hr class="flex-grow-1">
        <p class="text-center mx-2 mb-0">Hoặc đăng nhập bằng</p>
        <hr class="flex-grow-1">
      </div>

      <!-- Nút đăng nhập MXH -->
      <div class="row no-gutters">
        <div class="col-6 pr-1">
          <button type="button" class="btn btn-primary w-100">
            <i class="bi bi-facebook"></i> Facebook
          </button>
        </div>
        <div class="col-6 pl-1">
          <button type="button" class="btn btn-light border w-100 text-dark">
            <i class="bi bi-google"></i> Google
          </button>
        </div>
      </div>


      <div class="text-center mt-3">
        <label>Bạn chưa có tài khoản?</label>
        <a href="register.php" style="text-decoration: none;">Đăng ký</a>
      </div>
    </form>
  </div>
  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>