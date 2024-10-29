<?php

session_start();
include('includes/get_header.php');

?>
<style>
.brand a{
  width: 25%;
  height:50%;
  align-items:center;
  text-align:center;
}
</style>

<!-- Carousel Section -->
  <div class="home container">
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/1.jpg" class="d-block w-100 mt-2 pt-4" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/2.jpg" class="d-block w-100 mt-2 pt-4" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/3.jpg" class="d-block w-100 mt-2 pt-4" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
  </div>

  
  <!-- Featured Products Section -->

  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>
        Featured Products
      </h3>
      <hr>

      <p>Here You can Check our More Of Our Featured Products</p>
    </div>

    <div class="row mx-auto container">
    <?php
    include('get_featured_product.php');
    while($row = mysqli_fetch_assoc($result)){
     
    ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <a href="<?php echo "single-product.php?product_id=". $row['product_id'];?>">
        <img src="images/<?php echo $row['product_image']?>" alt="<?php echo $row['product_name']?>'s image" class="img-fluid mb-3 product-img"> 
    </a>
        <h4 class="p-name">
        <?php echo $row['product_name']?>
        </h4>
        <h3 class="p-price">&#8377 <?php echo $row['product_price'];?></h3>
       <a href="<?php echo "single-product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a> 
      </div>

      <?php
    }
  ?>
    
    </div>
  </section>
 

  <!-- Banner Section for Offers -->
  <section id="banner" class="banner my-5 py-5 text-center">
    <div class="container">
      <h4>Mid Season Sale</h4>
      <h2>
        Repulic Day Collection <br>
        More Then 30% OFF
      </h2>
      <a href="products.php"><button type="submit">Shop Now</button> </a> 
    </div>
  </section>


  <!-- SmartPhone Section -->

  <section id="smartphone featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>
        Smartphones
      </h3>
      <hr>

      <p>Here You can Check 5G Smartphone best prices</p>
    </div>
    <div class="row mx-auto container">

    <?php
    include('get_smartphone.php');
    while($row = mysqli_fetch_assoc($result)){
     
    ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">

    
      <a href="<?php echo "single-product.php?product_id=". $row['product_id'];?>">
        <img src="images/<?php echo $row['product_image']?>" alt="Product image" class="img-fluid mb-3 product-img"> </a>
        <h4 class="p-name">
          <?php echo $row['product_name']?>
        </h4>
        <h3 class="p-price">&#8377  <?php  echo $row['product_price'] ?></h3>
        <button class="buy-btn">Buy Now</button>
      </div>
      <?php }?>
      </div>
    </div>
  </section>

  <!-- Earphone Section -->
  <section id="tws featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>
        
      Earphones
      </h3>
      <hr>

      <p>Here You can Check Earphone at best prices</p>
    </div>
  <div class="row mx-auto container">

    <?php
    include('get_tws.php');
    while($row = mysqli_fetch_assoc($result)){
     
    ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">

    
      <a href="<?php echo "single-product.php?product_id=". $row['product_id'];?>">
        <img src="images/<?php echo $row['product_image']?>" alt="Product image" class="img-fluid mb-3 product-img"></a>
        <h4 class="p-name">
          <?php echo $row['product_name']?>
        </h4>
        <h3 class="p-price">&#8377  <?php  echo $row['product_price'] ?></h3>
        <button class="buy-btn">Buy Now</button>
      </div>
      <?php }?>
      </div>
    </div>
  </section>

  <!-- Smartwatches -->
  <section id="featured" class="smartwatch-section my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>
        Smartwatches
      </h3>
      <hr>

      <p>Here You can Check our More Smartwatch with fitness tracker</p>
    </div>
    < <div class="row mx-auto container">

<?php
include('get_smartwatch.php');
while($row = mysqli_fetch_assoc($result)){
 
?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">


  <a href="<?php echo "single-product.php?product_id=". $row['product_id'];?>">
    <img src="images/<?php echo $row['product_image']?>" alt="Product image" class="img-fluid mb-3 product-img"></a>
    <h4 class="p-name">
      <?php echo $row['product_name']?>
    </h4>
    <h3 class="p-price">&#8377  <?php  echo $row['product_price'] ?></h3>
    <button class="buy-btn">Buy Now</button>
  </div>
  <?php }?>
  </div>
</div>
</section>


<!-- Brands -->
<div class="container">
    <h4 class="text-center">Feature Brands</h4>
    <hr>
    <div class="brand row">
     <a href="products.php?searchQuery=samsung&search=Submit"> <img src="images/brand1.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12  brand-img"></a>
     <a href="products.php?searchQuery=boat&search=Submit"> <img src="images/brand5.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12  brand-img"></a>
     <a href="products.php?searchQuery=realme&search=Submit"> <img src="images/brand3.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12  brand-img"></a>
     <a href="products.php?searchQuery=apple&search=Submit"> <img src="images/brand4.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12  brand-img"></a>
  
    </div>
  </div>

<?php

include('includes/get_footer.php');

?>