<?php
include("server/databaseConnection.php");
$sql = "SELECT * FROM `products` WHERE product_category = 'tws' or product_category LIKE '%arphone' LIMIT 4";
$result = mysqli_query($conn,$sql);



?>