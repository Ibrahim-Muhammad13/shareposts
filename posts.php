<?php
session_start(); 
include 'connect.php';
include 'header.php';

?>

<div class="container post">
<div class="row mb-3">

    <div class="col-md-6">
    <h1>posts</h1>
    </div>
    <div class="col-md-6">
        <?php 
        if(isset($_SESSION['user'])){
        
       echo '<a href="addpost.php?userid='.$_SESSION['uid'].'" class="btn btn-primary pull-right">';
            
                
        }else {
            ?>
            <a href="login.php" class="btn btn-primary pull-right">

<?php
        }
        
        
        ?>
    <i class="fa fa-pencil"></i> add post
    </a>
    </div>

</div>

<?php 



$getStmt = $con->prepare("SELECT users.id as userid, posts.id,title,body FROM  posts
            INNER JOIN users ON posts.user_id = users.id");

$getStmt->execute();

$posts = $getStmt->fetchAll();

foreach($posts as $post){

  echo '<div class="card card-body mb-3">';
  echo '  <h4 class="card-title">'. $post['title'].' </h4>';
  echo '<p class="card-text" >'.$post['body'].'</p>';
    echo '<a href="showPost.php?id='.$post['id'].'&userid='.$post['userid'].'" class="btn btn-dark"> more </a>';
  echo '</div>';
}
?>


  



<?php include 'footer.php'; ?>