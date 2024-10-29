<?php
session_start();
include('server/databaseConnection.php');

if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}
$incorrectPassword = false;
$userNotExistError = false;

if(isset($_POST['login_btn'])) {
    $user_email = $_POST['email'];
    $user_entered_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM `users` WHERE user_email = ?");
    $stmt->bind_param('s',$user_email);
    $stmt->execute();
    $stmt->store_result();
    
    if($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $user_name, $user_email, $hashed_password);
        $stmt->fetch();
        
        if(password_verify($user_entered_password, $hashed_password)) {
            // Password is correct, proceed to account page
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            header('location: account.php');
           
        } else {
            // Incorrect password
           $incorrectPassword = true;
        }
    } else {
       $userNotExistError = true;
    }
 
}

?>

<?php

include('includes/get_header.php');

?>


  <!-- Login Section -->

  <section class="container form-section">
    <div class="form-container text-center mt-5 pt-3">
<h3 class="mt-3">

<?php



if($incorrectPassword){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Your Password is Incorrect.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
if($userNotExistError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> The Email is Not Registred with Us
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}


?>
    Login

</h3>

    </div>

    <div class="container mx-auto">
        <form action="login.php" id="login-form" method="POST">
            <div class="form-group">
              
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
          
            <input type="submit" class="btn mt-4" id="login-btn" name="login_btn" value="Login">
        </div>
        <div class="form-group">
            <p class="mt-4">Don't Have Account?</p>
          <a href="register.php" id="register-url " class="btn text-center" >Register</a>
        </div>
        </form>
    </div>


  </section>
 
 <!-- footer Section -->
 <?php

include('includes/get_footer.php');

?>