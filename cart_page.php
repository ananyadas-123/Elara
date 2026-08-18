<?php

session_start();

include("includes/connect.php");

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn,

"SELECT products.*,cart.quantity
FROM cart
JOIN products
ON cart.product_id = products.id
WHERE cart.user_id='$user_id'
ORDER BY cart.id DESC");

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>My Cart</title>

<link href="Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

/* ================= GOOGLE FONT ================= */

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* ================= GLOBAL ================= */

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{

font-family:'Poppins',sans-serif;

background:
linear-gradient(
135deg,
#020617,
#0f172a,
#111827
);

min-height:100vh;

color:white;

overflow-x:hidden;
}

.cart-hero{

padding:70px 0;

background:
linear-gradient(
135deg,
#0f172a,
#1e1b4b
);

border-bottom:
1px solid rgba(255,255,255,.08);

margin-bottom:50px;
}

.cart-hero h1{

font-size:56px;
font-weight:900;
margin-bottom:10px;
}

.cart-hero p{

font-size:18px;
color:#94a3b8;
margin:0;
}

/* ================= PAGE TITLE ================= */

.page-title{

font-size:52px;

font-weight:900;

margin:50px 0 35px;

display:flex;

align-items:center;

gap:18px;
}

.page-title i{

color:#8b5cf6;
}

/* ================= CART CARD ================= */

.cart-card{

background:#111827;

border-radius:30px;

padding:25px;

margin-bottom:25px;

border:
1px solid rgba(255,255,255,.06);

transition:.35s;

position:relative;

overflow:hidden;
}

.cart-card:hover{

transform:translateY(-8px);

border-color:#8b5cf6;

box-shadow:
0 20px 50px rgba(0,0,0,.45);
}

.cart-card::before{

content:'';

position:absolute;

width:250px;
height:250px;

background:
rgba(139,92,246,.08);

border-radius:50%;

top:-120px;
right:-80px;
}


/* ================= IMAGE ================= */

.cart-image{

height:220px;

background:
linear-gradient(
135deg,
#ffffff,
#f8fafc
);

border-radius:22px;
}

.cart-image img{

max-width:100%;

max-height:100%;

object-fit:contain;

transition:.4s;
}

.cart-card:hover .cart-image img{

transform:scale(1.08) rotate(-3deg);
}

/* ================= PRODUCT DETAILS ================= */

.product-name{

font-size:26px;

font-weight:800;

line-height:1.4;

margin-bottom:8px;
}

.brand{

font-size:15px;

color:#94a3b8;

margin-bottom:16px;
}

.price{

font-size:34px;

font-weight:900;

color:#8b5cf6;

margin-bottom:12px;
}

.qty{

font-size:17px;

color:#cbd5e1;
}

.qty b{
color:white;
}

/* ================= SUBTOTAL ================= */

.subtotal{

font-size:28px;

font-weight:800;

margin-bottom:22px;

color:#22c55e;
}

/* ================= BUTTONS ================= */

.action-btn{

padding:14px 24px;

border-radius:16px;

text-decoration:none;

font-weight:700;

display:inline-flex;

align-items:center;

gap:10px;

transition:.35s;

border:none;
}

/* BUY */

.buy-btn{

background:
linear-gradient(
135deg,
#2563eb,
#3b82f6
);

color:white;
}

.buy-btn:hover{

transform:translateY(-4px);

color:white;

box-shadow:
0 14px 30px rgba(37,99,235,.35);
}

/* REMOVE */

.remove-btn{

background:
linear-gradient(
135deg,
#ef4444,
#dc2626
);

color:white;
}

.remove-btn:hover{

transform:translateY(-4px);

color:white;

box-shadow:
0 14px 30px rgba(239,68,68,.35);
}

.qty-box{

display:flex;

align-items:center;

gap:12px;

margin-top:15px;
}

.qty-number{

width:42px;
height:42px;

background:#1e293b;

border-radius:12px;

display:flex;
align-items:center;
justify-content:center;

font-weight:700;
}

/* ================= TOTAL BOX ================= */
.total-box{

margin-top:60px;

background:
linear-gradient(
135deg,
#111827,
#1e293b
);

border-radius:35px;

padding:50px;

text-align:center;

border:
1px solid rgba(255,255,255,.08);
}


.total-box::before{

content:'';

position:absolute;

width:320px;
height:320px;

background:
rgba(34,197,94,.08);

border-radius:50%;

top:-180px;
left:-100px;
}

.total-title{

font-size:24px;

font-weight:600;

color:#cbd5e1;

margin-bottom:15px;
}

.total-price{

font-size:60px;

font-weight:900;

color:#22c55e;

margin-bottom:30px;
}

.checkout-btn{

background:
linear-gradient(
135deg,
#7c3aed,
#4f46e5
);

padding:18px 45px;

border-radius:18px;

font-weight:800;

font-size:18px;

display:inline-flex;

align-items:center;

gap:12px;

text-decoration:none;

color:white;

transition:.35s;
}

.checkout-btn:hover{

transform:translateY(-5px);

box-shadow:
0 18px 35px rgba(124,58,237,.4);

color:white;
}

/* ================= EMPTY CART ================= */

.empty-box{

margin-top:80px;

background:
rgba(255,255,255,.05);

border:
1px solid rgba(255,255,255,.08);

border-radius:35px;

padding:90px 30px;

text-align:center;

backdrop-filter:blur(14px);
}

.empty-box i{

font-size:80px;

margin-bottom:25px;

color:#8b5cf6;
}

.empty-box h2{

font-size:42px;

font-weight:900;

margin-bottom:18px;
}

.empty-box p{

font-size:18px;

color:#94a3b8;

margin-bottom:35px;
}

.stock-badge{

display:inline-block;

padding:8px 15px;

background:
rgba(34,197,94,.12);

color:#22c55e;

border-radius:30px;

font-size:13px;

font-weight:700;

margin-top:10px;
}


.summary-row{

display:flex;

justify-content:space-between;

margin-bottom:20px;

font-size:18px;

color:#cbd5e1;
}
/* ================= RESPONSIVE ================= */

@media(max-width:992px){

.page-title{
font-size:42px;
}

.product-name{
font-size:24px;
}

.total-price{
font-size:48px;
}

}

@media(max-width:768px){

.page-title{
font-size:34px;
}

.cart-card{
padding:22px;
}

.cart-image{
height:250px;
margin-bottom:25px;
}

.product-name{
font-size:26px;
}

.price{
font-size:28px;
}

.subtotal{
font-size:24px;
}

.total-box{
padding:30px 20px;
}

.total-price{
font-size:42px;
}

.checkout-btn{
width:100%;
justify-content:center;
}

.text-end{
text-align:left !important;
margin-top:25px;
}

}

</style>

</head>

<body>

<!-- ================= NAVBAR ================= -->

<?php include("includes/navbar.php"); ?>

<div class="cart-hero">

    <div class="container">

        <h1>
            Shopping Cart
        </h1>

        <p>
            Review your items and complete your purchase.
        </p>

    </div>

</div>

<!-- ================= PAGE CONTENT ================= -->

<div class="container py-5">

<?php

if(mysqli_num_rows($query)>0){

while($item=mysqli_fetch_assoc($query)){

$subtotal =
$item['price'] * $item['quantity'];

$total += $subtotal;

?>

<!-- ================= CART ITEM ================= -->

<div class="cart-card">

<div class="row align-items-center">

<!-- IMAGE -->

<div class="col-lg-3">

<div class="cart-image">

<img src="Admin/uploads/<?php echo $item['image']; ?>">

</div>

</div>

<!-- DETAILS -->

<div class="col-lg-5">

<h2 class="product-name">

<?php echo $item['name']; ?>

</h2>

<div class="brand">

<?php echo $item['brand']; ?>

</div>

<div class="price">

₹<?php echo $item['price']; ?>

</div>

<div class="stock-badge">

In Stock

</div>

<div class="qty-box">

<span>Qty</span>

<div class="qty-number">

<?php echo $item['quantity']; ?>

</div>

</div>

</div>

<!-- ACTION -->

<div class="col-lg-4 text-end">

<div class="subtotal">

Subtotal:
₹<?php echo $subtotal; ?>

</div>

<div class="d-flex
justify-content-lg-end
gap-3
flex-wrap">

<a href="buy_now.php?id=<?php echo $item['id']; ?>"
class="action-btn buy-btn">

<i class="fa fa-bag-shopping"></i>

Buy Now

</a>

<a href="remove_cart.php?id=<?php echo $item['id']; ?>"
class="action-btn remove-btn" onclick="return confirm('Are you sure? This item will be removed from your cart.');">

<i class="fa fa-trash"></i>

Remove

</a>

</div>

</div>

</div>

</div>

<?php } ?>

<div class="summary-row">

<span>Total Products</span>

<b>

<?php echo mysqli_num_rows($query); ?>

</b>

</div>

<!-- ================= TOTAL ================= -->

<div class="total-box">

<div class="total-title">

Total Amount

</div>

<div class="total-price">

₹<?php echo $total; ?>

</div>

<a href="checkout.php"
class="checkout-btn">

<i class="fa fa-credit-card"></i>

Proceed To Checkout

</a>

</div>



<?php } else { ?>

<!-- ================= EMPTY CART ================= -->

<div class="empty-box">

<i class="fa-solid fa-cart-plus"></i>

<h2>Oops! Your Cart Is Empty</h2>

<p>

Explore our latest collections and add your favorite products to the cart.

</p>

<a href="home.php"
class="checkout-btn">

<i class="fa fa-store"></i>

Continue Shopping

</a>

</div>

<?php } ?>

</div>

<?php include('profile.php'); ?>

<script src="Assets/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>