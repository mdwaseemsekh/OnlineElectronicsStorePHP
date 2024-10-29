<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
}

if(isset($_SESSION['admin_logged_in'])){
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
    }
    include('../server/databaseConnection.php');
    $stmt = $conn->prepare("DELETE FROM products WHERE `products`.`product_id` = ? ");

    $stmt->bind_param('i',$product_id);
    if($stmt->execute()){
        header('location:products.php?delete-success');
    }
} else {

     header('location:products.php?delete-failed=$conn->error');
   
}
$stmt->close();
$conn->close(); 

?>