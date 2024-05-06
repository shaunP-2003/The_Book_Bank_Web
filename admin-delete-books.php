<?php
	include 'dbConn.php';
	////The following method was taken from w3schools
				// Author: w3schools
				//Link: // https://www.w3schools.com/php/
	$book_id = $_GET["book_id"];
	//The following method was taken from youtube
				// Author: steo by step
				//Link: https://youtu.be/72U5Af8KUpA
				
	// Deleting from users data
	$sql = "DELETE FROM bookstbl WHERE book_id = '$book_id'";

	if ($conn->query($sql) === TRUE) {
		
		header("location:admin.php");
		
	} else {
		echo "Error updating approval status: " . $conn->error;
	}

	$conn->close();
?>