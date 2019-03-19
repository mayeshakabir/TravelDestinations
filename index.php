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
		  <div class="row no-gutter">
		  <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"> 
				<div class="names">
					<div class="container">
				      <div>
				      	<center>
				      		<h2><b>&copy; 2019</b><br></h2>
				      		<hr>
				      		<small><p>
				      		Rory Court <br>
				      		Simeon Stakić <br>
				      		Nada Kourkmas <br>
				      		Mayesha Kabir <br></p></small>
				      	</center>
				      </div>
					</div>
				</div>
		    </div>
		    <div class="col-md-8 col-lg-6">
		      <div class="login d-flex align-items-center py-5">
		        <div class="container">
		          <div class="row">
		            <div class="col-md-9 col-lg-8 mx-auto">
		              <h3 class="login-heading mb-4">Welcome back!</h3>
		              <form method="POST" action="#">
		                <div class="form-label-group">
		                  <input type="text" id="inputEmail" class="form-control" name="log_username" placeholder="Username" required autofocus>
		                  <label for="inputEmail">Username</label>
		                </div>
		                <div class="form-label-group">
		                  <input type="password" id="inputPassword" class="form-control" name="log_password" placeholder="Password" required>
		                  <label for="inputPassword">Password</label>
		                </div>
		                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
		                <?php loginHTML(); ?>
		              </form>
		            </div>
		          </div>
		        </div>
		      </div>
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