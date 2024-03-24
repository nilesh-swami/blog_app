<?php

class Database {
    // Database connection parameters
    private $host = 'localhost'; // Change to your database host
    private $db_name = 'my_blog'; // Change to your database name
    private $username = 'root'; // Change to your database username
    private $password = ''; // Change to your database password
    public $conn;

    // Constructor to establish the database connection
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
}

?>
