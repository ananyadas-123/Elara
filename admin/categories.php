<?php

session_start();

include("connect.php");

/* ================= DELETE CATEGORY ================= */

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query(
        $conn,
        "DELETE FROM categories WHERE id='$delete_id'"
    );

    $_SESSION['msg'] = "Category Deleted Successfully";

    header("Location: categories.php");
    exit;
}


/* ================= FETCH CATEGORY ================= */

$categories = mysqli_query(
    $conn,
    "SELECT * FROM categories ORDER BY id DESC"
);

?>

<style>

/* ================= CATEGORY BOX ================= */

.category-box{

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

    border-radius:24px;

    padding:30px;

}


/* ================= HEADER ================= */

.category-header{

    display:flex;

    align-items:center;

    justify-content:space-between;

    gap:20px;

    margin-bottom:25px;

}


/* ================= TITLE ================= */

.category-title{

    font-size:32px;

    font-weight:800;

    margin:0;

    color:#60a5fa;

}


/* ================= ADD CATEGORY BUTTON ================= */

.add-category-btn{

    display:inline-flex;

    align-items:center;

    gap:9px;

    padding:12px 20px;

    border-radius:14px;

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );

    color:white;

    font-weight:700;

    text-decoration:none;

    border:1px solid rgba(255,255,255,.1);

    box-shadow:
    0 10px 25px rgba(37,99,235,.25);

    transition:.3s;

}


.add-category-btn:hover{

    color:white;

    transform:translateY(-3px);

    box-shadow:
    0 15px 35px rgba(37,99,235,.4);

}


/* ================= MESSAGE ================= */

.alert-box{

    padding:14px 18px;

    border-radius:14px;

    background:
    rgba(37,99,235,.15);

    border:
    1px solid rgba(96,165,250,.15);

    margin-bottom:20px;

    color:#bfdbfe;

    font-weight:600;

}


/* ================= TABLE ================= */

.table{

    color:white;

    margin-bottom:0;

}


.table thead{

    background:#2563eb;

}


.table thead th{

    padding:16px;

    border:none;

    color:white;

    font-weight:700;

}


.table thead th:first-child{

    border-radius:10px 0 0 10px;

}


.table thead th:last-child{

    border-radius:0 10px 10px 0;

}


.table tbody tr{

    background:
    rgba(255,255,255,.03);

    transition:.25s;

}


.table tbody tr:hover{

    background:
    rgba(255,255,255,.07);

}


.table tbody td{

    padding:16px;

    vertical-align:middle;

    border-color:
    rgba(128,177,245,.05);

}


/* ================= DELETE BUTTON ================= */

.btn-delete{

    padding:10px 18px;

    border:none;

    border-radius:12px;

    background:#ef4444;

    color:white;

    font-weight:700;

    text-decoration:none;

    display:inline-flex;

    align-items:center;

    gap:7px;

    transition:.3s;

}


.btn-delete:hover{

    background:#dc2626;

    color:white;

    transform:translateY(-2px);

}


/* ================= EMPTY STATE ================= */

.empty-category{

    text-align:center;

    padding:50px 20px;

    color:#94a3b8;

}


.empty-category i{

    font-size:45px;

    margin-bottom:15px;

    color:#60a5fa;

}


/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    .category-header{

        flex-direction:column;

        align-items:stretch;

    }


    .category-title{

        font-size:26px;

    }


    .add-category-btn{

        justify-content:center;

        width:100%;

    }

}

</style>


<div class="category-box">


    <!-- ================= HEADER ================= -->

    <div class="category-header">

        <h2 class="category-title">

            Manage Categories

        </h2>


        <!-- ADD CATEGORY -->

        <a href="add_category.php"
   class="add-category-btn"
   onclick="loadPage('add_category.php'); return false;">

    <i class="fa-solid fa-plus"></i>
    Add Category

</a>

    </div>



    <!-- ================= MESSAGE ================= -->

    <?php if(isset($_SESSION['msg'])){ ?>

        <div class="alert-box">

            <i class="fa-solid fa-circle-check me-2"></i>

            <?php

                echo htmlspecialchars($_SESSION['msg']);

                unset($_SESSION['msg']);

            ?>

        </div>

    <?php } ?>



    <!-- ================= TABLE ================= -->

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


            <?php if(mysqli_num_rows($categories) > 0){ ?>


                <?php while($row = mysqli_fetch_assoc($categories)){ ?>


                    <tr>


                        <!-- ID -->

                        <td style="color:white;">

                            <?php echo $row['id']; ?>

                        </td>


                        <!-- CATEGORY -->

                        <td style="color:white;">

                            <strong>

                                <?php
                                echo htmlspecialchars(
                                    $row['category_name']
                                );
                                ?>

                            </strong>

                        </td>


                        <!-- DELETE -->

                        <td>

                            <a
                                href="categories.php?delete=<?php echo $row['id']; ?>"
                                class="btn-delete"

                                onclick="
                                return confirm(
                                    'Delete this category?'
                                );
                                "
                            >

                                <i class="fa-solid fa-trash"></i>

                                Delete

                            </a>

                        </td>


                    </tr>


                <?php } ?>


            <?php }else{ ?>


                <tr>

                    <td
                        colspan="3"
                        class="empty-category"
                    >

                        <i class="fa-solid fa-layer-group"></i>

                        <div>

                            No categories found.

                        </div>

                    </td>

                </tr>


            <?php } ?>


            </tbody>

        </table>

    </div>


</div>