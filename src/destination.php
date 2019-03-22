<?php

function displayResults() {
	$sql = "SELECT * FROM Destination";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require 'connect.php';

		$activity = (isset($_POST['filter_activity'])) ? $_POST['filter_activity'] : "";
		$country = (isset($_POST['filter_country'])) ? $_POST['filter_country'] : "";
		$city = (isset($_POST['filter_city'])) ? $_POST['filter_city'] : "";
		$rating = (isset($_POST['filter_rating'])) ? $_POST['filter_rating'] : "";
		
		$whereParts = array();

		if ($activity !== "") {
			$whereParts[] = "dest_ID IN (SELECT dest_ID
																	FROM Destination_Activity
                   								WHERE act_ID IN (SELECT act_ID
                                  								FROM Activity
                                  								WHERE name LIKE '%$activity%')
                   																)";
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

		$sql = "SELECT * FROM Destination ";
		if(count($whereParts)) {
	    	$sql .= "WHERE " . implode('AND ', $whereParts);
		}
	}
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
			$destinations .=	      '<img class="dest-pic" src="'.$row["pic_url"].'">';
			$destinations .=	    '</div>';
			$destinations .=	    '<div class="col-lg-8 ml-auto">';
			$destinations .=	    '<h3>'. $row["name"] . '&nbsp';
			$destinations .= 			'<form class="form-horizontal" method="POST" action="#">
										<input id="prodId" name="dest_ID" type="hidden" value="'.$row["dest_ID"].'">
										<input class="btn btn-sm btn-light" type="submit" name="btnReview" value="📝"/>
										</form></h3>';
			$destinations .=	      '<p><b>'.$row["description"].'</b>';

			$destinations .=	      '<br> rank: ';
										for ($i = 0; $i < $row["ranking"]; $i++) {
							    			$destinations .= '⭐';
										}
			$destinations .=	      '<br>Location: 📍<i>'.$row["city_name"]. '</i>, <a href="https://maps.google.com/?q='.$row["address"].'" target="_blank"><b>@</b>'. $row["address"].'</a>' . '</p>';
			$destinations .=		  '<div class="reviews"><div class="review-title"><b>📝 Reviews:</b></div><br>';
			$destinations .= 		  queryReviews($conn, $row["dest_ID"]);
			$destinations .=		  '</div>';
			$destinations .=		  '<div class="activities"><div class="activities-title"><b>🚴 Activities:</b></div><br>';
			$destinations .= 		  queryActivities($conn, $row["dest_ID"]);
			$destinations .=		  '</div>';
			$destinations .=	    '</div>';
			$destinations .=	'</div><hr>';
		}
		echo $destinations;
	}
	else {
		echo "<p>no destinations :(</p>";
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['btnReview'])){
			$dest_ID = $_POST['dest_ID'];
			if(!isset($_SESSION)) 
		    { 
		        session_start(); 
		    } 	
		    require 'connect.php';
			$username = $_SESSION['username'];
			echo $dest_ID .'  ' . $username;
		}
	}
}

function queryReviews($conn, $dest_ID) {
	$sql = "SELECT rating, review, p_ID FROM Review WHERE dest_ID = $dest_ID";

	$result = $conn->query($sql);
	$x = 1;

	if ($result->num_rows > 0) {
		$reviews = '';
		while($row = $result->fetch_assoc()) {
			$reviews .=	$x . '. ';
			for ($i = 0; $i < $row["rating"]; $i++) {
    			$reviews .= '<i>★</i>';
			}
			$reviews .=	' <i>' . $row["review"] . '</i> -' . queryPerson($conn, $row["p_ID"]) . '<br><br>';
			$x++;
		}
		return $reviews;
	}
	else {
		return 'no reviews :(';
	}
}

function queryPerson($conn, $p_ID) {
	$sql = "SELECT name FROM Person WHERE p_ID = $p_ID";

	$result = $conn->query($sql);

	if ($result->num_rows > 0 ){
		$row = $result->fetch_assoc();
		return $row["name"];
	}

}

function queryActivities($conn, $dest_ID) {
	$activities = "";
	$activities .= queryRecreation($conn, $dest_ID);
	$activities .= queryTour($conn, $dest_ID);
	return $activities;
}

function queryRecreation($conn, $dest_ID){
	$sql = "SELECT * FROM (Recreation NATURAL JOIN
      (SELECT act_ID, name, cost_avg FROM Activity
		WHERE act_ID IN
     		(SELECT act_ID FROM Destination_Activity
      		WHERE dest_ID = $dest_ID) )
               AS T2)";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
		$recreations = '';
		while($row = $result->fetch_assoc()) {
			$recreations .= $row["name"]; 
			// TODO $recreations .= ' | ' . $row["icon"];
			$recreations .= ' | cost: $' . $row["cost_avg"] . '<hr>';
		}
		return $recreations;
	}
	else {
		return 'no recreation :( <hr>';
	}
}

function queryTour($conn, $dest_ID){
	$sql = "SELECT name, provider, cost_avg, url, duration FROM (Activity NATURAL JOIN Tour NATURAL JOIN Destination_Activity)
     WHERE dest_ID = $dest_ID";

		$result = $conn->query($sql);

	 	if ($result->num_rows > 0) {
	 	$tours = '';
	 	while($row = $result->fetch_assoc()) {
	 		$tours .= '<b>' . $row["name"] . '</b> | ';
			$tours .= '<a href="https://' . $row["url"] .'" target="_blank">' . $row["provider"] . '</a>';
			$tours .= ' | duration: ' . $row["duration"] . ' hrs';
			$tours .= ' | cost: $' . $row["cost_avg"] . '<hr>';
	 	}
	 	return $tours;
	 }
	 else {
	 	return 'no tours :( <hr>';
	 }
}

?>
