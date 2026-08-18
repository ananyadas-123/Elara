<style>
    /* ================= LOGO ================= */

.logo-icon{

width:58px;
height:58px;

border-radius:18px;

background:
linear-gradient(
135deg,
#7c3aed,
#4f46e5
);

display:flex;
align-items:center;
justify-content:center;

font-size:24px;
color:white;
}

.logo-area h3{

font-size:30px;
font-weight:900;
margin:0;
}

.logo-area span{

font-size:12px;
color:#94a3b8;
letter-spacing:1px;
}

/* ================= USER CARD ================= */

.user-card{

background:
linear-gradient(
135deg,
rgba(124,58,237,.15),
rgba(79,70,229,.08)
);

border:
1px solid rgba(255,255,255,.08);

backdrop-filter:blur(15px);
}

.user-info{

flex:1;
}

.member-badge{

margin-top:8px;

display:inline-flex;
align-items:center;
gap:6px;

padding:6px 12px;

background:
rgba(34,197,94,.15);

color:#22c55e;

border-radius:20px;

font-size:12px;
font-weight:700;
}

/* ================= MENU ================= */

.menu-links a{

position:relative;

transition:.35s;

}

.menu-links a:hover{

background:

linear-gradient(135deg,

rgba(124,58,237,.35),

rgba(37,99,235,.18));

transform:translateX(8px);

box-shadow:

0 12px 25px rgba(124,58,237,.25);

}

.menu-links a.active{

background:

linear-gradient(135deg,#7c3aed,#4f46e5);

box-shadow:

0 15px 35px rgba(124,58,237,.35);

}
.menu-links a::before{

content:'';

position:absolute;

left:0;
top:0;

width:4px;
height:100%;

background:#8b5cf6;

transform:scaleY(0);

transition:.3s;
}

.menu-links a:hover::before,
.menu-links a.active::before{

transform:scaleY(1);
}

.menu-badge{

margin-left:auto;

width:26px;
height:26px;

border-radius:50%;

background:#8b5cf6;

display:flex;
align-items:center;
justify-content:center;

font-size:12px;
font-weight:700;

color:white;
}


/* ================= FOOTER ================= */

.sidebar-footer{

margin-top:40px;

padding-top:20px;

border-top:
1px solid rgba(255,255,255,.08);

text-align:center;
}

.sidebar-footer p{

margin:0;

font-weight:700;

color:white;
}

.sidebar-footer span{

font-size:12px;

color:#94a3b8;
}
</style>


<div class="sidebar">

    <!-- LOGO -->

    <div class="logo-area">

        <div class="logo-icon">

            <i class="fa-solid fa-shoe-prints"></i>

        </div>

        <div>

            <h3>ELARA</h3>
            <span>Premium Footwear</span>

        </div>

    </div>

    <!-- USER CARD -->

    <div class="user-card">

        <img src="uploads/<?php echo $user['image']; ?>">

        <div class="user-info">

            <h4><?php echo $user['name']; ?></h4>

            <p><?php echo $user['email']; ?></p>

            <div class="member-badge">

                <i class="fa-solid fa-circle-check"></i>

                Active Member

            </div>

        </div>

    </div>

    <!-- MENU -->

    <div class="menu-links">

        <a href="dashboard.php"
        class="<?php if($page=='dashboard'){echo 'active';} ?>">

            <i class="fa-solid fa-table-columns"></i>

            Dashboard

        </a>

        <a href="home.php">

            <i class="fa-solid fa-store"></i>

            Shop

        </a>

        <a href="#"
        data-bs-toggle="modal"
        data-bs-target="#profileModal">

            <i class="fa-regular fa-user"></i>

            Profile

        </a>

        <a href="wishlist_page.php">

            <i class="fa-solid fa-heart"></i>

            Wishlist

            <span class="menu-badge">

                <?php echo $total_wishlist; ?>

            </span>

        </a>

        <a href="cart_page.php">

            <i class="fa-solid fa-cart-shopping"></i>

            Cart

            <span class="menu-badge">

                <?php echo $total_cart; ?>

            </span>

        </a>

        <a href="my_orders.php">

            <i class="fa-solid fa-bag-shopping"></i>

            Orders

        </a>

        <a href="settings.php">

            <i class="fa-solid fa-gear"></i>

            Settings

        </a>

        <a href="logout.php"
        class="logout-btn">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>

    <!-- FOOTER -->

    <div class="sidebar-footer">

        <p>

            ELARA Ecommerce

        </p>


    </div>

</div>