<?php
session_start(); // Start session

// Check if member session is not set
if (!isset($_SESSION['mbrid'])) {
    // Redirect to login page
    header("Location: signin.php");
    exit; // Stop further execution
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
    
    <!-- datatable css cdn link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.min.css">
    
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
                <div class="card-header">
                    <h3 class="text-center">All Posts</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm" id="postTable">
                        <thead>
                            <th>Sr.No.</th>
                            <th>Post Title</th>
                            <th>Post Description</th>
                            <th>Post Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <!-- post list goes here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- datatable js cdn link -->
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.min.js"></script>

<!-- bootstrap js cdn -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<!-- customer js link -->
<script src="../js/view_post.js"></script>

</body>
</html>