<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Document</title>
</head>

<body>
    <nav class="navbar">
        <div class="nav_logo">
            <h1>
                <i class='bx bx-leaf'></i>
            </h1>
        </div>
        <ul class="nav_link">
            <li><a href="./home.php">Home</a></li>
            <li><a href="./about.php">About</a></li>
            <li><a href="./plants.php">Products</a></li>
            <li><a href="./category.php">Category</a></li>
            <li><a href="../page/logout.php">Logout</a></li>
        </ul>
        <div class="icon text-xl">
            <button type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                data-drawer-placement="right" aria-controls="drawer-right-example"><i class='bx bx-basket'></i></button>

        </div>
    </nav>
</body>

</html>