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
    <div class="row m-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Edit Post Details</h3>
                </div>
                <div class="card-body">
                    <form id="postForm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="postId" value="<?php echo $postDetails['post_id']; ?>">
                        <div class="form-group row">
                            <label class="col-4">Post title</label>
                            <div class="col-8">
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo $postDetails['post_title']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4">Post description</label>
                            <div class="col-8">
                                <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"><?php echo $postDetails['post_desc']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4">Select status</label>
                            <div class="col-8">
                                <select name="status" id="status" class="form-control">
                                    <option value="Publish">Publish</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4">Upload new image</label>
                            <div class="col-8">
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-right">
                                <input type="reset" name="btnReset" id="btnReset" class="btn btn-secondary">
                                <input type="submit" value="Update" name="btnUpdate" id="btnUpdate" class="btn btn-dark">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <span>Last set image</span>
            <br>
            <img src="uploads/<?php echo $postDetails['post_img_file_name']; ?>" id="postImg" alt="">
        </div>
    </div>
</div>

<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- bootstrap js cdn -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!-- customer js link -->
<script src="../js/update_post.js"></script>
</body>
</html>