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
            circle at 8% 15%,
            <?php echo $themeColor; ?>18 0%,
            transparent 28%
        ),

        radial-gradient(
            circle at 92% 80%,
            <?php echo $themeColor; ?>12 0%,
            transparent 30%
        ),

        radial-gradient(
            circle at 70% 20%,
            rgba(49,46,129,.18) 0%,
            transparent 30%
        ),

        #020617;

    color:#fff;

    overflow-x:hidden;
}


/* =====================================================
   NAVBAR
===================================================== */

.navbar{

    background:rgba(2,6,23,.92);

    padding:18px 0;

    border-bottom:1px solid rgba(255,255,255,.08);

    backdrop-filter:blur(18px);

    position:relative;

    z-index:100;
}


/* =====================================================
   HERO
===================================================== */

.hero{

    position:relative;

    min-height:680px;

    padding:80px 0 80px;

    overflow:hidden;

    background:
        radial-gradient(
            ellipse at 75% 45%,
            <?php echo $themeColor; ?>12 0%,
            transparent 38%
        );
}


/* Large ambient glow */

.hero::before{

    content:'';

    position:absolute;

    width:750px;

    height:750px;

    top:-260px;

    right:-180px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            <?php echo $themeColor; ?>18 0%,
            <?php echo $themeColor; ?>08 35%,
            transparent 70%
        );

    filter:blur(40px);

    pointer-events:none;

    z-index:0;
}


/* Bottom ambient glow */

.hero::after{

    content:'';

    position:absolute;

    width:700px;

    height:250px;

    left:35%;

    bottom:-150px;

    transform:translateX(-50%);

    background:
        radial-gradient(
            ellipse,
            <?php echo $themeColor; ?>15 0%,
            transparent 70%
        );

    filter:blur(45px);

    pointer-events:none;

    z-index:0;
}


/* Bootstrap row */

.hero .container,
.hero .row{

    position:relative;

    z-index:2;
}


/* =====================================================
   HERO CONTENT
===================================================== */

.hero-content{

    position:relative;

    z-index:10;
}


.hero-tag{

    display:inline-flex;

    align-items:center;

    padding:10px 18px;

    border-radius:40px;

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.09),
            rgba(255,255,255,.03)
        );

    border:1px solid rgba(255,255,255,.12);

    backdrop-filter:blur(15px);

    font-size:13px;

    font-weight:700;

    letter-spacing:1.6px;

    color:#e2e8f0;

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.08),
        0 10px 30px rgba(0,0,0,.15);
}


/* =====================================================
   HERO HEADING
===================================================== */

.hero h1{

    font-size:76px;

    font-weight:900;

    line-height:.98;

    margin:28px 0;

    letter-spacing:-3px;

    color:#fff;
}


.hero h1 span{

    color:<?php echo $themeColor; ?>;

    text-shadow:
        0 0 15px <?php echo $themeColor; ?>55,
        0 0 35px <?php echo $themeColor; ?>25;
}


/* =====================================================
   HERO PARAGRAPH
===================================================== */

.hero p{

    max-width:570px;

    color:#cbd5e1;

    font-size:17px;

    line-height:1.8;

    margin-bottom:0;
}


/* =====================================================
   HERO BUTTON
===================================================== */

.hero-btn{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    padding:17px 38px;

    margin-top:28px;

    border-radius:17px;

    background:<?php echo $themeGradient; ?>;

    color:#fff;

    font-size:17px;

    font-weight:800;

    text-decoration:none;

    box-shadow:
        0 15px 35px rgba(0,0,0,.35),
        0 0 30px <?php echo $themeColor; ?>20;

    transition:
        transform .35s ease,
        box-shadow .35s ease;
}


.hero-btn:hover{

    transform:translateY(-5px);

    color:#fff;

    box-shadow:
        0 22px 45px rgba(0,0,0,.45),
        0 0 45px <?php echo $themeColor; ?>35;
}


/* =====================================================
   HERO IMAGE CONTAINER
===================================================== */

.hero-image-column{

    position:relative;

    min-height:540px;

    display:flex;

    align-items:center;

    justify-content:center;
}


/* Main image wrapper */

.hero-image-wrap{

    position:relative;

    width:100%;

    max-width:720px;

    height:560px;

    display:flex;

    align-items:center;

    justify-content:center;

    isolation:isolate;

}


/* =====================================================
   GLOW BEHIND IMAGE
===================================================== */

.hero-image-wrap::before{

    content:'';

    position:absolute;

    width:520px;

    height:520px;

    left:50%;

    top:50%;

    transform:translate(-50%,-50%);

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            <?php echo $themeColor; ?>30 0%,
            <?php echo $themeColor; ?>16 28%,
            <?php echo $themeColor; ?>08 48%,
            transparent 72%
        );

    filter:blur(45px);

    z-index:-2;

    pointer-events:none;
}


/* Extra glow */

.hero-image-wrap::after{

    content:'';

    position:absolute;

    width:520px;

    height:130px;

    left:50%;

    bottom:50px;

    transform:translateX(-50%);

    background:
        radial-gradient(
            ellipse,
            <?php echo $themeColor; ?>30 0%,
            <?php echo $themeColor; ?>12 35%,
            transparent 72%
        );

    filter:blur(30px);

    z-index:-1;

    pointer-events:none;
}


/* =====================================================
   HERO IMAGE
===================================================== */

.hero-image{

    position:relative;

    z-index:2;

    width:100%;

    max-width:720px;

    height:560px;

    object-fit:contain;

    display:block;

    /*
       Strong feather around image.
       এতে rectangular edge অনেক বেশি disappear করবে।
    */

    -webkit-mask-image:
        radial-gradient(
            ellipse 74% 72% at center,
            #000 28%,
            rgba(0,0,0,.98) 43%,
            rgba(0,0,0,.82) 55%,
            rgba(0,0,0,.55) 68%,
            rgba(0,0,0,.20) 82%,
            transparent 100%
        );

    mask-image:
        radial-gradient(
            ellipse 74% 72% at center,
            #000 28%,
            rgba(0,0,0,.98) 43%,
            rgba(0,0,0,.82) 55%,
            rgba(0,0,0,.55) 68%,
            rgba(0,0,0,.20) 82%,
            transparent 100%
        );

    /*
       Dark image background কে surrounding dark
       website background-এর সাথে blend করবে।
    */

    mix-blend-mode:screen;

    filter:
        drop-shadow(
            0 25px 35px rgba(0,0,0,.45)
        )
        drop-shadow(
            0 0 40px <?php echo $themeColor; ?>30
        );

    transition:
        transform .5s ease,
        filter .5s ease;
}


/* Hover */

.hero-image:hover{

    transform:scale(1.025);

    filter:
        drop-shadow(
            0 30px 45px rgba(0,0,0,.55)
        )
        drop-shadow(
            0 0 60px <?php echo $themeColor; ?>45
        );
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

        min-height:auto;

        padding:75px 0 60px;

        text-align:center;
    }


    .hero h1{

        font-size:56px;

        letter-spacing:-2px;
    }


    .hero p{

        margin:0 auto;

        max-width:600px;
    }


    .hero-image-column{

        min-height:470px;

        margin-top:30px;
    }


    .hero-image-wrap{

        height:470px;

        max-width:650px;
    }


    .hero-image{

        height:470px;
    }
}


@media(max-width:768px){

    .hero{

        padding:60px 0 45px;
    }


    .hero h1{

        font-size:44px;

        letter-spacing:-1px;

        margin:22px 0;
    }


    .hero p{

        font-size:16px;

        line-height:1.7;
    }


    .hero-image-column{

        min-height:370px;

        margin-top:15px;
    }


    .hero-image-wrap{

        height:370px;
    }


    .hero-image{

        height:370px;
    }


    .hero-image-wrap::before{

        width:330px;

        height:330px;
    }


    .hero-image-wrap::after{

        width:350px;

        height:90px;
    }


    .product-image{

        height:220px;
    }
}


@media(max-width:480px){

    .hero h1{

        font-size:35px;
    }


    .hero-tag{

        font-size:11px;

        padding:8px 13px;
    }


    .hero-btn{

        padding:14px 28px;

        font-size:15px;
    }


    .hero-image-column{

        min-height:300px;
    }


    .hero-image-wrap{

        height:300px;
    }


    .hero-image{

        height:300px;
    }


    .hero-image-wrap::before{

        width:260px;

        height:260px;
    }
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