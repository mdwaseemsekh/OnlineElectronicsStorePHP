<?php
session_start();
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

include('server/databaseConnection.php');
if(isset($_GET['payment_id'], $_GET['user_id'], $_GET['order_id'])) {
    $payment_id = $_GET['payment_id'];
    $user_id = $_GET['user_id'];
    $order_id = $_GET['order_id'];

date_default_timezone_set("Asia/Calcutta");
$dt = date('Y-m-d h:i:s');


$sql1 = "UPDATE `orders` SET `order_status` = 'paid' WHERE `orders`.`order_id` = $order_id;";
if(!mysqli_query($conn, $sql1)) {
    // Database insertion successful

    echo 'errors';
}

$sql = "INSERT INTO `payments` (`sno`, `payment_id`, `user_id`, `order_id`, `dt`) VALUES (NULL,'$payment_id', '$user_id', '$order_id' , current_timestamp())";
    if(mysqli_query($conn, $sql)) {
        // Database insertion successful

        header("Location: success.php");
        exit();
    } else {
        // Database insertion failed
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

?>

<?php
include('includes/get_footer.php');

?>