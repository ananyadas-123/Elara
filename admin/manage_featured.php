<?php

include("connect.php");

$q = mysqli_query($conn,
"SELECT * FROM featured_collections
ORDER BY id DESC");

?>

<div class="d-flex justify-content-between mb-4">

<h3>Featured Collections</h3>

<a href="#" onclick="loadPage('add_featured.php')"
class="btn btn-primary">
+ Add Featured Collection
</a>

</div>

<table class="table table-dark table-hover">

<tr>

<th>Image</th>
<th>Title</th>
<th>Description</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($q)){ ?>

<tr>

<td>

<img
src="../uploads/<?php echo $row['image']; ?>"
width="120">

</td>

<td>

<?php echo $row['title']; ?>

</td>

<td>

<?php echo $row['description']; ?>

</td>

<td>

<a
href="delete_featured.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>