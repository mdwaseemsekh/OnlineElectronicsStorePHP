<?php

$servername = 'localhost';
$username = "root";
$password = "";
$database = "ignou_project";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("couldn't connect");
}

 
?>
