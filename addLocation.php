<?php
session_start();
include 'src/connect.php';
include 'src/destination.php'; 
include 'src/countryList.php'; 
include 'src/activityList.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Add - Travel Destinations</title>

		<!-- css -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="index.php">Home</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Link</a>
		      </li>
		      <li class="nav-item">
		      	<a class="nav-link" href="admin.php">Admin</a>
		      </li>
		    </ul>
		  </div>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<div class="d-block col-sm-3">
		            <div class="py-2 flex-grow-1">
		                <div class="sidebar flex-sm-column">
		                    <h1 class="my-4">🌏 Travel:
		                    </h1>
		                    
		                </div>
		            </div>
		        </div>
				<div class="col content">
					<h1> Users will be able to add destinations here</h1>
					<form action="" method="post">
					<div class="row">
						<div class ="col-sm-2">
						Name:
						</div> 
						<input type="text" name="name"><br>
					</div>
					<div class="row">
						<div class="col-sm-2">
						Nearest City:
						</div>
						<input type="text" name="city"><br>
					</div>
					<div class="row">
					<div class="col-sm-2">
						Country: 
					</div>
						<div class="form_input">
									<select id="filter_country" class="form-control" name="filter_country">
										<option value="" disabled selected hidden>choose Country</option>
										<option value="">n/a</option> 
										<?php echo countrySelect(); ?>
	                				</select>
						</div>
					</div>
						<div class="row">
							<div class="col-sm-2">
							Rating:
							</div>
							<div class="form_input">
										<select id="filter_rating" class="form-control" name="filter_rating">
											<option value="" disabled selected hidden>choose Rating</option>
											<option value="">n/a</option> 
											<option value=5>⭐⭐⭐⭐⭐</option> 
											<option value=4>⭐⭐⭐⭐</option> 
											<option value=3>⭐⭐⭐</option> 
											<option value=2>⭐⭐</option> 
											<option value=1>⭐</option> 
		                				</select>
							</div>
						</div>
						<input type="submit">
						</form>
					<?php
					//generateDestination();   <-- THIS IS CAUSING PROBLEMS
					
					?>
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