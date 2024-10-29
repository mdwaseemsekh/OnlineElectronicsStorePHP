<?php
session_start();
include('../server/databaseConnection.php');

if(!isset($_SESSION['admin_logged_in'])){
  header('location:login.php');
}


else if(isset($_SESSION['admin_logged_in'])){
    //get the page number clicked by the user

    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        $page_no = $_GET['page_no'];
        
      }else{
    
        //if user has not selected any page default will be first page
        
        $page_no = 1;
    
      }
  
  
       //total number of products
  
  $stmt = $conn->prepare("SELECT COUNT(*) As total_records FROM `products`");

  $stmt->execute();
   
   $stmt->bind_result($total_records);
  
   $stmt->store_result();
   $stmt->fetch();
   
  
$total_records_per_page = 10;

$offset = ($page_no-1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$total_no_of_pages = ceil($total_records/$total_records_per_page);


//get all products

$stmt2 = $conn->prepare("SELECT * FROM `products` LIMIT ?, ?");
$stmt2->bind_param("ii",$offset, $total_records_per_page);
$stmt2->execute();
$products = $stmt2->get_result();



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
                <h2> <b>All Products </b></h2>

                <hr>
             <?php   
if(isset($_GET['edit-success'])){
  
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your Edit Was Successfull !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  
  <?php }
  if(isset($_GET['edit-failure'])){
    ?>
    <div class="alert alert-danger" role="alert">
    Your Edit Was Failed!
  </div>
  
  <?php
  
  }
  ?>
             <?php   
if(isset($_GET['delete-success'])){
  
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Deletion Was Successfull !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  
  <?php }
  if(isset($_GET['delete-failed'])){
    ?>
    <div class="alert alert-danger" role="alert">
    Your deletion Was Failed!
  </div>
  
  <?php
  
  }
  ?>
                <table class="mt-5">
                    <tr>
                    <th>Product</th>        
                    <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Product Price</th>
                        <th>Color</th>
                        <th>Edit</th>
                        <th>Delete</th>
                       
                      
                      
        
                    </tr>

                    <?php while( $row = $products->fetch_assoc()){
                    ?>
        
                    <tr>
                        <td>
                            <div class="admin_product_img">
                            <img src="../images/<?php echo $row['product_image'] ?>" style="height: 50px; width: 50px;" alt="">
                            </div>
                        </td>
                        <td>
                        <?php echo $row['product_id']?>
                      </td>
                      <td>
                        <?php echo $row['product_name']?>
                       
                        </td>
                        <td>
                        <?php echo $row['product_category']?>
                               
        
                        </td>
                        
                        <td> &#8377 <?php echo $row['product_price']?> </td>
                        <td>
        
                        <?php echo $row['product_color']?>
                        </td>
                        <td>
                            <a href="edit_product.php?product_id=<?php echo $row['product_id']?>" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                          <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setProductId(<?php echo $row['product_id']; ?>)">
  Delete
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-left">
       Are You Sure You Want To Delete This Product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="#" class="btn btn-danger">Delete</a> <!-- delete link will be dynamically updated -->
      </div>
    </div>
  </div>
</div>

<script>
function setProductId(productId) {
  var editLink = document.querySelector('#exampleModal .btn-danger');
  editLink.href = 'deleteProduct.php?product_id=' + productId;
}
</script>

                        </td>

                        
        

                        <?php
                    }}


?>
</div>
</div>

<nav aria-label="page navigation example" class="container">
        <ul class = "pagination mt-4 text-center">
          <li class="page-item"><a href="<?php if($page_no <= 1){ echo '#'; }
          else{ echo "?page_no=".$page_no-1; } ?>" class="page-link <?php if($page_no<=1){ echo 'disabled'; } ?>" >Previous</a></li>
          <li class="page-item"><a class="page-link"><?php echo $page_no  ?> </a></li>
          <li class="page-item"><a href="<?php if($page_no >= $total_no_of_pages){ echo '#'; }
          else{ echo "?page_no=".$page_no+1; } ?>" class="page-link <?php if($page_no>=$total_no_of_pages){ echo 'disabled' ; } ?>">Next</a></li>
        </ul>

      </nav>


      <?php

include('getAdminFooter.php');
?>