<?php
session_start();
include 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: dashboard.php'); 
            exit();
        } else {
            echo "كلمة المرور غير صحيحة";
        }
    } else {
        echo "اسم المستخدم غير موجود";
    }
}
?>