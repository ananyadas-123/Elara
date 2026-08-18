<?php

include("connect.php");

if(isset($_POST['add'])){

$title = $_POST['title'];
$description = $_POST['description'];
$link = $_POST['link'];

$image = $_FILES['image']['name'];

move_uploaded_file(
$_FILES['image']['tmp_name'],
"../uploads/".$image
);

mysqli_query($conn,

"INSERT INTO featured_collections
(title,description,image,link)

VALUES

('$title','$description','$image','$link')"

);

echo "<script>alert('Collection Added');</script>";

}
?>