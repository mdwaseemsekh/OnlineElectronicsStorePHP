<?php

session_start();
if(isset($_SESSION['logged_in'])){
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['logged_in']);

header('location: login.php');
}


?>