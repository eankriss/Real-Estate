<?php		
	
	// Establishing Connection with Server by passing inputs as a parameter
	$conn = mysqli_connect('localhost','root','','realestatedb') or die(mysqli_error());

	date_default_timezone_set("Asia/Manila");

?>