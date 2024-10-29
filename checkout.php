<?php

session_start();
//done
//if user is not login get user to login page 
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}
if(empty($_SESSION['cart'])){
    
    header('location:cart.php?cart-empty');
    exit;
}



// else if user already login 
?>

<?php
include('includes/get_header.php');
?>


    <!-- checkout section -->

    <div class="container mx-auto">
        <form action="placeOrder.php" method="POST" id="checkout-form">
            <div class="form-group mt-4 pt-4">
                <H4 class="pt-5 mt-4 pb-3 text-center heading">
                    Check Out Page
                </H4>
              
                <input type="text" class="form-control mt-4 pt-3" id="name" name="name" placeholder="Full Name" required>
            </div>
            <div class="form-group">

                <input type="number" class="form-control" id="mobile" name="mobile" placeholder="9999-9999-99" pattern="[0-9]" required>
               
            </div>
            <div class="form-group">

                <input type="email" class="form-control" id="mobile" name="email" placeholder="E-Mail" required>
            </div>
            <div class="form-group">

                <input type="text" class="form-control" id="address-1" name="address" placeholder="Full Address" required>
                             <input type="text" class="form-control" id="address-1" name="city" placeholder="City" required>
                <input type="text" class="form-control" id="address-1" name="state" placeholder="State" required>
                <input type="number" class="form-control" id="address-1" name="pincode" placeholder="Pin Code" required>
                <select name="payment_mode" class="form-control">
                    <option value="cod">Cash On Delivery</option>
          <option value="online">Online Payment</option>
          <p>please select payment mode from the drop menu</p>
          
        <p><b>Order Total : 
            
        </b>&#8377 <?php echo $_SESSION['total_price'] ?></p>

        <input type="submit" class="form-control" id="procced-to-payment-btn" name="procced-to-payment-btn" value="Proceed">
        </div>
        </form>
<!-- footer Section -->
<?php
include('includes/get_footer.php');
?>