<?php
include('../server/databaseConnection.php');

session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
}

if(isset($_POST['submit_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $order_cost = $_POST['order_cost'];
    
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();
    
    // Handle query execution errors
    if (!$order_details) {
        die("Error in fetching order details: " . $stmt->error);
    }

}

include('getAdminHeader.php');
?>
<div class="row">
    <div class="col-lg-2 col-md-6 col-sm-12">
        <?php include('sideBar.php'); ?>
    </div>
    <div class="col-lg-10 col-md-6 col-sm-12">
        <section class="container my-5 py-5">
            <!-- Orders start here -->
            <section class="container my-5 py-5">
                <div class="container order-details orders" id="orders">
                    <h2><b>Orders Details</b></h2>
                    <hr>
                    <table class="mt-5">
                        <tr>
          <th>Product</th>
              <th>Product Price</th>
             <th>Product Quantity</th>
             <th>Order Date</th>
                        </tr>
          <?php while($row = $order_details->fetch_assoc()): ?>
            <tr>
            <td>
                               
 <img id="product-img" src="../images/<?php echo $row['product_image']?>" alt="">
             <b><?php echo $row['product_name']?></b>
            </td>
            <td>&#8377; <?php echo $row['product_price']?></td>
            <td><?php echo $row['product_quantity']?></td>
            <td><?php echo $row['order_date']?></td>
         </tr>
     <?php endwhile; ?>
 </table></div> </section>
        </section>
    </div>
</div>
<?php 
include('getAdminFooter.php'); 
?>
