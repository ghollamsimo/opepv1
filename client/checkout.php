<?php
include '../config/connect.php';
session_start();
$userid = $_SESSION['userId'];

$total = 0;
$select = "SELECT * FROM cart JOIN plants ON plant_id = idplants WHERE userid = $userid";
$stmtwo = $conn->query($select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&family=Tajawal:wght@500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/checkout.css?v=<?php echo time(); ?>">
    <title>Checkout</title>
</head>

<body>


    <div class="test">



        <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Shopping Cart</b></h4>
                            </div>
                        </div>
                    </div>
                    <?php
                    while ($afiche = mysqli_fetch_assoc($stmtwo)) :
                        $img = $afiche['img'];
                        $nom = $afiche['nom'];
                        $quantity = $afiche['quantity'];
                        $price = $afiche['price'];
                        $total += $price * $quantity;

                    ?>
                    <div class="row">
                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid" src="../img/<?= $img ?>"></div>
                            <div class="col">
                                <div class="row text-muted">Plants</div>
                                <div class="row"><?= $nom ?></div>
                            </div>
                            <div class="col-2">&euro; <?= $price ?> </div>
                        </div>
                    </div>
                    <?php endwhile ?>
                    <div class="back-to-shop"><a href="./plants.php">&leftarrow;</a><span class="text-muted">Back to
                            shop</span>
                    </div>
                </div>
                <div class="col-md-4 summary">
                    <div>
                        <h5><b>Summary</b></h5>
                    </div>
                    <hr>

                    <form>
                        <p>SHIPPING</p>
                        <select>
                            <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                        </select>
                        <p>GIVE CODE</p>
                        <input id="code" placeholder="Enter your code">
                    </form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>
                        <div class="col text-right">&euro; <?= $total ?></div>
                    </div>
                    <a href=" ./command.php?total=<?= $total ?>" class="btn btn-dark">Commande</a>
                </div>
            </div>

        </div>


        <!-- <a href=" ./command.php?total=<?= $total ?>">commande</a> -->
    </div>

</body>

</html>