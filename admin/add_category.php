<?php 
session_start();
include("connect.php"); 
?>

<div class="card shadow border-0 rounded-4">

    <div class="card-body p-4">

        <h3 class="mb-4 fw-bold text-primary">
            Add New Category
        </h3>

        <?php if(isset($_SESSION['msg'])){ ?>

            <div class="alert alert-info">
                <?php 
                    echo $_SESSION['msg']; 
                    unset($_SESSION['msg']);
                ?>
            </div>

        <?php } ?>

        <form method="POST" action="category_action.php">

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Category Name
                </label>

                <input 
                    type="text"
                    name="category_name"
                    class="form-control form-control-lg"
                    placeholder="Enter Category Name"
                    required
                >

            </div>

            <button 
type="submit"
name="submit"
class="btn btn-primary px-4 py-2">

Add Category

</button>

        </form>

    </div>

</div>