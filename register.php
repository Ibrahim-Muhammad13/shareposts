<?php
session_start();

include 'connect.php';
include 'header.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $user=$_POST['name'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $confirm_password 	= $_POST['confirm_password'];

    if(empty($_POST['name'])){
      $name_err="please enter name";
    }
    if(empty($_POST['email'])){
      $email_err="please enter email";
    }
    if(empty($_POST['password'])){
      $password_err="please enter password";
    }
    if(empty($_POST['confirm_password'])){
      $confirm_password_err="please confirm password";
    }
    if($_POST['password'] != $_POST['confirm_password']){
      $confirm_password_err="passwords dosnt match";
    }
    // Check If There's No Error Proceed The User Add

    if(!isset($name_err) && !isset($email_err) && !isset($password_err) && !isset($confirm_password_err)){
     
      
        
    // Check If The User Exist In Database

    $stmt = $con->prepare("SELECT 
    id, name, email  
FROM 
    users 
WHERE 
    name = ? 
    AND email =?
");

$stmt->execute(array($user,$email));

$get = $stmt->fetch();

$count = $stmt->rowCount();

// If Count > 0 This Mean The Database Contain Record About This Username

    if ($count > 0) {

        echo 'sorry this user is registerd please login';
        //sleep(5);

        header('refresh:5; login.php'); // Redirect To Dashboard Page

        exit();
    } 
else{

    $stmt = $con->prepare("INSERT INTO 
    users(name, password, email, created_at)
VALUES(:zuser, :zpass, :zmail, now())");
$stmt->execute(array(

'zuser' => $user,
'zpass' => $password,
'zmail' => $email 


));

// Echo Success Message
//echo 'rigisterdrd';
$succesMsg = 'Congrats You Are Now Registerd User you can login';
  header('location: login.php');
    }

    }
    
    

}//request method





?>

  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Create An Account</h2>
        <p>Please fill out this form to register with us</p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (isset($name_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo (isset($_POST['name'])) ? $_POST['name'] :''; ?>" >
            <span class="invalid-feedback"><?= $name_err;?></span>
          </div>
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (isset($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] :''; ?>">
            <span class="invalid-feedback"><?= $email_err;?></span>
          </div>
          <div class="form-group">
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (isset($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] :''; ?>">
            <span class="invalid-feedback"><?= $password_err;?></span>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password: <sup>*</sup></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (isset($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] :''; ?>">
            <span class="invalid-feedback"><?= $confirm_password_err;?></span>
          </div>
          <div class="form-group">
          <label> user adress</label>
          <input type="text" name="adrees" class="form-control form-control-lg <?php echo (isset($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] :''; ?>">
            <span class="invalid-feedback"><?= $confirm_password_err;?></span>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" name="Register" value="Register" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="login.php" class="btn btn-dark btn-block">Have an account? Login</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include 'footer.php'; ?>