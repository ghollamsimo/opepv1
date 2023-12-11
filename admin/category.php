<?php
include '../config/connect.php';
$showcategory = "SELECT * FROM category";
$stmt = $conn->query($showcategory);


if (isset($_POST['addcat'])) {
    $nomcat = $_POST['nomcat'];
    $requet = "INSERT INTO category (nom) VALUES (?)";
    $addcat = $conn->prepare($requet);
    $addcat->bind_param("s",  $nomcat);
    $addcat->execute();
    header('Location:' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['delet_cat'])) {
    $idcat = $_POST['idcat'];
    $delet = "DELETE FROM category WHERE idcategory = ?";
    $stmt2 = $conn->prepare($delet);
    $stmt2->bind_param("i", $idcat);
    $stmt2->execute();
    header('Location:' . $_SERVER['HTTP_REFERER']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/plant_dashboard.css?v=<?php echo time(); ?>">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Document</title>
</head>

<body>
    <?php include './sidebar.php' ?>
    <section class="home ">
        <div class="text nav_dash">
            <h6 class="text-sm">Welcome To Opep Dashboard</h6>
            <div class="icon gap-5">
                <i class='bx bx-search icon'></i>
                <i class='bx bx-bell icon'></i>
                <i class='bx bx-user-circle'></i>
            </div>
        </div>
        <div class="text adding">
            <h6 class="text-lg">Add Somme Category If You Want</h6>
            <button type="button" data-modal-toggle="authentication-modal" class="button bg-[#557C55]"><i
                    class='bx bx-plus'></i></button>
        </div>
        <div class="flex">
            <?php while ($results = mysqli_fetch_assoc($stmt)) : ?>
            <div
                class="h-44 m-5 w-32 bg-gray-100 rounded-xl flex flex-col justify-center shadow duration-300 hover:bg-white hover:shadow-xl">
                <h1 class=" text-sm leading-5 font-semibold text-center"><?= $results['nom'] ?></h1>
                <div class="flex relative top-14 justify-center items-end gap-5">
                    <button class="border-2 rounded-lg p-2"><i class='bx bx-edit-alt'></i></button>
                    <button class="border-2 rounded-lg p-2" data-modal-target="delete-modal"
                        data-modal-toggle="delete-modal-<?= $results["idcategory"] ?>"><i
                            class='bx bx-trash-alt'></i></button>
                </div>
            </div>

            <div id="delete-modal-<?= $results["idcategory"] ?>" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow ">

                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you
                                want to
                                delete this product?</h3>
                            <form action="" method="post">
                                <input type="hidden" name="idcat" value="<?= $results["idcategory"] ?>">
                                <button data-modal-hide="delete-modal" type="submit" name="delet_cat"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Yes, I'm sure
                                </button>
                                <button data-modal-hide="delete-modal" type="submit"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                    cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile ?>
        </div>
    </section>


    <!-- Modal For Add New Products -->
    <div id="authentication-modal" aria-hidden="true"
        class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
        <div class="relative w-full max-w-md px-4 h-full md:h-auto">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative p-5">
                <div class="flex justify-end p-2">
                    <button type="button"
                        class="text-gray-400  hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center  dark:hover:text-white"
                        data-modal-toggle="authentication-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-5">
                    <form action="" method="post">
                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name
                                Category</label>
                            <div class="relative mt-2 rounded-md shadow-sm">

                                <input type="text" name="nomcat"
                                    class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    placeholder="Name Category">
                            </div>
                        </div>
                        <div class="flex justify-end items-end m-5">
                            <button
                                class="px-4 py-2 bg-gradient-to-r bg-[#557C55] hover:opacity-80 text-white text-sm font-medium rounded-md"
                                name="addcat" type="submit">
                                Save
                            </button>
                    </form>
                </div>


            </div>
        </div>

    </div>



    <script src="https://unpkg.com/flowbite@1.4.4/dist/flowbite.js"></script>
</body>

</html>