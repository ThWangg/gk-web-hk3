<?php
session_start();
require_once('../model/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->login($email, $password)) {
        $_SESSION['user'] = $email;
        header("Location: ../view/index.php");
    } else {
        echo "<script>alert('Sai email hoặc mật khẩu!'); window.history.back();</script>";
    }
}
?>
