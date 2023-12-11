<?php
include '../config/connect.php';
$requet = "SELECT plants.*, category.nom as nom 
                 FROM plants 
                 LEFT JOIN category ON plants.categoryid = category.idcategory";
$stmt = $conn->query($requet);

$requetcat = "SELECT * FROM category";
$resultcat = $conn->query($requetcat);


session_start();
$userid = $_SESSION['userId'];

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

    <title>Opep | Home</title>
</head>

<body class="overflow-x-hidden">
    <header class="header">
        <?php include './nav.php' ?>

        <div class="header-section container">
            <div class="left">
                <h1 class="text-2xl">We Make Your Happiness <span class="text-success">Bloom</span></h1>
                <p>🌿 Welcome to [Your Plant Haven] - Your Online Oasis of Greenery! 🌿</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et deleniti dolorem enim odio corrupti nam
                    quam qui eaque? Perspiciatis voluptates voluptatibus dolore deserunt sequi voluptatum suscipit eum
                    corporis aut fugit!</p>
                <button class="bttn" href="products.php">Order Plants</button>
            </div>
            <div class="right">
                <img src="../img/plants_1.png" alt="">
                <div class="anim">
                    <img class="image_anim" src="../img/plants_2.png" alt="">
                </div>
            </div>
        </div>
    </header>

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
    </div>


    <div class="card">
        <div class="item">
            <i class='bx bx-box'></i>
            <div class="item_content">
                <h3>Free Return</h3>
                <p>Loremlaudantium, praesentium ipsa neque eveniet quo vero error adipisci fuga mollitia. Animi expedita
                </p>
            </div>
        </div>

        <div class="item">
            <i class='bx bx-box'></i>
            <div class="item_content">
                <h3>Fast Delivery</h3>
                <p>Loremlaudantium, praesentium ipsa neque eveniet quo vero error adipisci fuga mollitia. Animi expedita
                </p>
            </div>
        </div>

        <div class="item">
            <i class='bx bx-box'></i>
            <div class="item_content">
                <h3>Customer Support</h3>
                <p>Loremlaudantium, praesentium ipsa neque eveniet quo vero error adipisci fuga mollitia. Animi expedita
                </p>
            </div>
        </div>

        <div class="item">
            <i class='bx bx-dollar'></i>
            <div class="item_content">
                <h3>Affordable Price</h3>
                <p>Loremlaudantium, praesentium ipsa neque eveniet quo vero error adipisci fuga mollitia. Animi expedita
                </p>
            </div>
        </div>
    </div>



    <div class="products">
        <h1 class="text-3xl m-12">Our <span class="green">Plants</span></h1>
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
                        <h2><?= $row['nomplants'] ?></h2>
                        <h6>$<?= $row['price'] ?></h6>
                        <div class="btn_cat">
                            <span class="progress-text">
                                <?= $row['nom'] ?>
                            </span>
                            <form action="./plants.php">
                                <button class="btn">Add To Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile ?>

        </div>
    </div>

    <h1 class="text-center text-3xl m-12"><span class="green">About</span> Us</h1>
    <section class="bg-[#557C55] p-3 about">
        <div class="m-16 flex gap-[5rem]">
            <img src="../img/plants_1.png" alt="" width="300px">
            <p class="relative text-lg top-32 w-[1000rem] font-semibold flex justify-center">At Opep Garden, we believe
                in
                the
                transformative
                power of nature
                and
                the
                profound
                impact it
                can
                have on
                our well-being. Nestled in the heart of tranquility, Opep Garden is not just a place; it's an immersive
                experience designed to reconnect you with the beauty of the natural world.
            </p>
        </div>
    </section>


    <section>
        <h1 class="text-3xl text-center m-8">Our <span class="green">Category</span></h1>
        <div class="category">
            <?php while ($cate = mysqli_fetch_assoc($resultcat)) : ?>
            <div class="  w-full  p-4">
                <div class="bg-[#557C55] text-white w-full max-w-md flex flex-col rounded-xl shadow-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="rounded-full w-4 h-4 border border-white-500"></div>
                            <div class="text-md font-bold"><?= $cate['nom'] ?></div>
                        </div>

                    </div>
                    <div class="mt-4 text-white font-bold text-sm">
                        # CATEGORY
                    </div>
                </div>

            </div>
            <?php endwhile ?>
        </div>

    </section>

    <?php include './footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

    <script src="https://unpkg.com/flowbite@1.4.4/dist/flowbite.js"></script>

</body>

</html>