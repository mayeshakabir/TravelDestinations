<?php
include 'connect.php';

function queryDestinations() {
	/* TODO need to give filters to write up the query using a POST*/
	$conn = OpenCon();
	$sql = "SELECT city_name, name, pic_url, description, rating, address FROM Destination";
	$result = $conn->query($sql);
	/* template
	<div class="row">
	    <div class="col-md">
	      <a href="#">
	        <img class="dest_pic" src="https://cdn2.veltra.com/ptr/20151019025210_2135428681_10001_0.jpg?imwidth=550&impolicy=custom" alt="">
	      </a>
	    </div>
	    <div class="col-md">
	      <h3>Tokyo Tower</h3>
	      <p>description</p>
	      <br> rank: ⭐⭐⭐
	      <br> location:📍Tokyo, @address
	    </div>
	</div>
	*/
	if ($result->num_rows > 0) {
		$destinations = '<h1 class="my-4">→ <small>Top Destinations:</small></h1><br>'; 
		while($row = $result->fetch_assoc()) { 
			$destinations .=	'<div class="row">';
			$destinations .=	    '<div class="col-lg-4">';
			$destinations .=	      '<a><img class="dest-pic" src="'.$row["pic_url"].'" alt=""></a>';
			$destinations .=	    '</div>';
			$destinations .=	    '<div class="col-lg-8 ml-auto">';
			$destinations .=	      '<h3>✈️ '.$row["name"].'</h3>';
			$destinations .=	      '<p>'.$row["description"].'</p>';
			$destinations .=	      '<br> rating: ';
										for ($i = 0; $i < $row["rating"]; $i++) {
							    			$destinations .= '⭐';
										} 
			$destinations .=	      '<br> 📍'.$row["city_name"]. ', <b>@</b>'. $row["address"];
			$destinations .=	    '</div>';
			$destinations .=	'</div><hr>';
		}
		echo $destinations;
	}
	else {
		echo "no destinations :("; 
	}
	CloseCon($conn);
}
?>