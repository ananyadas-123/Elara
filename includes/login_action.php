<?php
    // session_start();
    // include('connect.php');
    // global $conn;
    // if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['login']))
    // {

    //     $email = $_POST['email'];
    //     $password = md5($_POST['password']);   // md5 again

    //     $check = "SELECT * FROM users WHERE email='$email'";
    //     $run = mysqli_query($conn,$check);

    //     if(mysqli_num_rows($run)>0)
    //     {
    //         $data = mysqli_fetch_assoc($run);

    //         if($data['password'] == $password)
    //         {
    //             $_SESSION['user_id'] = $data['id'];
    //             $_SESSION['user_name'] = $data['name'];
    //             $_SESSION['image']=$data['image'];

    //             // header("Location: dashboard.php");
    //             // exit();
    //             header("location:dashboard.php");
    //             exit();
    //         }
    //         else
    //         {
    //            header("Location:../index1.php");
    //             exit();
                
    //         }
    //     }
    //     else
    //     {
    //         header("Location:index1.php");
    //          exit();
    //     }

    // }



session_start();
include('connect.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // MD5 PASSWORD
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email'";
    $run = mysqli_query($conn, $query);

    if(mysqli_num_rows($run) > 0)
    {
        $user = mysqli_fetch_assoc($run);

        if($user['password'] == $password)
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['image'] = $user['image'];

            $_SESSION['welcome_type'] = "back";

            header("Location: ../home.php");
            exit();
        }
        else
        {
            echo "<script>
            alert('Wrong Password');
            window.location.href='../index.php';
            </script>";
        }
    }
    else
    {
        echo "<script>
        alert('Email not found');
        window.location.href='../index.php';
        </script>";
    }
}

?>