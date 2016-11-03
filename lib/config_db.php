<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "my_first_database";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("<br>[#all_conn_err]Connection failed: " . $conn->connect_error);
	} 
	

?>