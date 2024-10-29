<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('getAdminHeader.php');


if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
  }
  

include('../server/databaseConnection.php');
$status = false;

if($_GET['product_id']){
    $product_id = $_GET['product_id'];



    $stmt = $conn->prepare("SELECT * from products where product_id = ?");
    $stmt->bind_param('i',$product_id);
    
    $stmt->execute();
    $products = $stmt->get_result();


}


if(isset($_POST['edit_btn'])){
    $productName = $_POST['product_name'];
    $product_id = $_POST['product_id'];
    $productColor = $_POST['product_color'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $productCategory = $_POST['product_category'];

    $stmt1 = $conn->prepare("UPDATE `products` SET product_name = ?, product_description=?,
     product_price=?,product_category=? , product_color=?
     Where product_id = ?");

     $stmt1->bind_param('ssissi',$productName, $productDescription, $productPrice, $productCategory,$productColor, $product_id);

     if($stmt1->execute()){
     header('location:products.php?edit-success');
     }
     else{
        header('location:products.php?edit-failure');
     }

}





?>

<div class="container-fluid">
    <div class="row">
        
<div class="col-lg-2 col-md-6 col-sm-12">


<?php

include('sideBar.php');
?>
</div>
<div class=" col-lg-10 col-md-6 col-sm-12">

<section class="container my-5 py-5">
    <h3>Edit Product</h3>
    <form action="edit_product.php" method="POST">
        <div class="form-group">
<?php
        foreach($products as $product){
            ?>
       
        <label for="">Product Name :</label>
        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" value="<?php echo $product['product_name'] ?>">
        <label for="">Product Description :</label>
        <textarea class="form-control" id="product_Description" name="product_description" placeholder="Product Description" > <?php echo $product['product_description'] ?> </textarea>
        <label for="">Product Price :</label>
        <input type="text" class="form-control" id="product_Price" name="product_price" placeholder="Product Price" value="<?php echo $product['product_price'] ?>">
        <label for="">Product Category:</label>
        <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
        
        <input type="text" class="form-control" id="product_Category" name="product_category" placeholder="Product Category" value="<?php echo $product['product_category'] ?>"> 
        
        <label for="color">Product Color</label>
        <input type="text" class="form-control" id="product_Color" name="product_color" placeholder="Product Color" value="<?php echo $product['product_color'] ?>"> 
     
       <br> <input class="btn btn-primary" type="submit" name="edit_btn" value="Edit">
        </div>

    </form>
    <?php
} 

    ?>
    </section>
    </div>

</div>

<?php

include('getAdminFooter.php');
?>