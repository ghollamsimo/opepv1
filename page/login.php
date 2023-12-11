<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config/connect.php';
session_start();

if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {

            if ($row["idrole"] == 1) {
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                $_SESSION['userId'] = $row['iduser'];
                header("Location: ../client/home.php");
                exit();
            }
        } else {
            echo "<h3 class='incorect'>Incorrect password</h3>";
        }
    } else {
        echo "<h3 class='incorect'>User not found</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <!-- <link rel="stylesheet" href="./css/dist/output.css"> -->


    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="login">
            <div class="left">
                <h1 class="text-lg">Welcome To Opep Garden</h1>
                <h3>One Stope For All the variety Of Plants</h3>
                <div class="blob">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#A6CF98"
                            d="M65.8,-51.8C81.4,-33,87.3,-5.8,81.3,17.8C75.3,41.4,57.3,61.5,35.1,71.8C12.9,82.1,-13.6,82.6,-36.2,72.6C-58.9,62.7,-77.8,42.4,-82.9,19.1C-88.1,-4.1,-79.5,-30.3,-63.4,-49.3C-47.3,-68.3,-23.6,-80.1,0.8,-80.7C25.1,-81.3,50.3,-70.7,65.8,-51.8Z"
                            transform="translate(100 100)" />
                    </svg>
                    <img class="img" src="../img/plants_1.png" alt="">
                </div>
            </div>
            <div class="right">
                <h4><span><i class='bx bx-leaf'></i></span>Opep Garden</h4>
                <h1>Login In to Your Opep Account</h1>
                <div class="inputs">
                    <form action="" method="post">
                        <input class="input" type="text" name="email" placeholder="Email" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                        <input class="input" type="password" name="password" placeholder="Password"
                            id="exampleInputPassword1">
                        <input type="submit" name="submit" value="Login" class="submit">
                    </form>
                    <small class="signup">Don't Have Account? <a href="../index.php">Sign Up</a></small>
                </div>

            </div>
        </div>
    </div>
</body>

</html>