<?php

function generateDestination(){

	$sql = "INSERT INTO Destination (dest_ID, city_name, country_ID, name, pic_url, ranking, description, rating, visiting_hours, address)
		VALUES";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require 'connect.php';

		$dest_name = (isset($_POST['name'])) ? $_POST['dest_name'] : "";
		$dest_country = (isset($_POST['dest_country'])) ? $_POST['dest_country'] : "";
		$dest_city = (isset($_POST['dest_city'])) ? $_POST['dest_city'] : "";
		$dest_rating = (isset($_POST['dest_rating'])) ? $_POST['dest_rating'] : "";
			
		echo "This is the Destination Name: " . " " . $dest_name;


		$whereParts = array();

		if ($dest_name !== "") {
			//$whereParts[] = "dest_name LIKE '%$dest_name%' ";
		}
		if ($dest_country !== "") {
			//$whereParts[] = "dest_c IN (SELECT country_ID FROM Country WHERE name LIKE '%$country%') ";
		}
		if ($dest_city !== "") {
			//$whereParts[] = "city_name LIKE '%$city%' ";
		}
		if ($dest_rating !== "") {
			//$whereParts[] = "rating LIKE '%$rating%' ";
		}
	}
}

?>