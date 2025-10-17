<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['oldpassword'])) {
    require_once "../model/User.php";
    $user = new User();

    $email = $_SESSION['email'];
    $old = $_POST['oldpassword'];
    $new1 = $_POST['new1password'];
    $new2 = $_POST['new2password'];

    if ($new1 === $new2) {
        if ($user->changePassword($email, $old, $new1)) {
            echo "<script>alert('đã thay đổi mật khẩu'); window.location='../view/profile.php';</script>";
        } else {
            echo "<script>alert('mật khẩu cũ k chính xác'); window.location='../view/profile.php';</script>";
        }
    } else {
        echo "<script>alert('mật khẩu k khớp'); window.location='../view/profile.php';</script>";
    }
}
?>