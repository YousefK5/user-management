<?php require 'conn.php'; ?>

<?php
session_start();
if (isset($_SESSION['email'])) {
    $curEmail = $_SESSION['email'];
    $curUser = $conn->prepare("SELECT full_name, email 
        FROM users 
        WHERE email=:e");
    $curUser->bindParam(':e', $curEmail);
    $curUser->execute();
    $curUser = $curUser->fetch();
} else {
    header('location: ../index.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
    />
    <title>Document</title>
</head>
<body>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <h2>Welcome <?php echo $curUser['full_name']; ?></h2>
            </div>
            <div class="col-sm-3">
                <a href="logout.php" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Logout</span></a>						
            </div>
        </div>
        <h3>Your Email is <?php echo $curUser['email']; ?></h3>
</div>
    </body>
</html>