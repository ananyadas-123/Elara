<?php

include("connect.php");

$q =
mysqli_query($conn,
"SELECT * FROM home_slider
ORDER BY id DESC");

?>

<h3>Home Slider</h3>

<a href="#"
class="btn btn-success mb-3"
onclick="loadPage('add_slider.php')">

Add Slider

</a>

<table class="table table-dark">

<tr>
<th>Image</th>
<th>Title</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($q)){ ?>

<tr>

<td>

<img src="../uploads/<?php echo $row['image']; ?>"
width="120">

</td>

<td>

<?php echo $row['title']; ?>

</td>

<td>

<a href="delete_slider.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>