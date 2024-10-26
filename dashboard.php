<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); 
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <button onclick="location.href='manage_users.php'">Manage Users</button>
        <button onclick="location.href='manage_questions.php'">Manage Questions</button>
        <button onclick="location.href='view_results.php'">View Results</button>
        <button onclick="location.href='logout.php'">Logout</button>
    </div>
</body>
</html>