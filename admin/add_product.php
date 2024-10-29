<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');

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
            <div class="container orders" id = "orders">

              <h2>Add Product</h2>

              <hr>

              <?php   
if(isset($_GET['product-added-successfully'])){
  
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>Product has been Added Successfully !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  
  <?php }
  if(isset($_GET['edit-failure'])){
    ?>
    <div class="alert alert-danger" role="alert">
     Failed! Something Went Wrong!
  </div>
  
  <?php
  
  }
  ?>
              <div class="form mr-7 pr-6">
    <form action="create_product.php" enctype="multipart/form-data" method="post" >

    <div class="form-group">
     <input type="text" name="product_name" placeholder="Product Name" class="form-control mt-2 ">   
     <input type="text" name="product_description" placeholder="Product Description" class="form-control mt-2 ">   
     <input type="text" name="price" placeholder="Product Price" class="form-control mt-2 ">
     <input type="text" name="product_offer" placeholder="Product Offer" class="form-control mt-2 ">   
     <input type="text" name="product_category" placeholder="Product Category" class="form-control mt-2 ">   
     
     <input type="text" name="product_color" placeholder="Product Color" class="form-control mt-2 mb-3">   
    
     <label>Image 1</label>
     <input type="file" name="image1" id="image1">  <br>
     <label>Image 2</label>
     <input type="file" name="image2" id="image1"> <br>
     <label>Image 3</label>
     <input type="file" name="image3" id="image1"> <br>
     <label>Image 4</label>
     <input type="file" name="image4" id="image1"> <br>
    
     <input type="submit" name="create_btn" class="btn btn-primary mt-3" value="ADD">
    </div>
    </form>
</div>

</div>
</section>
</div>

<?php

include('getAdminFooter.php');
?>
