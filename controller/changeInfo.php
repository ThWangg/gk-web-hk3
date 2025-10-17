<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && !isset($_POST['oldpassword'])) {
    require_once "../model/User.php";
    $user = new User();

    $email = $_SESSION['email'];
    $name = trim($_POST['name']);
    $phonenumber = trim($_POST['phonenumber']);
    $address = trim($_POST['address']);

    // ktra format mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Sai Định dạng email sai'); window.location='../view/profile.php';</script>";
        return;
    }

    if (!preg_match('/^[0-9]{9,11}$/', $phonenumber)) {
        echo "<script>alert('Sai Định dạng sđt'); window.location='../view/profile.php';</script>";
        return;
    }

    // Cập nhật thông tin
    if ($user->updateUserInfo($email, $name, $phonenumber, $address)) {
        echo "<script>alert('đã cập nhật thành công'); window.location='../view/profile.php';</script>";
    } else {
        echo "<script>alert('k thể cập nhật. hãy thử lại sau'); window.location='../view/profile.php';</script>";
    }
}
