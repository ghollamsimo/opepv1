<?php
include '../config/connect.php';
session_start();
$userid = $_SESSION['userId'];


if (isset($_POST['productid'])) {
    $productid = $_POST['productid'];

    $select = "SELECT * FROM cart WHERE userid = $userid AND plant_id = $productid";
    $result = $conn->query($select);
    $rows = $result->num_rows;
    $quantity = 1;
    if ($rows > 0) {
        $row = $result->fetch_assoc();
        $quantity = $row['quantity'] + 1;
        $update = "UPDATE cart SET quantity = ? WHERE userid = ? AND plant_id = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("iii", $quantity, $userid, $productid);
        $stmt->execute();
        header('Location:' . $_SERVER['HTTP_REFERER']);
    } else {

        $requet = "INSERT INTO cart (userid , plant_id, quantity) VALUES (? , ?, ?)";
        $addcart = $conn->prepare($requet);
        $addcart->bind_param("iii", $userid, $productid, $quantity);
        $addcart->execute();
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
}
if (isset($_POST['delete_product'])) {
    $query = "DELETE FROM plants WHERE idplants = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_POST['id_product']);
    $stmt->execute();
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
$requet = "SELECT * FROM plants";
$stmt = $conn->query($requet);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/card.css?v=<?php echo time(); ?>">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Document</title>
</head>

<body class="overflow-x-hidden">
    <header class="header">
        <?php include './nav.php' ?>

        <div class="header-section container">
            <div class="left">
                <h1 class="text-2xl">Our <span class="text-[#557C55]">Plants</span></h1>
                <p class="font-bold w-full">🌿 Welcome to Opep Garden - Your Online Oasis of Greenery! 🌿</p>
                <p class="w-[40rem]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et deleniti dolorem enim
                    odio
                    corrupti nam
                    quam qui eaque? Perspiciatis voluptates voluptatibus dolore deserunt sequi voluptatum suscipit eum
                    corporis aut fugit!</p>
                <div class='max-w-md m-5'>
                    <div class="relative flex items-center w-full h-12 rounded-lg overflow-hidden">
                        <div class="grid place-items-center h-full w-12 text-gray-300">
                            <form action="" method="get">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                        </div>

                        <input class="peer h-full w-full outline-none text-sm text-gray-700 pr-2" type="text"
                            id="search" name="search"
                            value="<?php if (isset($_GET['search'])) {
                                                                                                                                                    echo $_GET['search'];
                                                                                                                                                } ?>"
                            placeholder="Search something.." />
                    </div>
                    </form>
                </div>
            </div>
            <div class="right">
                <img src="../img/plants_1.png" alt="">
                <div class="anim">
                    <img class="image_anim" src="../img/plants_2.png" alt="">
                </div>
            </div>
        </div>
    </header>
    <hr>

    <?php
    if (isset($_GET['search'])) {
        $filtervalues = $_GET['search'];
        $query = "SELECT * FROM plants WHERE nom LIKE '%$filtervalues%' LIMIT 1";
        $queryrun = mysqli_query($conn, $query);
        if (mysqli_num_rows($queryrun) > 0) {
            $row = mysqli_fetch_assoc($queryrun);
    ?>
    <div class="products">
        <div class="plant">
            <div class="courses-container">
                <div class="course">
                    <div class="course-preview">
                        <img src="../img/<?= $row['img'] ?>" alt="" width="100px">
                    </div>
                    <div class="course-info">
                        <h2><?= $row['nom'] ?></h2>
                        <h6>$<?= $row['price'] ?></h6>
                        <div class="btn_cat">
                            <span class="progress-text">
                                category Name
                            </span>
                            <button class="btn">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>
    <div class="">
        <h1 class="text-3xl text-center m-4">New <span class="green">Plants</span></h1>

        <div class="products">
            <div class="plant">
                <?php
                while ($row = mysqli_fetch_assoc($stmt)) :
                ?>
                <div class="courses-container">
                    <div class="course">
                        <div class="course-preview">
                            <img src="../img/<?= $row['img'] ?>" alt="" width="100px">
                        </div>
                        <div class="course-info">
                            <h2><?= $row['nom'] ?></h2>
                            <h6>$<?= $row['price'] ?></h6>
                            <div class="btn_cat">
                                <span class="progress-text">
                                    category Name
                                </span>
                                <form action="" method="post">
                                    <input type="hidden" name="productid" value="<?= $row['idplants']  ?>">
                                    <button name="addtocart" class="btn">Add To Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile ?>

            </div>
        </div>
    </div>


    <!-- drawer component -->
    <div id="drawer-right-example"
        class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 "
        tabindex="-1" aria-labelledby="drawer-right-label">
        <h5 id="drawer-right-label"
            class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">Panier
        </h5>
        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <hr>
        <div class="shoping_cart flex flex-col">
            <?php
            $select = "SELECT * FROM cart JOIN plants ON plant_id = idplants WHERE userid = $userid";
            $stmtwo = $conn->query($select);
            while ($afiche = mysqli_fetch_assoc($stmtwo)) :
                $img = $afiche['img'];
                $nom = $afiche['nom'];
                $quantity = $afiche['quantity'];
                $price = $afiche['price']; ?>
            <div class="flex m-3">
                <img src="../img/<?= $img ?>" alt="" width="100px">
                <div class="flex justify-center items-center gap-12 ">
                    <h5><?= $nom ?></h5>
                    <p>$<?= $price ?></p>
                </div>
            </div>
            <hr>
            <?php endwhile ?>
        </div>
        <div class="flex items-end ">
            <form class="w-100" method="post" action="checkout.php">
                <button class="submit">Checkout</button>
            </form>
        </div>
    </div>
    </div>


    <?php include './footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

    <script src="https://unpkg.com/flowbite@1.4.4/dist/flowbite.js"></script>
</body>

</html>