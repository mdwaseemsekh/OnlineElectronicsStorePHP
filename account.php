<?php
session_start();
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;   
}

  include('server/databaseConnection.php');
  $passwordMatchError = false ;
  $passwordLengthError = false;
  $otherError = false;
  $isPasswordUpdate = false;
 
  if(isset($_POST['change_password_btn']))
  {
   
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $user_email = $_SESSION['user_email'];
    
    
        if($password != $confirm_password){
        $passwordMatchError = true;
        }
    
        else if(strlen($password <= 6 )){
        $passwordLengthError = true;
        }
    
        else{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
            $stmt1 = $conn->prepare("UPDATE `users` SET `user_password` = ? WHERE `users`.`user_email` = ?;");
    
            $stmt1->bind_param('ss',$hashed_password,$user_email);
    
            if($stmt1->execute()){
            $isPasswordUpdate = true;
            
            }
            else{
            $otherError = true;
            }
    
        }

    }

if(isset($_SESSION['logged_in'])){
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ");
    $stmt->bind_param('i',$user_id);
    $stmt->execute();

    $orders = $stmt->get_result();
}

?>

<?php


include('includes/get_header.php');


?>

    <!-- Account Section -->
    <section class="container">
        <div class="row">
            <div class="text-center col-lg-6 col-md-12 col-sm-12">
            
                <h4 class="account-info"><b>Account Info</b></h4>
                <hr>
                <div class="account-info">
                    <p>Name <span><?php
                    if(isset($_SESSION['user_name'])){
                    echo $_SESSION['user_name'];
                    }?></span></p>


                    <p>Email <span><?php
                    if(isset($_SESSION['user_email'])){
                    echo $_SESSION['user_email'];}
                    ?></span></p>
                    <p><a href="#orders">My Orders</a></p>
                    <p><a href="logout.php">Log Out</a></p>
                </div>

            </div>



                <div class="text-center col-lg-6 col-md-12 col-sm-12">
                    <div class="change_password_form mt-6 pt-5 pt-6 pb-0 mb-0">
                
                <h2 class="mt-6 pt-5"><b>Change Password</b></h2>
                   
                       

                        <?php
                        if($passwordMatchError){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> Your Password do not match
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                          
                          }
                        if($passwordLengthError){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> Your Password is too short
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                          
                          }
                        if($isPasswordUpdate){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Your Password is Successfully Changed.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                          
                          }


                            ?>

                             

                        
                        <hr class="mx-auto">
                        <form action="account.php" method="POST" id="account-form">
                        
                        <div class="form-group">


                            <input type="password" class="form-control" id="account-password" name="password"
                                placeholder="New Password">
                        </div>
                        <div class="form-group">

                            <input type="password" class="form-control" id="account-password" name="confirm_password" placeholder="Confirm New Password">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Submit" name="change_password_btn" id="change-pass-btn">
                        </div>



                    </form>
                            
                    </div>
                </div>
            </div>



    </section>


        <!-- Orders start here -->
        <section class="container my-5 py-5">
            <div class="container orders" id = "orders">
                <h2 class="text-center"> <b>Your Orders </b></h2>
                <hr>
                <table class="mt-5">
                    <tr>
                        <th>Order Id</th>
                        <th>Order Cost</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>More</th>
                      
                      
        
                    </tr>

                    <?php while( $row = $orders->fetch_assoc()){
                    ?>
        
                    <tr>
                        <td>
                        <?php echo $row['order_id']?>
                        <?php 
                        ?>
                        </td>
                        <td>
                        <?php echo $row['order_cost']?>
                               
        
                        </td>
                        
                        <td>  <?php echo $row['order_date']?> </td>
                        <td>
        
                        <?php echo $row['order_status']?>
                        </td>
        
                       <td>
                        <form action="orderDetails.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id'];?>">
                            <input type="hidden" name="order_status" value="<?php echo $row['order_status'];?>">
                            <input type="hidden" name="order_cost" value="<?php echo $row['order_cost'];?>">
                        
                        <input type="submit" name="order_details-btn" id="order-detail-btn" value="Details" >
                        </form>

                       </td>
                    </tr>
                    <?php }

                    ?>
        
                   
                </table>
                
        
            </div>
       
        
        </section>
        

  <!-- footer Section -->
 <?php

include('includes/get_footer.php');

?>