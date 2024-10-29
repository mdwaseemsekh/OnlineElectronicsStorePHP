<?php
session_start();
if(isset($_SESSION['admin_logged_in']))
{
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_email']);
    unset($_SESSION['admin_name']);
    unset($_SESSION['admin_id']);
    header('location: login.php');

}
?>