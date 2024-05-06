<?php
session_start();
include 'dbConn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		// Retrieve the form data
		  $sbook_title = $_POST['sbook_title'];
		  $sbook_author = $_POST['sbook_author'];
		  $sbook_ISBN = $_POST['sbook_ISBN'];
		  $sbook_image = $_FILES['sbook_image'];
		  $sbook_condition = $_POST['sbook_condition'];

				///The following method was taken from Youtube
            // Author: CodeFlix
            //Link: https://youtu.be/3OUTgnaezNY
				// Move the uploaded image to a desired directory
				$targetDir = 'Images/';
				$targetFile = $targetDir . basename($sbook_image['name']);
			     move_uploaded_file($sbook_image['tmp_name'], $targetFile);
				 
				 
				// SQL query to insert data into the database
				 $sql = "INSERT INTO salerequests_tbl (sbook_title, sbook_author, sbook_ISBN, sbook_image, sbook_condition) 
					VALUES ('$sbook_title', '$sbook_author', '$sbook_ISBN', '$targetFile', '$sbook_condition')";


				if ($conn->query($sql) === TRUE) {
					$success_message = "Book Succesfully Sent For Sale";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
	

	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
         <meta name="viewport" content ="width=device-width, initial-scale=1.0">
		 <title>The Book Bank</title>
		 
		 <link rel="stylesheet" href="CSS-doc.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

		 <!-- bootstrap 5.1.0 CDN-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         <!-- bootstrap JS 5.1.0 CDN-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
	<!-- Display Success Message -->
    <?php if (isset($success_message)) { ?>
        <div class="alert alert-success mt-3">
            <?php echo $success_message; ?>
        </div>
    <?php } ?>
	<!-- Display Error Message -->
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger mt-3">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>
	
	<!--Register Form-->
	<!-- The following method was taken from Youtube
            // Author: Coding with Elias
            //Link: https://youtu.be/IMCHi-5Ig40 -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-black ">
		  <div class="container-fluid">
			<a class="navbar-brand" href="#">The Book Bank</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="bookstore.php">BookStore</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="trade-in.php">Trade In</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="contact.php">Contact Us</a>
				</li>
				<li class="nav-item">
					<?php if (isset($_SESSION['student_id'])) { ?>
						<a class="nav-link" href="logout.php">Logout : <?php echo $_SESSION['student_id']; ?></a> 
						 
					<?php } else { ?>
						<a class="nav-link" href="login.php">Login</a>
					<?php } ?>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="order-history.php">Order History</a>
				</li>
			  </ul>
			  <!--////The following method was taken from w3schools
				// Author: w3schools
				//Link: https://www.w3schools.com/bootstrap5/bootstrap_badges.php -->
			   <a class="nav-link" href="cart.php">
				<i class="fas fa-shopping-cart">
					 <span class="badge bg-primary rounded-pill" style="margin-right: 10px; font-size:12px"><?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></span>
				</i> 
			  </a>
				
			  <form class="d-flex">
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success" type="submit">Search</button>
			  </form>
			</div>
		  </div>
		</nav>
	
		
	
    <div class = "d-flex justify-content-center align-items-center " style="min-height : 100vh; background: lightgray;">
		<form method="POST" action="trade-in.php" enctype="multipart/form-data" style="background: white; border: 5px solid black; border-radius: 10px; padding: 20px;">
		<h1 class= "text-center">Send In A Sale Request</h1>	
			<div class="mb-3">
				<label for="sbook_title" class="form-label">Book Title:</label>
				<input type="text" class="form-control"  id="sbook_title"  name="sbook_title" required>
			</div>
			<div class="mb-3">
				<label for="sbook_author" class="form-label" >Book Author:</label>
				<input type="text" class="form-control"  id="sbook_author" name="sbook_author" required>
			</div>
			<div class="mb-3">
				<label for="sbook_ISBN" class="form-label" >Book ISBN:</label>
				<input type="text" class="form-control" id="sbook_ISBN" name="sbook_ISBN" required>
			</div>
			<div class="mb-3">
				<label for="sbook_image" class="form-label" >Books Image: </label>
				<input type="file" class="form-control" id="sbook_image" name="sbook_image">
			</div>
			<div class="mb-3">
				<label for="sbook_conditio" class="form-label" >Books Condition:</label>
				<input type="text" class="form-control" id="sbook_condition" name="sbook_condition" required>
			</div>
			
			
			<div class="row">
			  <div class="col-md-4"><input type="submit" class="btn btn-primary" value="Submit"></div>
			  <div class="col-md-4 ms-auto"><button type="button" class="btn btn-secondary" onclick="window.location.href = index.php';">Cancel</button></div>
			</div>	
		</form>
	</div>
</body>
</html>