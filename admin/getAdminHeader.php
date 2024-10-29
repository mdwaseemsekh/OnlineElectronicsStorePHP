<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iStore - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>

  </style>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg bg-dark fixed-top py-3 data-bs-theme= dark text-white">
    <div class="container">
      <img src="../images/logo.png" alt="logo" class="logo-img">
     
     
         <?php
         if(isset($_SESSION['admin_logged_in'])){

         

         ?>
         <h4>Admin Dashboard</h4>
         <?php
         }
         if(isset($_SESSION['admin_logged_in'])){

         

         ?>
          <a class="btn btn-primary" href="logout.php">Logout</a>
         <?php
         }

         ?>
        

       

     
    </div>
  </nav>