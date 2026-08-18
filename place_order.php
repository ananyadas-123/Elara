<?php

session_start();

include("includes/connect.php");

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

$name = mysqli_real_escape_string(
$conn,
$_POST['name']
);

$phone = mysqli_real_escape_string(
$conn,
$_POST['phone']
);

$address = mysqli_real_escape_string(
$conn,
$_POST['address']
);

$payment_method = mysqli_real_escape_string(
$conn,
$_POST['payment_method']
);

$order_type = $_POST['order_type'];

/* ================= CALCULATE TOTAL PRICE ================= */

$total_price = 0;

if($order_type == "buy_now"){

    $product_id = (int)$_POST['product_id'];

    $product_query = mysqli_query($conn,
    "SELECT * FROM products WHERE id='$product_id'");

    $product = mysqli_fetch_assoc($product_query);

    if(!$product){
        die("Product not found");
    }

    $total_price = $product['price'];

}else{

    $cart_query = mysqli_query($conn,
    "SELECT * FROM cart WHERE user_id='$user_id'");

    while($cart=mysqli_fetch_assoc($cart_query)){

        $product_id = $cart['product_id'];

        $product_query = mysqli_query($conn,
        "SELECT price FROM products
        WHERE id='$product_id'");

        $product = mysqli_fetch_assoc($product_query);

        $total_price +=
        ($product['price'] * $cart['quantity']);

    }

}

/* INSERT ORDER */

mysqli_query($conn,

"INSERT INTO orders(

user_id,
name,
phone,
address,
total_price,
payment_method,
order_status,
payment_status,
order_date

)

VALUES(

'$user_id',
'$name',
'$phone',
'$address',
'$total_price',
'$payment_method',
'Pending',
'Pending',
NOW()

)"

);

$order_id = mysqli_insert_id($conn);

/* GET CART ITEMS */

if($order_type == "buy_now"){

    $product_id = $_POST['product_id'];

    $product_query = mysqli_query(
    $conn,
    "SELECT * FROM products
    WHERE id='$product_id'"
    );

    $product = mysqli_fetch_assoc(
    $product_query
    );

mysqli_query($conn,

"INSERT INTO order_items(

order_id,
product_id,
product_name,
product_price,
quantity

)

VALUES(

'$order_id',
'$product_id',
'".$product['name']."',
'".$product['price']."',
'1'

)"

);

    mysqli_query($conn,

    "UPDATE products

    SET stock = stock - 1

    WHERE id='$product_id'"

    );

}else{

    $cart_query = mysqli_query($conn,

    "SELECT * FROM cart
    WHERE user_id='$user_id'"

    );

    while($cart=mysqli_fetch_assoc($cart_query)){

        $product_id = $cart['product_id'];

        $quantity = $cart['quantity'];

        $product_query = mysqli_query(
        $conn,
        "SELECT * FROM products
        WHERE id='$product_id'"
        );

        $product = mysqli_fetch_assoc(
        $product_query
        );

        $price = $product['price'];

        mysqli_query($conn,

"INSERT INTO order_items(

order_id,
product_id,
product_name,
product_price,
quantity

)

VALUES(

'$order_id',
'$product_id',
'".$product['name']."',
'$price',
'$quantity'

)"

);

        mysqli_query($conn,

        "UPDATE products

        SET stock = stock - $quantity

        WHERE id='$product_id'"

        );

    }

    mysqli_query($conn,

    "DELETE FROM cart
    WHERE user_id='$user_id'"

    );

}

 /* SUCCESS */

header(
"Location: order_success.php?id=".$order_id
);
exit();

?>