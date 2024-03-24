<?php
// delete_post.php

include_once '../../db/Database.php';
include_once '../../db/Post.php';

// Check if postId parameter exists
if (isset($_POST['postId'])) {

    $db = new Database();
    // Instantiate the Post class
    $post = new Post($db->conn);

    // Sanitize the postId to prevent SQL injection
    $postId = intval($_POST['postId']);

    // Attempt to delete the post
    if ($post->delete($postId)) {
        // Post deleted successfully
        $response['status'] = 'success';
        $response['message'] = 'Post deleted successfully.';
    } else {
        // Error deleting post
        $response['status'] = 'error';
        $response['message'] = 'Error deleting post.';
    }

    // Return JSON response
    echo json_encode($response);
} else {
    // postId parameter is missing, return an error response
    $response = array('status' => 'error', 'message' => 'Post ID parameter is missing');
    echo json_encode($response);
}
?>
