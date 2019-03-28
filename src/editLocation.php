<?php
session_start();
include 'connect.php';
include 'destination.php'; 
include 'countryList.php'; 
include 'activityList.php';
include 'generate.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Add - Review</title>

		<!-- css -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body>
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
					<form action="#" method="post">
					<div class="row">
						<div class="col-sm-2">
						Rating:
						</div>
						<div class="form_input">
							<select id="filter_rating" class="form-control" name="add_rating">
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
					<div class="row">
						<div class ="col-sm-2">
						Description:
						</div> 
						<input type="text" name="add_description"></input><br>
					</div>
					<div class="row">
						<div class ="col-sm-2">
						Name:
						</div> 
						<input type="text" name="add_name">"sf"</input><br>
					</div>
					<input type="submit">
					</form>
					<?php
					echo generateDestination();
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

<?php

function generateDestination(){

	require 'connect.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$dest_review = (isset($_POST['add_review'])) ? $_POST['add_review'] : null;
		$dest_rating = (isset($_POST['add_rating'])) ? $_POST['add_rating'] : null;
		$p_id = $_SESSION['p_id'];
		$dest_id = $_SESSION['dest_id'];

		echo 'p_id: ' . $p_id . ' dest_id: ' . $dest_id . ' user: ';

		$sql = "";

		if ($dest_review === null) {
			echo 'please write a review, try again!';
			return;
		} else {
			$sql = "INSERT INTO Review (rev_id, p_id, dest_id, rating, review) VALUES (null, '$p_id', '$dest_id', '$dest_rating', '$dest_review')";
			if ($conn->query($sql) === TRUE) {
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}

?>
