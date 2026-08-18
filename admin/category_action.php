<?php

session_start();

include("connect.php");

/* ================= ADD CATEGORY ================= */

if(isset($_POST['submit'])){

    $category_name = $_POST['category_name'];

    $check = mysqli_query(

    $conn,

    "SELECT * FROM categories

    WHERE category_name='$category_name'"

    );

    if(mysqli_num_rows($check) > 0){

        $_SESSION['msg'] =
        "Category Already Exists";

    }else{

        $insert = mysqli_query(

        $conn,

        "INSERT INTO categories(category_name)

        VALUES('$category_name')"

        );

        if($insert){

            $_SESSION['msg'] =
            "Category Added Successfully";

        }else{

            $_SESSION['msg'] =
            mysqli_error($conn);

        }

    }

    header("Location: dashboard.php?page=add_category");

    exit();

}

/* ================= UPDATE CATEGORY ================= */

if(isset($_POST['update'])){

    $id = $_POST['id'];

    $category_name = $_POST['category_name'];

    $update = mysqli_query(

    $conn,

    "UPDATE categories

    SET category_name='$category_name'

    WHERE id='$id'"

    );

    if($update){

        $_SESSION['msg'] =
        "Category Updated Successfully";

    }else{

        $_SESSION['msg'] =
        "Failed To Update";

    }

    header("Location: dashboard.php?page=categories");

    exit();

}

/* ================= DELETE CATEGORY ================= */

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    $delete = mysqli_query(

    $conn,

    "DELETE FROM categories

    WHERE id='$delete_id'"

    );

    if($delete){

        $_SESSION['msg'] =
        "Category Deleted Successfully";

    }else{

        $_SESSION['msg'] =
        "Failed To Delete";

    }

    header("Location: dashboard.php?page=categories");

    exit();

}

?>