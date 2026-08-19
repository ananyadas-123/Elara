<?php

$page = "home";

include('includes/auth.php');

/* =========================================================
   HELPER FUNCTIONS
========================================================= */

function e($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function slugify($text)
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function brandImage($brand)
{
    $slug = slugify($brand);

    $extensions = ['png', 'jpg', 'jpeg', 'webp'];

    foreach ($extensions as $ext) {

        $path = "images/brands/" . $slug . "." . $ext;

        if (file_exists($path)) {
            return $path;
        }
    }

    return "images/elara-logo.png";
}


/* =========================================================
   HERO SLIDER
========================================================= */

$get_slider = mysqli_query(
    $conn,
    "SELECT * FROM home_slider
     WHERE status='1'
     ORDER BY id DESC"
);


/* =========================================================
   STATISTICS
========================================================= */

$product_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total FROM products"
    )
)['total'];

$brand_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(DISTINCT brand) AS total
         FROM products
         WHERE brand IS NOT NULL
         AND brand != ''"
    )
)['total'];

$category_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(DISTINCT category) AS total
         FROM products
         WHERE category IS NOT NULL
         AND category != ''"
    )
)['total'];


/* =========================================================
   DYNAMIC BRANDS
========================================================= */

$brands_query = mysqli_query(
    $conn,
    "SELECT
        brand,
        COUNT(*) AS total_products
     FROM products
     WHERE brand IS NOT NULL
     AND brand != ''
     GROUP BY brand
     ORDER BY total_products DESC
     LIMIT 12"
);


/* =========================================================
   DYNAMIC CATEGORIES
========================================================= */

$categories_query = mysqli_query(
    $conn,
    "SELECT
        category,
        COUNT(*) AS total_products
     FROM products
     WHERE category IS NOT NULL
     AND category != ''
     GROUP BY category
     ORDER BY total_products DESC
     LIMIT 8"
);


/* =========================================================
   TRENDING PRODUCTS
========================================================= */

$trending_query = mysqli_query(
    $conn,
    "SELECT *
     FROM products
     ORDER BY
        CASE
            WHEN rating IS NULL OR rating = '' THEN 0
            ELSE CAST(rating AS DECIMAL(3,1))
        END DESC,
        id DESC
     LIMIT 8"
);


/* =========================================================
   FEATURED COLLECTIONS
========================================================= */

$featured_query = mysqli_query(
    $conn,
    "SELECT *
     FROM featured_collections
     ORDER BY id DESC
     LIMIT 4"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>ELARA | Premium Sneaker Collection</title>


<!-- BOOTSTRAP -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">


<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<!-- GOOGLE FONT -->

<link
href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">


<style>

/* =========================================================
   ROOT
========================================================= */

:root{

    --bg:#050816;
    --bg2:#0b1120;

    --primary:#8b5cf6;
    --primary2:#7c3aed;

    --blue:#2563eb;
    --cyan:#67e8f9;

    --white:#ffffff;

    --text:#f8fafc;
    --soft:#dbe4f0;
    --muted:#94a3b8;

    --glass:rgba(255,255,255,.055);
    --border:rgba(255,255,255,.09);

}


/* =========================================================
   GLOBAL
========================================================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{

    font-family:'Sora',sans-serif;

    background:

        radial-gradient(
            circle at 10% 10%,
            rgba(139,92,246,.12),
            transparent 30%
        ),

        radial-gradient(
            circle at 90% 35%,
            rgba(37,99,235,.10),
            transparent 30%
        ),

        linear-gradient(
            180deg,
            #050816 0%,
            #080d1b 50%,
            #050816 100%
        );

    color:var(--text);

    overflow-x:hidden;

}

a{
    text-decoration:none;
}

img{
    max-width:100%;
    display:block;
}


/* =========================================================
   MAIN CONTAINER
========================================================= */

.home-container{

    width:100%;

    max-width:1500px;

    margin:auto;

    padding:30px 35px 100px;

}


/* =========================================================
   HERO
========================================================= */

.hero-slider{

    position:relative;

    overflow:hidden;

    border-radius:36px;

    margin-bottom:80px;

    border:1px solid rgba(255,255,255,.08);

    box-shadow:
        0 35px 100px rgba(0,0,0,.45);

}

.hero-img{

    width:100%;

    height:650px;

    object-fit:cover;

    filter:brightness(.38);

    transition:transform 1s ease;

}

.carousel-item.active .hero-img{

    transform:scale(1.02);

}


/* HERO DARK OVERLAY */

.hero-slider::after{

    content:'';

    position:absolute;

    inset:0;

    background:

        linear-gradient(
            90deg,
            rgba(3,7,18,.98) 0%,
            rgba(3,7,18,.85) 35%,
            rgba(3,7,18,.45) 70%,
            rgba(3,7,18,.15) 100%
        );

    pointer-events:none;

}


/* HERO CONTENT */

.hero-caption{

    position:absolute;

    top:50%;

    left:75px;

    transform:translateY(-50%);

    max-width:650px;

    z-index:10;

}


.hero-badge{

    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:10px 18px;

    border-radius:50px;

    background:
        rgba(139,92,246,.15);

    border:
        1px solid rgba(167,139,250,.35);

    color:#c4b5fd;

    font-size:12px;

    font-weight:700;

    letter-spacing:3px;

    margin-bottom:25px;

    backdrop-filter:blur(12px);

}


.hero-caption h1{

    font-size:70px;

    line-height:1.03;

    font-weight:800;

    letter-spacing:-3px;

    margin-bottom:22px;

    color:#ffffff;

    text-shadow:
        0 10px 40px rgba(0,0,0,.45);

}

.hero-caption h1 span{

    background:
        linear-gradient(
            90deg,
            #a78bfa,
            #60a5fa,
            #67e8f9
        );

    -webkit-background-clip:text;

    -webkit-text-fill-color:transparent;

}

.hero-caption p{

    font-size:17px;

    line-height:1.9;

    color:#dbe4f0;

    max-width:570px;

    margin-bottom:32px;

}


/* HERO BUTTON */

.hero-btn{

    display:inline-flex;

    align-items:center;

    gap:10px;

    padding:15px 27px;

    border-radius:15px;

    background:
        linear-gradient(
            135deg,
            #8b5cf6,
            #2563eb
        );

    color:white;

    font-size:14px;

    font-weight:700;

    transition:.35s;

    box-shadow:
        0 15px 35px rgba(124,58,237,.25);

}

.hero-btn:hover{

    color:white;

    transform:translateY(-4px);

    box-shadow:
        0 20px 45px rgba(124,58,237,.40);

}


/* =========================================================
   STATS
========================================================= */

.hero-stats{

    display:grid;

    grid-template-columns:
        repeat(3,1fr);

    gap:20px;

    max-width:1100px;

    margin:-35px auto 100px;

    position:relative;

    z-index:20;

}


.hero-stat{

    padding:28px;

    text-align:center;

    border-radius:24px;

    background:
        rgba(15,23,42,.85);

    border:
        1px solid rgba(255,255,255,.09);

    backdrop-filter:blur(20px);

    box-shadow:
        0 20px 50px rgba(0,0,0,.25);

    transition:.35s;

}

.hero-stat:hover{

    transform:translateY(-7px);

    border-color:
        rgba(139,92,246,.45);

}


.hero-stat i{

    font-size:25px;

    color:#a78bfa;

    margin-bottom:12px;

}


.hero-stat h3{

    font-size:34px;

    font-weight:800;

    margin-bottom:5px;

}


.hero-stat p{

    margin:0;

    color:var(--muted);

    font-size:13px;

}

/* ================= HERO ELARA LOGO ================= */


.hero-brand-logo{
    width:190px;
    height:auto;
    object-fit:contain;

    margin-bottom:25px;

    filter:
        drop-shadow(0 0 10px rgba(139,92,246,.40))
        drop-shadow(0 0 25px rgba(103,232,249,.18));

    transition:.4s ease;
}

.hero-brand-logo:hover{
    transform:scale(1.04);
}

.hero-brand-logo img {
    width: 100%;
    height: 100%;

    object-fit: contain;
    object-position: left center;

    filter:
        brightness(1.15)
        drop-shadow(0 0 10px rgba(139,92,246,.45))
        drop-shadow(0 0 25px rgba(103,232,249,.18));

    transition: all .4s ease;
}

.hero-brand-logo:hover img {
    transform: scale(1.04);

    filter:
        brightness(1.2)
        drop-shadow(0 0 15px rgba(139,92,246,.65))
        drop-shadow(0 0 30px rgba(103,232,249,.25));
}

@media(max-width:576px){

    .hero-brand-logo{
        width:140px;
        margin-bottom:18px;
    }

}


/* =========================================================
   SECTION
========================================================= */

.section{

    margin-bottom:110px;

}


.section-heading{

    display:flex;

    justify-content:space-between;

    align-items:end;

    margin-bottom:35px;

}


.section-heading-left{

    max-width:700px;

}


.section-mini{

    display:inline-block;

    color:#c4b5fd;

    font-size:11px;

    font-weight:700;

    letter-spacing:3px;

    text-transform:uppercase;

    margin-bottom:12px;

}


.section-heading h2{

    font-size:42px;

    font-weight:800;

    letter-spacing:-1px;

    color:#ffffff;

    margin:0;

}


.section-heading p{

    margin-top:10px;

    color:#aebbd0;

    line-height:1.8;

}


.view-all{

    color:#a78bfa;

    font-size:14px;

    font-weight:700;

    transition:.3s;

}

.view-all:hover{

    color:#67e8f9;

}


/* =========================================================
   ORBIT BRANDS
========================================================= */

.orbit-section{

    padding:30px 0 20px;

}


.orbit-wrapper{

    width:540px;

    height:540px;

    position:relative;

    margin:0 auto;

}


.orbit-glow{

    position:absolute;

    width:380px;

    height:380px;

    top:50%;

    left:50%;

    transform:translate(-50%,-50%);

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(139,92,246,.20),
            transparent 68%
        );

    filter:blur(20px);

}


.orbit-ring{

    position:absolute;

    inset:30px;

    border-radius:50%;

    border:
        1px solid rgba(139,92,246,.10);

    box-shadow:
        0 0 70px rgba(139,92,246,.08);

}


.orbit{

    position:absolute;

    inset:0;

    border-radius:50%;

    animation:
        rotateOrbit 32s linear infinite;

}


.orbit:hover{

    animation-play-state:paused;

}


/* =========================================================
   CENTER ELARA LOGO
========================================================= */

.center-circle{

    position:absolute;

    top:50%;

    left:50%;

    transform:translate(-50%,-50%);

    width:205px;

    height:205px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    z-index:100;

    background:

        radial-gradient(
            circle at center,
            rgba(139,92,246,.18),
            rgba(15,23,42,.98) 65%
        );

    border:
        1px solid rgba(167,139,250,.30);

    box-shadow:

        0 0 30px rgba(139,92,246,.25),

        0 0 100px rgba(37,99,235,.15),

        inset 0 0 35px rgba(255,255,255,.04);

}


.center-circle::before{

    content:'';

    position:absolute;

    inset:10px;

    border-radius:50%;

    border:
        1px solid rgba(255,255,255,.05);

}


.center-circle img{

    position:relative;

    z-index:2;

    width:155px;

    height:155px;

    object-fit:contain;

    filter:

        drop-shadow(
            0 0 12px rgba(139,92,246,.55)
        )

        drop-shadow(
            0 0 25px rgba(103,232,249,.20)
        );

}


/* =========================================================
   BRAND ORBIT ITEM
========================================================= */

.brand-item{

    position:absolute;

    top:50%;

    left:50%;

    width:90px;

    height:90px;

    margin:-45px;

    border-radius:50%;

    background:#f8fafc;

    border:
        3px solid rgba(255,255,255,.14);

    display:flex;

    align-items:center;

    justify-content:center;

    overflow:hidden;

    transform:

        rotate(var(--angle))

        translate(215px)

        rotate(calc(var(--angle) * -1));

    box-shadow:

        0 15px 35px rgba(0,0,0,.35),

        0 0 0 1px rgba(255,255,255,.04);

    transition:.4s;

}


.brand-item img{

    width:72%;

    height:72%;

    object-fit:contain;

}


.brand-item:hover{

    border-color:#a78bfa;

    box-shadow:

        0 0 35px rgba(139,92,246,.45);

    transform:

        rotate(var(--angle))

        translate(215px)

        rotate(calc(var(--angle) * -1))

        scale(1.15);

}


/* =========================================================
   BRAND CARDS
========================================================= */

.brand-grid{

    display:grid;

    grid-template-columns:
        repeat(auto-fit,minmax(210px,1fr));

    gap:20px;

}


.brand-card{

    position:relative;

    overflow:hidden;

    padding:28px;

    text-align:center;

    border-radius:25px;

    background:
        rgba(255,255,255,.045);

    border:
        1px solid rgba(255,255,255,.08);

    transition:.4s;

}


.brand-card::before{

    content:'';

    position:absolute;

    width:160px;

    height:160px;

    top:-80px;

    right:-80px;

    border-radius:50%;

    background:
        rgba(139,92,246,.12);

}


.brand-card:hover{

    transform:translateY(-8px);

    border-color:
        rgba(139,92,246,.45);

}


.brand-logo{

    width:105px;

    height:105px;

    margin:0 auto 18px;

    border-radius:50%;

    background:#f8fafc;

    display:flex;

    align-items:center;

    justify-content:center;

    position:relative;

    z-index:2;

}


.brand-logo img{

    width:70%;

    height:70%;

    object-fit:contain;

}


.brand-card h5{

    font-size:18px;

    font-weight:700;

    color:#ffffff;

    position:relative;

    z-index:2;

}


.brand-card p{

    color:#94a3b8;

    font-size:12px;

    margin:5px 0 0;

    position:relative;

    z-index:2;

}


/* =========================================================
   CATEGORY
========================================================= */

.category-grid{

    display:grid;

    grid-template-columns:
        repeat(auto-fit,minmax(200px,1fr));

    gap:20px;

}


.category-card{

    position:relative;

    padding:30px;

    min-height:150px;

    display:flex;

    flex-direction:column;

    justify-content:center;

    border-radius:25px;

    background:
        linear-gradient(
            135deg,
            rgba(139,92,246,.12),
            rgba(37,99,235,.06)
        );

    border:
        1px solid rgba(139,92,246,.15);

    overflow:hidden;

    transition:.4s;

}


.category-card:hover{

    transform:translateY(-8px);

    border-color:
        rgba(139,92,246,.50);

}


.category-card i{

    font-size:30px;

    color:#a78bfa;

    margin-bottom:15px;

}


.category-card h4{

    font-size:19px;

    font-weight:700;

    color:#fff;

}


.category-card span{

    font-size:12px;

    color:#94a3b8;

}


/* =========================================================
   PRODUCT GRID
========================================================= */

.product-grid{

    display:grid;

    grid-template-columns:
        repeat(4,1fr);

    gap:22px;

}


.product-card{

    overflow:hidden;

    border-radius:26px;

    background:
        rgba(255,255,255,.045);

    border:
        1px solid rgba(255,255,255,.08);

    transition:.4s;

}


.product-card:hover{

    transform:translateY(-10px);

    border-color:
        rgba(139,92,246,.40);

    box-shadow:
        0 25px 60px rgba(0,0,0,.30);

}


.product-image{

    height:250px;

    background:#f8fafc;

    position:relative;

    overflow:hidden;

}


.product-image img{

    width:100%;

    height:100%;

    object-fit:cover;

    transition:.5s;

}


.product-card:hover .product-image img{

    transform:scale(1.08);

}


.product-brand{

    position:absolute;

    top:14px;

    left:14px;

    padding:7px 11px;

    border-radius:30px;

    background:rgba(3,7,18,.80);

    backdrop-filter:blur(10px);

    color:#c4b5fd;

    font-size:10px;

    font-weight:700;

    letter-spacing:1px;

}


.product-info{

    padding:20px;

}


.product-info h4{

    font-size:17px;

    font-weight:700;

    color:#fff;

    margin-bottom:7px;

}


.product-category{

    color:#94a3b8;

    font-size:12px;

    margin-bottom:15px;

}


.product-bottom{

    display:flex;

    justify-content:space-between;

    align-items:center;

}


.product-price{

    color:#a78bfa;

    font-size:19px;

    font-weight:800;

}


.product-rating{

    font-size:12px;

    color:#facc15;

}


.product-btn{

    display:block;

    text-align:center;

    margin-top:16px;

    padding:11px;

    border-radius:12px;

    background:
        linear-gradient(
            135deg,
            #8b5cf6,
            #2563eb
        );

    color:#fff;

    font-size:12px;

    font-weight:700;

    transition:.3s;

}


.product-btn:hover{

    color:white;

    transform:translateY(-2px);

}


/* =========================================================
   FEATURED COLLECTION
========================================================= */

.featured-grid{

    display:grid;

    grid-template-columns:
        repeat(2,1fr);

    gap:22px;

}


.feature-card{

    height:390px;

    position:relative;

    overflow:hidden;

    border-radius:30px;

    border:
        1px solid rgba(255,255,255,.08);

}


.feature-card img{

    width:100%;

    height:100%;

    object-fit:cover;

    transition:.6s;

}


.feature-card:hover img{

    transform:scale(1.08);

}


.feature-overlay{

    position:absolute;

    inset:0;

    padding:35px;

    display:flex;

    flex-direction:column;

    justify-content:flex-end;

    background:
        linear-gradient(
            to top,
            rgba(3,7,18,.95),
            rgba(3,7,18,.10)
        );

}


.feature-overlay h3{

    font-size:30px;

    font-weight:800;

    color:#fff;

}


.feature-overlay p{

    color:#cbd5e1;

    font-size:13px;

    line-height:1.7;

    max-width:500px;

}


.feature-overlay a{

    width:max-content;

    padding:11px 20px;

    border-radius:12px;

    background:#8b5cf6;

    color:#fff;

    font-size:12px;

    font-weight:700;

}


/* =========================================================
   ANIMATION
========================================================= */

@keyframes rotateOrbit{

    from{
        transform:rotate(0deg);
    }

    to{
        transform:rotate(360deg);
    }

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1200px){

    .product-grid{
        grid-template-columns:
            repeat(3,1fr);
    }

}


@media(max-width:992px){

    .home-container{
        padding:20px 20px 70px;
    }

    .hero-img{
        height:540px;
    }

    .hero-caption{
        left:45px;
    }

    .hero-caption h1{
        font-size:55px;
    }

    .product-grid{
        grid-template-columns:
            repeat(2,1fr);
    }

    .orbit-wrapper{
        width:460px;
        height:460px;
    }

    .brand-item{
        transform:
            rotate(var(--angle))
            translate(180px)
            rotate(calc(var(--angle) * -1));
    }

    .brand-item:hover{
        transform:
            rotate(var(--angle))
            translate(180px)
            rotate(calc(var(--angle) * -1))
            scale(1.12);
    }

}


@media(max-width:768px){

    .hero-slider{
        border-radius:24px;
    }

    .hero-img{
        height:520px;
    }

    .hero-caption{
        left:25px;
        right:25px;
    }

    .hero-caption h1{
        font-size:42px;
        letter-spacing:-2px;
    }

    .hero-caption p{
        font-size:14px;
    }

    .hero-stats{
        grid-template-columns:
            1fr;

        margin-top:-20px;
    }

    .section-heading{
        display:block;
    }

    .section-heading h2{
        font-size:32px;
    }

    .view-all{
        display:inline-block;
        margin-top:15px;
    }

    .orbit-wrapper{
        width:340px;
        height:340px;
    }

    .center-circle{
        width:145px;
        height:145px;
    }

    .center-circle img{
        width:110px;
        height:110px;
    }

    .brand-item{
        width:65px;
        height:65px;
        margin:-32px;

        transform:
            rotate(var(--angle))
            translate(135px)
            rotate(calc(var(--angle) * -1));
    }

    .brand-item:hover{
        transform:
            rotate(var(--angle))
            translate(135px)
            rotate(calc(var(--angle) * -1))
            scale(1.1);
    }

    .product-grid{
        grid-template-columns:
            1fr;
    }

    .featured-grid{
        grid-template-columns:
            1fr;
    }

}


@media(max-width:480px){

    .home-container{
        padding:15px 12px 60px;
    }

    .hero-img{
        height:500px;
    }

    .hero-caption h1{
        font-size:34px;
    }

    .hero-badge{
        font-size:9px;
    }

    .hero-brand-logo {
    width: 145px;
    height: 75px;
    margin-bottom: 12px;
}

.elara-logo img {
    width: 120px;
    height: 52px;
}

    .orbit-wrapper{
        width:300px;
        height:300px;
    }

    .center-circle{
        width:125px;
        height:125px;
    }

    .center-circle img{
        width:95px;
        height:95px;
    }

    .brand-item{
        width:55px;
        height:55px;
        margin:-27px;

        transform:
            rotate(var(--angle))
            translate(120px)
            rotate(calc(var(--angle) * -1));
    }

}


/* =========================================================
   CAROUSEL CONTROLS
========================================================= */

.carousel-control-prev,
.carousel-control-next{

    width:55px;

    height:55px;

    top:50%;

    margin-top:-27px;

    border-radius:50%;

    background:
        rgba(255,255,255,.08);

    backdrop-filter:blur(10px);

    opacity:1;

    z-index:30;

}


.carousel-control-prev{
    left:20px;
}

.carousel-control-next{
    right:20px;
}


</style>

</head>


<body>


<?php include('includes/navbar.php'); ?>


<div class="home-container">


<!-- =====================================================
     HERO SLIDER
====================================================== -->

<section class="hero-slider">

    <div id="heroSlider"
         class="carousel slide"
         data-bs-ride="carousel"
         data-bs-interval="5000">

        <div class="carousel-inner">

            <?php

            $active = true;

            if(mysqli_num_rows($get_slider) > 0){

                while($slide = mysqli_fetch_assoc($get_slider)){

            ?>

            <div class="carousel-item
                <?php
                if($active){
                    echo 'active';
                    $active = false;
                }
                ?>">

                <img
                    src="uploads/<?php echo e($slide['image']); ?>"
                    class="hero-img"
                    alt="<?php echo e($slide['title']); ?>"
                >

                <div class="hero-caption">

    <!-- ELARA LOGO -->


    <div class="hero-badge">
        NEW ARRIVAL
    </div>

    <h1>
        <?php echo $slide['title']; ?>
    </h1>

    <p>
        <?php echo $slide['subtitle']; ?>
    </p>

    <div class="hero-btns">

        <a href="<?php echo $slide['button_link']; ?>"
           class="hero-btn">

            <?php echo $slide['button_text']; ?>

        </a>

    </div>

</div>

            </div>

            <?php

                }

            }else{

            ?>

            <div class="carousel-item active">

                <img
                    src="images/hero-default.jpg"
                    class="hero-img"
                    alt="ELARA">

                <div class="hero-caption">

                    <div class="hero-badge">
                        ELARA
                    </div>

                    <h1>
                        Step Into
                        <span>Something Better.</span>
                    </h1>

                    <p>
                        Discover premium sneakers from the world's
                        most iconic brands.
                    </p>

                    <a href="#products" class="hero-btn">
                        Explore Collection
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

            </div>

            <?php } ?>

        </div>


        <!-- CONTROLS -->

        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#heroSlider"
            data-bs-slide="prev">

            <i class="fa-solid fa-chevron-left"></i>

        </button>


        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#heroSlider"
            data-bs-slide="next">

            <i class="fa-solid fa-chevron-right"></i>

        </button>

    </div>

</section>



<!-- =====================================================
     STATS
====================================================== -->

<section class="hero-stats">

    <div class="hero-stat">

        <i class="fa-solid fa-shoe-prints"></i>

        <h3>
            <?php echo $product_count; ?>+
        </h3>

        <p>
            Premium Products
        </p>

    </div>


    <div class="hero-stat">

        <i class="fa-solid fa-tags"></i>

        <h3>
            <?php echo $brand_count; ?>+
        </h3>

        <p>
            Top Brands
        </p>

    </div>


    <div class="hero-stat">

        <i class="fa-solid fa-layer-group"></i>

        <h3>
            <?php echo $category_count; ?>+
        </h3>

        <p>
            Categories
        </p>

    </div>

</section>



<!-- =====================================================
     BRAND ORBIT
====================================================== -->

<section class="section orbit-section" id="brands">


    <div class="section-heading">

        <div class="section-heading-left">

            <span class="section-mini">
                EXPLORE THE WORLD
            </span>

            <h2>
                Iconic Brands
            </h2>

            <p>
                Discover sneakers from the world's most
                recognized footwear brands.
            </p>

        </div>

    </div>


    <div class="orbit-wrapper">

        <div class="orbit-glow"></div>

        <div class="orbit-ring"></div>


        <!-- CENTER ELARA -->

        <div class="center-circle">

            <img
                src="images/logo.png"
                alt="ELARA Logo">

        </div>


        <!-- DYNAMIC BRANDS -->

        <div class="orbit">

            <?php

            mysqli_data_seek($brands_query, 0);

            $brandIndex = 0;

            while($brand = mysqli_fetch_assoc($brands_query)){

                $angle =
                    ($brandIndex * 360) /
                    max($brand_count, 1);

            ?>

            <a
                href="brands/<?php echo slugify($brand['brand']); ?>.php"
                class="brand-item"
                style="--angle:<?php echo $angle; ?>deg;"
                title="<?php echo e($brand['brand']); ?>">

                <img
                    src="<?php echo e(brandImage($brand['brand'])); ?>"
                    alt="<?php echo e($brand['brand']); ?>">

            </a>

            <?php

                $brandIndex++;

                if($brandIndex >= 12){
                    break;
                }

            }

            ?>

        </div>

    </div>

</section>



<!-- =====================================================
     BRANDS
====================================================== -->

<section class="section">


    <div class="section-heading">

        <div class="section-heading-left">

            <span class="section-mini">
                OUR BRANDS
            </span>

            <h2>
                Shop By Brand
            </h2>

        </div>

        <a href="#" class="view-all">
            View All →
        </a>

    </div>


    <div class="brand-grid">

        <?php

        mysqli_data_seek($brands_query, 0);

        $brandCounter = 0;

        while($brand = mysqli_fetch_assoc($brands_query)){

        ?>

        <a
            href="brands/<?php echo slugify($brand['brand']); ?>.php"
            class="brand-card">

            <div class="brand-logo">

                <img
                    src="<?php echo e(brandImage($brand['brand'])); ?>"
                    alt="<?php echo e($brand['brand']); ?>">

            </div>

            <h5>
                <?php echo e($brand['brand']); ?>
            </h5>

            <p>
                <?php echo $brand['total_products']; ?>
                Products
            </p>

        </a>

        <?php

            $brandCounter++;

            if($brandCounter >= 12){
                break;
            }

        }

        ?>

    </div>

</section>



<!-- =====================================================
     CATEGORIES
====================================================== -->

<section class="section">


    <div class="section-heading">

        <div class="section-heading-left">

            <span class="section-mini">
                FIND YOUR STYLE
            </span>

            <h2>
                Shop By Category
            </h2>

        </div>

    </div>


    <div class="category-grid">

        <?php

        $categoryIcons = [
            'running' => 'fa-person-running',
            'sport' => 'fa-person-running',
            'sports' => 'fa-person-running',
            'casual' => 'fa-shoe-prints',
            'basketball' => 'fa-basketball',
            'football' => 'fa-futbol',
            'training' => 'fa-dumbbell',
            'lifestyle' => 'fa-star'
        ];

        while($category = mysqli_fetch_assoc($categories_query)){

            $catName = strtolower($category['category']);

            $icon = 'fa-shoe-prints';

            foreach($categoryIcons as $key => $value){

                if(strpos($catName, $key) !== false){

                    $icon = $value;
                    break;

                }

            }

        ?>

        <a
            href="category.php?category=<?php echo urlencode($category['category']); ?>"
            class="category-card">

            <i class="fa-solid <?php echo $icon; ?>"></i>

            <h4>
                <?php echo e($category['category']); ?>
            </h4>

            <span>
                <?php echo $category['total_products']; ?>
                Products
            </span>

        </a>

        <?php } ?>

    </div>

</section>





<!-- =====================================================
     FEATURED COLLECTIONS
====================================================== -->

<section class="section">


    <div class="section-heading">

        <div class="section-heading-left">

            <span class="section-mini">
                CURATED FOR YOU
            </span>

            <h2>
                Featured Collections
            </h2>

        </div>

    </div>


    <div class="featured-grid">

        <?php

        while($row = mysqli_fetch_assoc($featured_query)){

        ?>

        <div class="feature-card">

            <img
                src="uploads/<?php echo e($row['image']); ?>"
                alt="<?php echo e($row['title']); ?>">


            <div class="feature-overlay">

                <h3>
                    <?php echo e($row['title']); ?>
                </h3>

                <p>
                    <?php echo e($row['description']); ?>
                </p>

                <a href="<?php echo e($row['link']); ?>">

                    Explore Collection

                    <i class="fa-solid fa-arrow-right ms-1"></i>

                </a>

            </div>

        </div>

        <?php } ?>

    </div>

</section>


</div>


<?php include('profile.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>