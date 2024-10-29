<?php
session_start();
include('server/databaseConnection.php');
if(isset($_GET['search'])){
  $search = $_GET['searchQuery'];
  
    //get the page number clicked by the user with a get request

    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
      $page_no = $_GET['page_no'];
      
    }else{
  
      //if user has not selected any page default will be first page
      
      $page_no = 1;
  
    }
     //total number of products
     // Prepare SQL statement to fetch products matching the search criteria
$stmt = $conn->prepare("SELECT COUNT(*) As total_records FROM `products` WHERE product_category LIKE ? OR product_name LIKE ? or product_description LIKE ? ");
$search = '%' . $search . '%'; // Adding wildcards for partial match
$stmt->bind_param("sss", $search, $search, $search);
$stmt->execute();

 $stmt->bind_result($total_records);

 $stmt->store_result();
 $stmt->fetch();
$total_records_per_page = 8;

$offset = ($page_no-1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records/$total_records_per_page);


//get all products
// Prepare SQL statement to fetch products matching the search criteria
$stmt2 = $conn->prepare("SELECT * FROM `products` where product_category LIKE ? OR product_name LIKE ? or product_description LIKE ? LIMIT ?, ?");
$search = '%' . $search . '%'; // Adding wildcards for partial match
$stmt2->bind_param("sssii", $search, $search, $search, $offset, $total_records_per_page);
$stmt2->execute();
$products = $stmt2->get_result();

}else{
  //get the page number clicked by the user

  if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    $page_no = $_GET['page_no'];
    
  }else{

    //if user has not selected any page default will be first page
    
    $page_no = 1;

  }
 
  //total number of products

$stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM `products`");

$stmt1->execute();
 $stmt1->bind_result($total_records);
 $stmt1->store_result();
 $stmt1->fetch();


 //products per page

 $total_records_per_page = 8;
 $offset = ($page_no-1) * $total_records_per_page;
 
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records/$total_records_per_page);


//get all products

$stmt2 = $conn->prepare("SELECT * FROM `products` LIMIT ?, ?");
$stmt2->bind_param("ii", $offset, $total_records_per_page);
$stmt2->execute();
$products = $stmt2->get_result();
}
?>

<?php
include('includes/get_header.php');
?>

   <!-- all the product -->

   <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <?php 
      if(isset($_GET['search'])){
        echo '<h3>
        Search Result for 
       "'.$_GET['searchQuery'].'"</h3>';
      
      }?>
      <?php 
      if(!isset($_GET['search'])){
        ?> 
      <h3>
       Our Products
      </h3>
      <hr>
      <p>Here You can Check our all Of Our Products</p>
    </div>
   <?php } ?>
    <div class="row mx-auto container">
    <?php

if($products->num_rows > 0){
    while($row = $products->fetch_assoc()){
      
    ?>
    
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      
      <a href="<?php echo "single-product.php?product_id=".$row['product_id'] ?>"><img src="images/<?php echo $row['product_image'] ?>" alt="" class="img-fluid mb-3 product-img"> </a> 
        <h4 class="p-name">
        <?php  echo $row['product_name']  ?>
        </h4>
        <h3 class="p-price">&#8377  <?php echo $row['product_price'] ?></h3>
        <a class="btn buy-btn" href="<?php echo "single-product.php?product_id=".$row['product_id'] ?>">Buy Now </a>
     
      
      </div>
        <?php } } else{
          echo '<h3> No Result Found </h3>';
         }
          ?>
      </div>
     
    </div>
  </section>

      <nav aria-label="page navigation example" class="container">
        <ul class = "pagination mt-4 text-center">
          <li class="page-item"><a href="<?php if($page_no <= 1){ echo '#'; }
          else{ echo "?page_no=".$page_no-1; } ?>" class="page-link <?php if($page_no<=1){ echo 'disabled'; } ?>" >Previous</a></li>
          <li class="page-item"><a class="page-link"><?php echo $page_no  ?> </a></li>
          <li class="page-item"><a href="<?php if($page_no >= $total_no_of_pages){ echo '#'; }
          else{ echo "?page_no=".$page_no+1; } ?>" class="page-link <?php if($page_no>=$total_no_of_pages){ echo 'disabled' ; } ?>">Next</a></li>
        </ul>

      </nav>
   
 <!-- footer Section -->
 <?php

include('includes/get_footer.php');
        
?>