<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: home.php");
    exit();
}

$_SESSION['buy_now_product'] = $_GET['id'];

header("Location: checkout.php?type=buy_now");
exit();

?>

<!DOCTYPE html>
<html>
<head>

<title>Buy Now</title>

<link href="Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#0f172a;color:white;">

<div class="container py-5">

<h2 class="mb-4">Checkout</h2>

<div class="card bg-dark text-white p-4">

<h3><?php echo $product['name']; ?></h3>

<p>Price: ₹<?php echo $product['price']; ?></p>

<form action="place_buy_order.php" method="POST">

<input type="hidden"
name="product_id"
value="<?php echo $product['id']; ?>">

<input type="hidden"
name="price"
value="<?php echo $product['price']; ?>">

<div class="mb-3">

<label>Name</label>

<input type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Phone</label>

<input type="text"
name="phone"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Address</label>

<textarea
name="address"
class="form-control"
required></textarea>

</div>

<button class="btn btn-primary">

Place Order

</button>

</form>

</div>

</div>
<?php include('profile.php'); ?>

</body>
</html>