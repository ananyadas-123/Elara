<?php

include("connect.php");

$id = $_GET['edit_category'];

$get = mysqli_query(
$conn,
"SELECT * FROM categories WHERE id='$id'"
);

$row = mysqli_fetch_assoc($get);

/* UPDATE */

if(isset($_POST['update'])){

    $category_name = $_POST['category_name'];

    $update = mysqli_query(

    $conn,

    "UPDATE categories

    SET category_name='$category_name'

    WHERE id='$id'"

    );

    if($update){

        echo "
        <div class='alert alert-success'>
        Category Updated Successfully
        </div>
        ";

    }

}

?>

<h3 class="mb-4">

Edit Category

</h3>

<form method="POST">

<label class="mb-2">

Category Name

</label>

<input
type="text"
name="category_name"
class="form-control"
value="<?php echo $row['category_name']; ?>">

<button
type="submit"
name="update"
class="btn btn-primary mt-3">

Update Category

</button>

</form>