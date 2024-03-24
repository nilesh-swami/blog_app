<?php

include_once 'db/Database.php';
include_once 'db/Post.php';
include_once 'db/Member.php';

$postDetails="";
$memberDetails="";

if(isset($_GET['post_id'])) {
    
    $database = new Database();
    
    // Create a new instance of the Post class
    $post = new Post($database->conn);
    $member = new Member($database->conn);

    $postId = intval($_GET['post_id']);

    // Call the getPostDetails method to fetch post details
    $postDetails = $post->getPostDetails($postId);

    // Get member details using mbrid from post details
    $mbrid = $postDetails['mbrid'];
    $memberDetails = $member->getMemberDetails($mbrid);

    // Check if post details are found
    if(!empty($postDetails)) {
        // Display the post details
        // echo '<h1>' . $postDetails['post_title'] . '</h1>';
        // echo '<p>' . $postDetails['post_desc'] . '</p>';
        // Display other details as needed
    } else {
        // Post not found
        echo 'Post not found.';
    }

} else {
    // Handle case where post_id parameter is missing
    echo "Post ID is missing.";
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include_once 'includes/navbar.php'; ?>

<div class="container">
    <div class="row m-1">
        <div class="col-md-12">
            <div class="post-heading m-2">
                <h2><?php echo $postDetails['post_title']; ?></h2>
                <h5 class="text-muted">By: <?php echo $memberDetails['fname']." ".$memberDetails['lname']; ?> | <?php echo substr($postDetails['post_date'], 0, 10); ?></h5>
            </div>
            <div class="post-img text-center m-2">
                <img src="member/uploads/<?php echo $postDetails['post_img_file_name']; ?>" alt="">
            </div>
            <div class="post-details text-justify m-2">
                <p><?php echo $postDetails['post_desc']; ?></p>
            </div>
        </div>
        <div class="go-back">
            <a href="index.php"> &lt; Back to View All Posts</a>
        </div>
    </div>
</div>


<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- bootstrap js cdn -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<!-- custom js link -->
<!-- <script src="js/index.js"></script> -->
</body>
</html>