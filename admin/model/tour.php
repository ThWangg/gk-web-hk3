<?php
require_once("/Tools/BaiTapHTML/web-hk3/gk/model/connectDb.php");
class Tour {
    private $conn;

    public function __construct() {
        $db = new connectDb();
        $this->conn = $db->connect();
    }

    public function getAllTours() {
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

    public function getTourById($id) {
        $query = "SELECT * FROM tours WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tour = $result->fetch_assoc();
        $stmt->close();
        return $tour;
    }

    public function addTour($name, $price, $day, $rating, $info) {
        $query = "INSERT INTO tours (name, price, day, rating, info) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsss", $name, $price, $day, $rating, $info);
        return $stmt->execute();
    }

    public function updateTour($id, $name, $price, $day, $rating, $info) {
        $query = "UPDATE tours SET name=?, price=?, day=?, rating=?, info=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsssi", $name, $price, $day, $rating, $info, $id);
        return $stmt->execute();
    }

    public function deleteTour($id) {
        $query = "DELETE FROM tours WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
