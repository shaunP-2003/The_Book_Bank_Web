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

		///The following method was taken from Youtube
            // Author: Mr Web Design
            //Link: https://youtu.be/UlxMjWvHJcU

// Add item to cart
if (isset($_POST['add_to_cart'])) {
    
    $student_id = $_SESSION['student_id']; // Assuming you store the user ID in a session variable
    $book_id = $_POST['book_id'];
    $quantity = $_POST['quantity'];
	
	// Check if the cart entry already exists for the student and book
    $existingCartQuery = "SELECT * FROM cart_tbl WHERE student_id = '$student_id' AND book_id = '$book_id'";
    $existingCartResult = mysqli_query($conn, $existingCartQuery);

    if (mysqli_num_rows($existingCartResult) > 0) {
        // Cart entry already exists, do nothing or show an error message
		$error_message = "This book is already in your cart.";
    } else {
		
        // Insert a new cart entry for the student and book
        $insertCartQuery = "INSERT INTO cart_tbl (student_id, book_id, quantity,cart_count) VALUES ('$student_id', '$book_id', $quantity, 0)";
        mysqli_query($conn, $insertCartQuery);
        
		// Update the cart count for the student that displays the amount of items in cart 
		$updateCartCountQuery = "UPDATE cart_tbl SET cart_count = cart_count + 1 WHERE student_id = '$student_id'";
		mysqli_query($conn, $updateCartCountQuery);

		// Retrieve the updated cart count to store in the navbar 
		$cartCountQuery = "SELECT cart_count FROM cart_tbl WHERE student_id = '$student_id'";
		$cartCountResult = mysqli_query($conn, $cartCountQuery);
		
		// then store the cartcounter in global session vairable 
		if ($cartCountResult) {
		$cartCountRowInTable = mysqli_fetch_assoc($cartCountResult);
		$_SESSION['cart_count'] = $cartCountRowInTable['cart_count'];
		
		header("Location: bookstore.php");
		exit;
	}

}
}

// Close the database connection
mysqli_close($conn);


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
	<br>
	
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
		
	<h1 class="text-center"> Book Store</h1><br>
	<!--The following method was taken from Youtube
            // Author: Coding with Elias
            //Link: https://youtu.be/IMCHi-5Ig40 -->
	<div class="container">
    <div class="row">
        <?php foreach ($books_array as $book): ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="<?php echo $book['bookImage']; ?>" class="card-img-top" alt="Book Image" height="450px">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $book['bookTitle']; ?></h5>
                    <p class="card-text">
                        <strong>Author:</strong> <?php echo $book['author']; ?><br>
                        <strong>Description:</strong> <?php echo $book['description']; ?><br>
                        <strong>ISBN:</strong> <?php echo $book['ISBN']; ?><br>
                        <strong>Edition:</strong> <?php echo $book['edition']; ?><br>
                        <strong>Price R:</strong> <?php echo $book['price']; ?><br>
                    </p>
                    <form action="" method="POST">
                        <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
                        <input type="number" name="quantity" class="qyt" maxlength="2" min="1" max="99" required>
                        <input type="submit" class="btn btn-primary" name="add_to_cart" value="Add to Cart">
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</body>