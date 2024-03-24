<?php
// Include the Post class and your database connection
include_once '../../db/Post.php';
include_once '../../db/Database.php';

$db = new Database();
// Create a new instance of the Post class
$post = new Post($db->conn);

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $postId = $_POST['postId'];
    $postTitle = $_POST['title'];
    $postDesc = $_POST['desc'];
    $postStatus = $_POST['status'];
    $file = isset($_FILES['file']) ? $_FILES['file'] : null;

    // Set post properties
    $post->setPostId($postId);
    $post->setPostTitle($postTitle);
    $post->setPostDesc($postDesc);
    $post->setPostStatus($postStatus);

    // Handle file upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Set file name
        $post->setPostImgFileName($file['name']);

        // Specify upload directory
        $target_dir = "../member/uploads/";

        // Move uploaded file to desired location
        $target_file = $target_dir . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $target_file);
    }

    // Attempt to update the post
    if ($post->update()) {
        // Post updated successfully
        $response['status'] = 'success';
        $response['message'] = 'Post updated successfully.';
        echo json_encode($response);
    } else {
        // Error updating post
        $response['status'] = 'error';
        $response['message'] = 'Error updating post.';
        echo json_encode($response);
    }
}
?>
