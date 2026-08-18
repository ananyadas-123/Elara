<?php
$conn = mysqli_connect("localhost","root","","elara_db");

$brand = $_GET['brand'];
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $brand; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
  <h2 class="text-center"><?php echo strtoupper($brand); ?> Shoes</h2>

  <div class="row mt-4">

  <?php
  $query = "SELECT * FROM products WHERE brand='$brand'";
  $result = mysqli_query($conn,$query);

  while($row = mysqli_fetch_assoc($result)) {
  ?>

    <div class="col-md-4">
      <div class="card text-center mb-4">
        <img src="images/products/<?php echo $row['image']; ?>">
        <div class="card-body">
          <h5><?php echo $row['name']; ?></h5>
          <p>৳<?php echo $row['price']; ?></p>
        </div>
      </div>
    </div>

  <?php } ?>

  </div>
</div>

</body>
</html>