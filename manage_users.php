<?php
session_start();
include 'connect.php';


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); 
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $new_role = $_POST['new_role'];

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$new_username', '$new_email', '$new_password', '$new_role')";
    mysqli_query($conn, $sql);
}


$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

