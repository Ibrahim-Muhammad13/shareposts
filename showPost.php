<?php
session_start(); 
include 'connect.php';
include 'header.php';
?>
   

<div class="container">
<div class="row mb-3">

    <div class="col-md-6">
      <a href="posts.php" class="btn btn-light"> <i class="fa fa-backward"></i> back</a>

    </div>
    <div class="col-md-6">
    <a href="addpost.php" class="btn btn-primary pull-right">
    <i class="fa fa-pencil"></i> add post
    </a>
    </div>

</div>

<?php 

$postid= $_GET['id'];
$userid=$_GET['userid'];


$getuser = $con->prepare("SELECT users.name , title ,body, posts.created_at FROM posts  
            INNER JOIN users ON posts.user_id = users.id WHERE posts.id =?" );
$getuser->execute(array($postid));
$posts = $getuser->fetchAll();
foreach($posts as $post){

  echo '<div class="card card-body mb-3">';
  echo '  <h4 class="card-title">'. $post['title'].' </h4>';
  echo '<p class="card-text" >'.$post['body'].'</p>';
  echo '<div class="bg-light p-2 mb-3">
  written by '.$post['name'].' on '.$post['created_at'].'
  </div>' ;
  echo '</div>';
}

  if($_SESSION['uid']==$userid){
    echo '<a href="edit.php?postid='.$postid.'&userid='.$userid.'" class="btn btn-dark">Edit</a>';
// <input type="submit" value="Delete" class="btn btn-danger">
// </form>
  } 




?>

  

<?php include 'footer.php'; ?>