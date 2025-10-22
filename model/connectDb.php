<?php
class ConnectDb
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbName = "vietnam_review";

    public function connect()
    {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->dbName);
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }
        // Thiết lập bảng mã UTF-8 (rất quan trọng nếu bạn có tiếng Việt)
        $conn->set_charset("utf8");
        return $conn;
    }
}
