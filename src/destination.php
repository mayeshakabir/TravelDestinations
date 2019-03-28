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

		if ($country !== "") {
			$whereParts[] = "country_id IN (SELECT country_ID FROM Country WHERE name LIKE '%$country%') ";
		}
		if ($city !== "") {
			$whereParts[] = "city_name LIKE '%$city%' ";
		}
		if ($rating !== "") {
			$whereParts[] = "rating LIKE '%$rating%' ";
		}
		if ($activity !== "all" && $activity !== "") {
			$whereParts[] = "dest_ID IN (SELECT dest_ID
									FROM Destination_Activity
									WHERE act_ID IN (SELECT act_ID
      								FROM Activity
      								WHERE name LIKE '%$activity%')
														)";
		}

		//rank, rating, name
		if ($activity === "all") { 
			$sql = "SELECT * FROM (SELECT * 
					FROM Destination d 
					WHERE NOT EXISTS 
					(SELECT * from Activity a 
					WHERE NOT EXISTS 
					(SELECT a.act_ID 
					FROM Destination_Activity da 
					WHERE da.act_ID=a.act_ID AND 
					da.dest_ID=d.dest_ID))) Something
					 ";
		}
		
		else { 
			$sql = "SELECT * FROM Destination "; 
		}

		if(count($whereParts)) {
	    	$sql .= "WHERE " . implode('AND ', $whereParts);
		}

		if (isset($_POST['filter_topRating'])) {
			$sql = "SELECT *
					FROM Destination
					WHERE dest_id IN 
					(SELECT id
					FROM ( 
						SELECT dest_ID as id, AVG(rating) AS avg_rating
						FROM Review
						GROUP BY id) T2
					WHERE T2.avg_rating = 
						(SELECT MAX(T1.avg_rating)
						FROM ( 
							SELECT dest_ID as id, AVG(rating) AS avg_rating
							FROM Review
							GROUP BY id) T1));
										";

		}
		if (isset($_POST['filter_maxActivities'])) {
			$sql = "SELECT *
					FROM Destination
					WHERE dest_id IN 
					(SELECT id
					FROM ( 
						SELECT dest_ID as id, COUNT(act_ID) AS act_count
						FROM Destination_Activity
						GROUP BY id) T2
					WHERE T2.act_count = 
						(SELECT MAX(T1.act_count)
						FROM ( 
							SELECT dest_ID as id, Count(act_ID) AS act_count
							FROM Destination_Activity
							GROUP BY id) T1));
										";
		}
	}
	// echo $sql;
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
			$destinations .= 			'<form style="display: inline-block;" class="form-horizontal" method="POST" action="#">
										<input id="prodId" name="dest_ID" type="hidden" value="'.$row["dest_ID"].'">
										<input class="btn btn-sm btn-light" type="submit" name="btnReview" value="📝"/>
										</form>';

			$destinations .= 			'<form style="display: inline-block;" class="form-horizontal" method="POST" action="#">
										<input name="update_dest_ID" type="hidden" value="'.$row["dest_ID"].'">
										<input class="btn btn-sm btn-light" type="submit" name="updateBtnReview" value="✏️"/>
										</form>';

			$destinations .= 			'<form style="display: inline-block;" class="form-horizontal" method="POST" action="#">
										<input name="delete_dest_ID" type="hidden" value="'.$row["dest_ID"].'">
										<input class="btn btn-sm btn-light" type="submit" name="deleteBtnReview" value="❌"/>
										</form>';

			$destinations .= 		'</h3>';
			$destinations .=	      '<p><b>'.$row["description"].'</b>';

			$destinations .=	      '<br> rank: ';
										for ($i = 0; $i < $row["rating"]; $i++) {
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
		if (isset($_POST['btnReview'])) {
			$dest_ID = $_POST['dest_ID'];
			if(!isset($_SESSION)) 
		    { 
		        session_start(); 
		    } 	
		    require 'connect.php';
			$username = $_SESSION['username'];

			$sql="select * from Person where name='".$username."' limit 1";
			$result=$conn->query($sql);
			if($result->num_rows==1) {
				$row = $result->fetch_assoc();
				$p_ID = $row['p_ID'];
				$_SESSION['p_id']  = $p_ID;
				$_SESSION['dest_id']  = $dest_ID;
				echo 'p_id: ' . $p_ID . ' dest_id: ' . $dest_ID . ' user: ' . $username;
				// header("Location:src/addLocation.php");
				$URL="addLocation.php";
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
				echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
			}

		}
		if (isset($_POST['updateBtnReview'])) {
			$dest_ID = $_POST['update_dest_ID'];
			if(!isset($_SESSION)) 
		    { 
		        session_start(); 
		    } 	
		    require 'connect.php';
		    $_SESSION['dest_id']  = $dest_ID;
		    $URL="editLocation.php";
			echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
			
			echo $dest_ID;
		}
		if (isset($_POST['deleteBtnReview'])) {
			$dest_ID = $_POST['delete_dest_ID'];
			
			require 'connect.php';
			$sql = "DELETE FROM Destination WHERE dest_ID LIKE $dest_ID";
			echo $sql;
			$result = $conn->query($sql);
			
			if ($result === TRUE) {
				$URL="homepage.php";
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
				echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
			} 
			else {
				echo "Error removing record: " . $conn->error; 
			}
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
