<?php
include '../config/connect.php';
$showplant = "SELECT * FROM plants";
$stmt = $conn->query($showplant);

$showcategory = "SELECT * FROM category";
$stmtcat = $conn->query($showcategory);

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
    <style>

    </style>
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
        <div class="home_content">
            <div class="card">
                <div class="item">
                    <i class='bx bxs-leaf'></i>
                    <div class="item_content">
                        <h3>The World First And Best Selling Plants Shop</h3>
                        <p>Loremlaudantium, praesentium ipsa neque eveniet quo vero error adipisci fuga mollitia. Animi
                            expedita
                        </p>
                    </div>
                </div>

                <div class="item">
                    <i class='bx bx-plus'></i>
                    <div class="item_content">
                        <h3>Get Your in One Deal</h3>
                        <p>Loremlaudantium, praesentium ipsa neque eveniet quo vero error adipisci fuga mollitia. Animi
                            expedita
                        </p>
                        <h4><a class="shop" href="./products.php">Go To Add Products</a></h4>
                    </div>
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

        <div class="">
            <div class="text">
                <h6>Table Of Plants</h6>
            </div>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name Of Plants</th>
                            <th>Price</th>
                            <th>Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($stmt)) :
                        ?>
                        <tr>
                            <td><img src="../img/<?= $row['img'] ?>" alt="" width="100px"></td>
                            <td><?= $row['nom'] ?></td>
                            <td>$<?= $row['price'] ?></td>
                            <td>Content 1</td>
                        </tr>
                        <?php endwhile ?>
                    <tbody>
                </table>
            </div>
        </div>


        <div class="">
            <div class="text">
                <h6>Table Of Categories</h6>
            </div>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Name Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($stmtcat)) :
                        ?>
                        <tr>
                            <td><?= $row['nom'] ?></td>
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