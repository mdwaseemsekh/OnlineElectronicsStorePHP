<?php
include("server/databaseConnection.php");
$sql = "SELECT * FROM `products` WHERE product_category like '%martphone%' LIMIT 4";
$result = mysqli_query($conn,$sql);

?>