<?php
session_start();

include("connect.php");

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);

    $brand = mysqli_real_escape_string($conn,$_POST['brand']);

    $category = mysqli_real_escape_string($conn,$_POST['category']);

    $price = mysqli_real_escape_string($conn,$_POST['price']);

    $rating = mysqli_real_escape_string($conn,$_POST['rating']);

    // IMAGE

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp,"uploads/".$image);

    // INSERT QUERY

    $insert = mysqli_query($conn,

    "INSERT INTO products
    (name,brand,category,price,rating,image)

    VALUES

    (
    '$name',
    '$brand',
    '$category',
    '$price',
    '$rating',
    '$image'
    )"

    );

    if($insert){

        $_SESSION['msg'] = "✅ Product Added Successfully";

    }else{

        $_SESSION['msg'] = "❌ Failed To Add Product";

    }

    header("Location: dashboard.php?page=add_product");

    exit();

}
?>