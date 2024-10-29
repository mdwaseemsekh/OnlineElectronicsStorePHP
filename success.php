<?php
session_start();
include('includes/get_header.php');
if(!isset($_SESSION['logged_in'])){
    header('location: index.php');
}


?>

<div class="alert alert-success mt-5 pt-5 text-center" role="alert">
    
<b>Success!</b><br>Order Placed Successfully. <br>
Go To <a href="account.php">Your Order</a>


</div>




<?php
include('includes/get_footer.php');

if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
    unset($_SESSION['total_price']);
    unset($_SESSION['total_quantity']);
}

?>