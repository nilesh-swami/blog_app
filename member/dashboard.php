<?php
session_start(); // Start session

// Check if member session is not set
if (!isset($_SESSION['mbrid'])) {
    // Redirect to login page
    header("Location: signin.php");
    exit; // Stop further execution
}
include_once '../db/Database.php';
include_once '../db/Post.php';

$mbrid = intval($_SESSION["mbrid"]);

$db = new Database();
$post = new Post($db->conn);
$publish_count = 0;
$publish_count = $post->getPostCount("Publish", $mbrid);
$pending_count = 0;
$pending_count = $post->getPostCount("Pending", $mbrid);
$draft_count = 0;
$draft_count = $post->getPostCount("Draft", $mbrid);

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
        <div class="col">
            <div class="card bg-success">
                <div class="card-header">
                    <h3>Total Published Posts</h3>
                </div>
                <div class="card-body">
                    <h1><?php echo $publish_count; ?></h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-warning">
                <div class="card-header">
                    <h3>Total Pending Posts</h3>
                </div>
                <div class="card-body">
                    <h1><?php echo $pending_count; ?></h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-info">
                <div class="card-header">
                    <h3>Total Draft Posts</h3>
                </div>
                <div class="card-body">
                    <h1><?php echo $draft_count; ?></h1>
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
</body>
</html>