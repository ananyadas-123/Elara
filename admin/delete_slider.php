<?php

include('../includes/connect.php');

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM home_slider
WHERE id='$id'");

header("Location: manage_slider.php");

?>