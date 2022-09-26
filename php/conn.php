<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=task3', 'root', 'root');
} catch (Exception $e) {
    $e->getMessage();
}

?>
