<?php
include 'dbConn.php';
session_start();

///The following method was taken from Youtube
            // Author: Coding with Elias
            //Link: https://youtu.be/IMCHi-5Ig40 
			
// Fetch books from the database using a SELECT query
$query = "SELECT * FROM bookstbl";
$result = mysqli_query($conn, $query);

// Create an empty array to store the fetched books
$books_array = [];

// Check if the query executed successfully
if ($result) {
    // Fetch each row as an associative array and add it to the $books array
    while ($row = mysqli_fetch_assoc($result)) {
        $books_array[] = $row;
    }
}

?>
<!DOCTYPE html><html lang="en">
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
	
	
	 <div class="hero-image">
        <div class="container">
            <div class="hero-text">
                <h1>Welcome to The Book Bank</h1>
                <p class="slogan">Your Source for Quality Books</p>
                <a href="trade-in.php" class="btn btn-info btn-lg">Trade In Now</a>
            </div>
        </div>
    </div>
	<br><br>
	<!--///The following method was taken from Youtube
            // Author: Coding with Elias
            //Link: https://youtu.be/IMCHi-5Ig40 -->
	<h2 class= "text-center" >Our Features</h2>
	<div class="container">		
		<div class="row">
			<?php $counter = 0; ?> <!--///The following method was taken from Stackoverflow
										// Author: packore
										//Link: https://stackoverflow.com/questions/2865373/how-would-i-stop-this-foreach-loop-after-3-iterations -->
            <?php foreach ($books_array as $book): ?>
			<?php if ($counter >= 3) {
				break; 
			}
			?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img  src="<?php echo $book['bookImage']; ?>" class="card-img-top" alt="Book Image" >
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $book['bookTitle']; ?></h5>
                        <p class="card-text">
                            <strong>Author:</strong> <?php echo $book['author']; ?>
                        </p>
                         <a href="bookstore.php" class="btn btn-primary">See More</a>
                    </div>
                </div>
            </div>
            <?php 
			 $counter++;
			endforeach; ?>
        </div>
	</div>
	
	<br>
	<div class="mission-container bg-dark text-white p-4">
    <h2 class="text-center">Our Mission</h2><br><br>
    <p class="text-center">At The Book Bank, our main goal is to provide an easy and convenient platform for students to sell and buy textbooks. We are dedicated to helping students save money by offering a wide selection of affordable used textbooks. Additionally, we aim to simplify the selling process, allowing students to easily list their textbooks for sale and connect with potential buyers. Our mission is to create a trusted and efficient marketplace that promotes accessibility and affordability of educational resources. 
	Join The Book Bank today and experience a seamless textbook trading experience!</p>
</div>

	
</body>