<?php

session_start();

include("includes/connect.php");

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

if(isset($_GET['id'])){

    $product_id = $_GET['id'];

    // CHECK PRODUCT EXISTS

    $check = mysqli_query($conn,

    "SELECT * FROM cart
    WHERE user_id='$user_id'
    AND product_id='$product_id'");

    if(mysqli_num_rows($check)>0){

        // UPDATE QUANTITY

        mysqli_query($conn,

        "UPDATE cart
        SET quantity = quantity + 1
        WHERE user_id='$user_id'
        AND product_id='$product_id'");

        $_SESSION['cart_msg'] =
        "Cart Quantity Updated 🛒";

    }else{

        // INSERT PRODUCT

        mysqli_query($conn,

        "INSERT INTO cart(user_id,product_id,quantity)

        VALUES('$user_id','$product_id','1')");

        $_SESSION['cart_msg'] =
        "Added To Cart 🛒";

    }

    header("Location: single_product.php?id=$product_id");
    exit();

}
?>