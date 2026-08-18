<?php
    session_start();
    include("../includes/connect.php");

    $users = mysqli_query($conn,
    "SELECT * FROM users ORDER BY id DESC");
?>

<style>

    .table-box{
    background:rgba(255,255,255,0.05);
    border-radius:20px;
    padding:25px;
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,0.08);
    overflow-x:auto;
    }

    table{
    width:100%;
    }

    th{
    padding:16px;
    background:rgba(255,255,255,0.05);
    }

    td{
    padding:16px;
    border-bottom:1px solid rgba(255,255,255,0.06);
    }

    .user-img{
    width:50px;
    height:50px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid #3b82f6;
    }

    .delete-btn{
    padding:10px 15px;
    background:#ef4444;
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-size:13px;
    font-weight:700;
    }

</style>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3>👤 Users Management</h3>

    <div class="badge bg-primary p-3">Total Users :<?php echo mysqli_num_rows($users); ?></div>

</div>

<div class="table-box">

    <table>

        <tr>

            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Action</th>

        </tr>

        <?php while($row = mysqli_fetch_assoc($users)){ ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><img class="user-img" src="../uploads/<?php echo $row['image']; ?>"></td>

            <td><?php echo $row['name']; ?></td>

            <td><?php echo $row['email']; ?></td>

            <td><?php echo $row['gender']; ?></td>

            <td>
                <a class="delete-btn" href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this user?')">Delete</a>
            </td>

        </tr>

        <?php } ?>

    </table>

</div>