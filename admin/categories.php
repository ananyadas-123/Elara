<?php

session_start();

include("connect.php");

/* DELETE CATEGORY */

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query(

    $conn,

    "DELETE FROM categories

    WHERE id='$delete_id'"

    );

    $_SESSION['msg'] =
    "Category Deleted Successfully";

}

/* FETCH CATEGORY */

$categories = mysqli_query($conn,"SELECT * FROM categories ORDER BY id DESC");

?>

<style>

    .category-box{

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

    border-radius:24px;

    padding:30px;

    }

    /* TITLE */

    .category-title{

    font-size:32px;

    font-weight:800;

    margin-bottom:25px;

    color:#60a5fa;

    }

    /* MESSAGE */

    .alert-box{

    padding:14px 18px;

    border-radius:14px;

    background:
    rgba(37,99,235,.15);

    margin-bottom:20px;

    color:#bfdbfe;

    font-weight:600;

    }

    /* TABLE */

    .table{

    color:white;

    }

    .table thead{

    background:#2563eb;

    }

    .table thead th{

    padding:16px;

    border:none;

    }

    .table tbody tr{

    background:
    rgba(255, 255, 255, 0.03);

    }

    .table tbody td{

    padding:16px;

    vertical-align:middle;

    border-color:
    rgba(128, 177, 245, 0.05);

    }


    /* BUTTONS */

    .btn-delete{

    padding:10px 18px;

    border:none;

    border-radius:12px;

    background:#ef4444;

    color:white;

    font-weight:700;

    text-decoration:none;

    display:inline-block;

    }

</style>

<div class="category-box">

    <h2 class="category-title">Manage Categories</h2>

    <?php if(isset($_SESSION['msg'])){ ?>

    <div class="alert-box">

        <?php

            echo $_SESSION['msg'];

            unset($_SESSION['msg']);

        ?>

    </div>

    <?php } ?>

    <div class="table-responsive">

    <table class="table align-middle">


        <thead>

            <tr>

                <th>ID</th>

                <th>Category</th>


                <th>Delete</th>

            </tr>

        </thead>

        <tbody>

            <?php while($row=mysqli_fetch_assoc($categories)){ ?>

            <tr>

                <form method="POST">

                    <td style="color:white;">

                        <?php echo $row['id']; ?>


                    </td>

                    <td style="color:white;">

                        <?php echo $row['category_name']; ?>

                    </td>

                    <td>

                        <a href="categories.php?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Delete this category?')">Delete</a>

                    </td>

                </form>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

</div>