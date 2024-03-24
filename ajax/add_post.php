<?php
session_start();
// Include the Database class file
include_once '../db/Database.php';
require_once '../db/Post.php'; 

// Prepare JSON response
$response = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $db = new Database();
    // Instantiate the Post class
    $post = new Post($db->conn);

    // Set post data from the form
    $post->setMbrid($_SESSION['mbrid']); 
    $post->setPostTitle($_POST['title']);
    $post->setPostDesc($_POST['desc']);
    $post->setPostStatus($_POST['status']);
    $post->setPostDate(date('Y-m-d H:i:s'));


    // Call the create() method to insert the post into the database
    $response = $post->create();

} else {
    // Invalid request method
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
