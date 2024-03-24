<?php
// session();

require_once 'db/Database.php';
require_once 'db/Post.php'; // Include the Post class

// =====================================================

$db = new Database();
$post = new Post($db->conn);
$allPosts = $post->getAllPosts("Publish");

// Define the number of records per page
$recordsPerPage = 6;

// Get the total number of pages
$totalPages = ceil(count($allPosts) / $recordsPerPage);

// Get the current page number from the request
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting index for the current page
$startIndex = ($page - 1) * $recordsPerPage;

// Get the posts for the current page
$currentPagePosts = array_slice($allPosts, $startIndex, $recordsPerPage);

// Return the posts for the current page as JSON
echo json_encode(array('posts' => $currentPagePosts, 'totalPages' => $totalPages));
?>
