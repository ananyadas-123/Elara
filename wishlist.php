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

    // CHECK ALREADY EXISTS

    $check = mysqli_query($conn,

    "SELECT * FROM wishlist
    WHERE user_id='$user_id'
    AND product_id='$product_id'");

    if(mysqli_num_rows($check) > 0){

        $_SESSION['wishlist_msg'] =
        "Already Added In Wishlist ❤️";

    }else{

        mysqli_query($conn,

        "INSERT INTO wishlist(user_id,product_id)
        VALUES('$user_id','$product_id')");

        $_SESSION['wishlist_msg'] =
        "Added To Wishlist ❤️";

    }

    header("Location: single_product.php?id=$product_id");
    exit();

}
?>