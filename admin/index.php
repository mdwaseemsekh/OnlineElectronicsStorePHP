<style>
      body {
    min-height:100vh;
    background-image: url("../images/back.jpg");
    /* Full height */
    
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #f0f0f0;

}
</style>
<?php

session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
}
include('getAdminHeader.php');

?>

<div class="row">
<div class="col-lg-2 col-md-6 col-sm-12">

<?php

include('sideBar.php');
?>
</div>
<div class=" col-lg-10 col-md-6 col-sm-12">

<section class="container my-5 py-5">
<h2 style="color:white;">
Welcome To Admin Dashboard

<?php
echo $_SESSION['admin_name'];
?>
</h2>
<?php
include('getAdminFooter.php');
?>