<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
}

if(isset($_SESSION['admin_logged_in'])){
    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
    }
    include('../server/databaseConnection.php');
    $stmt = $conn->prepare("DELETE FROM orders WHERE `orders`.`order_id` = ? ");

    $stmt->bind_param('i',$order_id);
    if($stmt->execute()){
        header('location:orders.php?delete-success');
    }
} else {

     header('location:orders.php?delete-failed=$conn->error');
   
}
$stmt->close();
$conn->close(); 

?>