<?php
	function OpenCon() {
		$dbhost = "localhost";
		$dbuser = "root"; $dbpass = "travel"; $db = "travel_destinations";
		$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
		return $conn;
	}
		
	function CloseCon($conn) {
		$conn -> close(); 
	}
	/* how to check connection on other pages:
	include 'connect.php';
	$conn = OpenCon();
	echo "Connected Successfully"; CloseCon($conn);
	*/
?>