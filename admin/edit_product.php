<?php

include("connect.php");

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM products WHERE id='$id'");

$product = mysqli_fetch_assoc($query);


if(isset($_POST['update_product'])){

    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $category_id = $_POST['category_id'];

    
    // IMAGE UPDATE

    $image = $product['image'];

    if($_FILES['image']['name'] != ""){

        $image = time() . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "uploads/".$image
        );
    }


    $update = mysqli_query($conn,

    "UPDATE products SET

    name='$name',
    brand='$brand',
    price='$price',
    rating='$rating',
    category_id='$category_id',
    image='$image'

    WHERE id='$id'"

    );

    if($update){

        header("Location: manage_products.php");

    }else{

        echo mysqli_error($conn);

    }

}

?>

<style>

body{

background:#0f172a;
font-family:Arial;
color:white;

}

.form-box{

width:500px;
margin:40px auto;
background:#111827;
padding:30px;
border-radius:20px;

}

input,select{

width:100%;
padding:14px;
margin-top:12px;
border:none;
border-radius:10px;
background:#1f2937;
color:white;

}

button{

width:100%;
padding:14px;
margin-top:20px;
border:none;
border-radius:12px;
background:#2563eb;
color:white;
font-size:16px;
font-weight:bold;
cursor:pointer;

}

.preview-img{

width:120px;
height:120px;
object-fit:cover;
border-radius:12px;
margin-top:15px;

}

</style>

<div class="form-box">

<h2>
Update Product
</h2>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="name"
value="<?php echo $product['name']; ?>"
placeholder="Product Name"
required>

<input
type="text"
name="brand"
value="<?php echo $product['brand']; ?>"
placeholder="Brand"
required>

<input
type="number"
step="0.01"
name="price"
value="<?php echo $product['price']; ?>"
placeholder="Price"
required>

<input
type="number"
step="0.1"
name="rating"
value="<?php echo $product['rating']; ?>"
placeholder="Rating"
required>

<select name="category_id" required>

<option value="">
Select Category
</option>

<?php

$cat_query = mysqli_query($conn,
"SELECT * FROM categories");

while($cat = mysqli_fetch_assoc($cat_query)){

?>

<option
value="<?php echo $cat['id']; ?>"

<?php
if($product['category_id']==$cat['id']){
echo "selected";
}
?>

>

<?php echo $cat['category_name']; ?>

</option>

<?php } ?>

</select>


<img
src="uploads/<?php echo $product['image']; ?>"
class="preview-img">


<input
type="file"
name="image">


<button type="submit" name="update_product">

Update Product

</button>

</form>

</div>