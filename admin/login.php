<?php
session_start();
include('../includes/connect.php');

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
    $run = mysqli_query($conn, $sql);

    if ($run && mysqli_num_rows($run) == 1) {

        $data = mysqli_fetch_assoc($run);

        if ($data['password'] == $password) {

            $_SESSION['id'] = $data['id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['profile'] = $data['profile'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Wrong password!";
        }

    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ELARA Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Segoe UI',sans-serif;
    background: radial-gradient(circle at top,#0f172a,#020617);
    overflow:hidden;
}

body::before{
    content:"";
    position:absolute;
    width:500px;
    height:500px;
    background:linear-gradient(45deg,#6366f1,#22d3ee);
    filter:blur(120px);
    opacity:0.25;
    top:-100px;
    left:-100px;
}

.login-box{
    width:380px;
    padding:35px;
    border-radius:18px;
    background:rgba(255,255,255,0.06);
    backdrop-filter:blur(18px);
    box-shadow:0 20px 60px rgba(0,0,0,0.6);
    position:relative;
    z-index:1;
}

.login-box h2{
    text-align:center;
    color:#e2e8f0;
    margin-bottom:25px;
}

.error-box{
    background:rgba(239,68,68,0.15);
    color:#f87171;
    padding:10px;
    border-radius:8px;
    font-size:13px;
    margin-bottom:15px;
    text-align:center;
}

.input-box{
    position:relative;
    margin-bottom:18px;
}

.input-box input{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:rgba(255,255,255,0.08);
    color:#fff;
    outline:none;
}

.input-box label{
    position:absolute;
    top:12px;
    left:12px;
    color:#94a3b8;
    font-size:13px;
    transition:0.2s;
}

.input-box input:focus + label,
.input-box input:not(:placeholder-shown) + label{
    top:-8px;
    font-size:11px;
    color:#60a5fa;
}

.pass-toggle{
    position:absolute;
    right:10px;
    top:12px;
    cursor:pointer;
    color:#94a3b8;
}

.btn-login{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:linear-gradient(45deg,#6366f1,#22d3ee);
    color:#fff;
    font-weight:600;
}

.footer{
    text-align:center;
    margin-top:15px;
    font-size:12px;
    color:#94a3b8;
}
</style>
</head>

<body>

<div class="login-box">

    <h2>Admin Login</h2>

    <?php if($error != "") { ?>
        <div class="error-box"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">

        <div class="input-box">
            <input type="email" name="email" placeholder=" " required>
            <label>Email</label>
        </div>

        <div class="input-box">
            <input type="password" name="password" id="password" placeholder=" " required>
            <label>Password</label>
            <span class="pass-toggle" onclick="togglePass()">👁</span>
        </div>

        <button type="submit" name="login" class="btn-login">Login</button>

    </form>

    <div class="footer">© 2026 ELARA Admin Panel</div>

</div>

<script>
function togglePass(){
    let p = document.getElementById("password");
    p.type = (p.type === "password") ? "text" : "password";
}
</script>

</body>
</html>