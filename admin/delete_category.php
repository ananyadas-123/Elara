<?php
include("connect.php");

$id = intval($_GET['id']);

mysqli_query($conn,
"DELETE FROM categories WHERE id='$id'");

header("Location: dashboard.php");
exit();
?>