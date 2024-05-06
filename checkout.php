<?php
include 'dbConn.php';
session_start();
////The following method was taken from w3schools
				// Author: w3schools
				//Link: // https://www.w3schools.com/php/
?>
<div class="container">
    <h1 class="text-center">Checkout</h1>
    <!-- Display the reference number and sessionId -->
    <p>Reference Number: <?php echo $_SESSION['order_num']; ?></p>
    <p>Session ID: <?php echo $_SESSION['sessionId']; ?></p>
    <p>Thank you for your order!</p>
	<a href ="logout.php" class="btn btn-primary">OK</a>
</div>
