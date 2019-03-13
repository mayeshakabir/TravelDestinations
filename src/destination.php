<?php

function displayResults() {
	$sql = "SELECT dest_ID, city_name, name, pic_url, description, rating, address FROM Destination";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require 'connect.php';

		$activity = (isset($_POST['filter_activity'])) ? $_POST['filter_activity'] : "";
		$country = (isset($_POST['filter_country'])) ? $_POST['filter_country'] : "";
		$city = (isset($_POST['filter_city'])) ? $_POST['filter_city'] : "";
		$rating = (isset($_POST['filter_rating'])) ? $_POST['filter_rating'] : "";
		$whereParts = array();

		if ($activity !== "") {
			$whereParts[] = "activity LIKE '%$activity%' ";
		}
		if ($country !== "") {
			$whereParts[] = "country_id IN (SELECT country_ID FROM Country WHERE name LIKE '%$country%') ";
		}
		if ($city !== "") {
			$whereParts[] = "city_name LIKE '%$city%' ";
		}
		if ($rating !== "") {
			$whereParts[] = "rating LIKE '%$rating%' ";
		}

		//rank, rating, name
			
		$sql = "SELECT dest_ID, city_name, name, pic_url, description, rating, address FROM Destination ";
		if(count($whereParts)) {
	    	$sql .= "WHERE " . implode('AND ', $whereParts);
		}
	}
	echo $sql;
	queryDestinations($sql);
}

function queryDestinations($sql) {
	/* TODO need to give filters to write up the query using a POST*/
	//$conn = OpenCon();
	require 'connect.php';
	$result = $conn->query($sql);
	/* template
	
	*/
	if ($result->num_rows > 0) {
		$destinations = '<h1 class="my-4">→ <small>Top Destinations:</small></h1><br>'; 
		while($row = $result->fetch_assoc()) { 
			$destinations .=	'<div class="row">';
			$destinations .=	    '<div class="col-lg-4">';
			$destinations .=	      '&nbsp&nbsp<img class="dest-pic" src="'.$row["pic_url"].'">';
			$destinations .=	    '</div>';
			$destinations .=	    '<div class="col-lg-8 ml-auto">';
			$destinations .=	      '<h3>'.$row["name"].' <small>✈️ </small></h3>';
			$destinations .=	      '<p><b>'.$row["description"].'</b>';
			$destinations .=	      '<br> rating: ';
										for ($i = 0; $i < $row["rating"]; $i++) {
							    			$destinations .= '⭐';
										} 
			$destinations .=	      '<br>Location: 📍<i>'.$row["city_name"]. '</i>, <a href="https://maps.google.com/?q='.$row["address"].'" target="_blank"><b>@</b>'. $row["address"].'</a>' . '</p>';
			$destinations .=		  '<div class="reviews"><div class="review-title"><b>📝 Reviews:</b></div>';
			$destinations .= 		  queryReviews($conn, $row["dest_ID"]);
			$destinations .=		  '</div>';
			$destinations .=		  '<div class="activities"><div class="activities-title"><b>🚴 Activities:</b></div>';
			$destinations .= 		  queryActivities($conn);
			$destinations .=		  '</div>';
			$destinations .=	    '</div>';
			$destinations .=	'</div><hr>';
		}
		echo $destinations;
	}
	else {
		echo "<p>no destinations :(</p>"; 
	}
}

function queryReviews($conn, $dest_ID) {
	$sql = "SELECT review FROM Review WHERE dest_ID=$dest_ID";
	$result = $conn->query($sql);
	$i = 1;

	if ($result->num_rows > 0) {
		$reviews = ''; 
		while($row = $result->fetch_assoc()) { 
			$reviews .=	$i . '. ' . $row["review"] . '<hr>';
			$i++;
		}
		return $reviews;
	}
	else {
		return 'no reviews :('; 
	}
}

function queryActivities($conn) {

	return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
}

?>