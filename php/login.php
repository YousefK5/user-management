<?php
require 'conn.php';

try {
    $curEmail = $_POST['email'];
    $curPassword = $_POST['pass'];
    $stmt = $conn->query(
        "SELECT email , password , is_admin FROM users WHERE email='$curEmail'"
    );
    $stmt = $stmt->fetch();
    if ($stmt) {
        if ($stmt['password'] == $curPassword) {
            $conn->query(
                "UPDATE users SET last_login=CURRENT_TIMESTAMP WHERE email='$curEmail'"
            );
            session_start();
            $_SESSION['email'] = $stmt['email'];
            if ($stmt['is_admin'] == 1) {
                echo '2';
            } else {
                echo '1';
            }
        } else {
            echo '0';
        }
    } else {
        echo '0';
    }
} catch (Exception $e) {
    $e->getMessage();
}

?>
