<?php

include("includes/auth.php");

$user_id = (int)$_SESSION['user_id'];


/* =========================================================
   ORDERS
========================================================= */

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE user_id='$user_id'
     ORDER BY id DESC"
);

$total_orders = mysqli_num_rows($query);


/* =========================================================
   PROCESSING COUNT
========================================================= */

$processing_query = mysqli_query(
    $conn,
    "SELECT id
     FROM orders
     WHERE user_id='$user_id'
     AND order_status='Processing'"
);

$processing = mysqli_num_rows($processing_query);


/* =========================================================
   DELIVERED COUNT
========================================================= */

$delivered_query = mysqli_query(
    $conn,
    "SELECT id
     FROM orders
     WHERE user_id='$user_id'
     AND order_status='Delivered'"
);

$delivered = mysqli_num_rows($delivered_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>My Orders | ELARA</title>


<!-- BOOTSTRAP -->

<link
href="Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet">


<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<!-- GOOGLE FONT -->

<link
href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
rel="stylesheet">


<style>

/* =========================================================
   GLOBAL
========================================================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    background:
    radial-gradient(
        circle at 10% 0%,
        rgba(124,58,237,.14),
        transparent 30%
    ),
    radial-gradient(
        circle at 90% 20%,
        rgba(79,70,229,.08),
        transparent 25%
    ),
    #030712;

    color:#fff;

    font-family:'Inter',sans-serif;

    min-height:100vh;

    overflow-x:hidden;
}


/* =========================================================
   PAGE
========================================================= */

.orders-page{

    max-width:1200px;

    margin:auto;

    padding:35px 20px 70px;
}


/* =========================================================
   HEADER
========================================================= */

.page-top{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:20px;

    margin-bottom:28px;
}

.page-title{

    font-size:34px;

    font-weight:900;

    letter-spacing:-1px;

    margin:0;
}

.page-title span{

    color:#8b5cf6;
}

.page-subtitle{

    color:#64748b;

    font-size:13px;

    margin-top:7px;

    margin-bottom:0;
}

.order-pill{

    display:flex;

    align-items:center;

    gap:7px;

    padding:9px 15px;

    border-radius:50px;

    background:rgba(139,92,246,.10);

    border:1px solid rgba(139,92,246,.25);

    color:#c4b5fd;

    font-size:12px;

    font-weight:700;

    white-space:nowrap;
}


/* =========================================================
   SUMMARY
========================================================= */

.summary-grid{

    display:grid;

    grid-template-columns:
    repeat(3,1fr);

    gap:15px;

    margin-bottom:32px;
}

.summary-card{

    display:flex;

    align-items:center;

    gap:14px;

    padding:17px;

    border-radius:19px;

    background:rgba(255,255,255,.035);

    border:1px solid rgba(255,255,255,.06);

    transition:.3s;
}

.summary-card:hover{

    transform:translateY(-4px);

    border-color:rgba(139,92,246,.35);

    background:rgba(139,92,246,.06);
}

.summary-icon{

    width:44px;

    height:44px;

    flex-shrink:0;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:13px;

    background:
    linear-gradient(
        135deg,
        #8b5cf6,
        #4f46e5
    );

    font-size:16px;
}

.summary-card h3{

    font-size:25px;

    font-weight:900;

    margin:0 0 2px;
}

.summary-card p{

    color:#64748b;

    font-size:11px;

    margin:0;
}


/* =========================================================
   ORDERS HEADER
========================================================= */

.orders-heading{

    display:flex;

    align-items:center;

    justify-content:space-between;

    margin-bottom:15px;
}

.orders-heading h2{

    font-size:20px;

    font-weight:800;

    margin:0;
}

.orders-heading span{

    color:#475569;

    font-size:11px;
}


/* =========================================================
   ORDER CARD
========================================================= */

.order-card{

    background:
    rgba(15,23,42,.72);

    border:1px solid rgba(255,255,255,.065);

    border-radius:21px;

    padding:17px;

    margin-bottom:14px;

    transition:.3s;

    backdrop-filter:blur(12px);
}

.order-card:hover{

    transform:translateY(-4px);

    border-color:rgba(139,92,246,.32);

    box-shadow:
    0 18px 40px rgba(0,0,0,.25);
}


/* =========================================================
   ORDER TOP
========================================================= */

.order-top{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding-bottom:13px;

    border-bottom:
    1px solid rgba(255,255,255,.05);

    gap:15px;
}

.order-number{

    font-size:13px;

    font-weight:800;

    color:#f8fafc;
}

.order-date{

    color:#64748b;

    font-size:10px;

    margin-top:4px;
}


/* =========================================================
   STATUS
========================================================= */

.status{

    display:inline-flex;

    align-items:center;

    gap:6px;

    padding:6px 11px;

    border-radius:50px;

    font-size:10px;

    font-weight:800;

    text-transform:uppercase;

    white-space:nowrap;
}

.status i{

    font-size:8px;
}

.pending{

    color:#fbbf24;

    background:rgba(245,158,11,.11);
}

.processing{

    color:#60a5fa;

    background:rgba(59,130,246,.11);
}

.shipped{

    color:#a78bfa;

    background:rgba(139,92,246,.11);
}

.delivered{

    color:#4ade80;

    background:rgba(34,197,94,.11);
}

.cancelled{

    color:#f87171;

    background:rgba(239,68,68,.11);
}


/* =========================================================
   ORDER CONTENT
========================================================= */

.order-content{

    display:grid;

    grid-template-columns:
    1fr auto;

    gap:20px;

    padding-top:15px;

    align-items:center;
}


/* =========================================================
   PRODUCTS
========================================================= */

.products-list{

    display:flex;

    flex-wrap:wrap;

    gap:10px;
}

.product-item{

    display:flex;

    align-items:center;

    gap:9px;

    min-width:180px;

    max-width:280px;

    padding:7px;

    border-radius:13px;

    background:rgba(255,255,255,.025);
}


/* =========================================================
   PRODUCT IMAGE
========================================================= */

.product-image{

    width:48px;

    height:48px;

    flex-shrink:0;

    border-radius:11px;

    background:#fff;

    overflow:hidden;

    display:flex;

    align-items:center;

    justify-content:center;

    border:1px solid rgba(255,255,255,.08);
}

.product-image img{

    width:100%;

    height:100%;

    object-fit:contain;

    padding:3px;

    display:block;
}

.product-placeholder{

    color:#8b5cf6;

    font-size:17px;
}


/* =========================================================
   PRODUCT INFO
========================================================= */

.product-info{

    min-width:0;
}

.product-name{

    font-size:11px;

    font-weight:700;

    color:#e2e8f0;

    white-space:nowrap;

    overflow:hidden;

    text-overflow:ellipsis;

    max-width:190px;
}

.product-qty{

    color:#64748b;

    font-size:9px;

    margin-top:3px;
}


/* =========================================================
   ORDER RIGHT
========================================================= */

.order-right{

    min-width:130px;

    text-align:right;
}

.order-total-label{

    color:#64748b;

    font-size:9px;

    margin-bottom:2px;
}

.order-total{

    color:#a78bfa;

    font-size:20px;

    font-weight:900;

    margin-bottom:8px;
}

.view-order{

    display:inline-flex;

    align-items:center;

    gap:6px;

    padding:8px 12px;

    border-radius:10px;

    background:
    linear-gradient(
        135deg,
        #8b5cf6,
        #4f46e5
    );

    color:#fff;

    text-decoration:none;

    font-size:10px;

    font-weight:700;

    transition:.3s;
}

.view-order:hover{

    color:#fff;

    transform:translateY(-2px);

    box-shadow:
    0 8px 20px
    rgba(124,58,237,.3);
}


/* =========================================================
   CUSTOMER INFO
========================================================= */

.customer-info{

    display:flex;

    align-items:center;

    gap:7px;

    margin-top:13px;

    padding-top:12px;

    border-top:
    1px solid rgba(255,255,255,.045);

    color:#475569;

    font-size:9px;
}

.customer-info i{

    color:#8b5cf6;

    font-size:10px;
}

.customer-name{

    color:#64748b;

    white-space:nowrap;

    overflow:hidden;

    text-overflow:ellipsis;

    max-width:350px;
}

.item-count{

    margin-left:auto;

    white-space:nowrap;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-orders{

    text-align:center;

    padding:60px 20px;

    background:
    rgba(255,255,255,.035);

    border:
    1px solid rgba(255,255,255,.06);

    border-radius:23px;
}

.empty-icon{

    width:65px;

    height:65px;

    margin:0 auto 18px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:19px;

    background:rgba(139,92,246,.10);

    color:#a78bfa;

    font-size:23px;
}

.empty-orders h3{

    font-size:20px;

    font-weight:800;

    margin-bottom:7px;
}

.empty-orders p{

    color:#64748b;

    font-size:12px;

    margin-bottom:20px;
}

.shop-btn{

    display:inline-flex;

    align-items:center;

    padding:10px 17px;

    border-radius:11px;

    background:
    linear-gradient(
        135deg,
        #8b5cf6,
        #4f46e5
    );

    color:#fff;

    text-decoration:none;

    font-size:11px;

    font-weight:700;
}

.shop-btn:hover{

    color:#fff;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:900px){

    .order-content{

        grid-template-columns:1fr;
    }

    .order-right{

        display:flex;

        align-items:center;

        justify-content:space-between;

        text-align:left;

        width:100%;
    }

    .order-total{

        margin-bottom:0;
    }

    .product-item{

        min-width:170px;
    }
}


@media(max-width:700px){

    .orders-page{

        padding:
        28px 14px 60px;
    }

    .page-top{

        align-items:flex-start;

        flex-direction:column;
    }

    .summary-grid{

        grid-template-columns:1fr;
    }

    .summary-card{

        padding:15px;
    }

    .products-list{

        flex-direction:column;
    }

    .product-item{

        max-width:none;

        width:100%;
    }
}


@media(max-width:480px){

    .page-title{

        font-size:28px;
    }

    .order-card{

        padding:13px;

        border-radius:18px;
    }

    .order-top{

        align-items:flex-start;

        flex-direction:column;
    }

    .status{

        align-self:flex-start;
    }

    .product-image{

        width:45px;

        height:45px;
    }

    .product-name{

        max-width:220px;
    }

    .customer-info{

        align-items:flex-start;
    }

    .item-count{

        margin-left:auto;
    }
}

</style>

</head>


<body>


<?php include('includes/navbar.php'); ?>


<div class="orders-page">


    <!-- =====================================================
         PAGE HEADER
    ====================================================== -->

    <div class="page-top">

        <div>

            <h1 class="page-title">

                My <span>Orders</span>

            </h1>

            <p class="page-subtitle">

                Track and manage your ELARA purchases.

            </p>

        </div>


        <div class="order-pill">

            <i class="fa-solid fa-box"></i>

            <?php echo $total_orders; ?>

            Orders

        </div>

    </div>


    <!-- =====================================================
         SUMMARY
    ====================================================== -->

    <div class="summary-grid">


        <div class="summary-card">

            <div class="summary-icon">

                <i class="fa-solid fa-bag-shopping"></i>

            </div>

            <div>

                <h3>
                    <?php echo $total_orders; ?>
                </h3>

                <p>
                    Total Orders
                </p>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">

                <i class="fa-solid fa-truck-fast"></i>

            </div>

            <div>

                <h3>
                    <?php echo $processing; ?>
                </h3>

                <p>
                    Processing
                </p>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div>

                <h3>
                    <?php echo $delivered; ?>
                </h3>

                <p>
                    Delivered
                </p>

            </div>

        </div>


    </div>


    <!-- =====================================================
         ORDER HEADING
    ====================================================== -->

    <div class="orders-heading">

        <h2>
            Recent Orders
        </h2>

        <span>
            Latest first
        </span>

    </div>


    <?php if($total_orders == 0){ ?>


        <!-- =================================================
             EMPTY ORDERS
        ================================================== -->

        <div class="empty-orders">

            <div class="empty-icon">

                <i class="fa-solid fa-bag-shopping"></i>

            </div>

            <h3>
                No Orders Yet
            </h3>

            <p>
                Your purchased products will appear here.
            </p>

            <a
            href="home.php"
            class="shop-btn">

                Start Shopping

                <i class="fa-solid fa-arrow-right ms-2"></i>

            </a>

        </div>


    <?php }else{ ?>


        <?php while($order = mysqli_fetch_assoc($query)){ ?>


            <?php

            /* =================================================
               STATUS
            ================================================= */

            $status = strtolower(
                trim(
                    $order['order_status']
                )
            );


            /* =================================================
               ITEM COUNT
            ================================================= */

            $count_q = mysqli_query(
                $conn,

                "SELECT SUM(quantity) AS total
                 FROM order_items
                 WHERE order_id='".$order['id']."'"
            );

            $count_data = mysqli_fetch_assoc($count_q);

            $item_count = (int)(
                $count_data['total'] ?? 0
            );

            

            /* =================================================
               PRODUCTS + PRODUCT IMAGE
            ================================================= */

            $item_q = mysqli_query(
                $conn,

                "SELECT
                    oi.product_id,
                    oi.product_name,
                    oi.quantity,
                    p.image AS product_image

                 FROM order_items oi

                 LEFT JOIN products p
                 ON oi.product_id = p.id

                 WHERE oi.order_id='".$order['id']."'

                 LIMIT 3"
            );

            ?>


            <!-- =================================================
                 ORDER CARD
            ================================================= -->

            <div class="order-card">


                <!-- TOP -->

                <div class="order-top">


                    <div>

                        <div class="order-number">

                            #ELARA-<?php
                            echo (int)$order['id'];
                            ?>

                        </div>


                        <div class="order-date">

                            <i class="fa-regular fa-calendar me-1"></i>

                            <?php

                            echo date(
                                "d M Y",
                                strtotime(
                                    $order['order_date']
                                )
                            );

                            ?>

                        </div>

                    </div>


                    <!-- STATUS -->

                    <span
                    class="status <?php echo htmlspecialchars($status); ?>">


                        <?php

                        if($status == 'delivered'){

                            echo '<i class="fa-solid fa-check"></i>';

                        }

                        elseif($status == 'processing'){

                            echo '<i class="fa-solid fa-spinner"></i>';

                        }

                        elseif($status == 'shipped'){

                            echo '<i class="fa-solid fa-truck"></i>';

                        }

                        elseif($status == 'cancelled'){

                            echo '<i class="fa-solid fa-xmark"></i>';

                        }

                        else{

                            echo '<i class="fa-solid fa-clock"></i>';

                        }

                        ?>


                        <?php

                        echo htmlspecialchars(
                            $order['order_status']
                        );

                        ?>

                    </span>


                </div>


                <!-- CONTENT -->

                <div class="order-content">


                    <!-- PRODUCTS -->

                    <div class="products-list">


                        <?php

                        if(
                            mysqli_num_rows($item_q) > 0
                        ){

                            while(
                                $item =
                                mysqli_fetch_assoc($item_q)
                            ){

                                /*
                                 * IMPORTANT:
                                 * products.image value
                                 * should be something like:
                                 *
                                 * nike-air-max.jpg
                                 *
                                 * and actual file:
                                 *
                                 * uploads/nike-air-max.jpg
                                 */

                                $image = trim(
                                    $item['product_image'] ?? ''
                                );

                        ?>


                            <div class="product-item">


                                <!-- PRODUCT IMAGE -->

                                <div class="product-image">


                                    <?php

                                    if($image != ''){

                                        /*
                                         * Remove possible
                                         * uploads/ from database
                                         */

                                        $image = basename($image);

                                    ?>

                                        <img
                                        src="uploads/<?php
                                        echo htmlspecialchars($image);
                                        ?>"
                                        alt="<?php
                                        echo htmlspecialchars(
                                            $item['product_name']
                                        );
                                        ?>"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">


                                        <i
                                        class="fa-solid fa-shoe-prints product-placeholder"
                                        style="display:none;">
                                        </i>


                                    <?php

                                    }else{

                                    ?>


                                        <i
                                        class="fa-solid fa-shoe-prints product-placeholder">
                                        </i>


                                    <?php } ?>


                                </div>


                                <!-- PRODUCT INFO -->

                                <div class="product-info">


                                    <div class="product-name">

                                        <?php

                                        echo htmlspecialchars(
                                            $item['product_name']
                                        );

                                        ?>

                                    </div>


                                    <div class="product-qty">

                                        Qty:
                                        <?php

                                        echo (int)
                                        $item['quantity'];

                                        ?>

                                    </div>


                                </div>


                            </div>


                        <?php

                            }

                        }else{

                        ?>


                            <div class="product-item">

                                <div class="product-image">

                                    <i class="fa-solid fa-box product-placeholder"></i>

                                </div>

                                <div class="product-info">

                                    <div class="product-name">

                                        Order Items

                                    </div>

                                </div>

                            </div>


                        <?php } ?>


                    </div>


                    <!-- RIGHT -->

                    <div class="order-right">


                        <div>

                            <div class="order-total-label">

                                Total

                            </div>


                            <div class="order-total">

                                ₹<?php

                                echo number_format(
                                    (float)$order['total_price'],
                                    2
                                );

                                ?>

                            </div>

                        </div>


                        <a
                        href="order_details.php?id=<?php
                        echo (int)$order['id'];
                        ?>"
                        class="view-order">

                            View

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>


                    </div>


                </div>


                <!-- CUSTOMER -->

                <div class="customer-info">


                    <i class="fa-solid fa-location-dot"></i>


                    <span class="customer-name">

                        <?php

                        echo htmlspecialchars(
                            $order['name']
                        );

                        ?>

                        &nbsp; • &nbsp;

                        <?php

                        echo htmlspecialchars(
                            $order['address']
                        );

                        ?>

                    </span>


                    <span class="item-count">

                        <i class="fa-solid fa-box"></i>

                        <?php echo $item_count; ?>

                        items

                    </span>


                </div>


            </div>


        <?php } ?>


    <?php } ?>


</div>


<?php include('profile.php'); ?>


<script
src="Assets/bootstrap/js/bootstrap.bundle.min.js">
</script>


</body>

</html>