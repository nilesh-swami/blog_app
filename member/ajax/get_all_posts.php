<?php
session_start();

require_once '../../db/Database.php';
require_once '../../db/Post.php'; // Include the Post class

// =====================================================

$db = new Database();
$post = new Post($db->conn);
$mbrid = intval($_SESSION["mbrid"]);

$allPosts = $post->getAllPostsByMid($mbrid);

// Set the appropriate headers for JSON response
header('Content-Type: application/json');

// Return JSON response
echo json_encode($allPosts);
?>
