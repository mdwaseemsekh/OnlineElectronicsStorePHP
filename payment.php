<?php

session_start();
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;

}

include('includes/get_header.php');


if(isset($_POST['payment-from-order-details'])){
    $order_id = $_POST['order_id'];
    $order_total_price = $_POST['order_amount'];
    $user_id = $_SESSION['user_id'];
}

else{
    $order_total_price = $_SESSION['total_price'];
$user_id = $_SESSION['user_id'];
$order_id = $_SESSION['order_id'];

}

?>
<div class="mt-5 pt-5 text-center">
    <h3>Payment Page</h3>
    <p>Final Amount : &#8377 <?php echo $order_total_price ?></p>
  <a href="javascript:void(0)" class="btn btn-primary buynow">Pay Now</a>
  
  </div>
  
<?php

include('includes/get_footer.php');

?>

<!-- Razor Pay Payment Gateway Code Start Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(".buynow").click(function(event) { // Added event parameter
        var options = {
            "key": "rzp_test_ZQHfxjnnXAOorU", // Replace with your Razorpay Key ID
            "amount": "<?php echo $order_total_price*100 ?>",
            "name": "istore - Online Electronics Store",
            "description": "Test Transaction",
            "image": "images/logo.jpg",
            "handler": function(response) {
                var payment_id = response.razorpay_payment_id;
                window.location.href = "online_pay.php?payment_id=" + payment_id + "&user_id=<?php echo $user_id ?>&order_id=<?php echo $order_id ?>";

            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        event.preventDefault(); // Prevent default action
    });
</script>
