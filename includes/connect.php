<?php
$conn = mysqli_connect("localhost","root","","elara");

if (!$conn) {
    echo("Connection failed: " . mysqli_connect_error());
}

?>
