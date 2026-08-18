<?php

session_start();
include('connect.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // MD5 PASSWORD
    $password = md5($_POST['password']);

    $gender = $_POST['gender'];

    // IMAGE
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $folder = "../uploads/" . $image;

    // CHECK EMAIL
    $check = "SELECT * FROM users WHERE email='$email'";
    $run = mysqli_query($conn, $check);

    if(mysqli_num_rows($run) > 0)
    {
        echo "<script>
        alert('Email already exists');
        window.location.href='../register.php';
        </script>";
    }
    else
    {
        move_uploaded_file($tmp, $folder);

        $insert = "INSERT INTO users(name,email,password,gender,image)
                   VALUES('$name','$email','$password','$gender','$image')";

        $query = mysqli_query($conn, $insert);

        if($query)
        {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['user_name'] = $name;
            $_SESSION['image'] = $image;

            $_SESSION['welcome_type'] = "new";
            header("Location: ../dashboard.php");
            exit();
        }
        else
        {
            echo "Registration Failed";
        }
    }
}


?>