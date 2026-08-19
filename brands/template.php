<?php

session_start();

include("../includes/connect.php");

/*
|--------------------------------------------------------------------------
| Guest / Logged-in User
|--------------------------------------------------------------------------
*/

$user_id = $_SESSION['user_id'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title><?php echo htmlspecialchars($brand); ?> Collection</title>

<link href="../Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* =====================================================
   GLOBAL
===================================================== */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{

    font-family:'Poppins',sans-serif;

    background:

    radial-gradient(
        circle at 10% 10%,
        <?php echo $themeColor; ?>30 0%,
        transparent 28%
    ),

    radial-gradient(
        circle at 90% 85%,
        <?php echo $themeColor; ?>20 0%,
        transparent 30%
    ),

    radial-gradient(
        circle at 70% 20%,
        #312e8130 0%,
        transparent 25%
    ),

    #020617;

    color:white;

    overflow-x:hidden;
}


/* =====================================================
   NAVBAR
===================================================== */

.navbar{

    background:#020617;

    padding:18px 0;

    border-bottom:1px solid rgba(255,255,255,.08);

}


/* =====================================================
   HERO
===================================================== */

.hero{

    padding:110px 0 90px;

    position:relative;

    overflow:hidden;

    min-height:620px;

}


/* Background glow */

.hero::before{

    content:'';

    position:absolute;

    width:650px;

    height:650px;

    background:
        radial-gradient(
            circle,
            <?php echo $themeColor; ?>20,
            transparent 68%
        );

    border-radius:50%;

    top:-230px;

    right:-180px;

    filter:blur(25px);

    pointer-events:none;

}


/* Bottom glow */

.hero::after{

    content:'';

    position:absolute;

    width:500px;

    height:300px;

    background:
        radial-gradient(
            ellipse,
            <?php echo $themeColor; ?>12,
            transparent 70%
        );

    bottom:-150px;

    left:25%;

    filter:blur(35px);

    pointer-events:none;

}


/* Hero content */

.hero-content{

    position:relative;

    z-index:5;

}


/* Premium tag */

.hero-tag{

    display:inline-block;

    padding:8px 16px;

    border-radius:30px;

    background:rgba(255,255,255,.07);

    backdrop-filter:blur(15px);

    border:1px solid rgba(255,255,255,.10);

    font-size:13px;

    font-weight:700;

    letter-spacing:1.5px;

    color:#e2e8f0;

}


/* Hero heading */

.hero h1{

    font-size:72px;

    font-weight:900;

    line-height:1;

    margin:25px 0;

    letter-spacing:-2px;

}

.hero h1 span{

    color:<?php echo $themeColor; ?>;

    text-shadow:
        0 0 25px <?php echo $themeColor; ?>50;
}


/* Hero paragraph */

.hero p{

    color:#cbd5e1;

    max-width:550px;

    font-size:17px;

    line-height:1.8;

}


/* Hero button */

.hero-btn{

    display:inline-flex;

    align-items:center;

    padding:16px 38px;

    margin-top:25px;

    border-radius:16px;

    background:<?php echo $themeGradient; ?>;

    color:white;

    font-weight:700;

    text-decoration:none;

    box-shadow:
        0 15px 35px rgba(0,0,0,.30);

    transition:.4s;

}

.hero-btn:hover{

    transform:translateY(-5px);

    box-shadow:
        0 20px 45px rgba(0,0,0,.45);

    color:white;

}


/* =====================================================
   HERO IMAGE AREA
===================================================== */
/* ================= HERO IMAGE - SEAMLESS BLEND ================= */

.hero-image-wrap{
    position:relative;
    width:100%;
    max-width:650px;
    margin:auto;

    display:flex;
    align-items:center;
    justify-content:center;

    /* Background-এর সাথে image blend করার জন্য */
    background:transparent;

    overflow:visible;
}

.hero-image{

    width:100%;
    max-width:650px;

    height:auto;

    object-fit:contain;

    display:block;

    /*
    IMAGE-এর চারপাশ fade করে দেবে।
    তাই rectangular edge বোঝা যাবে না।
    */
    -webkit-mask-image:
        radial-gradient(
            ellipse 70% 68% at center,
            black 48%,
            rgba(0,0,0,.95) 58%,
            rgba(0,0,0,.65) 70%,
            rgba(0,0,0,.25) 82%,
            transparent 100%
        );

    mask-image:
        radial-gradient(
            ellipse 70% 68% at center,
            black 48%,
            rgba(0,0,0,.95) 58%,
            rgba(0,0,0,.65) 70%,
            rgba(0,0,0,.25) 82%,
            transparent 100%
        );

    /*
    Image-এর dark background page-এর সাথে আরও blend হবে
    */
    mix-blend-mode:screen;

    filter:
        drop-shadow(0 25px 35px rgba(0,0,0,.35))
        drop-shadow(0 0 35px <?php echo $themeColor; ?>55);

    transition:all .5s ease;
}

/* Hover করলে খুব subtle zoom */

.hero-image:hover{

    transform:scale(1.025);

    filter:
        drop-shadow(0 30px 45px rgba(0,0,0,.4))
        drop-shadow(0 0 45px <?php echo $themeColor; ?>66);
}


/* Hero image hover */

.hero-image:hover{

    transform:scale(1.035);

    filter:
        drop-shadow(
            0 30px 45px rgba(0,0,0,.55)
        )
        drop-shadow(
            0 0 55px <?php echo $themeColor; ?>35
        );

}


/*
|--------------------------------------------------------------------------
| Glow behind image
|--------------------------------------------------------------------------
*/

.hero-image-wrapper::before{

    content:'';

    position:absolute;

    width:430px;

    height:430px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            <?php echo $themeColor; ?>25 0%,
            <?php echo $themeColor; ?>10 35%,
            transparent 72%
        );

    filter:blur(35px);

    z-index:0;

}


/*
|--------------------------------------------------------------------------
| Extra soft floor glow
|--------------------------------------------------------------------------
*/

.hero-image-wrapper::after{

    content:'';

    position:absolute;

    width:420px;

    height:100px;

    bottom:55px;

    left:50%;

    transform:translateX(-50%);

    background:
        radial-gradient(
            ellipse,
            <?php echo $themeColor; ?>25,
            transparent 70%
        );

    filter:blur(25px);

    z-index:0;

}


/* =====================================================
   STATS
===================================================== */

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

    border-color:<?php echo $themeColor; ?>;

    box-shadow:
        0 15px 35px rgba(0,0,0,.25);

}

.stat-card h2{

    font-size:38px;

    font-weight:900;

    color:<?php echo $themeColor; ?>;

    margin-bottom:5px;

    text-shadow:
        0 0 20px <?php echo $themeColor; ?>30;

}

.stat-card p{

    color:#cbd5e1;

    margin:0;

}


/* =====================================================
   FILTER
===================================================== */

.filter-section{

    padding:70px 0 35px;

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

    color:white;

    box-shadow:
        0 8px 25px <?php echo $themeColor; ?>35;

}


/* =====================================================
   PRODUCTS
===================================================== */

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


/* Product image */

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

    display:flex;

    align-items:center;

    justify-content:center;

    overflow:hidden;

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


/* =====================================================
   WISHLIST
===================================================== */

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

    text-decoration:none;

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


/* =====================================================
   PRODUCT BODY
===================================================== */

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


/* =====================================================
   PRODUCT BUTTON
===================================================== */

.product-buttons{

    display:block;

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

    box-shadow:
        0 15px 30px rgba(0,0,0,.3);

    color:white;

}


/* =====================================================
   GUEST NOTICE
===================================================== */

.guest-notice{

    margin-top:15px;

    font-size:12px;

    color:#94a3b8;

    text-align:center;

}

.guest-notice a{

    color:<?php echo $themeColor; ?>;

    font-weight:700;

    text-decoration:none;

}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:992px){

    .hero{

        text-align:center;

        padding:80px 0 60px;

    }

    .hero h1{

        font-size:52px;

    }

    .hero p{

        margin:auto;

    }

    .hero-image-wrapper{

        margin-top:35px;

        height:420px;

    }

    .hero-image{

        height:420px;

        max-width:650px;

    }

}


@media(max-width:768px){

    .hero{

        padding:65px 0 50px;

    }

    .hero h1{

        font-size:40px;

        letter-spacing:-1px;

    }

    .hero p{

        font-size:16px;

    }

    .hero-image-wrapper{

        height:340px;

        margin-top:20px;

    }

    .hero-image{

        height:340px;

    }

    .hero-image-wrapper::before{

        width:300px;

        height:300px;

    }

    .product-image{

        height:220px;

    }

}


/* Very small mobile */

@media(max-width:480px){

    .hero h1{

        font-size:34px;

    }

    .hero-image-wrapper{

        height:290px;

    }

    .hero-image{

        height:290px;

    }

    .hero-btn{

        padding:14px 28px;

    }

}

</style>

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php include("../includes/navbar.php"); ?>


<!-- =====================================================
     HERO
===================================================== -->

<section class="hero">

<div class="container">

<div class="row align-items-center">


<!-- HERO LEFT -->

<div class="col-lg-6 hero-content">

<span class="hero-tag">

PREMIUM COLLECTION

</span>


<h1>

Explore

<span>
<?php echo htmlspecialchars($brand); ?>
</span>

</h1>


<p>

Discover premium
<?php echo htmlspecialchars($brand); ?>
shoes crafted for comfort,
performance and modern fashion.

</p>


<a href="#products"
class="hero-btn">

Shop Now

<i class="fa-solid fa-arrow-down ms-2"></i>

</a>

</div>


<!-- HERO RIGHT -->

<div class="col-lg-6 text-center">

    <div class="hero-image-wrap">

        <img
            src="<?php echo htmlspecialchars($heroImage); ?>"
            class="hero-image"
            alt="<?php echo htmlspecialchars($brand); ?>">

    </div>

</div>


</div>

</div>

</section>


<!-- =====================================================
     STATS
===================================================== -->

<?php

$product_count = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT COUNT(*) as total
         FROM products
         WHERE brand='$brand'"

    )

);

$total_products = $product_count['total'];


$avg_rating = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT ROUND(AVG(rating),1) as rating
         FROM products
         WHERE brand='$brand'"

    )

);

$rating = $avg_rating['rating'] ?? 0;


$category_count = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT COUNT(DISTINCT category) as total
         FROM products
         WHERE brand='$brand'"

    )

);

$total_categories = $category_count['total'];

?>


<div class="container">

<div class="row text-center mt-5 g-4">


<div class="col-md-4">

<div class="stat-card">

<h2>

<?php echo $total_products; ?>+

</h2>

<p>
Products
</p>

</div>

</div>


<div class="col-md-4">

<div class="stat-card">

<h2>

<?php echo $total_categories; ?>

</h2>

<p>
Categories
</p>

</div>

</div>


<div class="col-md-4">

<div class="stat-card">

<h2>

<?php echo $rating; ?>★

</h2>

<p>
Average Rating
</p>

</div>

</div>


</div>

</div>


<!-- =====================================================
     FILTER
===================================================== -->

<section class="filter-section">

<div class="container text-center">


<button
class="filter-btn active"
onclick="filterProducts('all',event)">

All

</button>


<?php

$cats = mysqli_query(

    $conn,

    "SELECT * FROM categories"

);

while($cat = mysqli_fetch_assoc($cats)){

$category_name = strtolower(
    $cat['category_name']
);

?>


<button
class="filter-btn"
onclick="filterProducts(
'<?php echo htmlspecialchars($category_name); ?>',
event
)">

<?php

echo ucfirst(
    htmlspecialchars($cat['category_name'])
);

?>

</button>


<?php } ?>


</div>

</section>


<!-- =====================================================
     PRODUCTS
===================================================== -->

<section
class="products"
id="products">

<div class="container">

<div class="row g-4">


<?php

$q = mysqli_query(

    $conn,

    "SELECT *
     FROM products
     WHERE brand='$brand'"

);


while($row = mysqli_fetch_assoc($q)){


$isWish = 0;


if($user_id){

    $wish = mysqli_query(

        $conn,

        "SELECT id
         FROM wishlist
         WHERE user_id='$user_id'
         AND product_id='".$row['id']."'"

    );

    $isWish = mysqli_num_rows($wish);

}

?>


<div
class="col-lg-3 col-md-4 col-6 product
<?php

echo strtolower(
    htmlspecialchars($row['category'])
);

?>">


<div class="product-card">


<!-- PRODUCT IMAGE -->

<div class="product-image">


<?php if($user_id){ ?>


<div class="wishlist-icon">

<a
href="../wishlist_toggle.php?id=<?php echo $row['id']; ?>">

<i class="fa-heart

<?php

echo ($isWish)

    ? 'fa-solid text-danger'

    : 'fa-regular';

?>">

</i>

</a>

</div>


<?php } else { ?>


<div class="wishlist-icon">

<a
href="../login.php"
title="Login to use wishlist">

<i class="fa-regular fa-heart"></i>

</a>

</div>


<?php } ?>


<img

src="../admin/uploads/<?php

echo htmlspecialchars(
    $row['image']
);

?>"

alt="<?php

echo htmlspecialchars(
    $row['name']
);

?>">


</div>


<!-- PRODUCT BODY -->

<div class="product-body">


<h5 class="product-title">

<?php

echo htmlspecialchars(
    $row['name']
);

?>

</h5>


<div class="product-category">

<?php

echo htmlspecialchars(
    $row['category']
);

?>

</div>


<div class="rating">

<?php

echo htmlspecialchars(
    $row['rating']
);

?>

<i class="fa fa-star"></i>

</div>


<div class="price">

<?php

echo htmlspecialchars(
    $row['price']
);

?>

</div>


<div class="product-buttons">


<?php if($user_id){ ?>


<a

href="../single_product.php?id=<?php

echo $row['id'];

?>"

class="buy-btn">

View Details

<i class="fa-solid fa-arrow-right ms-2"></i>

</a>


<?php } else { ?>


<a

href="../login.php?redirect=single_product.php?id=<?php

echo $row['id'];

?>"

class="buy-btn">

Login to Buy

<i class="fa-solid fa-lock ms-2"></i>

</a>


<div class="guest-notice">

Please

<a href="../login.php">
login
</a>

or

<a href="../register.php">
create an account
</a>

to purchase.

</div>


<?php } ?>


</div>

</div>

</div>

</div>


<?php } ?>


</div>

</div>

</section>


<!-- =====================================================
     PROFILE
===================================================== -->

<?php

if($user_id){

    include('../profile.php');

}

?>


<!-- =====================================================
     FILTER JAVASCRIPT
===================================================== -->

<script>

function filterProducts(category,event){

    let products =
        document.querySelectorAll('.product');

    let buttons =
        document.querySelectorAll('.filter-btn');


    buttons.forEach(function(btn){

        btn.classList.remove('active');

    });


    event.target.classList.add('active');


    products.forEach(function(product){

        if(
            category === 'all' ||
            product.classList.contains(category)
        ){

            product.style.display = '';

        }

        else{

            product.style.display = 'none';

        }

    });

}

</script>


<script
src="../Assets/bootstrap/js/bootstrap.bundle.min.js">
</script>


</body>

</html>