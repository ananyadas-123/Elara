<?php
session_start();
include("../includes/connect.php");

if(!isset($_SESSION['id'])){
exit();
}

$products = mysqli_query($conn,
"SELECT * FROM products ORDER BY id DESC");
?>

<style>

.table-box{
background:rgba(255,255,255,0.05);
border-radius:20px;
padding:25px;
backdrop-filter:blur(15px);
border:1px solid rgba(255,255,255,0.08);
overflow-x:auto;
}

table{
width:100%;
border-collapse:collapse;
min-width:1000px;
}

th{
padding:16px;
background:rgba(255,255,255,0.05);
font-size:14px;
font-weight:700;
text-transform:uppercase;
color:#cbd5e1;
}

td{
padding:16px;
border-bottom:1px solid rgba(255,255,255,0.06);
color:#f1f5f9;
vertical-align:middle;
}

tr{
transition:.3s;
}

tr:hover{
background:rgba(255,255,255,0.04);
}

/* PRODUCT IMAGE */

.product-img{
width:70px;
height:70px;
border-radius:16px;
object-fit:cover;
border:2px solid rgba(255,255,255,0.1);
}

/* PRODUCT NAME */

.product-name{
font-size:15px;
font-weight:700;
color:white;
}

.brand{
font-size:12px;
color:#94a3b8;
margin-top:3px;
}

/* CATEGORY */

.category-badge{
padding:8px 14px;
border-radius:30px;
background:rgba(59,130,246,0.15);
color:#60a5fa;
font-size:12px;
font-weight:700;
border:1px solid #3b82f6;
display:inline-block;
}

/* PRICE */

.price{
font-size:15px;
font-weight:800;
color:#22c55e;
}

/* BUTTONS */

.action-btn{
padding:10px 16px;
border-radius:12px;
text-decoration:none;
font-size:13px;
font-weight:700;
display:inline-flex;
align-items:center;
justify-content:center;
transition:.3s;
border:none;
}

.delete-btn{
background:linear-gradient(45deg,#ef4444,#dc2626);
color:white;
}

.delete-btn:hover{
transform:translateY(-3px);
box-shadow:0 10px 20px rgba(239,68,68,0.35);
color:white;
}

/* HEADER */

.header-box{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
flex-wrap:wrap;
gap:15px;
}

.header-box h3{
margin:0;
font-size:28px;
font-weight:800;
}

.total-box{
padding:12px 18px;
background:rgba(255,255,255,0.05);
border-radius:14px;
border:1px solid rgba(255,255,255,0.08);
font-weight:700;
color:#cbd5e1;
}

/* EMPTY */

.empty-box{
padding:40px;
text-align:center;
background:rgba(255,255,255,0.04);
border-radius:18px;
font-size:18px;
color:#94a3b8;
}

</style>

<!-- HEADER -->

<div class="header-box">

<h3>🛍 Products Management</h3>

<div class="total-box">

Total Products :
<?php echo mysqli_num_rows($products); ?>

</div>

</div>

<!-- TABLE -->

<div class="table-box">

<?php if(mysqli_num_rows($products) > 0){ ?>

<table>

<tr>

<th>ID</th>
<th>Image</th>
<th>Product</th>
<th>Category</th>
<th>Price</th>
<th>Action</th>

</tr>

<?php while($row = mysqli_fetch_assoc($products)){ ?>

<tr>

<td>

#<?php echo $row['id']; ?>

</td>

<td>

<img
src="../uploads/<?php echo $row['image']; ?>"
class="product-img">

</td>

<td>

<div class="product-name">
<?php echo $row['name']; ?>
</div>

<div class="brand">
Brand :
<?php echo $row['brand']; ?>
</div>

</td>

<td>

<div class="category-badge">
<?php echo $row['category']; ?>
</div>

</td>

<td>

<div class="price">
₹<?php echo $row['price']; ?>
</div>

</td>

<td>

<a
href="delete.php?id=<?php echo $row['id']; ?>"
class="action-btn delete-btn"
onclick="return confirm('Delete this product?')">

🗑 Delete

</a>

</td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<div class="empty-box">

No Products Found

</div>

<?php } ?>

</div>