<?php

include("connect.php");

if(isset($_POST['add'])){

$title=$_POST['title'];
$subtitle=$_POST['subtitle'];
$button_text=$_POST['button_text'];
$button_link=$_POST['button_link'];

$image=$_FILES['image']['name'];

move_uploaded_file(
$_FILES['image']['tmp_name'],
"../uploads/".$image
);

mysqli_query($conn,

"INSERT INTO home_slider
(title,subtitle,image,button_text,button_link)

VALUES

('$title','$subtitle','$image',
'$button_text','$button_link')"

);

echo "Slider Added";

}

?>
