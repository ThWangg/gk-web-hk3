<?php
require_once('../model/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($user->register($email, $password, $name, $phone, $address)) {
        echo "<script>alert('Đăng ký thành công!'); window.location.href='../view/login.php';</script>";
    } else {
        echo "<script>alert('Email đã tồn tại hoặc lỗi đăng ký!'); window.history.back();</script>";
    }
}
?>
