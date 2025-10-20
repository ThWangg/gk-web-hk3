<?php
require_once('connectDb.php');
class User
{
    private $conn;

    function __construct(){
        require_once('connectDb.php');
        $db = new connectDb('localhost', 'root', '', 'vietnamtourist');
        $this->conn = $db->connect();
    }


    function login($email, $password){
        if (!$this->conn) return false;

        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // lưu thông tin voo session
                $_SESSION['username'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                return true;
            }
        }

        return false;
    }

    function register($email, $password, $name, $phone, $address){
        if (!$this->conn) return false;
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) return false;

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_sql = "INSERT INTO user (email, password, name, phonenumber, address)
                       VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $this->conn->prepare($insert_sql);
        $insert_stmt->bind_param("sssss", $email, $hashed_password, $name, $phone, $address);
        return $insert_stmt->execute();
    }
    function getUserByid($email){
    if (!$this->conn) return false;
    $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

    // đổi tt tk
     public function updateUserInfo($email, $name, $phonenumber, $address) {
        $stmt = $this->conn->prepare("UPDATE user SET name=?, phonenumber=?, address=? WHERE email=?");
        $stmt->bind_param("ssss", $name, $phonenumber, $address, $email);
        return $stmt->execute();
    }

    public function updateUserInfoWithRole($email, $name, $phonenumber, $address, $role) {
        $stmt = $this->conn->prepare("UPDATE user SET name=?, phonenumber=?, address=?, role=? WHERE email=?");
        $stmt->bind_param("sssss", $name, $phonenumber, $address, $role, $email);
        return $stmt->execute();
    }

    // Đổi mk
    public function changePassword($email, $oldPass, $newPass) {
        // Lấy mk cũ
        $stmt = $this->conn->prepare("SELECT password FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // ktra mk cũ
        if (!$row || !password_verify($oldPass, $row['password'])) {
            return false;
        }

        // đổi mk mới
        $newHash = password_hash($newPass, PASSWORD_DEFAULT);
        $update = $this->conn->prepare("UPDATE user SET password = ? WHERE email = ?");
        $update->bind_param("ss", $newHash, $email);
        return $update->execute();
    }
}
