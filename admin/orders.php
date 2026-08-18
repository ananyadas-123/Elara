<?php

include("../includes/connect.php");


/* =========================
   ORDERS
========================= */

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     ORDER BY id DESC"
);


/* =========================
   CHECK QUERY
========================= */

if (!$query) {

    die(
        "Database Error: " .
        htmlspecialchars(mysqli_error($conn))
    );

}


/* =========================
   STATS
========================= */

$total_orders = mysqli_num_rows($query);


/* Pending */

$pending_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM orders
     WHERE order_status='Pending'"
);

$pending_data = mysqli_fetch_assoc($pending_query);

$pending = (int)($pending_data['total'] ?? 0);


/* Processing */

$processing_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM orders
     WHERE order_status='Processing'"
);

$processing_data = mysqli_fetch_assoc($processing_query);

$processing = (int)($processing_data['total'] ?? 0);


/* Shipped */

$shipped_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM orders
     WHERE order_status='Shipped'"
);

$shipped_data = mysqli_fetch_assoc($shipped_query);

$shipped = (int)($shipped_data['total'] ?? 0);


/* Delivered */

$delivered_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM orders
     WHERE order_status='Delivered'"
);

$delivered_data = mysqli_fetch_assoc($delivered_query);

$delivered = (int)($delivered_data['total'] ?? 0);


/* Cancelled */

$cancelled_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM orders
     WHERE order_status='Cancelled'"
);

$cancelled_data = mysqli_fetch_assoc($cancelled_query);

$cancelled = (int)($cancelled_data['total'] ?? 0);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"
>

<title>Orders Management | ELARA</title>


<link
href="../Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet"
>


<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
>


<link
href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
rel="stylesheet"
>


<style>

/* =========================
   GLOBAL
========================= */

*{
    box-sizing:border-box;
}


body{

    margin:0;

    background:
    radial-gradient(
        circle at top left,
        rgba(124,58,237,.12),
        transparent 35%
    ),
    #030712;

    color:white;

    font-family:'Inter',sans-serif;

    min-height:100vh;

}


/* =========================
   PAGE
========================= */

.orders-page{

    max-width:1400px;

    margin:auto;

    padding:45px 20px 80px;

}


/* =========================
   HEADER
========================= */

.page-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:30px;

    gap:20px;

}


.page-title{

    font-size:36px;

    font-weight:900;

    margin:0;

}


.page-subtitle{

    color:#64748b;

    font-size:13px;

    margin-top:7px;

}


.order-count{

    padding:10px 17px;

    border-radius:50px;

    background:
    rgba(139,92,246,.12);

    border:
    1px solid rgba(139,92,246,.25);

    color:#c4b5fd;

    font-size:13px;

    font-weight:700;

}


/* =========================
   SUCCESS MESSAGE
========================= */

.success-message{

    background:
    rgba(34,197,94,.10);

    border:
    1px solid rgba(34,197,94,.25);

    color:#4ade80;

    padding:13px 17px;

    border-radius:14px;

    font-size:13px;

    margin-bottom:25px;

}


/* =========================
   STATS
========================= */

.stats-grid{

    display:grid;

    grid-template-columns:
    repeat(5,1fr);

    gap:15px;

    margin-bottom:30px;

}


.stats-card{

    background:
    rgba(255,255,255,.045);

    border:
    1px solid rgba(255,255,255,.07);

    border-radius:20px;

    padding:20px;

    transition:.3s;

}


.stats-card:hover{

    transform:translateY(-4px);

    border-color:
    rgba(139,92,246,.35);

    box-shadow:
    0 15px 35px rgba(0,0,0,.20);

}


.stats-icon{

    width:42px;

    height:42px;

    border-radius:13px;

    display:flex;

    align-items:center;

    justify-content:center;

    background:
    linear-gradient(
        135deg,
        #8b5cf6,
        #4f46e5
    );

    margin-bottom:14px;

}


.stats-card h3{

    font-size:28px;

    font-weight:900;

    margin:0 0 4px;

}


.stats-card p{

    margin:0;

    color:#64748b;

    font-size:12px;

}


/* =========================
   TABLE
========================= */

.orders-table{

    background:
    rgba(17,24,39,.80);

    border:
    1px solid rgba(255,255,255,.07);

    border-radius:22px;

    overflow:hidden;

    backdrop-filter:blur(15px);

}


.table{

    margin:0;

    color:white;

    min-width:1100px;

}


.table th{

    background:#0f172a;

    color:#94a3b8;

    padding:16px;

    border:none;

    font-size:11px;

    text-transform:uppercase;

    letter-spacing:.5px;

    white-space:nowrap;

}


.table td{

    padding:16px;

    vertical-align:middle;

    border-color:
    rgba(255,255,255,.05);

    font-size:12px;

}


.table tbody tr{

    transition:.2s;

}


.table tbody tr:hover{

    background:
    rgba(139,92,246,.045);

}


/* =========================
   ORDER
========================= */

.order-id{

    font-weight:800;

    color:#c4b5fd;

}


/* =========================
   CUSTOMER
========================= */

.customer-name{

    font-weight:700;

}


.customer-phone{

    color:#64748b;

    font-size:11px;

    margin-top:3px;

}


/* =========================
   PAYMENT
========================= */

.payment-method{

    font-weight:600;

}


.payment-status{

    color:#64748b;

    font-size:10px;

    margin-top:3px;

}


/* =========================
   STATUS
========================= */

.badge-status{

    display:inline-flex;

    align-items:center;

    gap:6px;

    padding:7px 12px;

    border-radius:50px;

    font-size:10px;

    font-weight:800;

    text-transform:uppercase;

}


.badge-status::before{

    content:'';

    width:6px;

    height:6px;

    border-radius:50%;

    background:currentColor;

}


.pending{

    background:
    rgba(245,158,11,.12);

    color:#fbbf24;

}


.processing{

    background:
    rgba(59,130,246,.12);

    color:#60a5fa;

}


.shipped{

    background:
    rgba(139,92,246,.12);

    color:#a78bfa;

}


.delivered{

    background:
    rgba(34,197,94,.12);

    color:#4ade80;

}


.cancelled{

    background:
    rgba(239,68,68,.12);

    color:#f87171;

}


/* =========================
   TRACKING
========================= */

.tracking-text{

    color:#a78bfa;

    font-weight:700;

    font-size:11px;

}


.not-assigned{

    color:#475569;

    font-size:11px;

}


/* =========================
   MANAGE BUTTON
========================= */

.manage-btn{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    gap:6px;

    padding:8px 13px;

    border:none;

    border-radius:10px;

    background:
    linear-gradient(
        135deg,
        #8b5cf6,
        #4f46e5
    );

    color:white;

    font-size:11px;

    font-weight:700;

    text-decoration:none;

    transition:.3s;

    white-space:nowrap;

}


.manage-btn:hover{

    color:white;

    transform:translateY(-2px);

    box-shadow:
    0 8px 20px
    rgba(124,58,237,.25);

}


/* =========================
   EMPTY ORDERS
========================= */

.empty-orders{

    text-align:center;

    padding:60px 20px;

    color:#64748b;

}


.empty-orders i{

    font-size:40px;

    margin-bottom:15px;

    color:#475569;

}


.empty-orders h4{

    color:#cbd5e1;

    font-size:16px;

    margin-bottom:6px;

}


.empty-orders p{

    font-size:12px;

    margin:0;

}


/* =========================
   MOBILE
========================= */

@media(max-width:1100px){

    .stats-grid{

        grid-template-columns:
        repeat(3,1fr);

    }

}


@media(max-width:700px){

    .orders-page{

        padding:
        30px 12px 60px;

    }


    .page-header{

        align-items:flex-start;

        flex-direction:column;

    }


    .page-title{

        font-size:30px;

    }


    .stats-grid{

        grid-template-columns:
        repeat(2,1fr);

    }

}


@media(max-width:450px){

    .stats-grid{

        grid-template-columns:1fr;

    }

}


</style>

</head>


<body>


<div class="orders-page">


<!-- =========================
     HEADER
========================= -->

<div class="page-header">

    <div>

        <h1 class="page-title">

            Orders Management

        </h1>


        <div class="page-subtitle">

            Manage orders, payments and delivery tracking.

        </div>

    </div>


    <div class="order-count">

        <i class="fa-solid fa-box me-2"></i>

        <?php echo $total_orders; ?>

        Orders

    </div>

</div>



<!-- =========================
     SUCCESS MESSAGE
========================= -->

<?php if(isset($_GET['updated'])){ ?>

<div class="success-message">

    <i class="fa-solid fa-circle-check me-2"></i>

    Order updated successfully.

</div>

<?php } ?>



<!-- =========================
     STATS
========================= -->

<div class="stats-grid">


    <!-- TOTAL -->

    <div class="stats-card">

        <div class="stats-icon">

            <i class="fa-solid fa-bag-shopping"></i>

        </div>

        <h3>

            <?php echo $total_orders; ?>

        </h3>

        <p>

            Total Orders

        </p>

    </div>



    <!-- PENDING -->

    <div class="stats-card">

        <div class="stats-icon">

            <i class="fa-solid fa-clock"></i>

        </div>

        <h3>

            <?php echo $pending; ?>

        </h3>

        <p>

            Pending

        </p>

    </div>



    <!-- IN DELIVERY -->

    <div class="stats-card">

        <div class="stats-icon">

            <i class="fa-solid fa-truck-fast"></i>

        </div>

        <h3>

            <?php

            echo $processing + $shipped;

            ?>

        </h3>

        <p>

            In Delivery

        </p>

    </div>



    <!-- DELIVERED -->

    <div class="stats-card">

        <div class="stats-icon">

            <i class="fa-solid fa-circle-check"></i>

        </div>

        <h3>

            <?php echo $delivered; ?>

        </h3>

        <p>

            Delivered

        </p>

    </div>



    <!-- CANCELLED -->

    <div class="stats-card">

        <div class="stats-icon">

            <i class="fa-solid fa-ban"></i>

        </div>

        <h3>

            <?php echo $cancelled; ?>

        </h3>

        <p>

            Cancelled

        </p>

    </div>


</div>



<!-- =========================
     ORDERS TABLE
========================= -->

<div class="orders-table">

    <div class="table-responsive">

        <table class="table">


            <thead>

                <tr>

                    <th>
                        Order
                    </th>

                    <th>
                        Customer
                    </th>

                    <th>
                        Total
                    </th>

                    <th>
                        Payment
                    </th>

                    <th>
                        Courier
                    </th>

                    <th>
                        Tracking
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Delivery
                    </th>

                    <th>
                        Date
                    </th>

                    <th>
                        Action
                    </th>

                </tr>

            </thead>



            <tbody>


            <?php

            if(mysqli_num_rows($query) > 0){

                while(
                    $order =
                    mysqli_fetch_assoc($query)
                ){

                    $status = strtolower(
                        trim(
                            $order['order_status']
                            ?? 'Pending'
                        )
                    );

            ?>


                <tr>


                    <!-- =========================
                         ORDER
                    ========================= -->

                    <td>

                        <div class="order-id">

                            #EL<?php

                            echo (int)$order['id'];

                            ?>

                        </div>

                    </td>



                    <!-- =========================
                         CUSTOMER
                    ========================= -->

                    <td>

                        <div class="customer-name">

                            <?php

                            echo htmlspecialchars(
                                $order['name'] ?? ''
                            );

                            ?>

                        </div>


                        <div class="customer-phone">

                            <?php

                            echo htmlspecialchars(
                                $order['phone'] ?? ''
                            );

                            ?>

                        </div>

                    </td>



                    <!-- =========================
                         TOTAL
                    ========================= -->

                    <td>

                        <strong>

                            ₹<?php

                            echo number_format(
                                (float)(
                                    $order['total_price']
                                    ?? 0
                                ),
                                2
                            );

                            ?>

                        </strong>

                    </td>



                    <!-- =========================
                         PAYMENT
                    ========================= -->

                    <td>

                        <div class="payment-method">

                            <?php

                            echo htmlspecialchars(
                                $order['payment_method']
                                ?? ''
                            );

                            ?>

                        </div>


                        <div class="payment-status">

                            <?php

                            echo htmlspecialchars(
                                $order['payment_status']
                                ?? 'Pending'
                            );

                            ?>

                        </div>

                    </td>



                    <!-- =========================
                         COURIER
                    ========================= -->

                    <td>

                        <?php

                        if(
                            !empty(
                                $order['courier']
                            )
                        ){

                        ?>

                            <span class="tracking-text">

                                <?php

                                echo htmlspecialchars(
                                    $order['courier']
                                );

                                ?>

                            </span>

                        <?php

                        }else{

                        ?>

                            <span class="not-assigned">

                                Not Assigned

                            </span>

                        <?php

                        }

                        ?>

                    </td>



                    <!-- =========================
                         TRACKING
                    ========================= -->

                    <td>

                        <?php

                        if(
                            !empty(
                                $order['tracking_id']
                            )
                        ){

                        ?>

                            <span class="tracking-text">

                                <?php

                                echo htmlspecialchars(
                                    $order['tracking_id']
                                );

                                ?>

                            </span>

                        <?php

                        }else{

                        ?>

                            <span class="not-assigned">

                                Not Assigned

                            </span>

                        <?php

                        }

                        ?>

                    </td>



                    <!-- =========================
                         STATUS
                    ========================= -->

                    <td>

                        <span
                        class="
                        badge-status
                        <?php echo htmlspecialchars($status); ?>
                        "
                        >

                            <?php

                            echo htmlspecialchars(
                                $order['order_status']
                                ?? 'Pending'
                            );

                            ?>

                        </span>

                    </td>



                    <!-- =========================
                         DELIVERY
                    ========================= -->

                    <td>

                        <?php

                        if(
                            !empty(
                                $order[
                                    'estimated_delivery'
                                ]
                            )
                        ){

                            $delivery_date =
                                strtotime(
                                    $order[
                                        'estimated_delivery'
                                    ]
                                );

                            if($delivery_date){

                        ?>

                            <span
                            style="
                            color:#c4b5fd;
                            font-size:11px;
                            font-weight:700;
                            "
                            >

                                <?php

                                echo date(
                                    "d M Y",
                                    $delivery_date
                                );

                                ?>

                            </span>

                        <?php

                            }else{

                        ?>

                            <span class="not-assigned">

                                Not Set

                            </span>

                        <?php

                            }

                        }else{

                        ?>

                            <span class="not-assigned">

                                Not Set

                            </span>

                        <?php

                        }

                        ?>

                    </td>



                    <!-- =========================
                         DATE
                    ========================= -->

                    <td>

                        <?php

                        if(
                            !empty(
                                $order['order_date']
                            )
                        ){

                            $order_date =
                                strtotime(
                                    $order['order_date']
                                );

                            if($order_date){

                                echo date(
                                    "d M Y",
                                    $order_date
                                );

                            }else{

                                echo "-";

                            }

                        }else{

                            echo "-";

                        }

                        ?>

                    </td>



                    <!-- =========================
                         ACTION
                    ========================= -->

                    <td>

                       <a
                            href="#"
                            class="manage-btn"
                            onclick="loadPage('update_order.php?id=<?php echo (int)$order['id']; ?>')">
                            <i class="fa-solid fa-pen"></i>
                            Manage
                        </a>

                    </td>


                </tr>


            <?php

                }

            }else{

            ?>


                <!-- =========================
                     NO ORDERS
                ========================= -->

                <tr>

                    <td
                    colspan="10"
                    >

                        <div class="empty-orders">

                            <i
                            class="fa-solid fa-box-open"
                            ></i>

                            <h4>

                                No Orders Found

                            </h4>

                            <p>

                                There are no orders to display.

                            </p>

                        </div>

                    </td>

                </tr>


            <?php

            }

            ?>


            </tbody>

        </table>

    </div>

</div>


</div>


</body>

</html>