<?php
session_start();

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    include('server/databaseConnection.php');
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    
    if ($stmt === false) {
        die('Error in preparing the statement.');
    }
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    header('location: index.php');
}
$row = $result->fetch_assoc();

?>

<?php


include('includes/get_header.php');


?>
    <!-- Photo of Product -->

    <section class="single-product my-6 pt-6 container">


        <div class="row  mt-2 mr-3">
        <!-- main photo of product -->
            <div class="mt-4 pt-4 col-lg-5 col-md-6 col-sm-12 big-img" >
                <img src="images/<?php echo $row['product_image'] ?>" alt="" class="mt-3 pt-3 img-fluid w-100 pb-1" id="big-img">

                <div class="small-img-group align-item-center">
                    <!-- small photos group -->
                    <div class="small-img-col">
                        <img src="images/<?php echo $row['product_image'] ?>" alt="" width="100%" class="small-img">

                    </div>
                    <div class="small-img-col">
                        <img src="images/<?php echo $row['product_image2'] ?>" alt="" width="100%" class="small-img">

                    </div>
                    <div class="small-img-col">
                        <img src="images/<?php echo $row['product_image3'] ?>" alt="" width="100%" class="small-img">

                    </div>
                    <div class="small-img-col">
                        <img src="images/<?php echo $row['product_image4'] ?>" alt="" width="100%" class="small-img">

                    </div>
            
                </div>
            </div>

            <div class="col-lg-5 col-md-6 col-sm-12 ">
                <h5>
                <?php echo $row['product_name'] ?>
                </h5>
                <h3 class="py-5"><?php echo $row['product_name'] ?></h3>
                <h2> &#8377 <?php echo $row['product_price'] ?></h2>
                <form action="cart.php" method="post">
                    <input style="width:50px; padding-left:10px;" type="number" value="1" name="product_quantity">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                    <input type="hidden" name="product_name" value=" <?php echo $row['product_name'] ?>  ">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>">
                <input style="background-color: rgb(14, 165, 241) ;color:white; padding:3px 10px" class="btn-primary" type="submit" name="add_to_cart" value="Add To Cart">
     
      
                </form>
                <h5 class="mt-4 pt-4">Product Description :</h5>
                <p class="mt-5 mb-5"><?php echo $row['product_description'] ?></p>
            </div>

        </div>
    </section>



    <!-- Related Products -->

    <section id="related" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>
                You may also like
            </h3>
            <hr>
<?php
//$stmt1 = $conn->prepare('SELECT * from products where product_cateogry = ? limit 4')
?>
            <p>Here You can Check 5G Smartphone best prices</p>
        </div>
        <div class="row mx-auto container">

            <div class="product text-center col-lg-3 col-md-4 cold-sm-12">

                <img src="images/phone2.jpg" alt="" class="img-fluid mb-3  product-img">
                <h4 class="p-name">
                    Oneplus CE 4
                </h4>
                <h3 class="p-price">&#8377 25999</h3>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 cold-sm-12">

                <img src="images/Samsung Galaxy A15 5G 128 GB, 8 GB RAM1.jpg" alt="" class="img-fluid mb-3  product-img">
                <h4 class="p-name">
                Samsung Galaxy A15
                </h4>
                <h3 class="p-price">&#8377 25999</h3>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 cold-sm-12">

                <img src="images/phone3.jpg" alt="" class="img-fluid mb-3 product-img">
                <h4 class="p-name">
                   IQoo Z7s
                </h4>
                <h3 class="p-price">&#8377 21999</h3>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 cold-sm-12">

                <img src="images/phone4.jpg" alt="" class="img-fluid mb-3 product-img">
                <h4 class="p-name">
                    Samsung M14 5G
                </h4>
                <h3 class="p-price">&#8377 31999</h3>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>
   
        <!-- mine javascript code -->
        <script> 
        let img = document.getElementById("big-img");
        let imgGroup = document.getElementsByClassName("small-img");

for (let i = 0; i < imgGroup.length; i++) {
    imgGroup[i].onclick = function () {
        console.log("working");
        img.src = imgGroup[i].src;
    };
}
         </script>

        <?php
include('includes/get_footer.php');

?>