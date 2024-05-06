<?php
include 'dbconn.php';
//References:  // Gosselin, D.,Kokoska, P and Easterbrooks, R.2010. PHP Programming With MySQL. 2nd ed.Boston: Cengage learning

// Get the student_id
$student_id = $_GET["student_id"];

//The following method was taken from W3schools
            // Author: w3schools
            //Link: https://www.w3schools.com/php/php_mysql_update.asp
// Update approval status to "approved"
$sql = "UPDATE userstbl SET reg_approval = 'Approved' WHERE student_id = '$student_id'";

if ($conn->query($sql) === TRUE) {
    echo "Registration request approved successfully.";
	header("location:admin.php");
	exit;
} else {
    echo "Error updating approval status: " . $conn->error;
}

$conn->close();

?>