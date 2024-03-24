<?php
// session_start();
?>
<?php
if (isset($_SESSION['mbrid'])) {
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="../images/auspian-logo.png" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <p class="mt-2 mr-5 text-info">Welcome <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></p>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="dashboard.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="../index.php" target="_blank">View Website</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="add_post.php">Add Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="view_post.php">View Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="../signout.php">Signout</a>
      </li>
  </div> 
</nav>
<?php
}
else{
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="images/auspian-logo.png" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-dark" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="signup.php">Signup</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="signin.php">Signin</a>
      </li>
  </div>
</nav>
<?php
}
?>
