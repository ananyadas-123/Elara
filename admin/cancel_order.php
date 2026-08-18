<?php

session_start();
include("includes/connect.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = (int)$_GET['id'];

/* Order Check */

$q = mysqli_query($conn,"
SELECT *
FROM orders
WHERE id='$order_id'
AND user_id='$user_id'
");

if(mysqli_num_rows($q)==0){
    die("Invalid Order");
}

$order = mysqli_fetch_assoc($q);

/* Only Pending Order Cancel */

if($order['order_status']!="Pending"){
    die("This order can't be cancelled.");
}


/* Restore Stock */

$item_q=mysqli_query($conn,"
SELECT *
FROM order_items
WHERE order_id='$order_id'
");

while($item=mysqli_fetch_assoc($item_q)){

    mysqli_query($conn,"
    UPDATE products
    SET stock=stock+".$item['quantity']."
    WHERE id='".$item['product_id']."'
    ");

}


/* Update Order */

mysqli_query($conn,"
UPDATE orders
SET
order_status='Cancelled',
cancelled_at=NOW()
WHERE id='$order_id'
");

header("Location: order_details.php?id=".$order_id);

?>