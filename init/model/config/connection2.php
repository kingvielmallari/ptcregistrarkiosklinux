<?php 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$conn = new mysqli("localhost", "root", "King123.", "onlineschooldocuments_db2");
	if($conn->connect_error) {
	  exit('Error connecting to database'); 
	}

?>