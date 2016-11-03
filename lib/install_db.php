<?php
	
	require_once "lib/config_db.php"; //$db settings
	
	$sql = "CREATE DATABASE IF NOT EXISTS my_first_database"; 
	if ($conn->query($sql) === TRUE) {
		echo "<br>DATABASE my_first_database created successfully";
	} else {
		echo "Error creating database: " . $conn->error;
		die();
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS `access` (
	
  `userid` bigint(20) NOT NULL AUTO_INCREMENT,
  `userlogin` varchar(60) NOT NULL,
  `criptedpassword` varchar(32) NOT NULL,
  `salt` varchar(10) NOT NULL,
  PRIMARY KEY (`userid`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
	
	
	";
	
	if ($conn->query($sql) === TRUE) {
	echo "<br>Table access created successfully";
	} else {
	echo "Error creating table: " . $conn->error;
	}
	
	
	
	$sql = "CREATE TABLE IF NOT EXISTS users (
	userid bigint(20) NOT NULL PRIMARY KEY,
	reg_date TIMESTAMP,
	first_name VARCHAR(60) NOT NULL,
	last_name VARCHAR(60) NOT NULL,
	e_mail VARCHAR(60) NOT NULL

	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2; ";

	if ($conn->query($sql) === TRUE) {
	echo "<br>Table users created successfully";
	} else {
	echo "Error creating table: " . $conn->error;
	}


?>