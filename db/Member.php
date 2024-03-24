<?php
session_start();

class Member {
    private $mbrid;
    private $fname;
    private $lname;
    private $login_email;
    private $pwd;
    private $created_on;
    private $phone;
    // Database connection
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getMbrid() {
        return $this->mbrid;
    }

    public function setMbrid($mbrid) {
        $this->mbrid = $mbrid;
    }

    public function getFname() {
        return $this->fname;
    }

    public function setFname($fname) {
        $this->fname = $fname;
    }

    public function getLname() {
        return $this->lname;
    }

    public function setLname($lname) {
        $this->lname = $lname;
    }

    public function getLoginEmail() {
        return $this->login_email;
    }

    public function setLoginEmail($login_email) {
        $this->login_email = $login_email;
    }

    public function getPwd() {
        return $this->pwd;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
    }

    public function getCreatedOn() {
        return $this->created_on;
    }

    public function setCreatedOn($created_on) {
        $this->created_on = $created_on;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function get($mbrid) {
        // Implement logic to get memeber details
    }
	
    public function create() {
        // Define your SQL query to insert a new member
        $query = "INSERT INTO members (fname, lname, login_email, pwd, created_on, phone) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param("ssssss", $this->fname, $this->lname, $this->login_email, $this->pwd, $this->created_on, $this->phone);

        // Execute the query
        if ($stmt->execute()) {
            return true; // Member created successfully
        } else {
            return false; // Error creating member
        }
    }

    public function update() {
        // Implement logic to update a member
    }

    public function delete() {
        // Implement logic to delete a member
    }

    public function isExists($mbemail){
        // Check if email already exists
        $query = "SELECT mbrid FROM members WHERE login_email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $mbemail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email already exists, return JSON response
            // return json_encode(array("status" => "error", "message" => "Member already registered."));
            return true;
        }
        return false;
    }

    public function authenticate() {
        // Define your SQL query to authenticate the user
        $query = "SELECT mbrid, fname, lname FROM members WHERE login_email = ? AND pwd = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->login_email, $this->pwd);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a row was returned
        if ($result->num_rows == 1) {
            // Authentication successful, fetch user details
            $row = $result->fetch_assoc();
            $this->mbrid = $row['mbrid'];
            $this->fname = $row['fname'];
            $this->lname = $row['lname'];

            // Set session variables
            $_SESSION['mbrid'] = $this->mbrid;
            $_SESSION['fname'] = $this->fname;
            $_SESSION['lname'] = $this->lname;

            return array('authenticated' => true, 'user_id' => $this->mbrid, 'user_name' => $this->fname . ' ' . $this->lname);
        } else {
            // Authentication failed
            return array('authenticated' => false);
        }
    }

    public function getMemberDetails($mbrid){
        // Define your SQL query to fetch member details
        $query = "SELECT * FROM members WHERE mbrid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $mbrid);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Check if a row was returned
        if ($result->num_rows == 1) {
            // Fetch member details
            $memberDetails = $result->fetch_assoc();
            return $memberDetails;
        } else {
            // Member not found
            return null;
        }
    }
    

}
