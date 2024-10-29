<?php
include("server/databaseConnection.php");
$sql = "SELECT * FROM `products` LIMIT 4";
$result = mysqli_query($conn,$sql);


?>