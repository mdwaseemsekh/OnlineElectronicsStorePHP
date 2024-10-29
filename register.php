<?php
session_start();
include('server/databaseConnection.php');

if($_SESSION['logged_in']){
  header('location: account.php');
  exit;
}
$passwordMatchError = false ;
$passwordLengthError = false;
$otherError = false;
$userExistError = false;
if(isset($_POST['register_btn'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];


  if($password != $confirm_password){
    $passwordMatchError = true;
  }

  else if(strlen($password <= 6 )){
    $passwordLengthError = true;
  }

  else{

    $stmt = $conn->prepare("SELECT count(*) FROM users where  user_email = ?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $stmt->bind_result($num_rows);
    $stmt->store_result();
    $stmt->fetch();
    
    if($num_rows != 0){
      $userExistError = true;
    }


    else{

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $stmt1 = $conn->prepare("INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES (?,?,?);");

      $stmt1->bind_param('sss',$name,$email,$hashed_password);

      if($stmt1->execute()){
    

        header('location:register.php?register-success');
      }

      else{
        $otherError = true;
      }
    }

  }

}




?>


<?php


include('includes/get_header.php');


?> 
<h3 class="text-center mt-5 pt-3">

Register

</h3>

<?php

if($passwordMatchError){
  echo '<div class="text-center container alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Passwords Don &#39t Match
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
if($passwordLengthError){
  echo '<div class="text-center container alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong>Your Password Should Be Atleast 6 Character
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
if($userExistError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> User Already Exist With the Same Email.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
if($otherError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Something Went Wrong! Please Try Again.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
if(isset($_GET['register-success'])){
  echo '<div class="container alert text-center alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Registered Successfully You Can Login Now
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}


?>
<hr class="mx-auto">
    </div>

    <div class="container mx-auto">
        <form action="register.php" method="POST" id="register-form">
            <div class="form-group">
               
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required >
        </div>
            <div class="form-group">
               
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
           
            <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
          
            <input type="submit" class="mt-4 py-1" id="register-btn" name="register_btn" href="login.php" value="Register">
        </div>

        <div class="form-group login-hyperlink">
            <p class="mt-4">Have Account?</p>
          <a href="login.php" class="login-url">Login</a>
        </div>
       
        </form>
    </div>


  </section>
 
 <!-- footer Section -->
 <?php

include('includes/get_footer.php');

?>