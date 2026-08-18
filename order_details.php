<?php

include("includes/auth.php");

$user_id = (int)$_SESSION['user_id'];

$order_id = isset($_GET['id'])
    ? (int)$_GET['id']
    : 0;


/* =========================
   CANCEL ORDER
========================= */

if(
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['cancel_order'])
){

    $cancel_order_id = (int)(
        $_POST['order_id'] ?? 0
    );

    $cancel_reason = trim(
        $_POST['cancel_reason'] ?? ''
    );

    if($cancel_order_id !== $order_id){

        die("Invalid order.");

    }


    /*
     * শুধু নিজের order cancel করতে পারবে
     */

    $check_query = mysqli_query(
        $conn,
        "SELECT id, order_status
         FROM orders
         WHERE id='$cancel_order_id'
         AND user_id='$user_id'
         LIMIT 1"
    );

    $cancel_order = mysqli_fetch_assoc(
        $check_query
    );


    if(!$cancel_order){

        die("Order not found.");

    }


    $current_status = strtolower(
        trim(
            $cancel_order['order_status']
        )
    );


    /*
     * Shipped / Delivered / Already Cancelled
     * হলে cancel করা যাবে না
     */

    if(
        $current_status === 'shipped' ||
        $current_status === 'delivered' ||
        $current_status === 'cancelled'
    ){

        header(
            "Location: order_details.php?id=" .
            $order_id .
            "&cancel=not_allowed"
        );

        exit();

    }


    $cancel_reason = mysqli_real_escape_string(
        $conn,
        $cancel_reason
    );


    /*
     * ORDER CANCEL
     */

    $update = mysqli_query(
        $conn,
        "UPDATE orders
         SET
            order_status='Cancelled',
            cancel_reason='$cancel_reason',
            cancelled_at=NOW()
         WHERE id='$cancel_order_id'
         AND user_id='$user_id'
         LIMIT 1"
    );


    if($update){

        header(
            "Location: order_details.php?id=" .
            $order_id .
            "&cancel=success"
        );

        exit();

    }else{

        header(
            "Location: order_details.php?id=" .
            $order_id .
            "&cancel=failed"
        );

        exit();

    }

}

/* =========================
   GET ORDER
========================= */

$order_query = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE id='$order_id'
     AND user_id='$user_id'
     LIMIT 1"
);

$order = mysqli_fetch_assoc($order_query);

if(!$order){
    header("Location: my_orders.php");
    exit();
}


/* =========================
   ORDER ITEMS
========================= */

$item_query = mysqli_query(
    $conn,
    "SELECT
        oi.*,
        p.image AS product_image
     FROM order_items oi
     LEFT JOIN products p
        ON oi.product_id = p.id
     WHERE oi.order_id='$order_id'"
);


/* =========================
   STATUS
========================= */

$status = strtolower(
    trim($order['order_status'])
);

$processing = false;
$shipped = false;
$delivered = false;

if($status == "processing"){
    $processing = true;
}

if($status == "shipped"){
    $processing = true;
    $shipped = true;
}

if($status == "delivered"){
    $processing = true;
    $shipped = true;
    $delivered = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Order #EL<?php echo $order['id']; ?> | ELARA
</title>


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

/* =================================
   GLOBAL
================================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    background:#030712;

    color:white;

    font-family:'Inter',sans-serif;

    overflow-x:hidden;
}


/* =================================
   PAGE
================================= */

.order-page{

    max-width:1100px;

    margin:auto;

    padding:35px 18px 70px;
}


/* =================================
   TOP HEADER
================================= */

.top-header{

    display:flex;

    justify-content:space-between;

    align-items:flex-start;

    gap:20px;

    margin-bottom:25px;
}

.back-link{

    display:inline-flex;

    align-items:center;

    gap:7px;

    color:#94a3b8;

    text-decoration:none;

    font-size:13px;

    font-weight:600;

    margin-bottom:10px;

    transition:.3s;
}

.back-link:hover{

    color:#a78bfa;
}

.order-title{

    font-size:30px;

    font-weight:900;

    margin:0;
}

.order-date{

    color:#64748b;

    font-size:12px;

    margin-top:6px;
}


/* =================================
   STATUS
================================= */

.status{

    display:inline-flex;

    align-items:center;

    gap:7px;

    padding:8px 14px;

    border-radius:50px;

    font-size:11px;

    font-weight:800;

    text-transform:uppercase;

    white-space:nowrap;
}

.status::before{

    content:"";

    width:6px;

    height:6px;

    border-radius:50%;

    background:currentColor;
}

.pending{

    color:#fbbf24;

    background:rgba(245,158,11,.12);
}

.processing{

    color:#60a5fa;

    background:rgba(59,130,246,.12);
}

.shipped{

    color:#a78bfa;

    background:rgba(139,92,246,.12);
}

.delivered{

    color:#4ade80;

    background:rgba(34,197,94,.12);
}

.cancelled{

    color:#f87171;

    background:rgba(239,68,68,.12);
}


/* =================================
   CARD
================================= */

.elara-card{

    background:#111827;

    border:1px solid rgba(255,255,255,.07);

    border-radius:22px;

    padding:20px;

    margin-bottom:18px;

    transition:.3s;
}

.elara-card:hover{

    border-color:rgba(139,92,246,.28);

    box-shadow:
    0 15px 35px rgba(0,0,0,.18);
}

.card-title{

    display:flex;

    align-items:center;

    gap:9px;

    font-size:16px;

    font-weight:800;

    margin-bottom:16px;
}

.card-title i{

    color:#8b5cf6;
}


/* =================================
   PRODUCT LIST
================================= */

.product-item{

    display:flex;

    align-items:center;

    gap:14px;

    padding:12px 0;

    border-bottom:
    1px solid rgba(255,255,255,.055);
}

.product-item:last-child{

    border-bottom:none;

    padding-bottom:0;
}

.product-image{

    width:65px;

    height:65px;

    flex-shrink:0;

    border-radius:16px;

    background:white;

    overflow:hidden;

    display:flex;

    align-items:center;

    justify-content:center;
}

.product-image img{

    width:100%;

    height:100%;

    object-fit:cover;
}

.product-placeholder{

    color:#8b5cf6;

    font-size:20px;
}

.product-info{

    flex:1;

    min-width:0;
}

.product-name{

    font-size:14px;

    font-weight:700;

    color:#f8fafc;

    white-space:nowrap;

    overflow:hidden;

    text-overflow:ellipsis;
}

.product-meta{

    color:#64748b;

    font-size:11px;

    margin-top:5px;
}

.product-price{

    font-size:14px;

    font-weight:800;

    color:#a78bfa;

    white-space:nowrap;
}


/* =================================
   TWO SMALL CARDS
================================= */

.info-grid{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:18px;
}


/* =================================
   DELIVERY
================================= */

.customer{

    display:flex;

    align-items:flex-start;

    gap:12px;
}

.customer-icon{

    width:40px;

    height:40px;

    flex-shrink:0;

    border-radius:13px;

    display:flex;

    align-items:center;

    justify-content:center;

    background:rgba(139,92,246,.12);

    color:#a78bfa;
}

.customer-name{

    font-size:14px;

    font-weight:700;

    margin-bottom:4px;
}

.customer-text{

    color:#64748b;

    font-size:11px;

    line-height:1.7;
}


/* =================================
   PAYMENT
================================= */

.total-label{

    color:#64748b;

    font-size:11px;

    margin-bottom:3px;
}

.total-price{

    font-size:28px;

    font-weight:900;

    color:#a78bfa;

    margin-bottom:12px;
}

.payment-row{

    display:flex;

    justify-content:space-between;

    gap:15px;

    padding:8px 0;

    border-top:
    1px solid rgba(255,255,255,.05);

    font-size:11px;
}

.payment-label{

    color:#64748b;
}

.payment-value{

    font-weight:700;

    text-align:right;
}

/* =================================
   PREMIUM ORDER TIMELINE
================================= */

.order-progress-card{
    position:relative;
    overflow:hidden;
}

.order-progress-card::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:1px;
    background:linear-gradient(
        90deg,
        transparent,
        rgba(139,92,246,.7),
        transparent
    );
}

.progress-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:15px;
    margin-bottom:28px;
}

.progress-header-left{
    display:flex;
    align-items:center;
    gap:10px;
}

.progress-header-left .header-icon{
    width:38px;
    height:38px;
    border-radius:12px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:rgba(139,92,246,.12);
    color:#a78bfa;

    border:1px solid rgba(139,92,246,.16);
}

.progress-header-title{
    font-size:16px;
    font-weight:800;
}

.progress-header-subtitle{
    color:#64748b;
    font-size:10px;
    margin-top:3px;
}

.current-status{
    padding:7px 12px;
    border-radius:50px;

    background:rgba(139,92,246,.10);
    border:1px solid rgba(139,92,246,.18);

    color:#c4b5fd;

    font-size:10px;
    font-weight:800;

    text-transform:uppercase;
}


/* =================================
   TIMELINE
================================= */

.order-timeline{
    position:relative;

    display:grid;
    grid-template-columns:
        repeat(4,1fr);

    gap:0;

    padding:5px 5px 0;
}


/* CONNECTING LINE */

.order-timeline::before{

    content:"";

    position:absolute;

    top:25px;

    left:11%;
    right:11%;

    height:3px;

    background:#1f2937;

    border-radius:10px;

}


/* ACTIVE CONNECTING LINE */

.timeline-progress{

    position:absolute;

    top:25px;

    left:11%;

    height:3px;

    width:0;

    background:
    linear-gradient(
        90deg,
        #7c3aed,
        #a78bfa
    );

    border-radius:10px;

    transition:.5s ease;

    z-index:1;
}


/* STEP */

.timeline-step{

    position:relative;

    z-index:2;

    text-align:center;

    min-width:0;
}


/* ICON */

.timeline-icon{

    width:50px;
    height:50px;

    margin:0 auto 11px;

    border-radius:50%;

    display:flex;

    align-items:center;
    justify-content:center;

    background:#111827;

    border:2px solid #273244;

    color:#475569;

    font-size:15px;

    transition:.35s ease;

    position:relative;

}


/* ACTIVE ICON */

.timeline-step.active
.timeline-icon{

    background:
    linear-gradient(
        135deg,
        #7c3aed,
        #4f46e5
    );

    border-color:#8b5cf6;

    color:#fff;

    box-shadow:
    0 0 0 6px
    rgba(139,92,246,.08),
    0 10px 25px
    rgba(124,58,237,.25);

}


/* CURRENT STEP */

.timeline-step.current
.timeline-icon{

    animation:
    timelinePulse 2s infinite;

}


/* CHECK */

.timeline-check{

    position:absolute;

    right:-3px;
    top:-3px;

    width:17px;
    height:17px;

    border-radius:50%;

    display:flex;

    align-items:center;
    justify-content:center;

    background:#22c55e;

    color:white;

    font-size:8px;

    border:2px solid #111827;

}


/* TEXT */

.timeline-title{

    color:#64748b;

    font-size:11px;

    font-weight:700;

    transition:.3s;

}

.timeline-step.active
.timeline-title{

    color:#e2e8f0;

}


.timeline-description{

    color:#475569;

    font-size:9px;

    margin-top:4px;

}


/* ACTIVE DESCRIPTION */

.timeline-step.active
.timeline-description{

    color:#8b5cf6;

}


/* =================================
   PULSE
================================= */

@keyframes timelinePulse{

    0%{
        box-shadow:
        0 0 0 0
        rgba(139,92,246,.35);
    }

    70%{
        box-shadow:
        0 0 0 10px
        rgba(139,92,246,0);
    }

    100%{
        box-shadow:
        0 0 0 0
        rgba(139,92,246,0);
    }

}


/* =================================
   MOBILE
================================= */

@media(max-width:600px){

    .progress-header{

        align-items:flex-start;

        flex-direction:column;

    }

    .current-status{

        align-self:flex-start;

    }

    .order-timeline{

        grid-template-columns:1fr;

        gap:22px;

        padding:0;

    }

    .order-timeline::before{

        top:25px;
        bottom:25px;

        left:24px;
        right:auto;

        width:3px;
        height:auto;

    }

    .timeline-progress{

        top:25px;
        left:24px;

        width:3px;

        height:0;

    }

    .timeline-step{

        display:flex;

        align-items:center;

        text-align:left;

        gap:13px;

    }

    .timeline-icon{

        margin:0;

        flex-shrink:0;

    }

    .timeline-info{

        flex:1;

    }

    .timeline-title{

        font-size:12px;

    }

    .timeline-description{

        font-size:10px;

    }

}

/* =================================
   CANCEL ORDER
================================= */

.cancel-order-card{

    border-color:
    rgba(239,68,68,.15);

    background:
    linear-gradient(
        135deg,
        rgba(239,68,68,.055),
        #111827
    );

}

.cancel-header{

    display:flex;

    align-items:center;

    gap:12px;

    margin-bottom:15px;

}

.cancel-icon{

    width:40px;

    height:40px;

    flex-shrink:0;

    border-radius:12px;

    display:flex;

    align-items:center;

    justify-content:center;

    background:
    rgba(239,68,68,.10);

    color:#f87171;

}

.cancel-title{

    font-size:13px;

    font-weight:800;

    color:#f8fafc;

}

.cancel-subtitle{

    font-size:10px;

    color:#64748b;

    margin-top:3px;

}

.cancel-reason{

    width:100%;

    margin-bottom:10px;

    resize:none;

}

.cancel-btn{

    width:100%;

    border:none;

    padding:11px 15px;

    border-radius:11px;

    background:
    rgba(239,68,68,.10);

    border:
    1px solid rgba(239,68,68,.20);

    color:#f87171;

    font-size:11px;

    font-weight:800;

    transition:.3s;

}

.cancel-btn:hover{

    background:#ef4444;

    color:white;

    transform:translateY(-1px);

    box-shadow:
    0 8px 20px
    rgba(239,68,68,.18);

}


/* =================================
   ACTIONS
================================= */

.actions{

    display:flex;

    gap:10px;

    margin-top:5px;
}

.action-btn{

    flex:1;

    display:flex;

    align-items:center;

    justify-content:center;

    gap:7px;

    padding:11px;

    border-radius:12px;

    text-decoration:none;

    font-size:12px;

    font-weight:700;

    transition:.3s;

    border:none;

    cursor:pointer;
}

.back-btn{

    background:#1f2937;

    color:white;
}

.back-btn:hover{

    background:#374151;

    color:white;
}

.print-btn{

    background:
    linear-gradient(
        135deg,
        #8b5cf6,
        #4f46e5
    );

    color:white;
}

.print-btn:hover{

    color:white;

    transform:translateY(-2px);
}


/* =================================
   MOBILE
================================= */

@media(max-width:768px){

    .order-page{

        padding:
        25px 13px 55px;
    }

    .top-header{

        flex-direction:column;

        align-items:flex-start;
    }

    .order-title{

        font-size:25px;
    }

    .info-grid{

        grid-template-columns:1fr;

        gap:0;
    }

    .elara-card{

        padding:17px;

        border-radius:19px;
    }

}

@media(max-width:480px){

    .product-image{

        width:52px;

        height:52px;

        border-radius:13px;
    }

    .product-name{

        font-size:12px;
    }

    .product-price{

        font-size:12px;
    }

    .actions{

        flex-direction:column;
    }

    .progress-step{

        font-size:9px;
    }

    .progress-icon{

        width:31px;

        height:31px;

        font-size:10px;
    }

}

</style>

</head>


<body>


<?php include('includes/navbar.php'); ?>


<div class="order-page">


    <!-- =================================
         HEADER
    ================================= -->

    <div class="top-header">

        <div>

            <a
            href="my_orders.php"
            class="back-link">

                <i class="fa-solid fa-arrow-left"></i>

                My Orders

            </a>

            <h1 class="order-title">

                Order #EL<?php echo $order['id']; ?>

            </h1>

            <div class="order-date">

                <i class="fa-regular fa-calendar me-1"></i>

                <?php

                echo date(
                    "d M Y, h:i A",
                    strtotime($order['order_date'])
                );

                ?>

            </div>

        </div>


        <span class="status <?php echo $status; ?>">

            <?php

            echo htmlspecialchars(
                $order['order_status']
            );

            ?>

        </span>

    </div>



    <!-- =================================
         PRODUCTS
    ================================= -->

    <div class="elara-card">

        <div class="card-title">

            <i class="fa-solid fa-bag-shopping"></i>

            Ordered Products

        </div>


        <?php

        if(mysqli_num_rows($item_query) > 0){

            while(
                $item =
                mysqli_fetch_assoc($item_query)
            ){

        ?>

        <div class="product-item">


            <!-- IMAGE -->

            <div class="product-image">

                <?php

                if(!empty($item['product_image'])){

                ?>

                    <img
                    src="uploads/<?php
                    echo htmlspecialchars(
                        $item['product_image']
                    );
                    ?>"
                    alt="Product"

                    onerror="
                    this.style.display='none';
                    this.parentElement
                    .querySelector('.product-placeholder')
                    .style.display='block';
                    ">

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


            <!-- INFO -->

            <div class="product-info">

                <div class="product-name">

                    <?php

                    echo htmlspecialchars(
                        $item['product_name']
                    );

                    ?>

                </div>

                <div class="product-meta">

                    Quantity:
                    <?php

                    echo (int)$item['quantity'];

                    ?>

                </div>

            </div>


            <!-- PRICE -->

            <div class="product-price">

                <?php


                if(isset($item['price'])){

                    echo "₹" .
                    number_format(
                        (float)$item['price'],
                        2
                    );

                }

                ?>

            </div>


        </div>

        <?php

            }

        }else{

        ?>

            <div class="text-secondary small">

                No product information available.

            </div>

        <?php } ?>


    </div>



    <!-- =================================
         DELIVERY + PAYMENT
    ================================= -->

    <div class="info-grid">


        <!-- DELIVERY -->

        <div class="elara-card">

            <div class="card-title">

                <i class="fa-solid fa-location-dot"></i>

                Delivery

            </div>


            <div class="customer">

                <div class="customer-icon">

                    <i class="fa-solid fa-user"></i>

                </div>


                <div>

                    <div class="customer-name">

                        <?php

                        echo htmlspecialchars(
                            $order['name']
                        );

                        ?>

                    </div>


                    <div class="customer-text">

                        <?php

                        echo htmlspecialchars(
                            $order['phone']
                        );

                        ?>

                        <br>

                        <?php

                        echo htmlspecialchars(
                            $order['address']
                        );

                        ?>

                    </div>

                </div>

            </div>

        </div>



        <!-- PAYMENT -->

        <div class="elara-card">

            <div class="card-title">

                <i class="fa-solid fa-credit-card"></i>

                Payment

            </div>


            <div class="total-label">

                Total Amount

            </div>


            <div class="total-price">

                ₹<?php

                echo number_format(
                    (float)$order['total_price'],
                    2
                );

                ?>

            </div>


            <div class="payment-row">

                <span class="payment-label">

                    Method

                </span>

                <span class="payment-value">

                    <?php

                    echo htmlspecialchars(
                        $order['payment_method']
                    );

                    ?>

                </span>

            </div>


            <div class="payment-row">

                <span class="payment-label">

                    Status

                </span>

                <span class="payment-value">

                    <?php

                    echo htmlspecialchars(
                        $order['payment_status']
                    );

                    ?>

                </span>

            </div>

        </div>


    </div>



    <!-- =================================
     PREMIUM ORDER PROGRESS
================================= -->

<div class="elara-card order-progress-card">


    <!-- HEADER -->

    <div class="progress-header">

        <div class="progress-header-left">

            <div class="header-icon">

                <i class="fa-solid fa-truck-fast"></i>

            </div>

            <div>

                <div class="progress-header-title">

                    Order Tracking

                </div>

                <div class="progress-header-subtitle">

                    Track your order journey

                </div>

            </div>

        </div>


        <!-- CURRENT STATUS -->

        <div class="current-status">

            <?php

            echo htmlspecialchars(
                $order['order_status']
            );

            ?>

        </div>

    </div>



    <!-- TIMELINE -->

    <div class="order-timeline">


        <!-- ACTIVE LINE -->

        <div
        class="timeline-progress"
        style="width:
        <?php

        if($status == 'pending'){

            echo '0%';

        }elseif($status == 'processing'){

            echo '27%';

        }elseif($status == 'shipped'){

            echo '58%';

        }elseif($status == 'delivered'){

            echo '78%';

        }else{

            echo '0%';

        }

        ?>;">
        </div>



        <!-- =================================
             PLACED
        ================================= -->

        <div class="timeline-step active">

            <div class="timeline-icon">

                <i class="fa-solid fa-check"></i>

                <span class="timeline-check">

                    <i class="fa-solid fa-check"></i>

                </span>

            </div>


            <div class="timeline-info">

                <div class="timeline-title">

                    Order Placed

                </div>

                <div class="timeline-description">

                    Order received

                </div>

            </div>

        </div>



        <!-- =================================
             PROCESSING
        ================================= -->

        <div
        class="timeline-step
        <?php

        if($processing){

            echo 'active';

        }

        if($status == 'processing'){

            echo ' current';

        }

        ?>">


            <div class="timeline-icon">

                <i class="fa-solid fa-box"></i>

                <?php if($processing){ ?>

                    <span class="timeline-check">

                        <i class="fa-solid fa-check"></i>

                    </span>

                <?php } ?>

            </div>


            <div class="timeline-info">

                <div class="timeline-title">

                    Processing

                </div>

                <div class="timeline-description">

                    Preparing your order

                </div>

            </div>

        </div>



        <!-- =================================
             SHIPPED
        ================================= -->

        <div
        class="timeline-step
        <?php

        if($shipped){

            echo 'active';

        }

        if($status == 'shipped'){

            echo ' current';

        }

        ?>">


            <div class="timeline-icon">

                <i class="fa-solid fa-truck"></i>

                <?php if($shipped){ ?>

                    <span class="timeline-check">

                        <i class="fa-solid fa-check"></i>

                    </span>

                <?php } ?>

            </div>


            <div class="timeline-info">

                <div class="timeline-title">

                    Shipped

                </div>

                <div class="timeline-description">

                    On the way

                </div>

            </div>

        </div>



        <!-- =================================
             DELIVERED
        ================================= -->

        <div
        class="timeline-step
        <?php

        if($delivered){

            echo 'active';

        }

        if($status == 'delivered'){

            echo ' current';

        }

        ?>">


            <div class="timeline-icon">

                <i class="fa-solid fa-house"></i>

                <?php if($delivered){ ?>

                    <span class="timeline-check">

                        <i class="fa-solid fa-check"></i>

                    </span>

                <?php } ?>

            </div>


            <div class="timeline-info">

                <div class="timeline-title">

                    Delivered

                </div>

                <div class="timeline-description">

                    Order completed

                </div>

            </div>

        </div>


    </div>


</div>


<?php

$can_cancel = (
    $status === 'pending' ||
    $status === 'processing'
);

?>

<?php if($can_cancel){ ?>

<!-- =================================
     CANCEL ORDER
================================= -->

<div class="elara-card cancel-order-card">

    <div class="cancel-header">

        <div class="cancel-icon">

            <i class="fa-solid fa-ban"></i>

        </div>

        <div>

            <div class="cancel-title">

                Need to cancel this order?

            </div>

            <div class="cancel-subtitle">

                You can cancel this order before it is shipped.

            </div>

        </div>

    </div>


    <form
        method="POST"
        action="order_details.php?id=<?php echo (int)$order['id']; ?>"
        onsubmit="
            return confirm(
                'Are you sure you want to cancel this order?'
            );
        "
    >

        <input
            type="hidden"
            name="order_id"
            value="<?php echo (int)$order['id']; ?>"
        >


        <textarea
            name="cancel_reason"
            class="form-control cancel-reason"
            rows="2"
            placeholder="Why do you want to cancel? (Optional)"
        ></textarea>


        <button
            type="submit"
            name="cancel_order"
            class="cancel-btn"
        >

            <i class="fa-solid fa-xmark"></i>

            Cancel Order

        </button>

    </form>

</div>

<?php } ?>


    <!-- =================================
         BUTTONS
    ================================= -->

    <div class="actions">

        <a
        href="my_orders.php"
        class="action-btn back-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Orders

        </a>


        <a
        href="#"
        onclick="window.print(); return false;"
        class="action-btn print-btn">

            <i class="fa-solid fa-print"></i>

            Print Invoice

        </a>

    </div>


</div>


<?php include('profile.php'); ?>


<script
src="Assets/bootstrap/js/bootstrap.bundle.min.js">
</script>


</body>

</html>