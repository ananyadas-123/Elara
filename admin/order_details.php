<?php

include("../includes/connect.php");

$id = $_GET['id'];

$query = mysqli_query($conn,

"SELECT * FROM orders
WHERE id='$id'");

$order = mysqli_fetch_assoc($query);

if(!$order){
die("Order Not Found");
}

?>

<?php

if(isset($_POST['update'])){

    $status = mysqli_real_escape_string($conn,$_POST['order_status']);
    $payment = mysqli_real_escape_string($conn,$_POST['payment_status']);
    $tracking = mysqli_real_escape_string($conn,$_POST['tracking_id']);
    $courier = mysqli_real_escape_string($conn,$_POST['courier']);
    $delivery = $_POST['estimated_delivery'];
$extra = "";

if($status=="Delivered"){
    $extra .= ",
    delivered_at = NOW()";
}

if($status=="Cancelled"){
    $extra .= ",
    cancelled_at = NOW()";
}
if($status=="Delivered"){
    $payment="Paid";
}
if($status=="Shipped" && empty($tracking)){

echo "<script>

alert('Tracking ID Required');

history.back();

</script>";

exit();

}

mysqli_query($conn,

"UPDATE orders SET

order_status='$status',

payment_status='$payment',

tracking_id='$tracking',

courier='$courier',

estimated_delivery='$delivery'

$extra

WHERE id='$id'

");

    echo "<script>
    alert('Order Updated Successfully');
    location.href='order_details.php?id=$id';
    </script>";

    exit();

}

?>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                <i class="fa fa-box me-2"></i>

                Order Details

            </h2>

            <p class="text-muted">

            Manage customer order and delivery.

            </p>

        </div>

        <a href="#"
        onclick="loadPage('orders.php')"
        class="btn btn-dark">

            <i class="fa fa-arrow-left"></i>

            Back

        </a>

    </div>
    <div class="card shadow-lg border-0 rounded-4 p-4 mb-4">

        <h2>

        Order #EL<?php echo $order['id']; ?>

        </h2>

        <p>

        Customer :

        <?php echo $order['name']; ?>

        </p>

        <p>

        Phone :

        <?php echo $order['phone']; ?>

        </p>

        <p>

        Address :

        <?php echo $order['address']; ?>

        </p>

    </div>

    <div class="card shadow-lg border-0 rounded-4 p-4 mb-4">

        <h3>

        Payment Details

        </h3>

        <p>

        Amount :

        ₹<?php echo number_format($order['total_price']);?>

        </p>

        <p>

        Method :

        <?php echo $order['payment_method'];?>

        </p>

        <p>

        Status :

        <?php echo $order['payment_status'];?>

        </p>

    </div>

    <div class="card shadow-lg border-0 rounded-4 p-4">

        <h3>

        Update Order

        </h3>

        <form method="POST">

            <label>

            Order Status

            </label>

            <select
            name="order_status"
            class="form-select mb-3">

                <option
                <?php if($order['order_status']=="Pending") echo "selected";?>>

                Pending

                </option>

                <option
                <?php if($order['order_status']=="Processing") echo "selected";?>>

                Processing

                </option>

                <option
                <?php if($order['order_status']=="Shipped") echo "selected";?>>

                Shipped

                </option>

                <option
                <?php if($order['order_status']=="Delivered") echo "selected";?>>

                Delivered

                </option>

                <option <?php if($order['order_status']=="Cancelled") echo "selected";?>>
                Cancelled
                </option>

            </select>

            <label>

            Payment Status

            </label>

            <select
            name="payment_status"
            class="form-select mb-3">

                <option
                <?php if($order['payment_status']=="Pending") echo "selected";?>>

                Pending

                </option>

                <option
                <?php if($order['payment_status']=="Paid") echo "selected";?>>

                Paid

                </option>

                <option
                <?php if($order['payment_status']=="Failed") echo "selected";?>>

                Failed

                </option>

            </select>

            <label class="fw-bold">

            Tracking ID

            </label>

            <input
            type="text"
            name="tracking_id"
            class="form-control mb-2"
            placeholder="Enter Tracking ID"
            value="<?php echo $order['tracking_id'];?>">

            <small class="text-muted d-block mb-3">

            Example :
            DEL123456789

            </small>

            <label class="fw-bold">

            Courier Company

            </label>

            <input
            type="text"
            name="courier"
            class="form-control mb-2"
            placeholder="Pathao / RedX / SteadFast"
            value="<?php echo $order['courier'];?>">

            <small class="text-muted d-block mb-3">

            Example :

            Pathao

            RedX

            SteadFast

            Sundarban

            </small>

            <label class="fw-bold">
Estimated Delivery
</label>

<input
type="date"
name="estimated_delivery"
class="form-control mb-3"
value="<?php echo $order['estimated_delivery']; ?>">

            <button

            name="update"

            class="btn btn-success px-4">

            Update Order

            </button>

        </form>

    </div>

    <div class="mt-4">

        <a
        href="orders.php"

        class="btn btn-dark">

        Back

        </a>

    </div>

</div>
<script>

const status=document.querySelector('[name=order_status]');
const tracking=document.querySelector('[name=tracking_id]');

status.onchange=function(){

if(this.value=="Shipped"){

tracking.required=true;

}else{

tracking.required=false;

}

}

</script>
