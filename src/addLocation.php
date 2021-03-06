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
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	</head>
	<body>
		<div class="container-fluid">
			<div class="edit">
				<h1>🌏 Travel →  <small>Add Review</small></h1>
				<form action="#" method="post">
					<div class="form-group">
						<label>Rating:</label>
						<div class="form_input">
							<select id="filter_rating" class="form-control" name="add_rating">
								<option value=5>⭐⭐⭐⭐⭐</option> 
								<option value=4>⭐⭐⭐⭐</option> 
								<option value=3>⭐⭐⭐</option> 
								<option value=2>⭐⭐</option> 
								<option value=1>⭐</option> 
	        				</select>
						</div>
					</div>
					<div class="form-group">
						<label>Review:</label>
						<textarea class="form-control" type="Review" name="add_review"></textarea><br>
					</div>
					<input type="submit" class="btn btn-primary">
				</form>
				<?php
				echo generateDestination();
				//generateDestination();   <-- THIS IS CAUSING PROBLEMS
				?>
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

		// echo 'p_id: ' . $p_id . ' dest_id: ' . $dest_id . ' user: ';

		$sql = "";

		if ($dest_review === "") {
			echo 'please write a review, try again!';
			return;
		} else {
			$sql = "INSERT INTO Review (rev_id, p_id, dest_id, rating, review) VALUES (null, '$p_id', '$dest_id', '$dest_rating', '$dest_review')";
			if ($conn->query($sql) === TRUE) {
				$URL="homepage.php";
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
				echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}

?>
