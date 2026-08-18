<?php
session_start();
include("connect.php");
?>

<h3 class="mb-4">Add Product</h3>

<?php if(isset($_SESSION['msg'])){ ?>

<div class="alert alert-info">

    <?php
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    ?>

</div>

<?php } ?>

<form method="POST" 
      action="product_action.php"
      enctype="multipart/form-data">

    <!-- PRODUCT NAME -->

    <label class="mb-2">Product Name</label>

    <input type="text" 
           name="name" 
           class="form-control" 
           placeholder="Enter Product Name" 
           required>

    <!-- BRAND -->

    <label class="mb-2">Brand</label>

    <select name="brand" class="form-select">

        <option value="Nike">Nike</option>
        <option value="Adidas">Adidas</option>
        <option value="Puma">Puma</option>
        <option value="Reebok">Reebok</option>
        <option value="Gucci">Gucci</option>

    </select>

    <!-- CATEGORY -->

    <label class="mb-2">Category</label>

    <select name="category" class="form-select">

        <?php

        $cat = mysqli_query($conn,"SELECT * FROM categories");

        while($c = mysqli_fetch_assoc($cat)){

        ?>

        <option value="<?php echo $c['category_name']; ?>">

            <?php echo $c['category_name']; ?>

        </option>

        <?php } ?>

    </select>

    <!-- PRICE -->

    <label class="mb-2">Price</label>

    <input type="number" 
           name="price" 
           class="form-control" 
           placeholder="Enter Product Price" 
           required>

    <!-- RATING -->

    <label class="mb-2">Rating</label>

    <input type="text" 
           name="rating" 
           class="form-control" 
           placeholder="Example 4.5" 
           required>


    <!-- description -->
    <label class="mb-2">Description</label>

        <textarea
        name="description"
        class="form-control"
        rows="5"
        placeholder="Enter Product Description"
        required></textarea>


    <!-- stock -->

    <label class="mb-2">Stock Quantity</label>

        <input type="number"
        name="stock"
        class="form-control"
        placeholder="Available Stock"
        value="50"
        required>

    <!-- IMAGE -->

    <label class="mb-2">Product Image</label>

    <input type="file" 
           name="image" 
           class="form-control"
           onchange="previewImage(event)"
           required>

    <!-- PREVIEW -->

    <img id="preview"

    style="
    width:100%;
    height:300px;
    object-fit:cover;
    border-radius:18px;
    margin-top:20px;
    display:none;
    ">

    <!-- BUTTON -->

    <button type="submit"
            name="submit"
            class="btn-custom mt-3">

        Add Product

    </button>

</form>

<script>

function previewImage(event){

    const reader = new FileReader();

    reader.onload = function(){

        const output = document.getElementById('preview');

        output.src = reader.result;

        output.style.display = "block";

    }

    reader.readAsDataURL(event.target.files[0]);

}

</script>