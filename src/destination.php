<?php
include 'connect.php';

function queryDestinations() {
	/* TODO need to give filters to write up the query using a POST*/
	$conn = OpenCon();
	$sql = "SELECT dest_ID, city_name, name, pic_url, description, rating, address FROM Destination";
	$result = $conn->query($sql);
	/* template
	
	*/
	if ($result->num_rows > 0) {
		$destinations = '<h1 class="my-4">→ <small>Top Destinations:</small></h1><br>'; 
		while($row = $result->fetch_assoc()) { 
			$destinations .=	'<div class="row">';
			$destinations .=	    '<div class="col-lg-4">';
			$destinations .=	      '<img class="dest-pic" src="'.$row["pic_url"].'">';
			$destinations .=	    '</div>';
			$destinations .=	    '<div class="col-lg-8 ml-auto">';
			$destinations .=	      '<h3>✈️ '.$row["name"].'</h3>';
			$destinations .=	      '<p>'.$row["description"];
			$destinations .=	      '<br> rating: ';
										for ($i = 0; $i < $row["rating"]; $i++) {
							    			$destinations .= '⭐';
										} 
			$destinations .=	      '<br> 📍'.$row["city_name"]. ', <b>@</b>'. $row["address"] . '</p>';
			$destinations .=		  '<div class="reviews"><div class="review-title"><b>Reviews:</b></div>';
			$destinations .= 		  queryReviews($conn, $row["dest_ID"]);
			$destinations .=		  '</div>';
			$destinations .=		  '<div class="activities"><div class="activity-title"><b>Activities:</b></div>';
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
	CloseCon($conn);
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