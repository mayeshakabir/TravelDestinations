<?php
session_start();
include 'src/connect.php';
include 'src/destination.php'; 
include 'src/countryList.php'; 
include 'src/activityList.php';
include 'src/login.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Travel Destinations</title>

		<!-- css -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body>
		<div class="container-fluid">
			<div class="sidenav">
         <div class="login-main-text">
            <h2>Application<br> Login Page</h2>
            <p>Login or register from here to access.</p>
         </div>
      </div>
			<div class="col-md-6 col-sm-12">
				<div class="login-form">
				   <form class="form-horizontal" method="POST" action="#">
				      <div class="form-group">
				         <label>User Name</label>
				         <input type="text" class="form-control" placeholder="User Name" name="log_username">
				      </div>
				      <div class="form-group">
				         <label>Password</label>
				         <input type="password" class="form-control" placeholder="Password" name="log_password">
				      </div>
				      <button type="submit" class="btn btn-black">Login</button>
				      <?php loginHTML(); ?>
				   </form>
				</div>
			</div>
		</div>
		
		<!-- css -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"> </script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	</body>
</html>