<?php
require_once('connectDb.php');

class Comment
{
    private $conn;

    function __construct()
    {
        $db = new connectDb('localhost', 'root', '', 'vietnamtourist');
        $this->conn = $db->connect();
    }

    // 🟢 Lấy bình luận theo bài viết
    function getcmtByPostId($post_id)
    {
        if (!$this->conn) return [];

        $stmt = $this->conn->prepare("SELECT * FROM cmt WHERE post_id = ? ORDER BY id DESC");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $cmt = [];
        while ($row = $result->fetch_assoc()) {
            $cmt[] = $row;
        }
        return $cmt;
    }

    // 🟢 Thêm bình luận mới
    function addComment($post_id, $username, $content)
    {
        if (!$this->conn) return false;

        $stmt = $this->conn->prepare("INSERT INTO cmt (post_id, username, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $post_id, $username, $content);
        return $stmt->execute();
    }

    // 🟢 Xoá bình luận
    function deleteComment($id)
    {
        if (!$this->conn) return false;

        $stmt = $this->conn->prepare("DELETE FROM cmt WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // 🟢 Cập nhật nội dung bình luận
    function updateComment($id, $content)
    {
        if (!$this->conn) return false;

        $stmt = $this->conn->prepare("UPDATE cmt SET content = ? WHERE id = ?");
        $stmt->bind_param("si", $content, $id);
        return $stmt->execute();
    }
}
?>
