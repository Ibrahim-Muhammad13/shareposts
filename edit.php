<?php include 'connect.php';
      include 'header.php';
      session_start();

    $postid=$_GET['postid'];
    $userid=$_GET['userid'];
      $stmt = $con->prepare("SELECT title, body FROM posts WHERE id = ?");
      $stmt->execute(array($postid));
      $post = $stmt->fetch();

      if($_SERVER['REQUEST_METHOD']=='POST'){
        $title=$_POST['title'];
        $body=$_POST['body'];
        $stmt=$con->prepare(" UPDATE posts SET title =? ,body =? WHERE id =$postid");
          $stmt->execute(array($title,$body));
          header('location: showPost.php?id='.$postid.'&userid='.$userid.' ');
        
      }





?>

<div class="container">

<a href="posts.php" class="btn btn-light"> <i class="fa fa-backward"></i> back</a>

      <div class="card card-body bg-light mt-5">
     
        <h2>edit post</h2>
        <p>create post with this form</p>
        <form action="" method="POST">
          <div class="form-group">
            <label for="title">title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-sm" value="<?= $post['title']; ?>">
            <span class="invalid-feedback"></span>
          </div>
          <div class="form-group">
            <label for="body">body: <sup>*</sup></label>
            <textarea name="body" class="form-control form-control-lg" ><?= $post['body'];?></textarea>
            <span class="invalid-feedback"></span>
          </div>
          
         <input type="submit" class="btn btn-success" value="submit"/>

        </form>
      </div>
   
    </div>
<?php include 'footer.php';?>