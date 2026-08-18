<?php

session_start();
include("includes/connect.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_query = mysqli_query(
$conn,
"SELECT * FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($user_query);

$total = 0;
$is_buy_now = false;

if(
    isset($_GET['type']) &&
    $_GET['type']=="buy_now" &&
    isset($_SESSION['buy_now_product'])
){

    $is_buy_now = true;

    $product_id = $_SESSION['buy_now_product'];

    $query = mysqli_query($conn,
    "SELECT * FROM products
    WHERE id='$product_id'");

}else{

    $query = mysqli_query($conn,
    "SELECT products.*,cart.quantity
    FROM cart
    JOIN products
    ON cart.product_id = products.id
    WHERE cart.user_id='$user_id'");

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Checkout</title>

<link href="Assets/bootstrap/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    background: linear-gradient(135deg,#0f172a,#111827);
    font-family: 'Segoe UI',sans-serif;
    color:#fff;
    min-height:100vh;
}

.navbar{
    background:rgba(2,6,23,.9);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(255,255,255,.05);
    padding:15px 0;
}

h2{
    font-weight:700;
    letter-spacing:.5px;
}

.checkout-box{
    background:#111827;
    border:1px solid rgba(255,255,255,.06);
    border-radius:24px;
    padding:35px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.25),
    inset 0 1px 0 rgba(255,255,255,.03);
    transition:.3s;
}

.checkout-box:hover{
    transform:translateY(-2px);
}

.checkout-box h4{
    font-weight:700;
    margin-bottom:25px;
    color:#f8fafc;
}

label{
    color:#cbd5e1;
    font-weight:600;
    margin-bottom:8px;
    display:block;
}

.form-control{
    background:#1e293b;
    border:1px solid rgba(255,255,255,.08);
    color:#fff;
    padding:14px 16px;
    border-radius:14px;
    transition:.3s;
}

.form-control:focus{
    background:#1e293b;
    color:#fff;
    border-color:#7c3aed;
    box-shadow:0 0 0 4px rgba(124,58,237,.15);
}

textarea.form-control{
    resize:none;
}

.order-box{
    background:#1e293b;
    border:1px solid rgba(255,255,255,.06);
    padding:18px;
    border-radius:18px;
    margin-bottom:15px;
    transition:.3s;
}

.order-box:hover{
    border-color:rgba(124,58,237,.4);
    transform:translateY(-2px);
}

.order-box h5{
    font-size:18px;
    font-weight:700;
    margin-bottom:10px;
}

.order-box p{
    margin-bottom:6px;
    color:#cbd5e1;
}

.total-box{
    margin-top:20px;
    background:linear-gradient(
        135deg,
        rgba(124,58,237,.18),
        rgba(124,58,237,.08)
    );
    border:1px solid rgba(124,58,237,.25);
    border-radius:18px;
    padding:25px;
    text-align:center;
}

.total-box h4{
    color:#cbd5e1;
    margin-bottom:10px;
}

.total-box h2{
    font-size:38px;
    font-weight:800;
    margin:0;
    color:#22c55e;
}

.place-btn{
    width:100%;
    border:none;
    border-radius:16px;
    padding:16px;
    font-size:17px;
    font-weight:700;
    color:white;
    background:linear-gradient(
        135deg,
        #7c3aed,
        #9333ea
    );
    transition:.3s;
    margin-top:10px;
}

.place-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 25px rgba(124,58,237,.35);
}

.place-btn:active{
    transform:scale(.98);
}

@media(max-width:768px){

    .checkout-box{
        padding:25px;
    }

    .total-box h2{
        font-size:30px;
    }

}

</style>

</head>

<body>

    <?php include('includes/navbar.php'); ?>

    <div class="container py-5">

<h2 class="mb-4">
<i class="fa fa-credit-card"></i>
Checkout
</h2>

<div class="row g-4">

    <!-- LEFT SIDE -->

    <div class="col-lg-7">

        <div class="checkout-box">

            <h4 class="mb-4">
                Shipping Information
            </h4>

            <form action="place_order.php" method="POST">

    <?php if($is_buy_now){ ?>

        <input type="hidden" name="order_type" value="buy_now">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

    <?php } else { ?>

        <input type="hidden" name="order_type" value="cart">

    <?php } ?>

    <div class="mb-3">
        <label>Full Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>"
            required>
    </div>

    <div class="mb-3">
        <label>Phone Number</label>
        <input
            type="tel"
            name="phone"
            class="form-control"
            value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"
            required>
    </div>

    <div class="mb-3">
        <label>Shipping Address</label>
        <textarea
            name="address"
            rows="4"
            class="form-control"
            required><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
    </div>

    <div class="mb-3">
        <label>Payment Method</label>
        <select
            name="payment_method"
            class="form-control"
            required>

            <option value="Cash On Delivery">
                Cash On Delivery
            </option>

        </select>
    </div>

    <!-- IMPORTANT -->
    <input
        type="hidden"
        name="total_price"
        value="<?php echo $total; ?>">

    <button
        type="submit"
        class="place-btn">
        <i class="fa-solid fa-check me-2"></i>
        Place Order
    </button>

</form>

        </div>

    </div>

    <!-- RIGHT SIDE -->

    <div class="col-lg-5">

        <div class="checkout-box">

            <h4 class="mb-4">
                Order Summary
            </h4>

            <?php

            mysqli_data_seek($query,0);

            while($item=mysqli_fetch_assoc($query)){

                $qty = $is_buy_now ? 1 : $item['quantity'];
                $subtotal = $item['price'] * $qty;
                $total += $subtotal;

            ?>

            <div class="order-box">

                <h5>
                <?php echo $item['name']; ?>
                </h5>

                <p>
                Qty:
                <?php echo $qty; ?>
                </p>

                <p>
                ₹<?php echo $item['price']; ?>
                </p>

                <p>
                Subtotal: ₹<?php echo $subtotal; ?>
                </p>

            </div>

            <?php } ?>

            <div class="total-box">

                <h4>Total</h4>

                <h2 class="text-success">

                ₹<?php echo $total; ?>

                </h2>

            </div>

        </div>

    </div>

</div>

</div>

<script src="Assets/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>