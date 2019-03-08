<?php include 'src/destination.php'; ?>
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
			<div class="row">
				<div class="d-none d-md-flex col-sm-4 bg-image">
		            <div class="py-2 sticky-top flex-grow-1">
		                <div class="sidebar flex-sm-column">
		                    <h1 class="my-4">🌏 Travel 
		                    	<small>bucket list!</small>
		                    </h1>
		                </div>
		            </div>
		        </div>
				<div class="col content">
					<?php echo queryDestinations(); ?>
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