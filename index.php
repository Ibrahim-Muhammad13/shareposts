<?php
session_start(); 
include 'connect.php';
include 'header.php';
?>
        <!--page content-->
  <div class="container">
    <div class="text-center welcome-div">
        <h1>Welcome to SharedPost !</h1>
        <p class="lead">Looking for cool posts? Find some and share yours with our community!</p>
        <a class="btn btn-primary text-center" href="posts.php">view posts </a>
    </div>
</div>
  
<?php include 'footer.php'; ?>
