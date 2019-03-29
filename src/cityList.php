<?php
function citySelect() {
	require 'connect.php';
	$sql = "SELECT DISTINCT city_name FROM Destination ORDER BY city_name";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$cities = '';
		while($row = $result->fetch_assoc()) {
			$cities .= '<option value="'. $row["city_name"] .'">'. $row["city_name"] .'</option>';
		}
	}
	echo $cities;
}

?>