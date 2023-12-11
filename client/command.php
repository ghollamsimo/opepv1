<?php
include '../config/connect.php';
session_start();
$userid = $_SESSION['userId'];

if (isset($_GET['total'])) {
    $date = date('Y-m-d');
    $requet = "INSERT INTO orders (total_price , order_date , user_id) VALUES (? , ? , ?)";
    $stmt = $conn->prepare($requet);
    $stmt->bind_param('isi', $_GET['total'], $date, $userid);
    $stmt->execute();

    $delete = "DELETE FROM cart WHERE userid = $userid";
    $stmt2 = $conn->query($delete);
    header('Location:home.php');
} else {
    echo "error";
}