<?php
include 'dbConn.php';
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="CSS-doc.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

		<!-- bootstrap 5.1.0 CDN-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         <!-- bootstrap JS 5.1.0 CDN-->
		 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
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
	




<br><br>
    <div class="container">
        <h3 class="text-center">Contact Us</h3>
        <form action="contact-form-handler.php" method="POST">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
</body>
</html>
