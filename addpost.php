<?php
session_start(); 
include 'connect.php';
include 'header.php';


  if(isset($_SESSION['user'])){

    
  if($_SERVER['REQUEST_METHOD']=='POST'){
  
    $title =$_POST['title'];
    $body = $_POST['body'];

    $userid= $_GET['userid'];


    // Validate The Form

    $formErrors = array();

    if (empty($title)) {
      $formErrors[] = 'title Can\'t be <strong>Empty</strong>';
    }

    if (empty($body)) {
      $formErrors[] = 'body Can\'t be <strong>Empty</strong>';
    }

    foreach($formErrors as $error) {
      echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    
			//	Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					// Insert post In Database

					$stmt = $con->prepare("INSERT INTO 

						posts(title,body,user_id,created_at)

						VALUES( :ztitle,:zbody,:zuser,now())");

					$stmt->execute(array(

						'ztitle' 	=> $title,
            'zbody' 	=> $body,
            'zuser'  => $userid
						

					));

					// Echo Success Message
          header('location: posts.php');
    }
  }
} else{
  echo 'error';
}
?>



        <div class="container">
  <a href="posts.php" class="btn btn-light"> <i class="fa fa-backward"></i> back</a>

  <div class="card card-body bg-light mt-5">
 
    <h2>add post</h2>
    <p>create post with this form</p>
    <form action="" method="POST">
      <div class="form-group">
        <label for="title">title: <sup>*</sup></label>
        <input type="text" name="title" class="form-control form-control-lg">
        
      </div>
      <div class="form-group">
        <label for="body">body: <sup>*</sup></label>
        <textarea name="body" class="form-control form-control-lg"></textarea>
      
       
      </div>
      
     <input type="submit" class="btn btn-success" value="submit"/>

    </form>
  </div>
</div>
  
<?php include 'footer.php'; ?>