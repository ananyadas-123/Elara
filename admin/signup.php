<?php
include('../includes/connect.php');

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    $image = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];

    $folder = "../uploads/" . $image;

    // check email
    $check = "SELECT * FROM admin WHERE email='$email'";
    $run = mysqli_query($conn, $check);

    if (mysqli_num_rows($run) > 0) {

        $msg = "⚠ Email already exists!";

    } else {

        if (!empty($image)) {

            if (move_uploaded_file($tmp, $folder)) {

                $insert = "INSERT INTO admin(name,email,password,profile)
                VALUES('$name','$email','$password','$image')";

                $query = mysqli_query($conn, $insert);

                if ($query) {
                    $msg = "✅ Signup successful!";
                } else {
                    $msg = "❌ Database insert failed!";
                }

            } else {
                $msg = "❌ Image upload failed!";
            }

        } else {
            $msg = "❌ Please select an image!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Signup</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    height:100vh;
    display:flex;
    font-family:'Segoe UI';
    background: radial-gradient(circle at top,#1f2937,#0f172a);
}

/* LEFT */
.left{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    color:white;
    background:linear-gradient(135deg,#0ea5e9,#6366f1);
}

.left h1{
    font-size:45px;
    font-weight:700;
}

.left p{
    opacity:0.8;
}

/* RIGHT */
.right{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* CARD */
.card-box{
    width:380px;
    padding:30px;
    border-radius:18px;
    background:rgba(255,255,255,0.06);
    backdrop-filter:blur(18px);
    box-shadow:0 10px 40px rgba(0,0,0,0.4);
    color:#fff;
    animation:fadeUp .6s ease;
}

.card-box h2{
    text-align:center;
    margin-bottom:20px;
}

/* INPUT */
.form-control{
    background:rgba(255,255,255,0.08);
    border:none;
    color:#fff;
    border-radius:10px;
}

.form-control::placeholder{
    color:#cbd5e1;
}

/* BUTTON */
.btn-custom{
    width:100%;
    border:none;
    border-radius:10px;
    padding:10px;
    font-weight:600;
    background:linear-gradient(45deg,#22c55e,#0ea5e9);
    transition:0.3s;
}

.btn-custom:hover{
    transform:scale(1.05);
}

/* MESSAGE */
.msg{
    text-align:center;
    margin-bottom:10px;
    padding:8px;
    border-radius:8px;
    font-size:13px;
    background:rgba(255,255,255,0.1);
}

/* ANIMATION */
@keyframes fadeUp{
    from{opacity:0;transform:translateY(20px);}
    to{opacity:1;transform:translateY(0);}
}

/* MOBILE */
@media(max-width:768px){
    body{flex-direction:column;}
    .left{display:none;}
}

</style>

</head>

<body>

<!-- LEFT -->
<div class="left">
    <h1>👟 ELARA ADMIN</h1>
    <p>Create & manage your store</p>
</div>

<!-- RIGHT -->
<div class="right">

<div class="card-box">

<h2>Create Account</h2>

<?php if($msg != "") { ?>
<div class="msg"><?php echo $msg; ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>

<input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<input type="file" name="img" class="form-control mb-3">

<button class="btn btn-custom" name="signup">Sign Up</button>

</form>

</div>

</div>

</body>
</html>