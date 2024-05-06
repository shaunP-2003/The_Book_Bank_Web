<?php
	include 'dbConn.php';
	
	$student_id = $_GET["student_id"];

	// Deleting from users data
	$sql = "DELETE FROM userstbl WHERE student_id = '$student_id'";

	if ($conn->query($sql) === TRUE) {
		
		header("location:admin.php");
		exit;
	} else {
		echo "Error updating approval status: " . $conn->error;
	}

	$conn->close();
?>