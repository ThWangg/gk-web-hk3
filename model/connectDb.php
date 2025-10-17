<?php

class connectDb {
    private $host;
    private $user;
    private $pass;
    private $dbName;


    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbName = "vietnam_review";
    }

    public function connect() {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->dbName);
        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            
        }
        return $conn;
    }
}


?>