<?php
session_start();
include('getAdminHeader.php');


if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
  }
  


include('../server/databaseConnection.php');
$status = false;

if($_GET['order_id']){
    $order_id = $_GET['order_id'];
    



    $stmt = $conn->prepare("SELECT * from orders where order_id = ?");
    $stmt->bind_param('i',$order_id);
    
    $stmt->execute();
    $orders = $stmt->get_result();

}


if(isset($_POST['edit_btn'])){
    $order_cost = $_POST['order_cost'];
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $user_phone = $_POST['user_phone'];
    $user_city = $_POST['user_city'];


    $stmt1 = $conn->prepare("UPDATE `orders` SET order_cost=?, order_status=?, user_phone=?, user_city=?
     Where order_id = ?");

     $stmt1->bind_param('ssssi',$order_cost, $order_status, $user_phone, $user_city,$order_id);

     if($stmt1->execute()){
        header('location:../orders.php?edit-success');
     }
     else{
        header('location:orders.php?edit-failure');
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
    <h3>Edit Orders</h3>
    
       <form action="edit_order.php" method="POST">
        <!-- <?php foreach($orders as $order) { ?> -->
       <input type="text" class="form-control" name="order_cost" placeholder="Order Cost" value="<?php echo $order['order_cost'] ?>">
       <input type="hidden" class="form-control" name="order_id" placeholder="Order Id" value="<?php echo $order['order_id'] ?>">
       <input type="text" class="form-control" name="order_status" placeholder="Order Status" value="<?php echo $order['order_status'] ?>">
       <input type="text" class="form-control" name="user_phone" placeholder="User Phone" value="<?php echo $order['user_phone'] ?>">
       <input type="text" class="form-control" name="user_city" placeholder="User City" value="<?php echo $order['user_city'] ?>">

       <br> <input class="btn btn-primary" type="submit" name="edit_btn" value="Edit">
       </form>
        </div>

    <?php }  ?>
    </section>
    </div>
</div>
<?php

include('getAdminFooter.php');
?>