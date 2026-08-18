<?php
session_start();
include("connect.php");

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

$product = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM products"));
$category = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM categories"));
$user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ELARA ADMIN</title>

<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

    <!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">
        ELARA
    </div>

    <div class="menu">

        <a href="#" onclick="loadPage('home.php')">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="#" onclick="loadPage('manage_slider.php')">
            <i class="fa-solid fa-images"></i>
            Home Slider
        </a>

        <a href="#" onclick="loadPage('trending_products.php')">
            <i class="fa-solid fa-fire"></i>
            Trending Products
        </a>

        <a href="#" onclick="loadPage('manage_products.php')">
            <i class="fa-solid fa-box"></i>
            Products
        </a>

        <a href="#" onclick="loadPage('add_product.php')">
            <i class="fa-solid fa-plus"></i>
            Add Product
        </a>

        <a href="#" onclick="loadPage('categories.php')">
            <i class="fa-solid fa-layer-group"></i>
            Categories
        </a>

        <a href="#" onclick="loadPage('add_category.php')">
            <i class="fa-solid fa-folder-plus"></i>
            Add Category
        </a>

        <a href="#" onclick="loadPage('manage_featured.php')">
            <i class="fa-solid fa-star"></i>
            Featured Collections
        </a>

        <a href="#" onclick="loadPage('users_list.php')">
            <i class="fa-solid fa-users"></i>
            Users
        </a>

        <a href="#" onclick="loadPage('orders.php')">
            <i class="fa-solid fa-users"></i>
            Orders
        </a>

        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

</div>

<!-- MAIN -->

<div class="main">
    <!-- TOPBAR -->

    <div class="topbar">

        <div>
            <h3>Admin Dashboard</h3>
            <p>Welcome back, <?php echo $_SESSION['name']; ?></p>
        </div>

        <div class="admin-profile">

            <img src="../uploads/<?php echo $_SESSION['profile']; ?>">

            <div>
                <h6><?php echo $_SESSION['name']; ?></h6>
                <small>Administrator</small>
            </div>

        </div>

    </div>

    <!-- CARDS ALWAYS SHOW -->

    <div class="cards">

        <div class="card-box">
            <div class="card-icon blue">
                <i class="fa-solid fa-box"></i>
            </div>
            <h5>Total Products</h5>
            <h2><?php echo $product; ?></h2>
        </div>

        <div class="card-box">
            <div class="card-icon purple">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <h5>Total Categories</h5>
            <h2><?php echo $category; ?></h2>
        </div>

        <div class="card-box">
            <div class="card-icon green">
                <i class="fa-solid fa-users"></i>
            </div>
            <h5>Total Users</h5>
            <h2><?php echo $user; ?></h2>
        </div>

    </div>

    <!-- DYNAMIC CONTENT -->

    <div id="content">

        <?php include("home.php"); ?>

    </div>

</div>

<script>

function loadPage(page){

    fetch(page)
    .then(response => response.text())
    .then(data => {

        document.getElementById("content").innerHTML = data;

    });

}

</script>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>