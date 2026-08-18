<?php

$page = "dashboard";

include('includes/auth.php');
include('includes/connect.php');

$id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$id'";
$run = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($run);

/* ================= DASHBOARD COUNTS ================= */

// Total Orders
$order_q = mysqli_query($conn,
"SELECT COUNT(*) as total FROM orders
WHERE user_id='$id'");
$order_data = mysqli_fetch_assoc($order_q);
$total_orders = $order_data['total'];

// Wishlist Count
$wishlist_q = mysqli_query($conn,
"SELECT COUNT(*) as total FROM wishlist
WHERE user_id='$id'");
$wishlist_data = mysqli_fetch_assoc($wishlist_q);
$total_wishlist = $wishlist_data['total'];

// Cart Count
$cart_q = mysqli_query($conn,
"SELECT COUNT(*) as total FROM cart
WHERE user_id='$id'");
$cart_data = mysqli_fetch_assoc($cart_q);
$total_cart = $cart_data['total'];

// Total Spent
$spent_q = mysqli_query($conn,

"SELECT SUM(total_price) as total_spent
FROM orders
WHERE user_id='$id'");

if(!$spent_q){
    die(mysqli_error($conn));
}

$spent_data = mysqli_fetch_assoc($spent_q);

$total_spent = $spent_data['total_spent'];

if($total_spent==""){
    $total_spent = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>ELARA Dashboard</title>

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- FONT AWESOME -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<!-- GOOGLE FONT -->

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<style>
<style>

:root{

--bg:#050816;
--card:#0f172a;
--card2:#111827;
--border:#233044;

--primary:#7c3aed;
--secondary:#2563eb;

--success:#22c55e;
--warning:#f59e0b;
--danger:#ef4444;

--text:#f8fafc;
--muted:#94a3b8;

}

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{

font-family:'Inter',sans-serif;

background:

radial-gradient(circle at 15% 20%,rgba(124,58,237,.20),transparent 22%),

radial-gradient(circle at 90% 80%,rgba(37,99,235,.15),transparent 25%),

linear-gradient(180deg,#030712,#071122);

color:white;

overflow-x:hidden;

}

/* ================= MAIN LAYOUT ================= */

.main-layout{
display:flex;
min-height:100vh;
}

/* ================= SIDEBAR ================= */

.sidebar{

width:290px;

height:100vh;

position:fixed;

left:0;

top:0;

padding:30px 22px;

background:

rgba(8,17,32,.75);

backdrop-filter:blur(30px);

border-right:1px solid rgba(255,255,255,.08);

box-shadow:

10px 0 40px rgba(0,0,0,.35);

}

.sidebar::-webkit-scrollbar{
width:4px;
}

.sidebar::-webkit-scrollbar-thumb{
background:#7c3aed;
border-radius:20px;
}

/* LOGO */

.logo-area{
display:flex;
align-items:center;
gap:14px;
margin-bottom:35px;
}

.logo-area img{
width:55px;
}

.logo-area h3{
font-size:28px;
font-weight:800;
margin:0;
color:white;
}

.logo-area span{
font-size:12px;
color:#94a3b8;
}

/* USER CARD */

.user-card{
display:flex;
align-items:center;
gap:15px;
padding:18px;
border-radius:24px;
background:rgba(255,255,255,.04);
border:1px solid rgba(255,255,255,.06);
margin-bottom:35px;
}

.stat-card{

background:

linear-gradient(
180deg,
rgba(255,255,255,.08),
rgba(255,255,255,.03)
);

border:

1px solid rgba(255,255,255,.08);

backdrop-filter:blur(30px);

border-radius:28px;

box-shadow:

0 15px 40px rgba(0,0,0,.30);

transition:.35s;

}

.user-card img{
width:70px;
height:70px;
border-radius:50%;
object-fit:cover;
border:3px solid #8b5cf6;
}

.user-card h4{
font-size:18px;
font-weight:700;
margin-bottom:4px;
color:white;
}

.user-card p{
font-size:13px;
color:#94a3b8;
margin:0;
}

/* MENU */

.menu-links{
margin-top:10px;
}

.menu-links a{
display:flex;
align-items:center;
gap:15px;
padding:15px 18px;
border-radius:18px;
margin-bottom:14px;
text-decoration:none;
color:white;
font-weight:600;
transition:.3s;
}

.menu-links a i{
width:42px;
height:42px;
border-radius:14px;
display:flex;
align-items:center;
justify-content:center;
background:rgba(255,255,255,.05);
font-size:16px;
}

.menu-links a{

position:relative;

transition:.35s;

}

.menu-links a:hover{

background:

linear-gradient(135deg,

rgba(124,58,237,.35),

rgba(37,99,235,.18));

transform:translateX(8px);

box-shadow:

0 12px 25px rgba(124,58,237,.25);

}

.menu-links a.active{

background:

linear-gradient(135deg,#7c3aed,#4f46e5);

box-shadow:

0 15px 35px rgba(124,58,237,.35);

}

.logout-btn{
margin-top:35px;
background:rgba(239,68,68,.12) !important;
color:#f87171 !important;
}

.logout-btn:hover{
background:linear-gradient(135deg,#ef4444,#dc2626) !important;
color:white !important;
}

/* ================= MAIN CONTENT ================= */

.main-content{
margin-left:290px;
width:calc(100% - 290px);
padding:35px;
}

/* ================= RESPONSIVE ================= */

@media(max-width:991px){

.sidebar{
left:-100%;
transition:.4s;
}

.main-content{
margin-left:0;
width:100%;
padding:20px;
}

}
/* ================= TOPBAR ================= */

.topbar{

padding:22px 28px;

background:

rgba(255,255,255,.04);

border:

1px solid rgba(255,255,255,.05);

border-radius:25px;

backdrop-filter:blur(25px);

margin-bottom:35px;

display:flex;

justify-content:space-between;

align-items:center;

}

.search-box{
flex:1;
height:65px;
border-radius:22px;
background:rgba(255,255,255,.04);
display:flex;
align-items:center;
padding:0 24px;
border:1px solid rgba(255,255,255,.06);
}

.top-actions{
display:flex;
align-items:center;
gap:14px;
}

.top-icon{
width:56px;
height:56px;
border-radius:18px;
background:rgba(255,255,255,.05);
display:flex;
align-items:center;
justify-content:center;
position:relative;
cursor:pointer;
transition:.3s;
}

.top-icon:hover{
background:#7c3aed;
transform:translateY(-4px);
}

.top-icon span{
position:absolute;
top:-4px;
right:-4px;
width:22px;
height:22px;
border-radius:50%;
background:#8b5cf6;
display:flex;
align-items:center;
justify-content:center;
font-size:11px;
font-weight:700;
}

.profile-mini img{
width:56px;
height:56px;
border-radius:50%;
object-fit:cover;
border:2px solid rgba(255,255,255,.08);
}

/* ================= PAGE TITLE ================= */

.page-title{
margin-bottom:35px;
}

.page-title h1{
font-size:42px;
font-weight:900;
margin-bottom:10px;
}

.page-title p{
color:#94a3b8;
font-size:16px;
}

/* ================= STATS ================= */

.stat-card{

padding:32px;

border-radius:28px;

background:

linear-gradient(

180deg,

rgba(255,255,255,.08),

rgba(255,255,255,.03)

);

border:

1px solid rgba(255,255,255,.08);

backdrop-filter:blur(25px);

transition:.4s;

overflow:hidden;

position:relative;

box-shadow:

0 20px 40px rgba(0,0,0,.25);

}

.stat-card::after{

content:'';

position:absolute;

right:-70px;

bottom:-70px;

width:160px;

height:160px;

background:

rgba(124,58,237,.12);

border-radius:50%;

}

.stat-card:hover{

transform:

translateY(-10px);

border-color:#7c3aed;

box-shadow:

0 25px 55px rgba(124,58,237,.25);

}

.stat-icon{
width:70px;
height:70px;
border-radius:20px;
display:flex;
align-items:center;
justify-content:center;
font-size:24px;
margin-bottom:22px;
position:relative;
z-index:2;
}

.icon-purple{
background:rgba(139,92,246,.15);
color:#8b5cf6;
}

.icon-pink{
background:rgba(236,72,153,.15);
color:#ec4899;
}

.icon-blue{
background:rgba(59,130,246,.15);
color:#3b82f6;
}

.icon-green{
background:rgba(34,197,94,.15);
color:#22c55e;
}

.stat-card h3{
font-size:42px;
font-weight:900;
margin-bottom:8px;
position:relative;
z-index:2;
}

.stat-card p{
color:#94a3b8;
font-size:15px;
margin-bottom:18px;
position:relative;
z-index:2;
}

.stat-card a{
color:white;
text-decoration:none;
font-weight:600;
position:relative;
z-index:2;
}

/* ================= TABLE ================= */

.orders-section{
margin-top:50px;
}

.section-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.section-header h2{
font-size:30px;
font-weight:800;
}

.custom-table{

background:

rgba(255,255,255,.04);

backdrop-filter:blur(25px);

border-radius:25px;

overflow:hidden;

border:

1px solid rgba(255,255,255,.06);

box-shadow:

0 20px 45px rgba(0,0,0,.25);

}

.custom-table table{
margin:0;
color:white;
}

.custom-table th{

background:#111827;

color:#cbd5e1;

font-size:13px;

text-transform:uppercase;

letter-spacing:1px;

}

.custom-table td{
padding:20px;
border-color:rgba(255,255,255,.05);
}

.status{

padding:8px 18px;

border-radius:50px;

font-size:12px;

font-weight:700;

letter-spacing:.5px;

text-transform:uppercase;

}

.delivered{
background:rgba(34,197,94,.15);
color:#22c55e;
}

.processing{
background:rgba(234,179,8,.15);
color:#eab308;
}

.shipped{
background:rgba(59,130,246,.15);
color:#3b82f6;
}


.welcome-card{

position:relative;

overflow:hidden;

padding:45px;

border-radius:35px;

background:

linear-gradient(

135deg,

#7c3aed,

#2563eb

);

box-shadow:

0 20px 60px rgba(124,58,237,.35);

}

.welcome-card::before{

content:'';

position:absolute;

width:350px;

height:350px;

background:

rgba(255,255,255,.08);

border-radius:50%;

right:-120px;

top:-120px;

}

.welcome-card img{
width:90px;
height:90px;
border-radius:50%;
object-fit:cover;
border:4px solid white;
}


.quick-action{

height:95px;

border-radius:22px;

background:

rgba(255,255,255,.04);

border:

1px solid rgba(255,255,255,.05);

transition:.35s;

}

.quick-action:hover{

background:

linear-gradient(

135deg,

#7c3aed,

#2563eb

);

transform:

translateY(-8px);

box-shadow:

0 15px 35px rgba(124,58,237,.30);

}

.mini{

font-size:12px;
color:#94a3b8;
margin-top:10px;

}


.summary-box{

margin-top:40px;

padding:35px;

border-radius:28px;

background:

rgba(255,255,255,.04);

backdrop-filter:blur(30px);

border:

1px solid rgba(255,255,255,.06);

box-shadow:

0 20px 45px rgba(0,0,0,.22);

}

.summary-item{

display:flex;

justify-content:space-between;

padding:15px 0;

border-bottom:
1px solid rgba(255,255,255,.05);

}

.btn-primary{

background:

linear-gradient(135deg,#7c3aed,#2563eb);

border:none;

}

.btn-primary:hover{

transform:translateY(-2px);

}
/* ================= RESPONSIVE ================= */

@media(max-width:991px){

.sidebar{
display:none;
}

.main-content{
margin-left:0;
padding:20px;
}

}

@media(max-width:768px){

.topbar{
flex-direction:column;
}

.search-box{
width:100%;
}

.page-title h1{
font-size:32px;
}

}

</style>

</head>

<body>

<div class="main-layout">

    <!-- SIDEBAR -->

    <?php include('includes/sidebar.php'); ?>

    <!-- MAIN CONTENT -->

    <div class="main-content">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

    <h2 style="font-weight:800;margin:0;">
        Customer Dashboard
    </h2>

    <p style="color:#94a3b8;margin:0;">
        Monitor your shopping activity
    </p>

</div>

            <div class="top-actions">

                <div class="top-icon">

                    <a href="wishlist_page.php"
                    class="nav-btn text-white">

                        <i class="fa fa-heart"></i>

                    </a>

                    <span>
                        <?php echo $total_wishlist; ?>
                    </span>

                </div>

                <div class="top-icon">

                    <a href="cart_page.php" class="nav-btn">

                        <i class="fa fa-cart-shopping"></i>

                    </a>
                    <span><?php echo $total_cart; ?></span>

                </div>

                <div class="profile-mini">

                    <!-- <img src="uploads/<?php //echo $user['image']; ?>"> -->

                </div>

            </div>

        </div>

<div class="welcome-card">

    <div>

        <span style="
        background:rgba(255,255,255,.15);
        padding:8px 14px;
        border-radius:30px;
        font-size:13px;
        display:inline-block;
        margin-bottom:15px;">

            ELARA Premium Member

        </span>

        <h2>

        Welcome Back,
        <?php echo $user['name']; ?> 👋

        </h2>

        <p>

        You have
        <b><?php echo $total_orders; ?></b>
        orders,
        <b><?php echo $total_cart; ?></b>
        items in cart and
        <b><?php echo $total_wishlist; ?></b>
        wishlist products.

        </p>

        <p>

            Track orders, manage wishlist,
            monitor cart activity and enjoy
            seamless shopping experience.

        </p>

    </div>

    <img src="uploads/<?php echo $user['image']; ?>">

</div>


        <!-- STATS -->

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">

                <div class="stat-card">

                    <div class="stat-icon icon-purple">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>

                    <h3><?php echo $total_orders; ?></h3>

                    <p>Total Orders</p>

                    <a href="my_orders.php">View Orders →</a>
                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="stat-card">

                    <div class="stat-icon icon-pink">
                        <i class="fa-regular fa-heart"></i>
                    </div>

                    <h3><?php echo $total_wishlist; ?></h3>

                <p>Wishlist Items</p>

                <a href="wishlist_page.php">
                View Wishlist →
                </a>
                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="stat-card">

                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>

                    <h3><?php echo $total_cart; ?></h3>

                    <p>Cart Products</p>

                    <a href="cart_page.php">
                    Go To Cart →
                    </a>
                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="stat-card">

                    <div class="stat-icon icon-green">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>

                    <h3>₹<?php echo number_format($total_spent); ?></h3>

                    <p>Total Spending</p>

                    <p class="mini">

                    Lifetime Orders
                    </p>

                </div>

            </div>

        </div>



        <div class="row g-4 mt-2">

            <div class="col-md-4">

                <a href="home.php" class="quick-action">

                    <i class="fa fa-heart"></i>

                    Continue Shopping

                </a>

            </div>

            <div class="col-md-4">

                <a href="my_orders.php" class="quick-action">

                    <i class="fa fa-cart-shopping"></i>

                    Track Orders

                </a>

            </div>

            <div class="col-md-4">

                <a href="profile.php" class="quick-action">

                    <i class="fa fa-store"></i>

                    Manage Profile

                </a>

            </div>

        </div>

        <div class="summary-box">

<h3>

Shopping Summary

</h3>

<div class="summary-item">

Orders Completed

<span>

<?php echo $total_orders; ?>

</span>

</div>

<div class="summary-item">

Wishlist Products

<span>

<?php echo $total_wishlist; ?>

</span>

</div>

<div class="summary-item">

Cart Products

<span>

<?php echo $total_cart; ?>

</span>

</div>

</div>

        <?php

            $last_order = mysqli_query($conn,

            "SELECT *
            FROM orders
            WHERE user_id='$id'
            ORDER BY id DESC
            LIMIT 1");

            $last = mysqli_fetch_assoc($last_order);

        ?>


        <div class="orders-section">

            <div class="section-header">

                <h2>Recent Orders</h2>

                <a href="orders.php" class="btn btn-outline-light">
                View All
                </a>

            </div>

            <div class="custom-table">

                <table class="table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $recent = mysqli_query($conn,

                        "SELECT *
                        FROM orders
                        WHERE user_id='$id'
                        ORDER BY id DESC
                        LIMIT 5");

                        while($row=mysqli_fetch_assoc($recent)){

                        ?>

                        <tr>

                            <td><?php echo $row['id']; ?></td>

                            <td>#EL<?php echo $row['id']; ?></td>

                            <td>₹<?php echo $row['total_price']; ?></td>

                            <td><?php echo $row['payment_method']; ?></td>

                            <td>

                            <span class="status <?php echo strtolower($row['order_status']); ?>">

                            <?php echo $row['order_status']; ?>

                            </span>

                            </td>

                            <td>

                            <?php echo date(
                            "d M Y",
                            strtotime($row['order_date'])
                            ); ?>

                            </td>

                            <td>

                                <a href="order_details.php?id=<?php echo $row['id']; ?>"

                                class="btn btn-sm btn-primary">

                                View

                                </a>

                            </td>

                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>


    </div>

</div>

<?php include('profile.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>