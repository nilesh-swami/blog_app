<?php
session_start(); // Start session

// Check if member session is not set
if (!isset($_SESSION['mbrid'])) {
    // Redirect to login page
    header("Location: signin.php");
    exit; // Stop further execution
}

// Include the necessary files and initialize the database connection
include_once '../db/Database.php';
include_once '../db/Post.php';
$postDetails = "";
// Check if the postId query parameter is set
if (isset($_GET['postId'])) {
    // Sanitize the postId to prevent SQL injection
    $postId = intval($_GET['postId']);

    $db = new Database();
    // Create a new instance of the Post class
    $post = new Post($db->conn);

    // Retrieve the post details based on the postId
    $postDetails = $post->getPostDetails($postId);

    // Check if the post details were found
    if ($postDetails) {
        // Display the post details
        // echo '<h1>' . $postDetails['post_title'] . '</h1>';
        // echo '<p>' . $postDetails['post_desc'] . '</p>';
        // echo '<p>Status: ' . $postDetails['post_status'] . '</p>';
        // You can display other post details as needed
    } else {
        // Handle case where post details were not found
        echo 'Post not found.';
    }
} else {
    // Handle case where postId query parameter is missing
    echo 'Post ID is missing.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- bootstrap css cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- custom css link -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include_once '../includes/navbar.php'; ?>

<!-- <h3>
<p>Welcome, <?php echo $_SESSION['fname']; ?>!</p>
</h3> -->

<div class="container">
    <div class="row mt-2">
        <div class="col-12">

            <div class="card">
                <h2 class="card-header"><?php echo $postDetails['post_title']; ?></h2>
                <div class="card-body">
                    <h5 class="card-title">Date: <?php echo $postDetails['post_date']; ?> | Status: <?php echo $postDetails['post_status']; ?></h5>
                    <p class="card-text"><?php echo $postDetails['post_desc']; ?></p>
                    <div class="post-actions d-flex justify-content-between">
                        <a href="view_post.php" class="btn btn-secondary">Go back to list</a>
                        <a href="edit_post.php?postId=<?php echo $postDetails['post_id']; ?>" class="btn btn-dark">Edit post</a>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>

<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- bootstrap js cdn -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!-- customer js link -->
<!-- <script src="../js/view_post.js"></script> -->
</body>
</html>