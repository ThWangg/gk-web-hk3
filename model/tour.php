<?php
require_once('connectDb.php');

class Tour
{
    private $conn;

    public function __construct()
    {
        $db = new connectDb();
        $this->conn = $db->connect();
    }

    // Lấy tất cả tour
    public function getAllTours()
    {
        $query = "SELECT * FROM tours ORDER BY id DESC";
        $result = $this->conn->query($query);
        $tours = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tours[] = $row;
            }
        }

        return $tours;
    }

    public function getLimitTours($limit)
    {
        // Dùng dấu ? thay vì :limit
        $sql = "SELECT * FROM tours ORDER BY id DESC LIMIT ?";
        $stmt = $this->conn->prepare($sql);

        // Gán giá trị cho placeholder ? (kiểu số nguyên)
        $stmt->bind_param("i", $limit);
        $stmt->execute();

        $result = $stmt->get_result();
        $tours = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tours[] = $row;
            }
        }

        $stmt->close();
        return $tours;
    }


    // Lấy tour theo ID
    public function getTourById($id)
    {
        $query = "SELECT * FROM tours WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tour = $result->fetch_assoc();
        $stmt->close();
        return $tour;
    }
}
