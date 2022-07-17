<?php
session_start(); 
include 'connect.php';
include 'header.php';


if (isset($_SESSION['user'])) {
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD']=='POST'){
    
    //$user=$_POST['name'];
    $password=$_POST['password'];
    $email=$_POST['email'];

    if(empty($_POST['email'])){
      $email_err="please enter email";
    }
    if(empty($_POST['password'])){
      $password_err="please enter password";
    }
     // Check If There's No Error Proceed The User Add

     if(!isset($email_err) && !isset($password_err) ){
      // Check If The User Exist In Database

$stmt = $con->prepare("SELECT 
id, email, password  
FROM 
users 
WHERE 
email = ? 
AND password =?
");

$stmt->execute(array($email,$password));

$get = $stmt->fetch();

$count = $stmt->rowCount();

// If Count > 0 This Mean The Database Contain Record About This Username

if ($count > 0) {

    
$_SESSION['user'] = $user; // Register Session Name
$_SESSION['uid'] = $get['id']; // Register User ID in Session
header('Location: index.php'); // Redirect To Dashboard Page

//exit();
}
else{
   
    echo 'you are not registed';

}

     }

    
}//request method


?>





<div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
      
        <h2>Login</h2>
        <p>Please fill in your credentials to log in</p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (isset($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] :''; ?>" >
            <span class="invalid-feedback"><?php echo $email_err;?></span>
          </div>
          <div class="form-group">
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (isset($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] :''; ?>">
            <span class="invalid-feedback"><?php echo $password_err;?> </span>
          </div>
          <div class="row">
            <div class="col"> 
              <input type="submit" value="Login" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="register.php" class="btn btn-dark btn-block">No account? Register</a>
            </div>
 
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include 'footer.php'; ?>