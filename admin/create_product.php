<?php

session_start();

if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
}

else{
    if(isset($_POST['create_btn'])){
       $product_name = $_POST['product_name'];
       $product_description = $_POST['product_description'];
       
       $product_offer = $_POST['product_offer'];
       $product_category = $_POST['product_category'];
       $product_color = $_POST['product_color'];
       $product_price = $_POST['price'];
        $product_category = strtolower($product_category);
        
       $image1 = $_FILES['image1']['tmp_name'];
       $image2 = $_FILES['image2']['tmp_name'];
       $image3 = $_FILES['image3']['tmp_name'];
       $image4 = $_FILES['image4']['tmp_name'];

       $image_name1= $product_name."1.jpg";
       $image_name2= $product_name."2.jpg";
       $image_name3= $product_name."3.jpg";
       $image_name4= $product_name."4.jpg";

       move_uploaded_file($image1,"..//images/".$image_name1);
       move_uploaded_file($image2,"..//images/".$image_name2);
       move_uploaded_file($image3,"..//images/".$image_name3);
       move_uploaded_file($image4,"..//images/".$image_name4);

       include('../server/databaseConnection.php');

       $stmt = $conn->prepare("INSERT INTO `products` (`product_name`, `product_category`, 
       `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`,
        `product_special_offer`, `product_color`) 
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param('sssssssiis', $product_name, $product_category, $product_description,
        $image_name1, $image_name2, $image_name3, $image_name4, $product_price, $product_offer, $product_color);

       if($stmt->execute()){
        header('location:add_product.php?product-added-successfully');
       }
    }
}