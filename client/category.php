<?php
include '../config/connect.php';

$requetcat = "SELECT * FROM category";
$resultcat = $conn->query($requetcat);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css?v=<?php echo time(); ?>">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Document</title>
</head>

<body>
    <?php include './nav.php' ?>
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
</body>

</html>