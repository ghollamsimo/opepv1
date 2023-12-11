<?php
include '../config/connect.php';
$showusers = "SELECT * FROM users";
$stmtow = $conn->query($showusers);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Document</title>
</head>

<body>
    <?php include './sidebar.php' ?>
    <section class="home ">
        <div class="text nav_dash">
            <h6>Welcome To Opep Dashboard</h6>
            <div class="icon">
                <i class='bx bx-search icon'></i>
                <i class='bx bx-bell icon'></i>
                <i class='bx bx-user-circle'></i>
            </div>
        </div>
        <div>
            <div class="text">
                <h6>Table Of Users</h6>
            </div>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($users = mysqli_fetch_assoc($stmtow)) :
                        ?>
                        <tr>
                            <td><?= $users['fullname'] ?></td>
                            <td><?= $users['email'] ?></td>
                            <td><?= $users['idrole'] ?></td>
                        </tr>
                        <?php endwhile ?>
                    <tbody>
                </table>
            </div>
        </div>
        </div>
    </section>
</body>

</html>