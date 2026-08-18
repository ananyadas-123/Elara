<?php

session_start();

include("includes/connect.php");

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn,

"SELECT products.*
FROM wishlist
JOIN products
ON wishlist.product_id = products.id
WHERE wishlist.user_id='$user_id'
ORDER BY wishlist.id DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Wishlist</title>

<link href="Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

body{

background:#0f172a;

font-family:sans-serif;

color:white;
}

.wishlist-header{

padding:70px 0 50px;

background:
linear-gradient(
135deg,
#0f172a,
#1e1b4b
);

border-bottom:
1px solid rgba(255,255,255,.08);

margin-bottom:40px;
}

.wishlist-header h1{

font-size:52px;
font-weight:900;
margin-bottom:10px;
}

.wishlist-header p{

color:#94a3b8;
font-size:18px;
margin:0;
}


.product-card{

background:#111827;

border-radius:28px;

overflow:hidden;

height:100%;

border:
1px solid rgba(255,255,255,.06);

transition:.35s;

position:relative;
}

.product-card:hover{

transform:
translateY(-10px);

box-shadow:
0 20px 40px rgba(0,0,0,.4);

border-color:#8b5cf6;
}

.product-image{

height:280px;

background:
linear-gradient(
135deg,
#ffffff,
#f8fafc
);

padding:30px;

display:flex;
align-items:center;
justify-content:center;
}

.product-image img{

max-width:100%;

max-height:100%;

object-fit:contain;
}

.product-info{
padding:20px;
}

.product-name{

font-size:20px;

font-weight:800;

line-height:1.4;

min-height:56px;
}

.product-price{

font-size:32px;

font-weight:900;

color:#8b5cf6;

margin:15px 0 25px;
}

.action-btn{

display:flex;

justify-content:center;

align-items:center;

gap:8px;

width:100%;

padding:14px;

border-radius:14px;

font-weight:700;

text-decoration:none;

margin-bottom:10px;

transition:.3s;
}

.view-btn{

background:
linear-gradient(
135deg,
#7c3aed,
#4f46e5
);

color:white;
}

.cart-btn{

background:
linear-gradient(
135deg,
#2563eb,
#1d4ed8
);

color:white;
}

.remove-btn{

background:
rgba(239,68,68,.12);

color:#ef4444;
}

.action-btn:hover{

transform:translateY(-3px);

color:white;
}

.empty-box{

padding:100px 50px;

text-align:center;

background:#111827;

border-radius:30px;

border:
1px dashed rgba(255,255,255,.1);
}

.empty-box i{

font-size:90px;

margin-bottom:25px;

color:#ef4444;
}

.empty-box h2{

font-weight:800;
margin-bottom:10px;
}

.empty-box p{

color:#94a3b8;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<?php include("includes/navbar.php"); ?>

<div class="wishlist-header">

    <div class="container">

        <h1>
            My Wishlist
        </h1>

        <p>
            Save your favorite sneakers and buy them anytime.
        </p>

    </div>

</div>

<!-- WISHLIST -->

<div class="container py-5">

<h1 class="page-title">

<i class="fa fa-heart"></i>
My Wishlist

</h1>

<div class="row g-4">

<?php

if(mysqli_num_rows($query)>0){

while($product=mysqli_fetch_assoc($query)){

?>

<div class="col-lg-3 col-md-6">

<div class="product-card">

<div class="product-image">

<img src="Admin/uploads/<?php echo $product['image']; ?>">

</div>

<div class="product-info">

<div class="product-name">

<?php echo $product['name']; ?>

</div>

<div class="product-price">

₹<?php echo $product['price']; ?>

</div>

<a href="single_product.php?id=<?php echo $product['id']; ?>"
class="action-btn view-btn">

<i class="fa fa-eye"></i>
View Product

</a>

<a href="cart.php?id=<?php echo $product['id']; ?>"
class="action-btn cart-btn">

<i class="fa fa-cart-shopping"></i>
Add To Cart
</a>

<a href="remove_wishlist.php?id=<?php echo $product['id']; ?>"
class="action-btn remove-btn">

<i class="fa fa-trash"></i>
Remove

</a>

</div>

</div>

</div>

<?php } } else { ?>

<div class="col-12">

<div class="empty-box">

<i class="fa fa-heart-crack"></i>

<h2>Wishlist Is Empty</h2>

<p>
No Products Added In Wishlist
</p>

<a href="home.php"
class="btn btn-primary mt-4 px-4 py-3">

Continue Shopping

</a>
</div>

</div>

<?php } ?>

</div>

</div>

<?php include('profile.php'); ?>
<script src="Assets/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>