<?php

class Post {
    private $post_id;
    private $mbrid;
    private $post_title;
    private $post_desc;
    private $post_status;
    private $post_img_file_name;
    private $post_date;
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPostId() {
        return $this->post_id;
    }

    public function setPostId($post_id) {
        $this->post_id = $post_id;
    }

    public function getMbrid() {
        return $this->mbrid;
    }

    public function setMbrid($mbrid) {
        $this->mbrid = $mbrid;
    }

    public function getPostTitle() {
        return $this->post_title;
    }

    public function setPostTitle($post_title) {
        $this->post_title = $post_title;
    }

    public function getPostDesc() {
        return $this->post_desc;
    }

    public function setPostDesc($post_desc) {
        $this->post_desc = $post_desc;
    }

    public function getPostStatus() {
        return $this->post_status;
    }

    public function setPostStatus($post_status) {
        $this->post_status = $post_status;
    }

    public function getPostImgFileName() {
        return $this->post_img_file_name;
    }

    public function setPostImgFileName($post_img_file_name) {
        $this->post_img_file_name = $post_img_file_name;
    }

    public function getPostDate() {
        return $this->post_date;
    }

    public function setPostDate($post_date) {
        $this->post_date = $post_date;
    }

    public function get($post_id) {
        // Implement logic to get a post details
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
	
    public function create() {
        // Check file size
        if ($_FILES['file']['size'] > 2 * 1024 * 1024) { // 2MB limit
            // File size exceeds limit, return JSON response
            $response['status'] = 'error';
            $response['message'] = 'File size exceeds 2MB limit.';
            return $response;
        }

        // Check file type
        $allowedTypes = array('image/jpeg', 'image/jpg', 'image/png');
        if (!in_array($_FILES['file']['type'], $allowedTypes)) {
            // Invalid file type, return JSON response
            $response['status'] = 'error';
            $response['message'] = 'Only JPG, JPEG, or PNG file types are allowed.';
            return $response;
        }

        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO posts (mbrid, post_title, post_desc, post_status, post_img_file_name, post_date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("isssss", $this->mbrid, $this->post_title, $this->post_desc, $this->post_status, $this->post_img_file_name, $this->post_date);
        
        // Set file name
        // Set datetime stamp as part of the file name
        $datetime = date('Ymd_His');
        $original_filename = $_FILES['file']['name'];
        $extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $new_filename = $datetime . '_' . $this->generateRandomString() . '.' . $extension;

        $this->post_img_file_name = $new_filename;

        // Move uploaded file to desired location
        $target_dir = "../member/uploads/"; // Specify upload directory
        $target_file = $target_dir . $new_filename;
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            // File upload failed, return JSON response
            $response['status'] = 'error';
            $response['message'] = 'Failed to move uploaded file.';
            return $response;
        }
        
        // Execute the statement
        if ($stmt->execute()) {
            // Post created successfully
            $stmt->close();
            $this->conn->close();
            $response['status'] = 'success';
            $response['message'] = 'Post added successfully.';
        } else {
            // Error creating post
            $stmt->close();
            $this->conn->close();
            $response['status'] = 'error';
            $response['message'] = 'Error adding post.';
        }

        return $response;
    }

    public function update() {
        // Define your SQL query to update the post
        $query = "UPDATE posts SET post_title = ?, post_desc = ?, post_status = ? WHERE post_id = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bind_param("sssi", $this->post_title, $this->post_desc, $this->post_status, $this->post_id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Post updated successfully
            $stmt->close();
            return true;
        } else {
            // Error updating post
            $stmt->close();
            return false;
        }
    }    

    public function delete($postId) {
        // Define your SQL query to delete the post
        $query = "DELETE FROM posts WHERE post_id = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bind_param("i", $postId);
        
        // Execute the query
        if ($stmt->execute()) {
            // Post deleted successfully
            $stmt->close();
            return true;
        } else {
            // Error deleting post
            $stmt->close();
            return false;
        }
    }

    public function getAllPosts($status){
        if($status==''||$status==null||empty($status)){
            // Define your SQL query
            $query = "SELECT * FROM posts";

            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Execute the query
            $stmt->execute();

            // Fetch all rows
            $result = $stmt->get_result();

            // Initialize an array to store posts
            $posts = array();

            // Loop through each row and fetch posts
            while ($row = $result->fetch_assoc()) {
                // Create a post object
                $post = array(
                    "post_id" => $row['post_id'],
                    "mbrid" => $row['mbrid'],
                    "post_title" => $row['post_title'],
                    "post_desc" => $row['post_desc'],
                    "post_status" => $row['post_status'],
                    "post_img_file_name" => $row['post_img_file_name'],
                    "post_date" => $row['post_date']
                );

                // Add post object to the array
                $posts[] = $post;
            }

            // Close the statement
            $stmt->close();

            // Return the array of posts
            return $posts;
        }
        else{
            // Define your SQL query
            $query = "SELECT * FROM posts WHERE post_status='$status'";

            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Execute the query
            $stmt->execute();

            // Fetch all rows
            $result = $stmt->get_result();

            // Initialize an array to store posts
            $posts = array();

            // Loop through each row and fetch posts
            while ($row = $result->fetch_assoc()) {
                // Create a post object
                $post = array(
                    "post_id" => $row['post_id'],
                    "mbrid" => $row['mbrid'],
                    "post_title" => $row['post_title'],
                    "post_desc" => $row['post_desc'],
                    "post_status" => $row['post_status'],
                    "post_img_file_name" => $row['post_img_file_name'],
                    "post_date" => $row['post_date']
                );

                // Add post object to the array
                $posts[] = $post;
            }

            // Close the statement
            $stmt->close();

            // Return the array of posts
            return $posts;
        }
    }

    public function getAllPostsByMid($mbrid){
        // Define your SQL query
        $query = "SELECT * FROM posts WHERE mbrid = ?";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bind_param("i", $mbrid);

        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();

        // Initialize an array to store posts
        $posts = array();

        // Loop through each row and fetch posts
        while ($row = $result->fetch_assoc()) {
            // Create a post object
            $post = array(
                "post_id" => $row['post_id'],
                "mbrid" => $row['mbrid'],
                "post_title" => $row['post_title'],
                "post_desc" => $row['post_desc'],
                "post_status" => $row['post_status'],
                "post_img_file_name" => $row['post_img_file_name'],
                "post_date" => $row['post_date']
            );

            // Add post object to the array
            $posts[] = $post;
        }

        // Close the statement
        $stmt->close();

        // Return the array of posts
        return $posts;
    }

    public function getPostDetails($pid){
        // Define your SQL query to fetch post details based on post_id
        $query = "SELECT * FROM posts WHERE post_id = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bind_param("i", $pid);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Check if post details are found
        if($result->num_rows > 0) {
            // Fetch post details as an associative array
            $postData = $result->fetch_assoc();
            
            // Return post details
            return $postData;
        } else {
            // Post not found, return empty array
            return array();
        }
        
        // Close the statement
        $stmt->close();
    }

    public function getPostCount($status, $mbrid) {
        // Define your SQL query
        $query = "SELECT COUNT(*) AS post_count FROM posts WHERE post_status = ? AND mbrid = ?";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bind_param("si", $status, $mbrid);
    
        // Execute the query
        $stmt->execute();
    
        // Get the result
        $result = $stmt->get_result();
    
        // Fetch the row
        $row = $result->fetch_assoc();
    
        // Get the post count
        $postCount = $row['post_count'];
    
        // Close the statement
        $stmt->close();
    
        // Return the post count
        return $postCount;
    }
    
    
}
