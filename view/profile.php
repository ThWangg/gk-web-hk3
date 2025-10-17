<?php
session_start();
require_once "../model/User.php";

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href = './login.php';</script>";
    exit;
}


$user = new User();
$getdata = $user->getUserByid($_SESSION['email']);

if (!$getdata) {
    echo "<script>alert('Không tìm thấy tài khoản trong hệ thống'); window.location.href = './login.php';</script>";
    exit;
}

$name = htmlspecialchars($getdata['name'] ?? '');
$email = htmlspecialchars($getdata['email'] ?? '');
$phone = htmlspecialchars($getdata['phonenumber'] ?? '');
$address = htmlspecialchars($getdata['address'] ?? '');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="../include/style/bootstrap.css">
    <link rel="stylesheet" href="../include/fontawesome/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url("../upload/VinhHaLong.jpg");
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .profile-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 40px;
            padding: 50px 5%;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: rgba(0, 0, 0, 0.88);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            text-align: center;
            padding: 20px;
            height: fit-content;
        }

        .sidebar h1 {
            color: white;
            font-family: 'ZCOOL QingKe HuangYou', cursive;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .menu-account {
            color: #fff;
            padding: 12px 0;
            font-size: 16px;
            cursor: pointer;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: background 0.3s;
        }

        .menu-account:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .menu-account-logout {
            color: #ff3333;
            font-weight: bold;
            margin-top: 15px;
        }

        .menu-account-logout:hover {
            color: #ff6666;
        }

        /* CONTENT */
        .profile-container {
            flex: 1;
            background: rgba(15, 15, 15, 0.92);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            max-width: 800px;
        }

        .profile-container h2 {
            font-family: 'ZCOOL QingKe HuangYou', cursive;
            font-size: 26px;
            margin-bottom: 10px;
        }

        .profile-avatar {
            height: 160px;
            width: 160px;
            border-radius: 50%;
            background: #ddd;
            display: block;
            margin: 20px auto;
        }

        .profile-name {
            color: #e00;
            text-align: center;
            margin-top: 10px;
            font-size: 22px;
            font-weight: bold;
        }

        hr.custom {
            width: 250px;
            height: 3px;
            background: chocolate;
            border: none;
            margin: 10px auto 20px auto;
        }

        .info-item p {
            margin: 5px 0;
            font-size: 17px;
            color: #ddd;
        }

        .form-control {
            background: #1a1a1a;
            color: #fff;
            border: 1px solid #555;
        }

        .btn-secondary {
            background: #555;
            border: none;
        }

        .btn-secondary:hover {
            background: #777;
        }
    </style>
</head>

<body>

    <?php require_once('header.php'); ?>
    <div class="profile-wrapper">
        <!-- sidebar -->
        <div class="sidebar">
            <h1>Account</h1>
            <div class="menu-account" onclick="showSection('info')">Personal Information</div>
            <div class="menu-account" onclick="showSection('changeInfo')">Change Information</div>
            <div class="menu-account" onclick="showSection('changePass')">Change Password</div>
        </div>

        <!-- content -->
        <div class="profile-container" id="section-info">
            <h2>Personal Information</h2>
            <hr style="border-color: #666;">
            <div class="text-center">
                <img src="../upload/unnamed.png" class="profile-avatar" alt="avatar">
                <div class="profile-name"><?php echo htmlspecialchars($getdata['name']); ?></div>
                <hr class="custom">
            </div>
            <div class="info-item">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($getdata['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($getdata['email']); ?></p>
                <p><strong>Phone number:</strong> <?php echo htmlspecialchars($getdata['phonenumber']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($getdata['address']); ?></p>
            </div>
        </div>

        <!-- đổi tt -->
        <div class="profile-container" id="section-changeInfo" style="display:none;">
            <h2>Change Information</h2>
            <hr style="border-color: #666;">
            <form method="POST" action="../controller/changeInfo.php">
                <div class="form-group mt-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                        value="<?php echo htmlspecialchars($getdata['name']); ?>" required>
                </div>
                <div class="form-group mt-3">
                    <label>Phone number</label>
                    <input type="text" name="phonenumber" class="form-control"
                        value="<?php echo htmlspecialchars($getdata['phonenumber']); ?>" required>
                </div>
                <div class="form-group mt-3">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control"
                        value="<?php echo htmlspecialchars($getdata['email']); ?>" required>
                </div>
                <div class="form-group mt-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control"
                        value="<?php echo htmlspecialchars($getdata['address']); ?>" required>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-secondary" type="submit">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- đổi mk -->
        <div class="profile-container" id="section-changePass" style="display:none;">
            <h2>Change Password</h2>
            <hr style="border-color: #666;">
            <form method="POST" action="../controller/changePass.php">
                <div class="form-group mt-3">
                    <label>Old Password</label>
                    <input type="password" class="form-control" name="oldpassword" required>
                </div>
                <div class="form-group mt-3">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="new1password" required>
                </div>
                <div class="form-group mt-3">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="new2password" required>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-secondary" type="submit">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showSection(section) {
            document.getElementById('section-info').style.display = 'none';
            document.getElementById('section-changeInfo').style.display = 'none';
            document.getElementById('section-changePass').style.display = 'none';
            document.getElementById('section-' + section).style.display = 'block';
        }
    </script>

</body>

</html>