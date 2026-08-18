<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . "/connect.php";

$base_url = "/shoes-website/";

$user_id = $_SESSION['user_id'] ?? 0;

$user = null;

if($user_id){

    $user_query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE id='$user_id'"
    );

    $user = mysqli_fetch_assoc($user_query);
}

$cart_count = 0;
$wish_count = 0;

if($user_id){

    $cart = mysqli_query($conn,
    "SELECT COUNT(*) as total
    FROM cart
    WHERE user_id='$user_id'");

    $cart_count = mysqli_fetch_assoc($cart)['total'];

    $wish = mysqli_query($conn,
    "SELECT COUNT(*) as total
    FROM wishlist
    WHERE user_id='$user_id'");

    $wish_count = mysqli_fetch_assoc($wish)['total'];
}

$name = $user['name'] ?? 'Guest';

$profile_image = $base_url . "uploads/default.png";

if(
isset($user['image']) &&
$user['image'] != ''
){
    $profile_image =
    $base_url . "uploads/" . $user['image'];
}


?>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

.main-navbar{

background:#020617;

border-bottom:1px solid rgba(255,255,255,.08);

padding:15px 0;

position:sticky;

top:0;

z-index:9999;

backdrop-filter:blur(15px);

box-shadow:0 10px 30px rgba(0,0,0,.25);

}

/* ================= ELARA LOGO ================= */

.elara-logo{
    display:flex;
    align-items:center;
    text-decoration:none;
    padding:2px 0;
}

.elara-logo img{
    width:145px;
    height:58px;
    object-fit:contain;

    filter:
        drop-shadow(0 0 8px rgba(139,92,246,.30))
        drop-shadow(0 0 18px rgba(103,232,249,.12));

    transition:all .35s ease;
}

.elara-logo:hover img{
    transform:scale(1.05);

    filter:
        drop-shadow(0 0 12px rgba(139,92,246,.50))
        drop-shadow(0 0 25px rgba(103,232,249,.20));
}

.nav-link-custom{
    color:#e2e8f0 !important;
    font-weight:600;
    margin:0 10px;
    transition:all .3s ease;
}

.nav-link-custom:hover{
    color:#ffffff !important;
}

.nav-link-custom.active{
    color:#a78bfa !important;
}

.nav-icon{
    position:relative;
    font-size:22px;
    color:#e2e8f0;
    text-decoration:none;
    transition:.3s;
}

.nav-icon:hover{
    color:#a78bfa;
}

.count-badge{

position:absolute;

top:-10px;

right:-12px;

width:20px;

height:20px;

background:#ef4444;

border-radius:50%;

display:flex;

align-items:center;

justify-content:center;

font-size:11px;

font-weight:700;

color:white;
}

.profile-btn{
display:flex;
align-items:center;
gap:10px;

padding:6px 12px;

background:#111827;
border:1px solid rgba(255,255,255,.08);

border-radius:50px;

color:white;

cursor:pointer;
}

.profile-btn:hover{
background:#1f2937;
color:white;
}

.profile-btn img{

width:40px;
height:40px;

border-radius:50%;

object-fit:cover;

border:2px solid #8b5cf6;
}

.profile-name{
font-size:14px;
font-weight:600;
color:white;
}

.dropdown-menu{

background:#111827;

border:none;

border-radius:16px;

overflow:hidden;
}
.dropdown-menu{
z-index:99999;
}

.dropdown-menu{
    min-width:220px;
    margin-top:12px;
}

.dropdown-item{

color:white;
padding:12px 18px;
}

.dropdown-item:hover{

background:#8b5cf6;

color:white;
}

.navbar-toggler{

border:none;
}

.navbar-toggler:focus{

box-shadow:none;
}

@media(max-width:991px){

.profile-name{
display:none;
}

.navbar-collapse{
margin-top:15px;
}

}
@media(max-width:991px){

    .elara-logo img{
        width:125px;
        height:52px;
    }

    .profile-name{
        display:none;
    }

    .navbar-collapse{
        margin-top:15px;
    }
}
@media(max-width:991px){

.navbar-collapse{

background:#0f172a;

padding:20px;

border-radius:18px;

margin-top:15px;

border:1px solid rgba(255,255,255,.08);

}

}

</style>

<nav class="navbar navbar-expand-lg main-navbar">

<div class="container-fluid px-lg-5 px-3">
<!-- LOGO -->
<!-- ELARA LOGO -->

<a class="elara-logo"
   href="<?php echo $base_url; ?>home.php">

    <img
        src="<?php echo $base_url; ?>images/logo.png"
        alt="ELARA"
    >

</a>

<!-- MOBILE TOGGLE -->

<button class="navbar-toggler text-white"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarContent">

<i class="fa fa-bars"></i>

</button>

<!-- MENU -->

<div class="collapse navbar-collapse"
id="navbarContent">

<ul class="navbar-nav mx-auto">

<li class="nav-item">

<a class="nav-link nav-link-custom <?php echo ($page=='home')?'active':''; ?>"
href="<?php echo $base_url; ?>home.php">

Home

</a>

</li>

<li class="nav-item">

<a class="nav-link nav-link-custom"
href="my_orders.php">

My Orders

</a>

</li>

</ul>

<!-- RIGHT SIDE -->

<div class="d-flex
align-items-center
gap-4">

<!-- WISHLIST -->

<a href="wishlist_page.php"
class="nav-icon">

<i class="fa-solid fa-heart"></i>

<?php if($wish_count > 0){ ?>

<span class="count-badge">

<?php echo $wish_count; ?>

</span>

<?php } ?>

</a>

<!-- CART -->

<!-- <a href="cart_page.php"
class="nav-icon"> -->

<a href="<?php echo $base_url; ?>cart_page.php" class="nav-icon">

<i class="fa-solid fa-cart-shopping"></i>

<?php if($cart_count > 0){ ?>

<span class="count-badge">

<?php echo $cart_count; ?>

</span>

<?php } ?>

</a>

<!-- PROFILE -->

<div class="dropdown">

<button
class="profile-btn"
type="button"
data-bs-toggle="dropdown">

<img
src="<?php echo $profile_image; ?>"
alt="profile"
onerror="this.src='<?php echo $base_url; ?>uploads/default.png';">
<span class="profile-name">
<?php echo $name; ?>
</span>

<i class="fa-solid fa-chevron-down"></i>

</button>

<ul class="dropdown-menu dropdown-menu-end">

<li>
<!-- <a class="dropdown-item" href="../dashboard.php"> -->
   <a class="dropdown-item" href="<?php echo $base_url; ?>dashboard.php">
<i class="fa fa-table-columns me-2"></i>
Dashboard
</a>
</li>

<li>
<!-- <a class="dropdown-item" href="profile.php"> -->
    <a class="dropdown-item" href="<?php echo $base_url; ?>profile.php">
    
<i class="fa fa-user me-2"></i>
My Profile
</a>
</li>

<li>
<!-- <a class="dropdown-item" href="wishlist_page.php"> -->
    <a class="dropdown-item" href="<?php echo $base_url; ?>wishlist_page.php">
<i class="fa fa-heart me-2"></i>
Wishlist
</a>
</li>

<li>
<!-- <a class="dropdown-item" href="my_orders.php"> -->
   
<a class="dropdown-item" href="<?php echo $base_url; ?>my_orders.php">
<i class="fa fa-box me-2"></i>
My Orders
</a>
</li>

<li><hr class="dropdown-divider"></li>

<li>
<!-- <a class="dropdown-item text-danger" href="logout.php"> -->
    <a class="dropdown-item text-danger" href="<?php echo $base_url; ?>logout.php">
<i class="fa fa-right-from-bracket me-2"></i>
Logout
</a>
</li>

</ul>

</div>

</div>

</div>

</div>


</nav>

