<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iStore - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .nav-button {
    margin-left:11%;
}
.nav-item{
    margin-right: 0px;
    
}

.search-form form{
    width:30rem;
    margin-left: 8rem;
    margin-right: 8rem;
}


</style>
</head>

<body>


  <!-- navbar -->
  <nav class="navbar navbar-expand-lg bg-dark fixed-top py-3 data-bs-theme= dark text-white">
    <div class="container">
       <a href="index.php"><img src="images/logo.png" alt="logo" class="logo-img"> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav-button" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item search-form">
                <form action="products.php" method="GET" class="d-flex" role="search">
                    <input name="searchQuery" value="<?php if(isset($_GET['search'])){ echo $_GET['searchQuery']; } ?>"
                     class="form-control me-2" type="search" placeholder="Search Product" aria-label="Search" required>
                  <input type="submit" class="btn btn-primary" name="search" value="Search">
                  </form>
            </li>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="account.php">My Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="products.php">Products</a>
          </li>


          <li class="nav-item mr-4 pr-8">
           <a href="account.php"> <i class="fa-solid fa-user"></i></a>
           <a href="cart.php"> <i class="fa-solid fa-cart-shopping"><?php 
           if(isset($_SESSION['total_quantity']) && $_SESSION['total_quantity'] !== 0){
           ?>
           <span class="cart-quantity mr-4 pr-4">
           <?php
           echo $_SESSION['total_quantity'];
            } ?></span></i></a>
          </li>

        </ul>

      </div>
      
    </div>
  </nav>