<?php

include '../config/connect.php';
$showplant = "SELECT * FROM plants";
$stmt = $conn->query($showplant);

$showCategories = "SELECT * FROM category";
$stmtCategories = $conn->query($showCategories);

    $showProducts = "SELECT plants.*, category.nom as nom 
                    FROM plants 
                    LEFT JOIN category ON plants.categoryid = category.idcategory";
$stmtProducts = $conn->query($showProducts);

if (isset($_POST['add_product'])) {
    $uploadimg = $_POST['uploadimg'];
    $price = $_POST['price'];
    $nomproduct = $_POST['nomproduct'];
    $categoryid = $_POST['option'];

    $addproduct = "INSERT INTO plants (img, nomplants, price , categoryid) VALUES (?, ?, ? , ?)";
    $stmtadd = $conn->prepare($addproduct);
    $stmtadd->bind_param("ssii", $uploadimg, $nomproduct, $price, $categoryid);
    $stmtadd->execute();
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
if (isset($_POST['delete_product'])) {
    $query = "DELETE FROM plants WHERE idplants = ?";
    $stmtdelte = $conn->prepare($query);
    $stmtdelte->bind_param("i", $_POST['id_product']);
    $stmtdelte->execute();
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
// if (isset($_POST['editproduct'])) {
//     $img = $_POST['uploadimg'];
//     $prix = $_POST['price'];
//     $nom = $_POST['nomproduct'];

//     $edit = "UPDATE plants SET plants";
//     $exe = $conn->prepare($edit);
//     $exe->bind_param()
// }
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
            <div class="icon">
                <i class='bx bx-search icon'></i>
                <i class='bx bx-bell icon'></i>
                <i class='bx bx-user-circle'></i>
            </div>
        </div>
        <div class="">
            <div class="text adding">
                <h6 class="text-lg">Add Somme Plants If You Want</h6>
                <button type="button" data-modal-toggle="authentication-modal" class="button bg-[#557C55]"><i
                        class='bx bx-plus'></i></button>
            </div>
            <div class="plant">
                <?php
                while ($row = mysqli_fetch_assoc($stmtProducts)) :
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
                                <span class="progress-text"><?= $row['nom'] ?></span>
                                <button class="button"><i class='bx bx-edit-alt'></i></button>
                                <button data-modal-target="delete-modal"
                                    data-modal-toggle="delete-modal-<?= $row["idplants"] ?>" class="button"><i
                                        class='bx bx-trash-alt'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal For Delete Plants -->
                <div id="delete-modal-<?= $row["idplants"] ?>" tabindex="-1"
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
                                    <input type="hidden" name="id_product" value="<?= $row["idplants"] ?>">
                                    <button data-modal-hide="delete-modal" type="submit" name="delete_product"
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
                            <label for="currency">Select Category</label>
                            <select id="currency" name="option"
                                class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                <option selected>Choose Category</option>
                                <?php while ($cat = mysqli_fetch_assoc($stmtCategories)) : ?>
                                <option value="<?= $cat['idcategory'] ?>"><?= $cat['nom'] ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>
                        <div class="col-span-full">
                            <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Cover
                                photo</label>
                            <div
                                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="uploadimg" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="text" name="price"
                                    class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <label for="currency" class="sr-only">Currency</label>
                                    <select id="currency" name="currency"
                                        class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                        <option>USD</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <div class="relative mt-2 rounded-md shadow-sm">

                                <input type="text" name="nomproduct"
                                    class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    placeholder="Name Plants">
                            </div>
                        </div>
                        <div class="flex justify-end m-2 ">
                            <button
                                class="px-4 py-2 bg-gradient-to-r bg-[#557C55] hover:opacity-80 text-white text-sm font-medium rounded-md"
                                name="add_product" type="submit">
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