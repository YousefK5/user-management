<?php require 'conn.php'; ?>

<?php
session_start();
if ($_SESSION['email']) {
    $curEmail = $_SESSION['email'];
    $stmt = $conn->query("SELECT is_admin from users WHERE email='$curEmail'");
    $stmt = $stmt->fetch();
    if (!$stmt['is_admin']) {
        header('location: welcome.php');
    } else {
        $curId = $_GET['id'];
        $conn->query("DELETE FROM users WHERE id='$curId'");
        header('location:admin.php');
    }
} else {
    header('location: ../index.html');
}


?>
