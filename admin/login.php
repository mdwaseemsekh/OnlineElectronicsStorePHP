<style>
      body {
    min-height:100vh;
    background-image: url("../images/back.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #f0f0f0;
}

form{
    background-color:white;
}
</style>
<?php
session_start();
include('../server/databaseConnection.php');

if(isset($_SESSION['admin_logged_in'])){
  header('location: index.php');
  exit;
}
$incorrectPassword = false;
$NotExistError = false;

if(isset($_POST['login_btn'])) {
    $admin_email = $_POST['email'];
    $admin_entered_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM `admin` WHERE admin_email = ?");
    $stmt->bind_param('s',$admin_email);
    $stmt->execute();
    $stmt->store_result();
    
    if($stmt->num_rows === 1) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $hashed_password);
        $stmt->fetch();
        
        if(password_verify($admin_entered_password, $hashed_password)) {
            // Password is correct, proceed to index page
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;
            header('location: index.php');
           
        } else {
            // Incorrect password
           $incorrectPassword = true;
        }
    } else {
       $NotExistError = true;
    }  
}
?>

<?php
include('getAdminHeader.php');
if($incorrectPassword){
  echo '<div class="container text-center mt-5 pt-5 alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Your Password is Incorrect.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
if($NotExistError){
  echo '<div class="container text-center mt-5 pt-5 alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> The Email is Not Registred with Us
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
<div class="login-section m">
    <div class="container mx-auto mt-8">
        <form action="login.php" class="mt-2" id="login-form" method="POST">
        <h3 class="mt-4 pt-5 text-center"> Admin Login </h3>
<hr> <br>
    <div class="form-group">
              
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
          
            <input type="submit" class="btn mt-4" id="login-btn" name="login_btn" value="Login">
        </div>
       
        </form>
    </div>   
</div>
 
 <!-- footer Section -->
  <!-- link bootstrap js  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>