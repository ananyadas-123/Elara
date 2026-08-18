<?php
session_start();
include("../includes/connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title><?php echo $brand; ?> Collection</title>

<link href="../Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:
    radial-gradient(circle at top left,#312e81 0%,transparent 25%),
    radial-gradient(circle at bottom right,#7c3aed 0%,transparent 25%),
    #020617;
    color:white;
    overflow-x:hidden;
}

/* ================= NAVBAR ================= */

.navbar{
background:#020617;
padding:18px 0;
border-bottom:1px solid rgba(255,255,255,.08);
}

.logo{
font-size:30px;
font-weight:800;
color:white;
}

.logo span{
color:<?php echo $themeColor; ?>;
}

.nav-links{
display:flex;
gap:15px;
align-items:center;
}

.nav-links a{
text-decoration:none;
color:white;
font-weight:600;
padding:10px 18px;
border-radius:12px;
transition:.3s;
}

.nav-links a:hover{
background:<?php echo $themeColor; ?>;
color:white;
}

/* ================= HERO ================= */

.hero{
    padding:120px 0;
    position:relative;
}

.hero::before{
    content:'';
    position:absolute;
    width:600px;
    height:600px;
    background:rgba(255,255,255,.03);
    border-radius:50%;
    top:-250px;
    right:-150px;
    filter:blur(20px);
}

.hero-tag{
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,.1);
}

.hero h1{
    font-size:72px;
    font-weight:900;
    line-height:1;
}

.hero p{
    color:#cbd5e1;
    max-width:550px;
}

.hero-btn{
display:inline-block;
padding:16px 38px;
border-radius:16px;
background:<?php echo $themeGradient; ?>;
color:white;
font-weight:700;
text-decoration:none;
box-shadow:0 15px 35px rgba(0,0,0,.3);
transition:.4s;
}

.hero-btn:hover{
transform:translateY(-5px);
box-shadow:0 20px 40px rgba(0,0,0,.45);
}

.product-image{
position:relative;
height:260px;
background:white;
display:flex;
align-items:center;
justify-content:center;
padding:20px;
overflow:hidden;
}

.wishlist-icon{
position:absolute;
top:15px;
right:15px;
z-index:99;
}

.wishlist-icon a{
width:46px;
height:46px;
background:rgba(255,255,255,.95);
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
backdrop-filter:blur(10px);
transition:.3s;
text-decoration: none;
}

.wishlist-icon a:hover{
transform:scale(1.1);
}

.fa-solid.fa-heart{
color:#ef4444;
}

.fa-regular.fa-heart{
color:#64748b;
}
/* ================= FILTER ================= */

.filter-section{
padding-bottom:35px;
}

.filter-btn{
padding:12px 24px;
border:none;
border-radius:14px;
background:rgba(255,255,255,.05);
color:white;
margin:6px;
font-weight:700;
transition:.35s;
}

.filter-btn:hover,
.filter-btn.active{
background:<?php echo $themeColor; ?>;
}

/* ================= PRODUCTS ================= */

.products{
padding:30px 0 100px;
}

.product-card{
background:rgba(255,255,255,.05);
backdrop-filter:blur(18px);
border:1px solid rgba(255,255,255,.08);
border-radius:28px;
overflow:hidden;
height:100%;
transition:.4s;
}

.product-card:hover{
transform:translateY(-12px);
border-color:<?php echo $themeColor; ?>;
box-shadow:
0 25px 50px rgba(0,0,0,.4);
}

.product-image{
height:280px;
background:
linear-gradient(
135deg,
#ffffff,
#f8fafc
);
padding:25px;
position:relative;
}

.product-image img{
width:100%;
height:100%;
object-fit:contain;
transition:.4s;
}

.product-card:hover img{
transform:scale(1.08);
}

.product-body{
padding:24px;
}

.product-title{
font-size:20px;
font-weight:800;
margin-bottom:8px;
min-height:50px;
}

.product-category{
font-size:13px;
color:#94a3b8;
margin-bottom:14px;
}

.rating{
display:inline-flex;
align-items:center;
gap:6px;
padding:6px 12px;
border-radius:30px;
background:#16a34a;
font-size:13px;
font-weight:700;
margin-bottom:18px;
}

.price{
font-size:32px;
font-weight:900;
color:white;
margin-bottom:18px;
}

.price::before{
content:'₹';
font-size:20px;
margin-right:3px;
color:<?php echo $themeColor; ?>;
}

.product-buttons{
display:block;
}

.cart-btn,
.buy-btn{
flex:1;
text-align:center;
padding:12px;
border-radius:14px;
font-weight:700;
text-decoration:none;
transition:.35s;
}

.cart-btn{
background:#111827;
color:white;
}

.cart-btn:hover{
background:#1e293b;
color:white;
}

.buy-btn{
display:block;
width:100%;
padding:14px;
border-radius:14px;
background:<?php echo $themeGradient; ?>;
color:white;
font-weight:700;
text-decoration:none;
text-align:center;
transition:.35s;
}

.buy-btn:hover{
transform:translateY(-4px);
box-shadow:0 15px 30px rgba(0,0,0,.3);
}

/* state */

.stat-card{
    background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    padding:25px;
    backdrop-filter:blur(12px);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.stat-card h2{
    font-size:38px;
    font-weight:900;
    color:<?php echo $themeColor; ?>;
    margin-bottom:5px;
}

.stat-card p{
    color:#cbd5e1;
    margin:0;
}

/* ================= RESPONSIVE ================= */

@media(max-width:992px){

.hero{
text-align:center;
}

.hero h1{
font-size:48px;
}

.hero p{
margin:auto auto 35px;
}

.hero-image{
margin-top:40px;
}

}

@media(max-width:768px){

.hero h1{
font-size:36px;
}

.hero p{
font-size:16px;
}

.product-image{
height:220px;
}

.navbar .container{
flex-direction:column;
gap:15px;
}

}

</style>

</head>

<body>

<!-- ================= NAVBAR ================= -->

<?php include("../includes/navbar.php"); ?>


<!-- ================= HERO ================= -->

<section class="hero">

<div class="container">

<div class="row align-items-center">

<!-- LEFT -->

<div class="col-lg-6 hero-content">

<span class="hero-tag">

PREMIUM COLLECTION

</span>

<h1>

Explore
<span><?php echo $brand; ?></span>

</h1>

<p>

Discover premium <?php echo $brand; ?> shoes crafted for comfort,
performance and modern fashion.

</p>

<a href="#products" class="hero-btn">

Shop Now

</a>

</div>

<!-- RIGHT -->

<div class="col-lg-6 text-center">

<img src="<?php echo $heroImage; ?>"
class="hero-image">

</div>

</div>

</div>

</section>

<!-- state -->

<?php

$product_count = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) as total FROM products WHERE brand='$brand'")
);

$total_products = $product_count['total'];

$avg_rating = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT ROUND(AVG(rating),1) as rating FROM products WHERE brand='$brand'")
);

$rating = $avg_rating['rating'];

$category_count = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(DISTINCT category) as total FROM products WHERE brand='$brand'")
);

$total_categories = $category_count['total'];

?>

<div class="row text-center mt-5 g-4">

    <div class="col-md-4">
        <div class="stat-card">
            <h2><?php echo $total_products; ?>+</h2>
            <p>Products</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <h2><?php echo $total_categories; ?></h2>
            <p>Categories</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <h2><?php echo $rating; ?>★</h2>
            <p>Average Rating</p>
        </div>
    </div>

</div>

<!-- ================= FILTER ================= -->

<section class="filter-section">

<div class="container text-center">

<button class="filter-btn active"
onclick="filterProducts('all',event)">

All

</button>

<?php

$cats = mysqli_query(
$conn,
"SELECT * FROM categories"
);

while($cat = mysqli_fetch_assoc($cats)){

?>

<button class="filter-btn"

onclick="filterProducts('<?php echo strtolower($cat['category_name']); ?>',event)">

<?php echo ucfirst($cat['category_name']); ?>

</button>

<?php } ?>

</div>

</section>

<!-- ================= PRODUCTS ================= -->

<section class="products" id="products">

<div class="container">

<div class="row g-4">

<?php

$q = mysqli_query($conn,

"SELECT * FROM products
WHERE brand='$brand'"

);

while($row = mysqli_fetch_assoc($q)){
    $user_id = $_SESSION['user_id'] ?? 0;

$isWish = 0;

if($user_id){

$wish = mysqli_query($conn,

"SELECT id FROM wishlist
WHERE user_id='$user_id'
AND product_id='".$row['id']."'");

$isWish = mysqli_num_rows($wish);
}

?>

<div class="col-lg-3 col-md-4 col-6 product <?php echo strtolower($row['category']); ?>">

<div class="product-card">

<!-- IMAGE -->

<div class="product-image">

    <div class="wishlist-icon">

        <a href="../wishlist_toggle.php?id=<?php echo $row['id']; ?>">

            <i class="fa-heart <?php echo ($isWish) ? 'fa-solid text-danger' : 'fa-regular'; ?>"></i>

        </a>

    </div>

    <img src="../admin/uploads/<?php echo $row['image']; ?>">

</div>

<!-- BODY -->

<div class="product-body">

<h5 class="product-title">

<?php echo $row['name']; ?>

</h5>

<div class="product-category">

<?php echo $row['category']; ?>

</div>

<div class="rating">

<?php echo $row['rating']; ?>

<i class="fa fa-star"></i>

</div>

<div class="price">

<?php echo $row['price']; ?>

</div>

<div class="product-buttons">

<a href="../single_product.php?id=<?php echo $row['id']; ?>"
class="buy-btn">

View Details

</a>

</div>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<!-- ================= JS ================= -->
<?php include('../profile.php'); ?>

<script>

function filterProducts(category,event){

let products =
document.querySelectorAll('.product');

let buttons =
document.querySelectorAll('.filter-btn');

buttons.forEach(btn=>{

btn.classList.remove('active');

});

event.target.classList.add('active');

products.forEach(product=>{

if(category==='all' ||

product.classList.contains(category)){

product.style.display='block';

}else{

product.style.display='none';

}

});

}

</script>

</body>
</html>