<?php

session_start();
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;  
}
include('server/databaseConnection.php');


if(isset($_POST['order_id'])  && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $order_cost = $_POST['order_cost'];
    
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();
}

else{
    header('location: account.php');
}
?>
<?php
include('includes/get_header.php');
?>
    <!-- Orders start here -->
    <section class="container my-5 py-5">
            <div class="container order-details orders" id = "orders">
                <h2 class="text-center"> <b>Orders Details</b></h2>
                <hr>
                <table class="mt-5">
                    <tr>
                        <th>Product</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Order Date</th>
                    </tr>

                    <?php while( $row = $order_details->fetch_assoc()){
                    ?>
        
                    <tr>
                        <td>
                          <img id="product-img" src="images/<?php echo $row['product_image']?>" alt="">  
                        <?php echo $row['product_name']?>
                        </td>
                        <td>&#8377
                        <?php echo $row['product_price']?>
                               
                        </td>
                        
                        <td>  <?php echo $row['product_quantity']?> </td>
                        <td>
        
                        <?php echo $row['order_date']?>
                        </td>                   
                    </tr>
                    <?php }

                    ?>                   
                </table>

                <?php
                if($order_status=="pending"){
                    ?>
<form action="payment.php" method="POST" style="float:right;">
<h4>
&#8377
    <?php echo $order_cost;
    ?>
</h4>
<input type="hidden" name="order_id" value="<?php echo $order_id ?>">
<input type="hidden" name="order_amount" value="<?php echo $order_cost ?>">
<input type="submit" name="payment-from-order-details" class="btn btn-primary" value="Pay Now">
</form>
<?php }
?>        
 </div>   
   </section>

 <!-- footer Section -->
 <?php

include('includes/get_footer.php');

?>