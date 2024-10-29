<?php
session_start();

if(isset($_POST['add_to_cart'])){

    if(isset($_SESSION['cart'])){
    //if cart has already product


       $product_array_ids = array_column($_SESSION['cart'],"product_id");
         if(!in_array($_POST['product_id'],$product_array_ids)){

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
     
        $product_array = array(
         'product_id' => $product_id,
         'product_name' => $product_name,
         'product_price' => $product_price,
         'product_image' => $product_image,
         'product_quantity' => $product_quantity,
        );
     
         $_SESSION['cart'][$product_id] = $product_array;
        //product already in cart

       }

        else{

            echo '<script> alert("Product Already Added to Cart"); </script>';
        }

        calculateTotalPrice();
   } 

//else if user has no item in cart

else{
   
   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $product_array = array(
    'product_id' => $product_id,
    'product_name' => $product_name,
    'product_price' => $product_price,
    'product_image' => $product_image,
    'product_quantity' => $product_quantity,
   );

    $_SESSION['cart'] [$product_id] = $product_array;
    calculateTotalPrice();  
}

}
else if(isset($_POST['remove_product'])){
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculateTotalPrice();
}

else if(isset($_POST['edit_quantity'])){
$product_id = $_POST['product_id'];
$product_quantity = $_POST['product_quantity'];

$product_array = $_SESSION['cart'][$product_id];

$product_array['product_quantity'] = $product_quantity;

$_SESSION['cart'][$product_id] = $product_array;
calculateTotalPrice();
}

elseif(!isset($_SESSION['cart'])){

    echo '<script>alert("Your Cart is empty"); </script>';
   
}
function calculateTotalPrice(){
    $totalPrice = 0;
    $totalQuantity = 0;

    foreach($_SESSION['cart'] as $key =>$value){
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $totalPrice = $totalPrice +($quantity * $price);

        $totalQuantity = $totalQuantity + $quantity;

    }

    $_SESSION['total_price']= $totalPrice;
    $_SESSION['total_quantity']= $totalQuantity;

}
?>
<?php
include('includes/get_header.php');
?>

    <!-- cart start here -->
    <section class="container my-5 py-5">
    <div class="container cart">
        <h2> <b>Your Cart </b></h2>
        <hr>
        <?php
        if(isset($_GET['cart-empty'])){
  echo '<div class="container alert text-center alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong>You Cannot Checkout With An Empty Cart
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
?>
        <table class="mt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>

            </tr>

            <?php
            if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $key => $value){
    ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="images/<?php echo $value['product_image'] ?>" alt="">
                        <div>
                            <h4>  <?php echo $value['product_name'] ?></h4>


                            <p>&#8377  <?php echo $value['product_price'] ?> </p>
                            <br>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>" >
                               <input type="submit" name = "remove_product"class="remove-btn" value="remove" >
                            </form>

                        </div>
                    </div>
                </td>
                <td>
                    <form action="cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>"/>
                        <input type="number" name="product_quantity" id="quantity-input" value="<?php echo $value['product_quantity'] ?>"/>
                        <input type="submit" name="edit_quantity" class="edit-btn" id="quantity-edit-btn" value="edit"/>
                   </form>
                </td>

                <td>
                    &#8377 <span class="prodct-price"><?php echo $value['product_quantity'] * $value['product_price'] ?></span>
                </td>
            </tr>

            <?php } }?>
        </table>
        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td>&#8377 <?php if(isset($_SESSION['total_price'])){ echo $_SESSION['total_price'] ;} ?></td>
                </tr>
            </table>
        </div>

    </div>
                <div class="checkout-btn">
    
                    <form action="checkout.php" method="POST">
                        <input type="submit" name="checkout-btn" id="checkout-btn"  value="Checkout"/>
                   </form>

</div>

</section>

<!-- footer Section -->
<?php
include('includes/get_footer.php');
?>