<?php

include("../includes/connect.php");


/* =========================
   VALIDATE ORDER ID
========================= */

if(
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
){

    die("Invalid Order ID");

}

$order_id = (int)$_GET['id'];


/* =========================
   GET ORDER
========================= */

$order_query = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE id='$order_id'
     LIMIT 1"
);


if(!$order_query){

    die(
        "Database Error: " .
        htmlspecialchars(
            mysqli_error($conn)
        )
    );

}


$order = mysqli_fetch_assoc(
    $order_query
);


if(!$order){

    die("Order not found");

}


/* =========================
   UPDATE ORDER
========================= */

if(
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['update_order'])
){

    /* =========================
       BASIC DATA
    ========================= */

    $status = trim(
        $_POST['order_status'] ?? ''
    );

    $payment_status = trim(
        $_POST['payment_status'] ?? 'Pending'
    );

    $courier = trim(
        $_POST['courier'] ?? ''
    );

    $tracking_id = trim(
        $_POST['tracking_id'] ?? ''
    );

    $estimated_delivery = trim(
        $_POST['estimated_delivery'] ?? ''
    );

    $cancel_reason = trim(
        $_POST['cancel_reason'] ?? ''
    );


    /* =========================
       ALLOWED VALUES
    ========================= */

    $allowed_status = [
        'Pending',
        'Processing',
        'Shipped',
        'Delivered',
        'Cancelled'
    ];

    $allowed_payment = [
        'Pending',
        'Paid',
        'Failed'
    ];


    if(
        !in_array(
            $status,
            $allowed_status,
            true
        )
    ){

        die("Invalid order status");

    }


    if(
        !in_array(
            $payment_status,
            $allowed_payment,
            true
        )
    ){

        die("Invalid payment status");

    }


    /* =========================
       CURRENT STATUS
    ========================= */

    $old_status = trim(
        $order['order_status'] ?? 'Pending'
    );


    /* =========================
       ESCAPE DATA
    ========================= */

    $status = mysqli_real_escape_string(
        $conn,
        $status
    );

    $payment_status = mysqli_real_escape_string(
        $conn,
        $payment_status
    );

    $courier = mysqli_real_escape_string(
        $conn,
        $courier
    );

    $tracking_id = mysqli_real_escape_string(
        $conn,
        $tracking_id
    );

    $cancel_reason = mysqli_real_escape_string(
        $conn,
        $cancel_reason
    );


    /* =========================
       ESTIMATED DELIVERY
    ========================= */

    if($estimated_delivery !== ''){

        $estimated_delivery =
            "'" .
            mysqli_real_escape_string(
                $conn,
                $estimated_delivery
            ) .
            "'";

    }else{

        $estimated_delivery = "NULL";

    }


    /* =========================
       TIMESTAMP VALUES
    ========================= */

    /*
     * Existing timestamp preserve করা হবে।
     */

    $delivered_at =
        !empty($order['delivered_at'])
        ? "'" .
          mysqli_real_escape_string(
              $conn,
              $order['delivered_at']
          ) .
          "'"
        : "NULL";


    $cancelled_at =
        !empty($order['cancelled_at'])
        ? "'" .
          mysqli_real_escape_string(
              $conn,
              $order['cancelled_at']
          ) .
          "'"
        : "NULL";


    $cancel_by =
        !empty($order['cancel_by'])
        ? "'" .
          mysqli_real_escape_string(
              $conn,
              $order['cancel_by']
          ) .
          "'"
        : "NULL";


    /* =========================
       DELIVERED
    ========================= */

    if($status === 'Delivered'){

        /*
         * প্রথমবার Delivered হলে
         * current time save হবে।
         */

        if(empty($order['delivered_at'])){

            $delivered_at = "NOW()";

        }

        /*
         * Delivered হলে cancelled info clear
         */

        $cancelled_at = "NULL";

        $cancel_by = "NULL";

        $cancel_reason = "";

    }


    /* =========================
       CANCELLED
    ========================= */

    elseif($status === 'Cancelled'){

        /*
         * প্রথমবার Cancelled হলে
         * current time save হবে।
         */

        if(empty($order['cancelled_at'])){

            $cancelled_at = "NOW()";

        }

        /*
         * Admin থেকে cancel হলে
         * cancel_by = Admin
         */

        $cancel_by = "'Admin'";


        /*
         * Cancel reason না দিলে default reason
         */

        if(trim($cancel_reason) === ''){

            $cancel_reason =
                "Order cancelled by admin.";

        }

    }


    /* =========================
       OTHER STATUS
    ========================= */

    else{

        /*
         * Pending / Processing / Shipped
         * হলে delivery/cancel timestamps
         * clear থাকবে।
         */

        $delivered_at = "NULL";

        $cancelled_at = "NULL";

        $cancel_by = "NULL";

        $cancel_reason = "";

    }


    /* =========================
       UPDATE QUERY
    ========================= */

    $sql = "

        UPDATE orders

        SET

            order_status = '$status',

            payment_status = '$payment_status',

            courier = '$courier',

            tracking_id = '$tracking_id',

            estimated_delivery = $estimated_delivery,

            delivered_at = $delivered_at,

            cancelled_at = $cancelled_at,

            cancel_reason = '$cancel_reason',

            cancel_by = $cancel_by

        WHERE id = '$order_id'

        LIMIT 1

    ";


    $update = mysqli_query(
        $conn,
        $sql
    );


    /* =========================
       ERROR
    ========================= */

    if(!$update){

        die(

            "<div style='
                font-family:Arial;
                padding:40px;
                background:#030712;
                color:white;
                min-height:100vh;
            '>

                <h2 style='color:#f87171;'>
                    Update Failed
                </h2>

                <p style='color:#94a3b8;'>

                    " .
                    htmlspecialchars(
                        mysqli_error($conn)
                    )
                    . "

                </p>

                <a
                    href='orders.php'
                    style='
                        display:inline-block;
                        margin-top:15px;
                        padding:10px 16px;
                        background:#7c3aed;
                        color:white;
                        text-decoration:none;
                        border-radius:10px;
                    '>

                    Back to Orders

                </a>

            </div>"

        );

    }


    /* =========================
       SUCCESS
    ========================= */

    header(
        "Location: orders.php?updated=1"
    );

    exit();

}


/* =========================
   CURRENT STATUS
========================= */

$current_status = strtolower(
    trim(
        $order['order_status'] ?? 'Pending'
    )
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Update Order #EL<?php echo $order_id; ?>
</title>


<link
href="../Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet">


<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<style>

*{
    box-sizing:border-box;
}


body{

    margin:0;

    background:
    radial-gradient(
        circle at top left,
        rgba(124,58,237,.13),
        transparent 35%
    ),
    #030712;

    color:white;

    font-family:Arial,sans-serif;

}


.page{

    max-width:850px;

    margin:auto;

    padding:40px 20px 70px;

}


/* =========================
   HEADER
========================= */

.page-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:25px;

    gap:20px;

}


.page-title{

    font-size:30px;

    font-weight:800;

    margin:0;

}


.page-subtitle{

    color:#64748b;

    font-size:13px;

    margin-top:6px;

}


.order-id{

    background:#1e293b;

    color:#c4b5fd;

    padding:9px 15px;

    border-radius:50px;

    font-size:12px;

    font-weight:700;

    white-space:nowrap;

}


/* =========================
   CARD
========================= */

.update-card{

    background:#111827;

    border:
    1px solid rgba(255,255,255,.07);

    border-radius:22px;

    padding:25px;

}


/* =========================
   ORDER INFO
========================= */

.order-info{

    display:grid;

    grid-template-columns:
    repeat(3,1fr);

    gap:12px;

    margin-bottom:28px;

}


.info-box{

    background:#0f172a;

    padding:15px;

    border-radius:14px;

}


.info-label{

    color:#64748b;

    font-size:10px;

    margin-bottom:5px;

}


.info-value{

    font-size:14px;

    font-weight:700;

}


/* =========================
   CURRENT STATUS
========================= */

.current-status{

    display:flex;

    align-items:center;

    justify-content:space-between;

    gap:15px;

    background:#0f172a;

    border:
    1px solid rgba(255,255,255,.06);

    padding:15px;

    border-radius:15px;

    margin-bottom:25px;

}


.current-status-label{

    color:#64748b;

    font-size:11px;

}


.current-status-value{

    font-size:12px;

    font-weight:800;

}


/* STATUS COLORS */

.status-dot{

    display:inline-flex;

    align-items:center;

    gap:7px;

}


.status-dot::before{

    content:"";

    width:7px;

    height:7px;

    border-radius:50%;

    background:currentColor;

}


.status-pending{

    color:#fbbf24;

}


.status-processing{

    color:#60a5fa;

}


.status-shipped{

    color:#a78bfa;

}


.status-delivered{

    color:#4ade80;

}


.status-cancelled{

    color:#f87171;

}


/* =========================
   FORM
========================= */

.form-title{

    font-size:17px;

    font-weight:800;

    margin-bottom:20px;

}


.form-label{

    color:#cbd5e1;

    font-size:12px;

    font-weight:700;

    margin-bottom:7px;

}


.form-control,
.form-select{

    background:#0f172a;

    border:
    1px solid #1e293b;

    color:white;

    border-radius:12px;

    padding:11px 13px;

}


.form-control:focus,
.form-select:focus{

    background:#0f172a;

    color:white;

    border-color:#8b5cf6;

    box-shadow:
    0 0 0 .2rem
    rgba(139,92,246,.10);

}


.form-select option{

    background:#0f172a;

    color:white;

}


.form-control::placeholder{

    color:#475569;

}


/* =========================
   CANCEL BOX
========================= */

#cancelBox{

    display:none;

    padding:15px;

    border-radius:15px;

    background:
    rgba(239,68,68,.07);

    border:
    1px solid rgba(239,68,68,.18);

}


.cancel-warning{

    display:flex;

    align-items:flex-start;

    gap:10px;

    color:#fca5a5;

    font-size:11px;

    line-height:1.6;

    margin-bottom:12px;

}


.cancel-warning i{

    margin-top:2px;

    color:#f87171;

}


/* =========================
   ACTIONS
========================= */

.actions{

    display:flex;

    gap:10px;

    margin-top:25px;

}


.btn-update{

    border:none;

    background:
    linear-gradient(
        135deg,
        #8b5cf6,
        #4f46e5
    );

    color:white;

    padding:12px 20px;

    border-radius:12px;

    font-weight:700;

    cursor:pointer;

}


.btn-update:hover{

    color:white;

    opacity:.9;

}


.btn-back{

    background:#1e293b;

    color:#cbd5e1;

    padding:12px 20px;

    border-radius:12px;

    text-decoration:none;

    font-weight:700;

}


.btn-back:hover{

    background:#334155;

    color:white;

}


/* =========================
   MOBILE
========================= */

@media(max-width:650px){

    .page{

        padding:
        25px 14px 50px;

    }


    .page-header{

        align-items:flex-start;

        flex-direction:column;

        gap:12px;

    }


    .order-info{

        grid-template-columns:1fr;

    }


    .actions{

        flex-direction:column;

    }


    .btn-update,
    .btn-back{

        width:100%;

        text-align:center;

    }

}

</style>

</head>


<body>


<div class="page">


<!-- =========================
     HEADER
========================= -->

<div class="page-header">

    <div>

        <h1 class="page-title">

            Update Order

        </h1>

        <div class="page-subtitle">

            Manage order status, payment and delivery.

        </div>

    </div>


    <div class="order-id">

        #EL<?php echo $order_id; ?>

    </div>

</div>



<!-- =========================
     CARD
========================= -->

<div class="update-card">


<!-- =========================
     BASIC INFO
========================= -->

<div class="order-info">


    <div class="info-box">

        <div class="info-label">
            CUSTOMER
        </div>

        <div class="info-value">

            <?php

            echo htmlspecialchars(
                $order['name'] ?? ''
            );

            ?>

        </div>

    </div>


    <div class="info-box">

        <div class="info-label">
            TOTAL
        </div>

        <div class="info-value">

            ₹<?php

            echo number_format(
                (float)$order['total_price'],
                2
            );

            ?>

        </div>

    </div>


    <div class="info-box">

        <div class="info-label">
            PAYMENT METHOD
        </div>

        <div class="info-value">

            <?php

            echo htmlspecialchars(
                $order['payment_method'] ?? ''
            );

            ?>

        </div>

    </div>

</div>



<!-- =========================
     CURRENT STATUS
========================= -->

<div class="current-status">

    <div>

        <div class="current-status-label">

            CURRENT ORDER STATUS

        </div>

        <div
        class="
        current-status-value
        status-dot
        status-<?php echo htmlspecialchars($current_status); ?>
        ">

            <?php

            echo htmlspecialchars(
                $order['order_status'] ?? 'Pending'
            );

            ?>

        </div>

    </div>


    <?php if(!empty($order['cancel_by'])){ ?>

    <div style="
        text-align:right;
        font-size:10px;
        color:#64748b;
    ">

        Cancelled By

        <strong style="
            display:block;
            color:#cbd5e1;
            margin-top:3px;
        ">

            <?php

            echo htmlspecialchars(
                $order['cancel_by']
            );

            ?>

        </strong>

    </div>

    <?php } ?>

</div>



<div class="form-title">

    <i class="fa-solid fa-truck-fast me-2"></i>

    Order Management

</div>



<form method="POST">


<!-- =========================
     STATUS
========================= -->

<div class="mb-4">

    <label class="form-label">

        Order Status

    </label>

    <select
    name="order_status"
    id="orderStatus"
    class="form-select"
    required>

        <option
        value="Pending"
        <?php

        if($current_status == "pending")
            echo "selected";

        ?>>

            Pending

        </option>


        <option
        value="Processing"
        <?php

        if($current_status == "processing")
            echo "selected";

        ?>>

            Processing

        </option>


        <option
        value="Shipped"
        <?php

        if($current_status == "shipped")
            echo "selected";

        ?>>

            Shipped

        </option>


        <option
        value="Delivered"
        <?php

        if($current_status == "delivered")
            echo "selected";

        ?>>

            Delivered

        </option>


        <option
        value="Cancelled"
        <?php

        if($current_status == "cancelled")
            echo "selected";

        ?>>

            Cancelled

        </option>

    </select>

</div>



<!-- =========================
     PAYMENT STATUS
========================= -->

<div class="mb-4">

    <label class="form-label">

        Payment Status

    </label>

    <select
    name="payment_status"
    class="form-select"
    required>

        <option
        value="Pending"
        <?php

        if(
            ($order['payment_status'] ?? '')
            === 'Pending'
        )
            echo "selected";

        ?>>

            Pending

        </option>


        <option
        value="Paid"
        <?php

        if(
            ($order['payment_status'] ?? '')
            === 'Paid'
        )
            echo "selected";

        ?>>

            Paid

        </option>


        <option
        value="Failed"
        <?php

        if(
            ($order['payment_status'] ?? '')
            === 'Failed'
        )
            echo "selected";

        ?>>

            Failed

        </option>

    </select>

</div>



<!-- =========================
     COURIER
========================= -->

<div class="mb-4">

    <label class="form-label">

        Courier

    </label>

    <select
    name="courier"
    class="form-select">

        <option value="">

            Select Courier

        </option>


        <option
        value="Pathao"
        <?php

        if(
            ($order['courier'] ?? '')
            === 'Pathao'
        )
            echo "selected";

        ?>>

            Pathao

        </option>


        <option
        value="Steadfast"
        <?php

        if(
            ($order['courier'] ?? '')
            === 'Steadfast'
        )
            echo "selected";

        ?>>

            Steadfast

        </option>


        <option
        value="RedX"
        <?php

        if(
            ($order['courier'] ?? '')
            === 'RedX'
        )
            echo "selected";

        ?>>

            RedX

        </option>


        <option
        value="Sundarban"
        <?php

        if(
            ($order['courier'] ?? '')
            === 'Sundarban'
        )
            echo "selected";

        ?>>

            Sundarban

        </option>

    </select>

</div>



<!-- =========================
     TRACKING
========================= -->

<div class="mb-4">

    <label class="form-label">

        Tracking ID

    </label>

    <input
    type="text"
    name="tracking_id"
    class="form-control"
    placeholder="Enter tracking number"
    value="<?php

    echo htmlspecialchars(
        $order['tracking_id'] ?? ''
    );

    ?>">

</div>



<!-- =========================
     ESTIMATED DELIVERY
========================= -->

<div class="mb-4">

    <label class="form-label">

        Estimated Delivery

    </label>

    <input
    type="date"
    name="estimated_delivery"
    class="form-control"
    value="<?php

    echo htmlspecialchars(
        $order['estimated_delivery'] ?? ''
    );

    ?>">

</div>



<!-- =========================
     CANCEL BOX
========================= -->

<div
class="mb-4"
id="cancelBox">


    <div class="cancel-warning">

        <i class="fa-solid fa-triangle-exclamation"></i>

        <div>

            This order will be marked as
            <strong>Cancelled</strong>.
            The cancellation time and admin
            cancellation information will be saved.

        </div>

    </div>


    <label class="form-label">

        Cancellation Reason

    </label>


    <textarea
    name="cancel_reason"
    id="cancelReason"
    class="form-control"
    rows="3"
    placeholder="Reason for cancellation"><?php

    echo htmlspecialchars(
        $order['cancel_reason'] ?? ''
    );

    ?></textarea>

</div>



<!-- =========================
     ACTIONS
========================= -->

<div class="actions">


    <a
    href="orders.php"
    class="btn-back">

        <i class="fa-solid fa-arrow-left me-2"></i>

        Back

    </a>


    <button
    type="submit"
    name="update_order"
    class="btn-update">

        <i class="fa-solid fa-check me-2"></i>

        Save Changes

    </button>


</div>


</form>


</div>


</div>



<script>

const status =
document.getElementById("orderStatus");

const cancelBox =
document.getElementById("cancelBox");

const cancelReason =
document.getElementById("cancelReason");


function checkStatus(){

    if(
        status.value === "Cancelled"
    ){

        cancelBox.style.display =
            "block";

        cancelReason.required = true;

    }else{

        cancelBox.style.display =
            "none";

        cancelReason.required = false;

    }

}


status.addEventListener(
    "change",
    checkStatus
);


checkStatus();

</script>


</body>

</html>