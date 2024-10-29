<?php
//if user is not login get user to login page 
session_start();
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

// else if user already login 
else{
    include('includes/get_header.php');

include('server/databaseConnection.php');


if(isset($_POST['procced-to-payment-btn'])){
  //get user info and store it in database
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $pincode = $_POST['pincode'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $order_cost = $_SESSION['total_price'];
  $order_status = 'pending';
  $user_id = $_SESSION['user_id'];
  date_default_timezone_set('Asia/Kolkata');
  $order_date = date('Y-m-d H:i:s');
  
  
    $selectedMode = $_POST["payment_mode"];
}


if($selectedMode=='cod'){

$stmt = $conn ->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,pincode,order_date)
VALUES(?,?,?,?,?,?,?,?)");

$stmt -> bind_param('isiissis',$order_cost,$order_status,$user_id,$mobile,$city,$address,$pincode,$order_date);
$stmtStatus = $stmt->execute();

if(!$stmtStatus){
    header('location: index.php');
    exit;
}

$order_id = $stmt->insert_id;




//get product from cart by using session;

foreach($_SESSION['cart'] as $key => $value){
    $product = $_SESSION['cart'][$key];
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_quantity = $product['product_quantity'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];

$stmt1 = $conn->prepare('INSERT INTO order_items (order_id,product_id,product_name,product_image,product_quantity,product_price,user_id,order_date)
    VALUES (?,?,?,?,?,?,?,?)');

    $stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_quantity,$product_price,$user_id,$order_date);

    $stmt1->execute();

    header('location: success.php');



}

}

else{

  
$stmt = $conn ->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,pincode,order_date)
VALUES(?,?,?,?,?,?,?,?)");

$stmt -> bind_param('isiissis',$order_cost,$order_status,$user_id,$mobile,$city,$address,$pincode,$order_date);
$stmtStatus = $stmt->execute();

if(!$stmtStatus){
    header('location: index.php');
    exit;
}

$order_id = $stmt->insert_id;
$_SESSION['order_id'] = $order_id;




//get product from cart by using session;

foreach($_SESSION['cart'] as $key => $value){
    $product = $_SESSION['cart'][$key];
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_quantity = $product['product_quantity'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];

$stmt1 = $conn->prepare('INSERT INTO order_items (order_id,product_id,product_name,product_image,product_quantity,product_price,user_id,order_date)
    VALUES (?,?,?,?,?,?,?,?)');

    $stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_quantity,$product_price,$user_id,$order_date);

    $stmt1->execute();

    header('location: payment.php');

   }
}}
?>

   <?php
include('includes/get_footer.php');
?>