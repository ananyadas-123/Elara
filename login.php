<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login • ELARA</title>

<link href="Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

/* ===============================
   ELARA PREMIUM LOGIN UI v2
   Part 1A
================================*/

*{
margin:0;
padding:0;
box-sizing:border-box;
}

:root{

--bg:#040816;
--card:#0f172a;

--card2:#111827;

--border:rgba(255,255,255,.08);

--primary:#8b5cf6;

--primary2:#6366f1;

--text:#ffffff;

--muted:#94a3b8;

--radius:28px;

}

html{

scroll-behavior:smooth;

}

body{

font-family:'Sora',sans-serif;

min-height:100vh;

background:

radial-gradient(circle at top left,#312e81 0%,transparent 35%),

radial-gradient(circle at bottom right,#1d4ed8 0%,transparent 35%),

linear-gradient(135deg,#030712,#0f172a,#111827);

display:flex;

align-items:center;

justify-content:center;

overflow-x:hidden;

position:relative;

padding:30px;

color:var(--text);

}

/* Floating Glow */

body::before{

content:"";

position:absolute;

width:520px;

height:520px;

border-radius:50%;

background:rgba(139,92,246,.18);

filter:blur(120px);

top:-180px;

left:-180px;

animation:floatOne 9s ease-in-out infinite;

}

body::after{

content:"";

position:absolute;

width:420px;

height:420px;

border-radius:50%;

background:rgba(37,99,235,.16);

filter:blur(120px);

bottom:-180px;

right:-160px;

animation:floatTwo 10s ease-in-out infinite;

}

@keyframes floatOne{

0%{transform:translate(0,0);}

50%{transform:translate(40px,25px);}

100%{transform:translate(0,0);}

}

@keyframes floatTwo{

0%{transform:translate(0,0);}

50%{transform:translate(-40px,-25px);}

100%{transform:translate(0,0);}

}

/* ===============================
   CINEMATIC VIDEO BACKGROUND
================================ */

.video-background{
    position:fixed;
    inset:0;

    width:100%;
    height:100%;

    object-fit:cover;

    z-index:0;

    pointer-events:none;
}

.video-overlay{
    position:fixed;
    inset:0;

    background:
        linear-gradient(
            135deg,
            rgba(2,6,23,.88),
            rgba(15,23,42,.75),
            rgba(49,46,129,.60)
        );

    z-index:1;

    pointer-events:none;
}

.login-wrapper{
    position:relative;
    z-index:5;
}


/* .login-wrapper{
    width:100%;
    max-width:460px;
    margin:auto;
    position:relative;
    z-index:5;
} */

    body{
    font-family:'Sora',sans-serif;

    min-height:100vh;

    background:#030712;

    display:flex;
    align-items:center;
    justify-content:center;

    overflow:hidden;

    position:relative;

    padding:30px;

    color:var(--text);
}

.login-card{
    background:rgba(15,23,42,.82);
    backdrop-filter:blur(25px);
    border:1px solid rgba(255,255,255,.08);
    border-radius:30px;
    padding:45px;
    box-shadow:0 30px 80px rgba(0,0,0,.5);
}

/* LOGO */

.center-logo{
    text-align:center;
    margin-bottom:32px;
}

.center-logo img{
    display:none;
}


.center-logo h1{
    margin:0;
    font-size:42px;
    font-weight:800;
    letter-spacing:5px;
    line-height:1;
    
    background:linear-gradient(
        135deg,
        #ffffff 20%,
        #c4b5fd 55%,
        #8b5cf6 100%
    );
   -webkit-background-clip:text;
   -webkit-text-fill-color:transparent;

    filter:drop-shadow(
        0 8px 20px rgba(139,92,246,.18)
    );
}

.center-logo p{
    margin:12px 0 0;
    color:#64748b;
    font-size:10px;
    font-weight:600;
    letter-spacing:4px;
    text-transform:uppercase;
}

/* FORM */

.center-form-title{
    text-align:center;
    font-size:28px;
    font-weight:800;
    margin-bottom:8px;
}

.center-form-subtitle{
    text-align:center;
    color:#94a3b8;
    font-size:14px;
    margin-bottom:30px;
    line-height:1.7;
}

/* INPUT */

.input-group-custom{
    position:relative;
    margin-bottom:18px;
}

.input-group-custom > i:first-child{
    position:absolute;
    left:17px;
    top:50%;
    transform:translateY(-50%);
    color:#64748b;
    z-index:2;
    transition:.3s;
}

.form-control{
    width:100%;
    height:58px;
    padding:0 48px;
    background:#111827;
    border:1px solid rgba(255,255,255,.08);
    border-radius:15px;
    color:#fff;
    font-size:14px;
    transition:.3s;
}

.form-control::placeholder{
    color:#64748b;
}

.form-control:focus{
    background:#151e30;
    border-color:#8b5cf6;
    color:#fff;
    box-shadow:0 0 0 4px rgba(139,92,246,.12);
}

.input-group-custom:focus-within > i:first-child{
    color:#8b5cf6;
}

/* PASSWORD EYE */

.toggle-password{
    position:absolute;
    right:17px;
    top:50%;
    transform:translateY(-50%);
    color:#64748b;
    cursor:pointer;
    z-index:5;
}

.toggle-password:hover{
    color:#a78bfa;
}

/* FORGOT */

.forgot-link{
    display:inline-block;
    color:#94a3b8;
    font-size:13px;
    text-decoration:none;
    margin:2px 0 22px;
}

.forgot-link:hover{
    color:#a78bfa;
}

/* LOGIN BUTTON */

.btn-login-custom{
    width:100%;
    height:58px;
    border:none;
    border-radius:15px;
    background:linear-gradient(135deg,#8b5cf6,#6366f1);
    color:#fff;
    font-size:15px;
    font-weight:700;
    transition:.3s;
}

.btn-login-custom:hover{
    transform:translateY(-2px);
    box-shadow:0 15px 30px rgba(139,92,246,.3);
}

.btn-login-custom:active{
    transform:scale(.98);
}

/* REGISTER */

.extra-links{
    text-align:center;
    margin-top:25px;
    padding-top:22px;
    border-top:1px solid rgba(255,255,255,.07);
    color:#94a3b8;
    font-size:13px;
}

.extra-links a{
    color:#a78bfa;
    font-weight:700;
    text-decoration:none;
}

.extra-links a:hover{
    color:#c4b5fd;
}

/* FOOTER */

.login-footer{
    text-align:center;
    margin-top:22px;
    color:#475569;
    font-size:11px;
    line-height:1.7;
}


/* MOBILE */

@media(max-width:576px){

    body{
        padding:20px;
    }

    .login-wrapper{
        max-width:420px;
    }

    .login-card{
        padding:32px 22px;
        border-radius:24px;
    }

    .center-form-title{
        font-size:25px;
    }

}

</style>

</head>

<body>

<video
    class="video-background"
    autoplay
    muted
    loop
    playsinline
    preload="auto">

    <source src="videos/login_bg1.mp4" type="video/mp4">

</video>

<div class="video-overlay"></div>


<div class="login-wrapper">

    <div class="login-card">

        <!-- LOGO -->

        <div class="center-logo">

            <h1>ELARA.</h1>

            <p>Premium Footwear</p>

         </div>


        <!-- FORM TITLE -->

        <h2 class="center-form-title">
            Welcome Back 👋
        </h2>

        <p class="center-form-subtitle">
            Sign in to continue your ELARA experience.
        </p>


        <!-- LOGIN FORM -->

        <form action="includes/login_action.php" method="POST">

            <!-- EMAIL -->

            <div class="input-group-custom">

                <i class="fa-solid fa-envelope"></i>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email Address"
                    required>

            </div>


            <!-- PASSWORD -->

            <div class="input-group-custom">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    required>

                <span
                    class="toggle-password"
                    onclick="togglePassword()">

                    <i
                        id="eyeIcon"
                        class="fa-solid fa-eye">
                    </i>

                </span>

            </div>


            <!-- FORGOT PASSWORD -->

            <div class="text-end">

                <a
                    href="forgot_password.php"
                    class="forgot-link">

                    Forgot Password?

                </a>

            </div>


            <!-- LOGIN BUTTON -->

            <button
                type="submit"
                name="login"
                class="btn-login-custom">

                <i class="fa-solid fa-right-to-bracket me-2"></i>

                Login Account

            </button>

        </form>


        <!-- REGISTER -->

        <div class="extra-links">

            Don't have an account?

            <a href="register.php">
                Create Account →
            </a>

        </div>


        <!-- FOOTER -->

        <div class="login-footer">

            Protected by Secure Authentication

            <br>

            © ELARA 2026

        </div>

    </div>

</div>


<script>

function togglePassword(){

    const password =
        document.getElementById("password");

    const eye =
        document.getElementById("eyeIcon");

    if(password.type === "password"){

        password.type = "text";

        eye.classList.remove("fa-eye");

        eye.classList.add("fa-eye-slash");

    }else{

        password.type = "password";

        eye.classList.remove("fa-eye-slash");

        eye.classList.add("fa-eye");

    }

}

</script>


</body>
</html>