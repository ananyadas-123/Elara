<?php

session_start();

$order_id = isset($_GET['id'])
? $_GET['id']
: "000";

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Order Successful | ELARA</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{

font-family:'Inter',sans-serif;

min-height:100vh;

display:flex;
justify-content:center;
align-items:center;

background:
linear-gradient(
135deg,
#020617,
#0f172a,
#111827
);

padding:20px;
}

.success-card{

width:100%;
max-width:700px;

background:#111827;

border-radius:35px;

padding:60px 40px;

text-align:center;

border:1px solid rgba(255,255,255,.08);

box-shadow:
0 25px 60px rgba(0,0,0,.45);
}

.success-icon{

width:120px;
height:120px;

margin:auto;
margin-bottom:25px;

border-radius:50%;

background:
linear-gradient(
135deg,
#10b981,
#22c55e
);

display:flex;
align-items:center;
justify-content:center;

font-size:55px;
color:white;

animation:pop .6s ease;
}

@keyframes pop{

0%{
transform:scale(.4);
opacity:0;
}

100%{
transform:scale(1);
opacity:1;
}

}

.success-card h1{

font-size:42px;
font-weight:800;

margin-bottom:15px;

color:white;
}

.success-card p{

color:#94a3b8;

font-size:17px;

line-height:1.8;

margin-bottom:20px;
}

.order-id{

display:inline-block;

padding:12px 22px;

border-radius:15px;

background:
rgba(124,58,237,.15);

border:
1px solid rgba(124,58,237,.3);

color:#c4b5fd;

font-weight:700;

margin-bottom:30px;
}

.info-box{

background:#1f2937;

padding:20px;

border-radius:18px;

margin-bottom:30px;
}

.info-box h5{

margin-bottom:10px;

font-weight:700;

color:white;
}

.info-box p{

margin:0;

font-size:15px;
}

.btn-group-custom{

display:flex;

justify-content:center;

gap:15px;

flex-wrap:wrap;
}

.shop-btn{

padding:15px 28px;

border-radius:16px;

background:
linear-gradient(
135deg,
#7c3aed,
#4f46e5
);

color:white;

font-weight:700;

text-decoration:none;

transition:.3s;
}

.shop-btn:hover{

transform:translateY(-4px);

color:white;
}

.order-btn{

padding:15px 28px;

border-radius:16px;

background:#1f2937;

border:1px solid rgba(255,255,255,.08);

color:white;

font-weight:700;

text-decoration:none;

transition:.3s;
}

.order-btn:hover{

background:#374151;

color:white;
}

.brand{

margin-top:35px;

color:#6b7280;

font-size:14px;
}

@media(max-width:576px){

.success-card{

padding:40px 25px;
}

.success-card h1{

font-size:30px;
}

.success-icon{

width:90px;
height:90px;

font-size:40px;
}

}

</style>

</head>

<body>

<div class="success-card">

<div class="success-icon">

<i class="fa-solid fa-check"></i>

</div>

<h1>
Order Confirmed
</h1>

<p>

Thank you for shopping with ELARA.
Your order has been placed successfully
and is now being processed.

</p>

<div class="order-id">

Order ID #<?php echo $order_id; ?>

</div>

<div class="info-box">

<h5>
<i class="fa-solid fa-truck-fast"></i>
 Estimated Delivery
</h5>

<p>
Your order will be delivered within
3-7 business days.
</p>

</div>

<div class="btn-group-custom">

<a href="home.php"
class="shop-btn">

<i class="fa-solid fa-bag-shopping"></i>

Continue Shopping

</a>

<a href="my_orders.php"
class="order-btn">

<i class="fa-solid fa-box"></i>

View Orders

</a>

</div>

<div class="brand">

© <?php echo date("Y"); ?>
ELARA Luxury Sneakers

</div>

</div>

</body>
</html>