<?php

session_start();
include("includes/connect.php");

if(!isset($_GET['id'])){
    header("Location: home.php");
    exit();
}

$id = (int)$_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM products WHERE id='$id'");

if(mysqli_num_rows($query) == 0){
    header("Location: home.php");
    exit();
}

$product = mysqli_fetch_assoc($query);

/* Wishlist Check */

$is_wishlisted = false;

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

    $wish = mysqli_query($conn,

    "SELECT id FROM wishlist
    WHERE user_id='$user_id'
    AND product_id='$id'");

    $is_wishlisted = mysqli_num_rows($wish) > 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
<?php echo $product['name']; ?>
</title>

<link href="Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:#0f172a;
font-family:'Poppins',sans-serif;
color:white;
}

/* PAGE */

.product-page{
padding:60px 0;
}

/* CARD */

.product-wrapper{
background:#111827;
border-radius:28px;
padding:40px;
border:1px solid rgba(255,255,255,.06);
box-shadow:0 15px 40px rgba(0,0,0,.25);
}

/* IMAGE */

.product-image{
height:520px;
background:white;
border-radius:24px;
display:flex;
align-items:center;
justify-content:center;
overflow:hidden;
padding:30px;
}

.product-image img{
max-width:100%;
max-height:100%;
object-fit:contain;
transition:.4s;
}

.product-image:hover img{
transform:scale(1.05);
}

/* DETAILS */

.product-title{
font-size:42px;
font-weight:800;
margin-bottom:12px;
}

.brand{
font-size:16px;
color:#94a3b8;
margin-bottom:15px;
}

.rating{
display:inline-flex;
align-items:center;
gap:6px;
padding:7px 15px;
background:#16a34a;
border-radius:30px;
font-size:14px;
font-weight:600;
margin-bottom:18px;
}

.price{
font-size:48px;
font-weight:900;
color:#8b5cf6;
margin-bottom:15px;
}

.stock{
font-size:16px;
font-weight:700;
margin-bottom:25px;
}

.description{
font-size:16px;
line-height:1.9;
color:#cbd5e1;
margin-bottom:35px;
}

/* BUTTONS */

.action-buttons{
display:flex;
gap:12px;
flex-wrap:wrap;
}

.btn-action{
padding:15px 24px;
border-radius:14px;
text-decoration:none;
font-weight:700;
transition:.3s;
display:flex;
align-items:center;
justify-content:center;
gap:8px;
}

.btn-action:hover{
transform:translateY(-3px);
color:white;
}

.wishlist-btn{
background:#1e293b;
color:white;
width:60px;
}

.wishlist-btn.active{
background:#dc2626;
}

.cart-btn{
background:#2563eb;
color:white;
}

.buy-btn{
background:#8b5cf6;
color:white;
}

/* MOBILE */

@media(max-width:992px){

.product-image{
height:400px;
margin-bottom:30px;
}

.product-title{
font-size:34px;
}

.price{
font-size:38px;
}

}

@media(max-width:768px){

.product-wrapper{
padding:25px;
}

.product-title{
font-size:28px;
}

.price{
font-size:34px;
}

.action-buttons{
flex-direction:column;
}

.wishlist-btn{
width:100%;
}

.btn-action{
width:100%;
}

}

</style>

</head>

<body>

<?php include("includes/navbar.php"); ?>

<section class="product-page">

<div class="container">

<div class="product-wrapper">

<div class="row align-items-center g-5">

<!-- IMAGE -->

<div class="col-lg-6">

<div class="product-image">

<img src="Admin/uploads/<?php echo $product['image']; ?>">

</div>

</div>

<!-- DETAILS -->

<div class="col-lg-6">

<h1 class="product-title">

<?php echo $product['name']; ?>

</h1>

<div class="brand">

Brand:
<b><?php echo $product['brand']; ?></b>

</div>

<div class="rating">

<?php echo $product['rating']; ?>

<i class="fa fa-star"></i>

</div>

<div class="price">

₹<?php echo number_format($product['price']); ?>

</div>

<div class="stock">

<?php

if($product['stock'] > 10){

    echo "<span style='color:#22c55e'>
    <i class='fa fa-circle-check'></i>
    In Stock
    </span>";

}elseif($product['stock'] > 0){

    echo "<span style='color:#f59e0b'>
    <i class='fa fa-triangle-exclamation'></i>
    Only ".$product['stock']." Left
    </span>";

}else{

    echo "<span style='color:#ef4444'>
    <i class='fa fa-circle-xmark'></i>
    Out Of Stock
    </span>";

}

?>

</div>

<p class="description">

<?php

if(!empty($product['description'])){

    echo nl2br($product['description']);

}else{

    echo "Premium quality footwear designed for comfort, durability and everyday performance. Perfect for daily wear with modern styling and long-lasting support.";

}

?>

</p>

<div class="action-buttons">

<a href="wishlist.php?id=<?php echo $product['id']; ?>"
class="btn-action wishlist-btn <?php echo $is_wishlisted ? 'active' : ''; ?>">

<i class="fa fa-heart"></i>

</a>

<a href="cart.php?id=<?php echo $product['id']; ?>"
class="btn-action cart-btn">

<i class="fa fa-cart-shopping"></i>
Add To Cart

</a>

<a href="buy_now.php?id=<?php echo $product['id']; ?>"
class="btn-action buy-btn">

<i class="fa fa-bag-shopping"></i>
Buy Now

</a>

</div>

</div>

</div>

</div>

</div>

</section>

<?php include('profile.php'); ?>

</body>
</html>