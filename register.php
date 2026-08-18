<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register • ELARA</title>

<link href="Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

/* =====================================================
   ELARA REGISTER — CINEMATIC PREMIUM UI
===================================================== */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{
    --primary:#8b5cf6;
    --primary2:#6366f1;
    --blue:#2563eb;
    --text:#ffffff;
    --muted:#94a3b8;
}

html{
    scroll-behavior:smooth;
}

body{

    font-family:'Sora',sans-serif;

    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:center;

    padding:30px 20px;

    color:white;

    background:#030712;

    overflow-x:hidden;

    position:relative;
}


/* =====================================================
   VIDEO BACKGROUND
===================================================== */

.video-background{

    position:fixed;

    inset:0;

    width:100%;
    height:100%;

    object-fit:cover;

    z-index:-10;

    pointer-events:none;

}

.video-overlay{

    position:fixed;

    inset:0;

    z-index:-9;

    pointer-events:none;

    background:
        linear-gradient(
            135deg,
            rgba(2,6,23,.92),
            rgba(15,23,42,.78),
            rgba(49,46,129,.68)
        );
}


/* =====================================================
   FLOATING GLOW
===================================================== */

body::before{

    content:"";

    position:fixed;

    width:500px;
    height:500px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(139,92,246,.25),
            transparent 70%
        );

    filter:blur(100px);

    top:-220px;
    left:-180px;

    z-index:-8;

    animation:
        glowOne 9s ease-in-out infinite;

}

body::after{

    content:"";

    position:fixed;

    width:450px;
    height:450px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(37,99,235,.22),
            transparent 70%
        );

    filter:blur(110px);

    bottom:-200px;
    right:-160px;

    z-index:-8;

    animation:
        glowTwo 10s ease-in-out infinite;

}

@keyframes glowOne{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(45px,30px);
    }

}

@keyframes glowTwo{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-40px,-30px);
    }

}


/* =====================================================
   REGISTER WRAPPER
===================================================== */

.register-wrapper{

    width:100%;

    max-width:500px;

    position:relative;

    z-index:5;

    margin:auto;

}


/* =====================================================
   REGISTER CARD
===================================================== */

.register-card{

    position:relative;

    padding:42px;

    border-radius:30px;

    background:
        rgba(15,23,42,.82);

    border:
        1px solid rgba(255,255,255,.09);

    backdrop-filter:blur(25px);

    -webkit-backdrop-filter:blur(25px);

    box-shadow:
        0 30px 80px rgba(0,0,0,.55),
        inset 0 1px 0 rgba(255,255,255,.04);

    overflow:hidden;

    animation:
        cardEnter .8s ease forwards;

}


/* top shine */

.register-card::before{

    content:"";

    position:absolute;

    top:0;
    left:10%;

    width:80%;
    height:1px;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(167,139,250,.8),
            transparent
        );

}


/* animated glow inside card */

.register-card::after{

    content:"";

    position:absolute;

    width:220px;
    height:220px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(139,92,246,.10),
            transparent 70%
        );

    top:-120px;
    right:-100px;

    pointer-events:none;

}

@keyframes cardEnter{

    from{

        opacity:0;

        transform:
            translateY(30px)
            scale(.97);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            scale(1);

    }

}


/* =====================================================
   LOGO
===================================================== */

.center-logo{

    text-align:center;

    margin-bottom:28px;

    position:relative;

    z-index:2;

}

.center-logo h1{

    margin:0;

    font-size:42px;

    font-weight:800;

    letter-spacing:6px;

    line-height:1;

    background:
        linear-gradient(
            135deg,
            #ffffff 20%,
            #ddd6fe 55%,
            #8b5cf6 100%
        );

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;

    filter:
        drop-shadow(
            0 8px 20px
            rgba(139,92,246,.22)
        );

    animation:
        logoFloat 4s ease-in-out infinite;

}

.center-logo p{

    margin-top:10px;

    color:#64748b;

    font-size:10px;

    font-weight:600;

    letter-spacing:4px;

    text-transform:uppercase;

}

@keyframes logoFloat{

    0%,100%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-4px);
    }

}


/* =====================================================
   TITLE
===================================================== */

.form-title{

    text-align:center;

    font-size:27px;

    font-weight:800;

    margin-bottom:8px;

}

.form-subtitle{

    text-align:center;

    color:#94a3b8;

    font-size:13px;

    line-height:1.7;

    margin-bottom:28px;

}


/* =====================================================
   INPUT
===================================================== */

.input-box{

    position:relative;

    margin-bottom:16px;

}

.input-box > i:first-child{

    position:absolute;

    left:17px;

    top:50%;

    transform:translateY(-50%);

    color:#64748b;

    font-size:15px;

    z-index:3;

    transition:.3s;

}

.input-box:focus-within > i:first-child{

    color:#a78bfa;

}

.form-control,
.form-select{

    width:100%;

    height:56px;

    padding-left:48px;

    padding-right:45px;

    border-radius:15px;

    background:
        rgba(255,255,255,.045);

    border:
        1px solid rgba(255,255,255,.08);

    color:white;

    font-family:'Sora',sans-serif;

    font-size:13px;

    outline:none;

    transition:.3s;

}

.form-control::placeholder{

    color:#64748b;

}

.form-control:focus,
.form-select:focus{

    background:
        rgba(255,255,255,.07);

    border-color:#8b5cf6;

    color:white;

    box-shadow:
        0 0 0 4px
        rgba(139,92,246,.12);

}

.form-select{

    appearance:none;

    -webkit-appearance:none;

}

.form-select option{

    background:#111827;

    color:white;

}


/* =====================================================
   PASSWORD TOGGLE
===================================================== */

.toggle-pass{

    position:absolute;

    right:17px;

    top:50%;

    transform:translateY(-50%);

    color:#64748b;

    cursor:pointer;

    z-index:5;

    transition:.3s;

}

.toggle-pass:hover{

    color:#a78bfa;

}


/* =====================================================
   PASSWORD STRENGTH
===================================================== */

.password-strength{

    margin-top:-8px;

    margin-bottom:16px;

}

.strength-bars{

    display:flex;

    gap:5px;

    margin-bottom:6px;

}

.strength-bar{

    height:3px;

    flex:1;

    border-radius:10px;

    background:#1e293b;

    transition:.3s;

}

.strength-text{

    font-size:10px;

    color:#64748b;

}


/* =====================================================
   UPLOAD
===================================================== */

.upload-section{

    margin-bottom:18px;

}

.upload-label{

    display:flex;

    align-items:center;

    justify-content:space-between;

    color:#cbd5e1;

    font-size:12px;

    font-weight:600;

    margin-bottom:9px;

}

.upload-label span{

    color:#64748b;

    font-size:10px;

    font-weight:400;

}

.file-input{

    width:100%;

    padding:12px 14px;

    border-radius:14px;

    background:
        rgba(255,255,255,.045);

    border:
        1px solid rgba(255,255,255,.08);

    color:#94a3b8;

    font-size:11px;

    cursor:pointer;

}

.file-input:hover{

    border-color:
        rgba(139,92,246,.45);

}

.file-input::file-selector-button{

    border:none;

    padding:8px 13px;

    border-radius:9px;

    background:#1e293b;

    color:#cbd5e1;

    font-family:'Sora',sans-serif;

    font-size:10px;

    margin-right:10px;

    cursor:pointer;

}


/* =====================================================
   IMAGE PREVIEW
===================================================== */

.preview-wrapper{

    display:none;

    align-items:center;

    gap:12px;

    margin-top:12px;

    padding:9px;

    background:
        rgba(255,255,255,.035);

    border-radius:13px;

}

.preview{

    width:48px;
    height:48px;

    object-fit:cover;

    border-radius:12px;

    border:
        1px solid
        rgba(255,255,255,.12);

}

.preview-info{

    font-size:10px;

    color:#94a3b8;

}

.preview-info strong{

    display:block;

    color:#e2e8f0;

    margin-bottom:3px;

}


/* =====================================================
   REGISTER BUTTON
===================================================== */

.btn-register{

    width:100%;

    height:57px;

    border:none;

    border-radius:15px;

    background:
        linear-gradient(
            135deg,
            #8b5cf6,
            #6366f1
        );

    color:white;

    font-family:'Sora',sans-serif;

    font-size:14px;

    font-weight:700;

    cursor:pointer;

    position:relative;

    overflow:hidden;

    transition:.35s;

}

.btn-register::before{

    content:"";

    position:absolute;

    top:0;
    left:-120%;

    width:100%;
    height:100%;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.25),
            transparent
        );

    transition:.65s;

}

.btn-register:hover::before{

    left:120%;

}

.btn-register:hover{

    transform:translateY(-2px);

    box-shadow:
        0 16px 32px
        rgba(139,92,246,.3);

}

.btn-register:active{

    transform:scale(.98);

}


/* =====================================================
   BOTTOM
===================================================== */

.bottom-text{

    text-align:center;

    margin-top:22px;

    padding-top:20px;

    border-top:
        1px solid
        rgba(255,255,255,.07);

    color:#94a3b8;

    font-size:12px;

}

.bottom-text a{

    color:#a78bfa;

    font-weight:700;

    text-decoration:none;

    transition:.3s;

}

.bottom-text a:hover{

    color:#c4b5fd;

}


/* =====================================================
   FOOTER
===================================================== */

.register-footer{

    text-align:center;

    margin-top:18px;

    color:#475569;

    font-size:10px;

    line-height:1.7;

}


/* =====================================================
   MOBILE
===================================================== */

@media(max-width:576px){

    body{

        padding:20px 14px;

    }

    .register-wrapper{

        max-width:100%;

    }

    .register-card{

        padding:32px 20px;

        border-radius:24px;

    }

    .center-logo h1{

        font-size:35px;

    }

    .form-title{

        font-size:24px;

    }

    .form-subtitle{

        font-size:12px;

    }

}

</style>

</head>


<body>


<!-- =====================================================
     CINEMATIC BACKGROUND VIDEO
===================================================== -->

<video
    class="video-background"
    autoplay
    muted
    loop
    playsinline
    preload="auto">

    <source src="videos/register-bg.mp4" type="video/mp4">

</video>

<div class="video-overlay"></div>


<!-- =====================================================
     REGISTER
===================================================== -->

<div class="register-wrapper">

    <div class="register-card">


        <!-- LOGO -->

        <div class="center-logo">

            <h1>ELARA.</h1>

            <p>Premium Footwear</p>

        </div>


        <!-- TITLE -->

        <h2 class="form-title">

            Create Your Account

        </h2>

        <p class="form-subtitle">

            Join ELARA and step into a world of premium footwear.

        </p>


        <!-- FORM -->

        <form
            action="includes/register_action.php"
            method="POST"
            enctype="multipart/form-data">


            <!-- NAME -->

            <div class="input-box">

                <i class="fa-solid fa-user"></i>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Full Name"
                    autocomplete="name"
                    required>

            </div>


            <!-- EMAIL -->

            <div class="input-box">

                <i class="fa-solid fa-envelope"></i>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email Address"
                    autocomplete="email"
                    required>

            </div>


            <!-- PASSWORD -->

            <div class="input-box">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Create Password"
                    autocomplete="new-password"
                    oninput="checkPassword()"
                    required>

                <span
                    class="toggle-pass"
                    onclick="togglePass()">

                    <i
                        id="eyeIcon"
                        class="fa-solid fa-eye">
                    </i>

                </span>

            </div>


            <!-- PASSWORD STRENGTH -->

            <div class="password-strength">

                <div class="strength-bars">

                    <span class="strength-bar"
                          id="bar1"></span>

                    <span class="strength-bar"
                          id="bar2"></span>

                    <span class="strength-bar"
                          id="bar3"></span>

                    <span class="strength-bar"
                          id="bar4"></span>

                </div>

                <div
                    class="strength-text"
                    id="strengthText">

                    Use 8+ characters for a stronger password

                </div>

            </div>


            <!-- GENDER -->

            <div class="input-box">

                <i class="fa-solid fa-venus-mars"></i>

                <select
                    name="gender"
                    class="form-select"
                    required>

                    <option value="">
                        Select Gender
                    </option>

                    <option value="Male">
                        Male
                    </option>

                    <option value="Female">
                        Female
                    </option>

                    <option value="Other">
                        Other
                    </option>

                </select>

            </div>


            <!-- PROFILE PHOTO -->

            <div class="upload-section">

                <div class="upload-label">

                    <span
                        style="color:#cbd5e1;font-size:12px;font-weight:600;">

                        Profile Photo

                    </span>

                    <span>
                        Optional
                    </span>

                </div>


                <input
                    type="file"
                    name="image"
                    class="file-input"
                    accept="image/*"
                    onchange="previewImg(event)">


                <div
                    class="preview-wrapper"
                    id="previewWrapper">

                    <img
                        id="imgPreview"
                        class="preview"
                        alt="Preview">

                    <div class="preview-info">

                        <strong>
                            Profile preview
                        </strong>

                        Your selected image will appear here.

                    </div>

                </div>

            </div>


            <!-- BUTTON -->

            <button
                type="submit"
                name="register"
                class="btn-register">

                <i class="fa-solid fa-user-plus me-2"></i>

                Create Account

            </button>


        </form>


        <!-- LOGIN -->

        <div class="bottom-text">

            Already have an account?

            <a href="login.php">

                Login →

            </a>

        </div>


        <!-- FOOTER -->

        <div class="register-footer">

            Protected by Secure Authentication

            <br>

            © ELARA 2026

        </div>


    </div>

</div>


<script>

/* =====================================================
   PASSWORD SHOW / HIDE
===================================================== */

function togglePass(){

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


/* =====================================================
   PASSWORD STRENGTH
===================================================== */

function checkPassword(){

    const password =
        document.getElementById("password").value;

    const bars = [

        document.getElementById("bar1"),
        document.getElementById("bar2"),
        document.getElementById("bar3"),
        document.getElementById("bar4")

    ];

    const text =
        document.getElementById("strengthText");


    let score = 0;


    if(password.length >= 6){

        score++;

    }

    if(password.length >= 8){

        score++;

    }

    if(/[A-Z]/.test(password)){

        score++;

    }

    if(/[0-9]/.test(password) ||
       /[^A-Za-z0-9]/.test(password)){

        score++;

    }


    bars.forEach(function(bar){

        bar.style.background = "#1e293b";

    });


    if(score === 0){

        text.innerText =
            "Use 8+ characters for a stronger password";

        text.style.color = "#64748b";

    }


    if(score === 1){

        bars[0].style.background = "#ef4444";

        text.innerText =
            "Weak password";

        text.style.color = "#ef4444";

    }


    if(score === 2){

        bars[0].style.background = "#f59e0b";
        bars[1].style.background = "#f59e0b";

        text.innerText =
            "Fair password";

        text.style.color = "#f59e0b";

    }


    if(score === 3){

        bars[0].style.background = "#8b5cf6";
        bars[1].style.background = "#8b5cf6";
        bars[2].style.background = "#8b5cf6";

        text.innerText =
            "Good password";

        text.style.color = "#a78bfa";

    }


    if(score === 4){

        bars[0].style.background = "#22c55e";
        bars[1].style.background = "#22c55e";
        bars[2].style.background = "#22c55e";
        bars[3].style.background = "#22c55e";

        text.innerText =
            "Strong password";

        text.style.color = "#22c55e";

    }

}


/* =====================================================
   IMAGE PREVIEW
===================================================== */

function previewImg(event){

    const file =
        event.target.files[0];

    const img =
        document.getElementById("imgPreview");

    const wrapper =
        document.getElementById("previewWrapper");


    if(!file){

        wrapper.style.display = "none";

        return;

    }


    img.src =
        URL.createObjectURL(file);

    wrapper.style.display = "flex";

}

</script>


</body>

</html>