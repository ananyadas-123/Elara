<?php

session_start();

include('connect.php');

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

$id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$id'";

$run = mysqli_query($conn,$query);

$user = mysqli_fetch_assoc($run);

?>