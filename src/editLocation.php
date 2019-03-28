<?php
session_start();
include 'connect.php';
include 'destination.php'; 
include 'countryList.php'; 
include 'activityList.php';
include 'generate.php';

$dest_id = $_SESSION['dest_id'];
$sql = "SELECT * FROM Destination WHERE dest_id LIKE '$dest_id'";
$result =  $conn->query($sql);
if ($result) {
	$row = $result->fetch_assoc();
	$p_name = $row["name"];
	$p_description = $row["description"];
	$p_rating = $row["rating"];
	$p_hours = $row["visiting_hours"];
}


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
				<div class="col content edit">
					<h1>🌏 Travel →  <small>Edit Destinations</small></h1>
					<form action="#" method="post">

					<div class="form-group">
					    <label for="exampleInputEmail1">Name</label>
					    <input class="form-control" type="text" name="n_name" value = "<?php echo $p_name; ?>">
					</div>
					<div class="form-group">
					    <label for="exampleInputEmail1">Description</label>
					    <input class="form-control" type="text" name="n_description" value = "<?php echo $p_description; ?>">
					</div>
					<div class="form-group">
					    <label for="exampleInputEmail1">Rating</label>
					    <input class="form-control" type="text" name="n_rating" value = "<?php echo $p_rating; ?>">
					</div>
					<div class="form-group">
					    <label for="exampleInputEmail1">Hours</label>
					    <input class="form-control" type="text" name="n_hours" value = "<?php echo $p_hours; ?>">
					</div>


					<input type="submit">
					</form>
					<?php
					echo generateDestination();					
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
		$n_name = (isset($_POST['n_name'])) ? $_POST['n_name'] : null;
		$n_description = (isset($_POST['n_description'])) ? $_POST['n_description'] : null;
		$n_rating = (isset($_POST['n_rating'])) ? $_POST['n_rating'] : null;
		$n_hours = (isset($_POST['n_hours'])) ? $_POST['n_hours'] : null;

		$dest_id = $_SESSION['dest_id'];

		// echo 'n_name: ' . $n_name . ' n_description: ' . $n_description . ' user: ';

		$sql = "";

		if ($n_name === null) {
			echo 'please give a name, try again!';
			return;
		} else {
			$sql = "UPDATE Destination
					SET name = '$n_name', description = '$n_description', rating = '$n_rating', visiting_hours = '$n_hours'
					WHERE dest_id = '$dest_id'";
			if ($conn->query($sql) === TRUE) {
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}

?>
