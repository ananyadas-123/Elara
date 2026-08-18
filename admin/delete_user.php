<?php

session_start();
include("../includes/connect.php");

if(!isset($_SESSION['id'])){
header("Location: login.php");
exit();
}

if(isset($_GET['id'])){

$id = intval($_GET['id']);

$query = mysqli_query($conn,
"SELECT * FROM users WHERE id='$id'");

$user = mysqli_fetch_assoc($query);

if($user){

$image = "../uploads/".$user['image'];

if(file_exists($image)){
unlink($image);
}

mysqli_query($conn,
"DELETE FROM users WHERE id='$id'");

}

}

header("Location: dashboard.php");
exit();

?>