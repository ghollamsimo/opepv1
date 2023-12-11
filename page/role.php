<?php
include '../config/connect.php';
session_start();
if ($_SESSION) {
    $email = $_SESSION['email'];
}

if (isset($_POST['1'])) {
    $test = 1;
} else if (isset($_POST['2'])) {
    $test = 2;
}
if (isset($test)) {
    $select = "SELECT * FROM users WHERE email = '$email'";
    $stmt = $conn->query($select);
    $row = mysqli_fetch_assoc($stmt);
    $userId = $row['iduser'];

    $updateRequet = $conn->prepare("UPDATE users SET idrole = ? where email = ? ");
    $updateRequet->bind_param("is", $test, $email);
    $updateRequet->execute();
    if ($test == 1) {
        header("location: ../admin/dashboard.php");
    } else if ($test == 2) {
        $_SESSION['userId'] =  $userId;
        header("location: ../client/home.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&family=Tajawal:wght@500&display=swap"
        rel="stylesheet">
    <title>Role</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-item-center m-5 align-items-center">
        <form action="" method="post">
            <button type="submit" class="btn btn-primary" name="2">CLIENT</button>
            <button type="submit" class="btn btn-success" name="1">ADMIN</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>