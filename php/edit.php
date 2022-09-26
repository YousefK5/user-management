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
        $curUser = $conn->query("SELECT * from users WHERE id='$curId'");
        $curUser = $curUser->fetch();
        // print_r($curUser);

        if (isset($_POST['save'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $phone = $_POST['phone'];
            $conn->query(
                "UPDATE users SET id='$id' , full_name='$name' , email='$email' , password='$pass', phone='$phone' WHERE id = '$curId'"
            );
            header('location:admin.php');
        }
    }
} else {
    header('location: ../index.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
    
/* Modal styles */
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}	
</style>
</head>
<body>
<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>ID</label>
						<input type="text" name="id" class="form-control" value="<?php echo $curUser[
          'id'
      ]; ?>" required>
					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="<?php echo $curUser[
          'full_name'
      ]; ?>" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" value="<?php echo $curUser[
          'email'
      ]; ?>" required>
					</div>	
                    <div class="form-group">
						<label>Password</label>
						<input type="text" name="pass" class="form-control" value="<?php echo $curUser[
          'password'
      ]; ?>" required>
					</div>
                    <div class="form-group">
						<label>Phone</label>
						<input type="phone" name="phone" class="form-control" value="<?php echo $curUser[
          'phone'
      ]; ?>" required>
					</div>			
				</div>
				<div class="modal-footer">
					<a href="admin.php" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="save" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</body>
</html>