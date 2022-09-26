<?php
require 'conn.php';

session_start();

$_SESSION['email'] = $_POST['email'];

$fullName = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['pass'];
$birthDate = $_POST['birthDate'];

try {
    $stmt = $conn->prepare("INSERT INTO users
    (email,phone,full_name,birth_date,password)
    VALUES (:email,:phone,:name,:birthDate,:pass)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':name', $fullName);
    $stmt->bindParam(':birthDate', $birthDate);
    $stmt->bindParam(':pass', $password);

    $stmt->execute();
} catch (Exception $e) {
    $e->getMessage();
}

?>
