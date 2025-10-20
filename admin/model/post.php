<?php
// model/post.php
require_once("../VietNamTourist/model/connectDb.php");

class Post
{
    private $conn;
    private $lastError = '';

    public function __construct()
    {
        $db = new connectDb(); // nếu connectDb cần tham số, chỉnh ở đây
        $this->conn = $db->connect();
        if ($this->conn) {
            $this->conn->set_charset('utf8mb4');
        } else {
            $this->lastError = 'No DB connection';
        }
    }

    public function getLastError()
    {
        if (!empty($this->lastError)) return $this->lastError;
        return $this->conn ? $this->conn->error : 'No DB connection';
    }

    // ----------------------------
    // READ
    // ----------------------------
    public function getAll()
    {
        $sql = "SELECT * FROM post ORDER BY id DESC";
        $res = $this->conn->query($sql);
        $rows = [];
        if ($res) {
            while ($r = $res->fetch_assoc()) $rows[] = $r;
            $res->free();
        } else {
            $this->lastError = $this->conn->error;
        }
        return $rows;
    }

    public function getAllPosts()
    {
        return $this->getAll();
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM post WHERE id = ?");
        if (!$stmt) {
            $this->lastError = $this->conn->error;
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res ? $res->fetch_assoc() : null;
        $stmt->close();
        return $row;
    }

    public function getPostById($id)
    {
        return $this->getById($id);
    }

    // ----------------------------
    // CREATE
    // ----------------------------
    public function insert($title, $image, $contents, $author)
    {
        $this->lastError = '';
        $stmt = $this->conn->prepare("INSERT INTO post (title, image, contents, author, created) VALUES (?, ?, ?, ?, NOW())");
        if (!$stmt) {
            $this->lastError = $this->conn->error;
            return false;
        }
        $stmt->bind_param("ssss", $title, $image, $contents, $author);
        $ok = $stmt->execute();
        if (!$ok) $this->lastError = $stmt->error;
        $stmt->close();
        return $ok;
    }

    public function addPost($title, $image, $contents, $author)
    {
        return $this->insert($title, $image, $contents, $author);
    }

    // ----------------------------
    // UPDATE
    // ----------------------------
    // signature: update($id, $title, $image, $contents, $author)
    public function update($id, $title, $image, $contents, $author)
    {
        $this->lastError = '';
        $stmt = $this->conn->prepare("UPDATE post SET title = ?, image = ?, contents = ?, author = ? WHERE id = ?");
        if (!$stmt) {
            $this->lastError = $this->conn->error;
            return false;
        }
        $stmt->bind_param("ssssi", $title, $image, $contents, $author, $id);
        $ok = $stmt->execute();
        if (!$ok) $this->lastError = $stmt->error;
        $stmt->close();
        return $ok;
    }

    public function updatePost($id, $title, $image, $contents, $author)
    {
        return $this->update($id, $title, $image, $contents, $author);
    }

    // ----------------------------
    // DELETE
    // ----------------------------
    public function delete($id)
    {
        $this->lastError = '';
        $stmt = $this->conn->prepare("DELETE FROM post WHERE id = ?");
        if (!$stmt) {
            $this->lastError = $this->conn->error;
            return false;
        }
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        if (!$ok) $this->lastError = $stmt->error;
        $stmt->close();
        return $ok;
    }

    public function deletePost($id)
    {
        return $this->delete($id);
    }

}
