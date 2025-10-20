<?php 

require_once('connectDb.php');
class Post {
    private $conn;

    public function __construct() {
        $db = new connectDb();
        $this->conn = $db->connect();
    }

    public function getAllPosts() {
        $query = "SELECT * FROM post ORDER BY id DESC";
        $result = $this->conn->query($query);
        $posts = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }

        return $posts;
    }

    function getPostById($id) {
    $query = "SELECT * FROM post WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $stmt->close();
    return $post;
}

}

?>
