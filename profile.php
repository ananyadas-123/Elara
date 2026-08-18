
<?php

include('includes/connect.php');

$id = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM users WHERE id='$id'")
);

/* UPDATE PROFILE */

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $email = $_POST['email'];

    // IMAGE UPDATE

    if(!empty($_FILES['image']['name'])){

        $img = time().$_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "uploads/".$img
        );

        mysqli_query($conn,"UPDATE users SET

        name='$name',
        email='$email',
        image='$img'

        WHERE id='$id'");

    }else{

        mysqli_query($conn,"UPDATE users SET

        name='$name',
        email='$email'

        WHERE id='$id'");
    }

    echo "<script>
    window.location.href='dashboard.php';
    </script>";
}

?>

<!-- PROFILE MODAL -->

<div class="modal fade"
id="profileModal"
tabindex="-1">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content profile-modal">

<div class="modal-header border-0">

<h4 class="modal-title fw-bold">
My Profile
</h4>

<button type="button"
class="btn-close btn-close-white"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body text-center">

<img src="uploads/<?php echo $user['image']; ?>"
class="profile-img">

<form method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<input type="text"
name="name"
class="form-control custom-input"
value="<?php echo $user['name']; ?>">

</div>

<div class="mb-3">

<input type="email"
name="email"
class="form-control custom-input"
value="<?php echo $user['email']; ?>">

</div>

<div class="mb-4">

<input type="file"
name="image"
class="form-control custom-input">

</div>

<button name="update"
class="update-btn">

Update Profile

</button>

</form>

</div>

</div>

</div>

</div>

<style>

.profile-modal{
background:#0f172a;
border-radius:28px;
border:1px solid rgba(255,255,255,.08);
color:white;
padding:10px;
}

.profile-img{
width:120px;
height:120px;
border-radius:50%;
object-fit:cover;
border:4px solid #8b5cf6;
margin-bottom:25px;
}

.custom-input{
height:55px;
border-radius:16px !important;
background:rgba(255,255,255,.05) !important;
border:1px solid rgba(255,255,255,.08) !important;
color:white !important;
}

.custom-input:focus{
box-shadow:none !important;
border-color:#8b5cf6 !important;
}

.custom-input::file-selector-button{
background:#8b5cf6;
border:none;
color:white;
padding:10px 16px;
border-radius:10px;
margin-right:12px;
}

.update-btn{
width:100%;
height:58px;
border:none;
border-radius:18px;
background:linear-gradient(135deg,#7c3aed,#4f46e5);
color:white;
font-weight:700;
font-size:16px;
transition:.3s;
}

.update-btn:hover{
transform:translateY(-3px);
box-shadow:0 12px 25px rgba(124,58,237,.35);
}

.btn-close{
filter:invert(1);
}

</style>