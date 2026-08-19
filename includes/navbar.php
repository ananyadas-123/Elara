<?php

/*
|--------------------------------------------------------------------------
| SESSION
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
|--------------------------------------------------------------------------
| DATABASE
|--------------------------------------------------------------------------
*/

require_once __DIR__ . "/connect.php";


/*
|--------------------------------------------------------------------------
| BASE URL
|--------------------------------------------------------------------------
*/

$base_url = "/shoes-website/";


/*
|--------------------------------------------------------------------------
| LOGIN STATUS
|--------------------------------------------------------------------------
*/

$user_id = $_SESSION['user_id'] ?? 0;

$is_logged_in = !empty($user_id);


/*
|--------------------------------------------------------------------------
| CURRENT PAGE
|--------------------------------------------------------------------------
|
| চাইলে অন্য page থেকেও $page variable set করতে পারবে।
|
*/

$page = $page ?? '';

if ($page === '') {

    $current_file = basename($_SERVER['PHP_SELF']);

    if ($current_file === 'home.php') {
        $page = 'home';
    }

    elseif ($current_file === 'my_orders.php') {
        $page = 'orders';
    }

    elseif ($current_file === 'wishlist_page.php') {
        $page = 'wishlist';
    }

    elseif ($current_file === 'cart_page.php') {
        $page = 'cart';
    }

    elseif ($current_file === 'profile.php') {
        $page = 'profile';
    }

}


/*
|--------------------------------------------------------------------------
| USER DATA
|--------------------------------------------------------------------------
*/

$user = null;

if ($is_logged_in) {

    $user_query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE id='" . intval($user_id) . "' LIMIT 1"
    );

    if ($user_query) {
        $user = mysqli_fetch_assoc($user_query);
    }

}


/*
|--------------------------------------------------------------------------
| USER NAME
|--------------------------------------------------------------------------
*/

$name = $user['name'] ?? 'User';


/*
|--------------------------------------------------------------------------
| PROFILE IMAGE
|--------------------------------------------------------------------------
*/

$profile_image = $base_url . "uploads/default.png";

if (
    !empty($user['image'])
) {

    $profile_image =
        $base_url . "uploads/" . $user['image'];

}


/*
|--------------------------------------------------------------------------
| CART COUNT
|--------------------------------------------------------------------------
*/

$cart_count = 0;

if ($is_logged_in) {

    $cart_query = mysqli_query(
        $conn,

        "SELECT COUNT(*) AS total
         FROM cart
         WHERE user_id='" . intval($user_id) . "'"
    );

    if ($cart_query) {

        $cart_data = mysqli_fetch_assoc($cart_query);

        $cart_count = (int)($cart_data['total'] ?? 0);

    }

}


/*
|--------------------------------------------------------------------------
| WISHLIST COUNT
|--------------------------------------------------------------------------
*/

$wish_count = 0;

if ($is_logged_in) {

    $wish_query = mysqli_query(
        $conn,

        "SELECT COUNT(*) AS total
         FROM wishlist
         WHERE user_id='" . intval($user_id) . "'"
    );

    if ($wish_query) {

        $wish_data = mysqli_fetch_assoc($wish_query);

        $wish_count = (int)($wish_data['total'] ?? 0);

    }

}

?>


<!-- =====================================================
     FONT AWESOME
===================================================== -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
>


<style>

/* =====================================================
   MAIN NAVBAR
===================================================== */

.main-navbar{

    background:#020617;

    border-bottom:1px solid rgba(255,255,255,.08);

    padding:15px 0;

    position:sticky;

    top:0;

    z-index:9999;

    backdrop-filter:blur(15px);

    box-shadow:
    0 10px 30px rgba(0,0,0,.25);

}


/* =====================================================
   LOGO
===================================================== */

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
        drop-shadow(
            0 0 8px rgba(139,92,246,.30)
        )
        drop-shadow(
            0 0 18px rgba(103,232,249,.12)
        );

    transition:all .35s ease;

}

.elara-logo:hover img{

    transform:scale(1.05);

    filter:
        drop-shadow(
            0 0 12px rgba(139,92,246,.50)
        )
        drop-shadow(
            0 0 25px rgba(103,232,249,.20)
        );

}


/* =====================================================
   NAV LINKS
===================================================== */

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


/* =====================================================
   NAV ICONS
===================================================== */

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


/* =====================================================
   COUNT BADGE
===================================================== */

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


/* =====================================================
   PROFILE BUTTON
===================================================== */

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

    transition:.3s;

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


/* =====================================================
   DROPDOWN
===================================================== */

.dropdown-menu{

    background:#111827;

    border:none;

    border-radius:16px;

    overflow:hidden;

    min-width:220px;

    margin-top:12px;

    z-index:99999;

    box-shadow:
    0 20px 40px rgba(0,0,0,.35);

}

.dropdown-item{

    color:white;

    padding:12px 18px;

    transition:.25s;

}

.dropdown-item:hover{

    background:#8b5cf6;

    color:white;

}

.dropdown-divider{

    border-color:rgba(255,255,255,.1);

}


/* =====================================================
   GUEST BUTTONS
===================================================== */

.guest-buttons{

    display:flex;

    align-items:center;

    gap:12px;

}

.guest-login{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    padding:10px 20px;

    border-radius:12px;

    border:1px solid rgba(255,255,255,.15);

    color:#e2e8f0;

    text-decoration:none;

    font-weight:600;

    transition:.3s;

}

.guest-login:hover{

    background:rgba(255,255,255,.08);

    color:white;

    border-color:rgba(255,255,255,.25);

}

.guest-signup{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    gap:8px;

    padding:10px 20px;

    border-radius:12px;

    background:
    linear-gradient(
        135deg,
        #8b5cf6,
        #6366f1
    );

    color:white;

    text-decoration:none;

    font-weight:700;

    transition:.3s;

    box-shadow:
    0 8px 20px rgba(99,102,241,.25);

}

.guest-signup:hover{

    color:white;

    transform:translateY(-2px);

    box-shadow:
    0 12px 25px rgba(99,102,241,.35);

}


/* =====================================================
   MOBILE TOGGLE
===================================================== */

.navbar-toggler{

    border:none;

    color:white !important;

}

.navbar-toggler:focus{

    box-shadow:none;

}


/* =====================================================
   MOBILE
===================================================== */

@media(max-width:991px){

    .elara-logo img{

        width:125px;

        height:52px;

    }


    .navbar-collapse{

        background:#0f172a;

        padding:20px;

        border-radius:18px;

        margin-top:15px;

        border:1px solid rgba(255,255,255,.08);

    }


    .profile-name{

        display:none;

    }


    .guest-buttons{

        margin-top:15px;

        justify-content:center;

        width:100%;

    }


    .guest-login,
    .guest-signup{

        flex:1;

        text-align:center;

    }

}


/* =====================================================
   SMALL MOBILE
===================================================== */

@media(max-width:575px){

    .guest-buttons{

        flex-direction:column;

    }

    .guest-login,
    .guest-signup{

        width:100%;

    }

}

</style>


<!-- =====================================================
     NAVBAR
===================================================== -->

<nav class="navbar navbar-expand-lg main-navbar">

<div class="container-fluid px-lg-5 px-3">


<!-- =====================================================
     LOGO
===================================================== -->

<a
class="elara-logo"
href="<?php echo $base_url; ?>home.php"
>

<img
src="<?php echo $base_url; ?>images/logo.png"
alt="ELARA"
>

</a>


<!-- =====================================================
     MOBILE TOGGLE
===================================================== -->

<button
class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarContent"
aria-controls="navbarContent"
aria-expanded="false"
aria-label="Toggle navigation"
>

<i class="fa fa-bars"></i>

</button>


<!-- =====================================================
     NAV CONTENT
===================================================== -->

<div
class="collapse navbar-collapse"
id="navbarContent"
>


<!-- =====================================================
     LOGGED IN MENU
===================================================== -->

<?php if($is_logged_in): ?>


<ul class="navbar-nav mx-auto">


<li class="nav-item">

<a
class="nav-link nav-link-custom
<?php echo ($page == 'home') ? 'active' : ''; ?>"
href="<?php echo $base_url; ?>home.php"
>

Home

</a>

</li>


<li class="nav-item">

<a
class="nav-link nav-link-custom
<?php echo ($page == 'orders') ? 'active' : ''; ?>"
href="<?php echo $base_url; ?>my_orders.php"
>

My Orders

</a>

</li>

</ul>


<!-- =====================================================
     LOGGED IN RIGHT SIDE
===================================================== -->

<div
class="d-flex align-items-center gap-4"
>


<!-- WISHLIST -->

<a
href="<?php echo $base_url; ?>wishlist_page.php"
class="nav-icon"
title="Wishlist"
>

<i class="fa-solid fa-heart"></i>


<?php if($wish_count > 0): ?>

<span class="count-badge">

<?php echo $wish_count; ?>

</span>

<?php endif; ?>

</a>


<!-- CART -->

<a
href="<?php echo $base_url; ?>cart_page.php"
class="nav-icon"
title="Cart"
>

<i class="fa-solid fa-cart-shopping"></i>


<?php if($cart_count > 0): ?>

<span class="count-badge">

<?php echo $cart_count; ?>

</span>

<?php endif; ?>

</a>


<!-- =====================================================
     PROFILE
===================================================== -->

<div class="dropdown">


<button
class="profile-btn"
type="button"
data-bs-toggle="dropdown"
aria-expanded="false"
>

<img
src="<?php echo htmlspecialchars($profile_image); ?>"
alt="Profile"
onerror="
this.src='<?php echo $base_url; ?>uploads/default.png';
"
>

<span class="profile-name">

<?php echo htmlspecialchars($name); ?>

</span>

<i class="fa-solid fa-chevron-down"></i>

</button>


<ul
class="dropdown-menu dropdown-menu-end"
>


<!-- DASHBOARD -->

<li>

<a
class="dropdown-item"
href="<?php echo $base_url; ?>dashboard.php"
>

<i class="fa fa-table-columns me-2"></i>

Dashboard

</a>

</li>


<!-- PROFILE -->

<li>

<a
class="dropdown-item"
href="<?php echo $base_url; ?>profile.php"
>

<i class="fa fa-user me-2"></i>

My Profile

</a>

</li>


<!-- WISHLIST -->

<li>

<a
class="dropdown-item"
href="<?php echo $base_url; ?>wishlist_page.php"
>

<i class="fa fa-heart me-2"></i>

Wishlist

<?php if($wish_count > 0): ?>

<span
class="badge bg-danger float-end"
>

<?php echo $wish_count; ?>

</span>

<?php endif; ?>

</a>

</li>


<!-- ORDERS -->

<li>

<a
class="dropdown-item"
href="<?php echo $base_url; ?>my_orders.php"
>

<i class="fa fa-box me-2"></i>

My Orders

</a>

</li>


<!-- DIVIDER -->

<li>

<hr class="dropdown-divider">

</li>


<!-- LOGOUT -->

<li>

<a
class="dropdown-item text-danger"
href="<?php echo $base_url; ?>logout.php"
>

<i class="fa fa-right-from-bracket me-2"></i>

Logout

</a>

</li>


</ul>

</div>

</div>


<!-- =====================================================
     GUEST MENU
===================================================== -->

<?php else: ?>


<ul class="navbar-nav mx-auto">


<li class="nav-item">

<a
class="nav-link nav-link-custom"
href="<?php echo $base_url; ?>home.php"
>

Home

</a>

</li>


</ul>


<!-- =====================================================
     GUEST RIGHT SIDE
===================================================== -->

<div class="guest-buttons">


<a
href="<?php echo $base_url; ?>login.php"
class="guest-login"
>

Login

</a>


<a
href="<?php echo $base_url; ?>register.php"
class="guest-signup"
>

Get Started

<i class="fa-solid fa-arrow-right"></i>

</a>

</div>


<?php endif; ?>


</div>

</div>

</nav>