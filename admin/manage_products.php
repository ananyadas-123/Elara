<?php

include("connect.php");

$query=mysqli_query($conn,
"SELECT products.*,
categories.category_name AS category_name

FROM products

LEFT JOIN categories

ON products.category_id=categories.id

ORDER BY products.id DESC");

if(!$query){

    die(mysqli_error($conn));

}

?>

<style>

.table-box{

background:#111827;

padding:25px;

border-radius:20px;

overflow-x:auto;

}

table{
width:100%;
min-width:900px;
border-collapse:collapse;
}

th,td{
padding:16px;
}

.product-img{

width:70px;
height:70px;

object-fit:cover;

border-radius:12px;

}
tr:hover{
background:#1f2937;
transition:.3s;
}

.action-btn{

padding:10px 16px;

border-radius:10px;

text-decoration:none;

font-weight:700;

color:white;

}

.edit-btn{
background:#2563eb;
}

.delete-btn{
background:#dc2626;
}

</style>

<h3 class="mb-4">
🛍 Products Management
</h3>

<div class="table-box">

<table>

<tr>

<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Brand</th>
<th>Category</th>
<th>Price</th>
<th>Rating</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>

<img
src="uploads/<?php echo $row['image']; ?>"
class="product-img">

</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['brand']; ?>
</td>

<td>
<?php echo $row['category_name']; ?>
</td>

<td>
₹<?php echo $row['price']; ?>
</td>

<td>
⭐ <?php echo $row['rating']; ?>
</td>

<td>

<a
href="edit_product.php?id=<?php echo $row['id']; ?>"
class="action-btn edit-btn">

Edit

</a>
<a
href="delete_product.php?id=<?php echo $row['id']; ?>"
class="action-btn delete-btn"
onclick="return confirm('Are you sure?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>