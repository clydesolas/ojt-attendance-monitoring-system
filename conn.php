<?php
	$conn = mysqli_connect('localhost', 'root', '', 'scheduling_db') or die(mysqli_error());
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
?>