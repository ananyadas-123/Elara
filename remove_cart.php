<?php

session_start();

include("includes/connect.php");

$user_id = $_SESSION['user_id'];

$product_id = $_GET['id'];
?>

<script>
if (confirm("Are you sure? This item will be removed from your cart.")) {
    window.location.href = "delete_cart.php?id=<?php echo $product_id; ?>&confirm=1";
} else {
    window.location.href = "cart_page.php";
}
</script>

<?php

session_start();
include("includes/connect.php");

if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {

    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];

    mysqli_query($conn, "
        DELETE FROM cart
        WHERE user_id='$user_id'
        AND product_id='$product_id'
    ");
}

header("Location: cart_page.php");
exit();

?>
