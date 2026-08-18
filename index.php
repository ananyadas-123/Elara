<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ELARA • Luxury Sneakers</title>

<link href="Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<nav class="navbar navbar-expand-lg custom-navbar">

    <div class="container">

        <a href="#home" class="navbar-brand">
    <img src="images/logo.png" class="logo-img" alt="ELARA Luxury Sneakers">
</a>


        <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navMenu">

            <i class="fa-solid fa-bars"></i>

        </button>


        <div class="collapse navbar-collapse" id="navMenu">


            <ul class="navbar-nav mx-auto">

                <li class="nav-item">

                    <a class="nav-link active" href="#home">
                        Home
                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link" href="#brandCircle">
                        Brands
                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link" href="#collection">
                        Trending
                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link" href="#features">
                        Features
                    </a>

                </li>

            </ul>


            <div class="nav-buttons">

                <a href="login.php" class="btn-login">

                    Login

                </a>


                <a href="register.php" class="btn-start">

                    Get Started

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>


        </div>

    </div>

</nav>



<!-- =====================================================
     HERO SECTION
===================================================== -->

<section class="hero" id="home">


    <!-- BACKGROUND VIDEO -->

    <video
    class="hero-video"
    autoplay
    muted
    loop
    playsinline
    preload="auto">

        <source src="videos/hero-bg.mp4" type="video/mp4">

    </video>


    <!-- DARK OVERLAY -->

    <div class="hero-overlay"></div>


    <!-- GLOW -->

    <div class="hero-glow"></div>


    <div class="container hero-content">


        <div class="row align-items-center">


            <!-- LEFT -->

            <div class="col-lg-7">


                <div class="hero-sub">

                    <span></span>

                    PREMIUM SNEAKER COLLECTION

                </div>


                <h1 class="hero-title">

                    Elevate Your

                    <br>

                    <span>Streetwear Style.</span>

                </h1>


                <p class="hero-text">

                    Discover iconic sneakers designed for
                    modern fashion lovers. Experience premium
                    aesthetics, everyday comfort and bold
                    street culture — all in one destination.

                </p>


                <!-- CTA -->

                <div class="hero-buttons">


                    <a href="register.php"
                    class="hero-primary">

                        Explore Collection

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>


                    <a href="#brandCircle"
                    class="hero-secondary">

                        Explore Brands

                    </a>


                </div>


                <!-- STATS -->

                <div class="hero-stats">


                    <div class="hero-stat">

                        <strong>5+</strong>

                        <span>Premium Brands</span>

                    </div>


                    <div class="hero-stat-line"></div>


                    <div class="hero-stat">

                        <strong>100%</strong>

                        <span>Authentic Products</span>

                    </div>


                    <div class="hero-stat-line"></div>


                    <div class="hero-stat">

                        <strong>24/7</strong>

                        <span>Customer Support</span>

                    </div>


                </div>


            </div>


            <!-- RIGHT SIDE -->

            <div class="col-lg-5">


                <div class="hero-floating-card">


                    <div class="floating-icon">

                        <i class="fa-solid fa-shoe-prints"></i>

                    </div>


                    <div>

                        <span>ELARA SELECT</span>

                        <strong>Premium Footwear</strong>

                    </div>


                    <i class="fa-solid fa-arrow-up-right-from-square floating-arrow"></i>


                </div>


            </div>


        </div>

    </div>


    <!-- SCROLL -->

    <div class="scroll-indicator">

        <span>SCROLL TO EXPLORE</span>

        <i class="fa-solid fa-chevron-down"></i>

    </div>


</section>



<!-- =====================================================
     BRANDS
===================================================== -->

<section class="orbit-section" id="brandCircle">


    <div class="container text-center">


        <div class="section-label">

            TOP BRANDS

        </div>


        <h2 class="orbit-title">

            Explore Premium

            <span>Sneaker Brands</span>

        </h2>


        <p class="section-intro">

            Discover collections from the world's most
            iconic sneaker brands.

        </p>


        <div class="orbit-wrapper">


            <div class="orbit-glow"></div>


            <!-- CENTER -->

            <div class="center-circle">
                <img src="images/logo.png" alt="Center Logo">
            </div>


            <!-- ORBIT -->

            <div class="orbit">


                <!-- NIKE -->

                <a href="brands/nike.php"
                class="brand-item"
                style="--x:0deg;">

                    <div class="brand-logo">

                        <img
                        src="images/brands/brand1.jpg"
                        alt="Nike">

                    </div>


                    <div class="brand-preview">

                        <div class="preview-image">

                            <img
                            src="images/brands/nike-preview.jpg"
                            alt="Nike">

                        </div>


                        <div class="preview-content">

                            <span>01</span>

                            <h3>Nike</h3>

                            <p>
                                Luxury streetwear sneakers
                            </p>

                            <strong>
                                Explore Collection
                                <i class="fa-solid fa-arrow-right"></i>
                            </strong>

                        </div>

                    </div>

                </a>



                <!-- ADIDAS -->

                <a href="brands/adidas.php"
                class="brand-item"
                style="--x:72deg;">

                    <div class="brand-logo">

                        <img
                        src="images/brands/adidas - Copy.png"
                        alt="Adidas">

                    </div>


                    <div class="brand-preview">

                        <div class="preview-image">

                            <img
                            src="images/brands/adidas-preview.jpg"
                            alt="Adidas">

                        </div>


                        <div class="preview-content">

                            <span>02</span>

                            <h3>Adidas</h3>

                            <p>
                                Modern performance collection
                            </p>

                            <strong>
                                Explore Collection
                                <i class="fa-solid fa-arrow-right"></i>
                            </strong>

                        </div>

                    </div>

                </a>



                <!-- PUMA -->

                <a href="brands/puma.php"
                class="brand-item"
                style="--x:144deg;">

                    <div class="brand-logo">

                        <img
                        src="images/brands/brand2.jpg"
                        alt="Puma">

                    </div>


                    <div class="brand-preview">

                        <div class="preview-image">

                            <img
                            src="images/brands/puma-preview.jpg"
                            alt="Puma">

                        </div>


                        <div class="preview-content">

                            <span>03</span>

                            <h3>Puma</h3>

                            <p>
                                Sport meets modern fashion
                            </p>

                            <strong>
                                Explore Collection
                                <i class="fa-solid fa-arrow-right"></i>
                            </strong>

                        </div>

                    </div>

                </a>



                <!-- REEBOK -->

                <a href="brands/reebok.php"
                class="brand-item"
                style="--x:216deg;">

                    <div class="brand-logo">

                        <img
                        src="images/brands/reebok1 - Copy.png"
                        alt="Reebok">

                    </div>


                    <div class="brand-preview">

                        <div class="preview-image">

                            <img
                            src="images/brands/reebok-preview.jpg"
                            alt="Reebok">

                        </div>


                        <div class="preview-content">

                            <span>04</span>

                            <h3>Reebok</h3>

                            <p>
                                Classic retro vibes
                            </p>

                            <strong>
                                Explore Collection
                                <i class="fa-solid fa-arrow-right"></i>
                            </strong>

                        </div>

                    </div>

                </a>



                <!-- GUCCI -->

                <a href="brands/gucci.php"
                class="brand-item"
                style="--x:288deg;">

                    <div class="brand-logo">

                        <img
                        src="images/brands/gucci.png"
                        alt="Gucci">

                    </div>


                    <div class="brand-preview">

                        <div class="preview-image">

                            <img
                            src="images/brands/gucci-preview.jpg"
                            alt="Gucci">

                        </div>


                        <div class="preview-content">

                            <span>05</span>

                            <h3>Gucci</h3>

                            <p>
                                Luxury fashion sneakers
                            </p>

                            <strong>
                                Explore Collection
                                <i class="fa-solid fa-arrow-right"></i>
                            </strong>

                        </div>

                    </div>

                </a>


            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     TRENDING COLLECTION
===================================================== -->

<section class="products-section" id="collection">


    <div class="container">


        <div class="section-header text-center">


            <div class="section-label">

                TRENDING COLLECTION

            </div>


            <h2 class="section-title">

                Sneakers That

                <span>Define You.</span>

            </h2>


            <p class="section-text">

                Explore premium sneakers from our featured
                collections and discover your next statement pair.

            </p>

        </div>



        <div class="row g-4 justify-content-center mt-4">


            <!-- PRODUCT 1 -->

            <div class="col-lg-4 col-md-6">


                <div class="preview-product-card">


                    <div class="preview-image">


                        <img
                        src="images/brands/nike-preview.jpg"
                        alt="Nike Air Max">


                        <div class="product-number">

                            01

                        </div>


                        <div class="preview-overlay">

                            <a href="register.php">

                                <i class="fa-solid fa-arrow-up-right-from-square"></i>

                            </a>

                        </div>


                    </div>


                    <div class="preview-content">


                        <span class="preview-brand">

                            NIKE

                        </span>


                        <h4>

                            Nike Air Max

                        </h4>


                        <p>

                            Premium running sneaker crafted
                            for comfort, streetwear and performance.

                        </p>


                        <div class="preview-footer">


                            <div class="product-rating">

                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>

                            </div>


                            <a
                            href="register.php"
                            class="preview-btn">

                                View Collection

                            </a>

                        </div>

                    </div>

                </div>

            </div>



            <!-- PRODUCT 2 -->

            <div class="col-lg-4 col-md-6">


                <div class="preview-product-card">


                    <div class="preview-image">


                        <img
                        src="images/brands/adidas-preview.jpg"
                        alt="Adidas Ultra Boost">


                        <div class="product-number">

                            02

                        </div>


                        <div class="preview-overlay">

                            <a href="register.php">

                                <i class="fa-solid fa-arrow-up-right-from-square"></i>

                            </a>

                        </div>


                    </div>


                    <div class="preview-content">


                        <span class="preview-brand">

                            ADIDAS

                        </span>


                        <h4>

                            Adidas Ultra Boost

                        </h4>


                        <p>

                            Stylish premium sneakers designed
                            for modern luxury and everyday comfort.

                        </p>


                        <div class="preview-footer">


                            <div class="product-rating">

                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>

                            </div>


                            <a
                            href="register.php"
                            class="preview-btn">

                                View Collection

                            </a>

                        </div>

                    </div>

                </div>

            </div>



            <!-- PRODUCT 3 -->

            <div class="col-lg-4 col-md-6">


                <div class="preview-product-card">


                    <div class="preview-image">


                        <img
                        src="images/brands/puma-preview.jpg"
                        alt="Puma RS-X">


                        <div class="product-number">

                            03

                        </div>


                        <div class="preview-overlay">

                            <a href="register.php">

                                <i class="fa-solid fa-arrow-up-right-from-square"></i>

                            </a>

                        </div>


                    </div>


                    <div class="preview-content">


                        <span class="preview-brand">

                            PUMA

                        </span>


                        <h4>

                            Puma RS-X

                        </h4>


                        <p>

                            Futuristic casual sneakers with
                            bold design and modern streetwear energy.

                        </p>


                        <div class="preview-footer">


                            <div class="product-rating">

                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>

                            </div>


                            <a
                            href="register.php"
                            class="preview-btn">

                                View Collection

                            </a>

                        </div>

                    </div>

                </div>

            </div>


        </div>



        <!-- CTA -->

        <div class="main-cta text-center">


            <a
            href="register.php"
            class="hero-signup-btn">

                Create Free Account

                <i class="fa-solid fa-arrow-right"></i>

            </a>


        </div>


    </div>

</section>



<!-- =====================================================
     FEATURES
===================================================== -->

<section class="features-section" id="features">


    <div class="container">


        <div class="section-header text-center mb-5">


            <div class="section-label">

                WHY ELARA

            </div>


            <h2 class="section-title">

                Built Around

                <span>Your Experience.</span>

            </h2>

        </div>



        <div class="row g-4">


            <div class="col-lg-4 col-md-6">


                <div class="feature-card">


                    <div class="feature-icon">

                        <i class="fa-solid fa-truck-fast"></i>

                    </div>


                    <span class="feature-number">

                        01

                    </span>


                    <h3>

                        Fast Delivery

                    </h3>


                    <p>

                        Get your favourite sneakers delivered
                        quickly and safely across India.

                    </p>

                </div>

            </div>



            <div class="col-lg-4 col-md-6">


                <div class="feature-card">


                    <div class="feature-icon">

                        <i class="fa-solid fa-shield-halved"></i>

                    </div>


                    <span class="feature-number">

                        02

                    </span>


                    <h3>

                        100% Original

                    </h3>


                    <p>

                        Discover authentic premium sneakers
                        from globally recognised brands.

                    </p>

                </div>

            </div>



            <div class="col-lg-4 col-md-6">


                <div class="feature-card">


                    <div class="feature-icon">

                        <i class="fa-solid fa-headset"></i>

                    </div>


                    <span class="feature-number">

                        03

                    </span>


                    <h3>

                        24/7 Support

                    </h3>


                    <p>

                        Our support experience is designed
                        around you, whenever you need us.

                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer-section">


    <div class="container">


        <div class="row gy-5">


            <!-- BRAND -->

            <div class="col-lg-5">


                <div class="footer-brand">


                    <a href="index.php"
                    class="footer-logo-text">

                        ELARA<span>.</span>

                    </a>


                    <p class="footer-desc">

                        ELARA delivers premium luxury sneakers
                        and authentic streetwear collections
                        crafted for modern fashion enthusiasts.

                    </p>


                    <div class="footer-social">


                        <a href="#">

                            <i class="fab fa-facebook-f"></i>

                        </a>


                        <a href="#">

                            <i class="fab fa-instagram"></i>

                        </a>


                        <a href="#">

                            <i class="fab fa-twitter"></i>

                        </a>


                        <a href="#">

                            <i class="fab fa-linkedin-in"></i>

                        </a>


                    </div>

                </div>

            </div>



            <!-- COMPANY -->

            <div class="col-lg-2 col-md-4">


                <h4 class="footer-heading">

                    Company

                </h4>


                <ul class="footer-links">

                    <li>
                        <a href="#home">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="#brandCircle">
                            Brands
                        </a>
                    </li>

                    <li>
                        <a href="#collection">
                            Trending
                        </a>
                    </li>

                    <li>
                        <a href="#features">
                            Features
                        </a>
                    </li>

                </ul>

            </div>



            <!-- BRANDS -->

            <div class="col-lg-2 col-md-4">


                <h4 class="footer-heading">

                    Brands

                </h4>


                <ul class="footer-links">

                    <li>
                        <a href="brands/nike.php">
                            Nike
                        </a>
                    </li>

                    <li>
                        <a href="brands/adidas.php">
                            Adidas
                        </a>
                    </li>

                    <li>
                        <a href="brands/puma.php">
                            Puma
                        </a>
                    </li>

                    <li>
                        <a href="brands/reebok.php">
                            Reebok
                        </a>
                    </li>

                    <li>
                        <a href="brands/gucci.php">
                            Gucci
                        </a>
                    </li>

                </ul>

            </div>



            <!-- CONTACT -->

            <div class="col-lg-3 col-md-4">


                <h4 class="footer-heading">

                    Contact

                </h4>


                <div class="footer-contact">


                    <p>

                        <i class="fa-solid fa-location-dot"></i>

                        Kolkata, West Bengal, India

                    </p>


                    <p>

                        <i class="fa-solid fa-envelope"></i>

                        support@elara.com

                    </p>


                    <p>

                        <i class="fa-solid fa-phone"></i>

                        +91 98765 43210

                    </p>


                </div>

            </div>


        </div>



        <div class="footer-bottom">


            <p>

                © 2026 ELARA Luxury Sneakers.
                All Rights Reserved.

            </p>


            <span>

                Crafted for sneaker culture.

            </span>

        </div>


    </div>

</footer>



<script src="Assets/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>