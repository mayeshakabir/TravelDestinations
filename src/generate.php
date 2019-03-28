<?php

/*function generateDestination(){

	$sql = "INSERT INTO Destination (dest_ID, city_name, country_ID, name, pic_url, ranking, description, rating, visiting_hours, address)
		VALUES";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require 'connect.php';

		$dest_name = (isset($_POST['name'])) ? $_POST['name'] : "";
		$dest_city = (isset($_POST['city'])) ? $_POST['city'] : "";
		$dest_country = (isset($_POST['filter_country'])) ? $_POST['filter_country'] : "";
		$dest_rating = (isset($_POST['filter_rating'])) ? $_POST['filter_rating'] : "";
			
		echo "This is the Destination Name: " . " " . $dest_country;


		$whereParts = array();

		if ($dest_name !== "") {
			$whereParts[] = "dest_name LIKE '%$dest_name%' ";
		}
		if ($dest_country !== "") {
			$whereParts[] = "dest_c IN (SELECT country_ID FROM Country WHERE name LIKE '%$country%') ";
		}
		if ($dest_city !== "") {
			$whereParts[] = "city_name LIKE '%$city%' ";
		}
		if ($dest_rating !== "") {
			$whereParts[] = "rating LIKE '%$rating%' ";
		}
	}
}*/


?>