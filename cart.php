<?php
// Include the necessary files and start the session
include 'dbConn.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit;
}

// Retrieve the student ID from the session
$student_id = $_SESSION['student_id'];

//The following method was taken from geeksforgeeksWeb : for the $qurey
				// Author: GeeksForGeeks
				//Link: https://www.geeksforgeeks.org/php-mysql-joins/
			
			
// Fetch the books from the bookstbl table
$query = "SELECT b.book_id, b.bookTitle, b.author, b.price, b.bookImage, c.quantity
          FROM bookstbl b
          JOIN cart_tbl c ON b.book_id = c.book_id
          WHERE c.student_id = '$student_id'";

$result = mysqli_query($conn, $query);

//The following method was taken from youtube
				// Author: Mr Web Design 
				//Link: https://youtu.be/ChBnZXtvCxc

// Update the cart if the quantity is changed
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    if (isset($_POST['book_id'])) {
        $book_id = $_POST['book_id'];
        $quantity = $_POST['quantity'];

        // Update the quantity in the cart_tbl table
        $updateQuery = "UPDATE cart_tbl SET quantity = '$quantity' WHERE student_id = '$student_id' AND book_id = '$book_id'";
		
        mysqli_query($conn, $updateQuery);
		
		header("Location: cart.php");
		exit;
    } else {
        // Handle the case when book_id is not present in $_POST
        // You can display an error message or perform appropriate error handling here
    }
}
//The following method was taken from youtube
				// Author: Mr Web Design 
				//Link: https://youtu.be/ChBnZXtvCxc
// Delete a book from the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    if (isset($_POST['book_id'])) {
        $book_id = $_POST['book_id'];

        // Delete the book from the cart_tbl table
        $deleteQuery = "DELETE FROM cart_tbl WHERE student_id = '$student_id' AND book_id = '$book_id'";
        mysqli_query($conn, $deleteQuery);
		// Update the cart count for the student
		$updateCartCountQuery = "UPDATE cart_tbl SET cart_count = cart_count - 1 WHERE student_id = '$student_id'";
		mysqli_query($conn, $updateCartCountQuery);

		// Retrieve the updated cart count
		$cartCountQuery = "SELECT cart_count FROM cart_tbl WHERE student_id = '$student_id'";
		$cartCountResult = mysqli_query($conn, $cartCountQuery);

		if ($cartCountResult) {
			$cartCountRow = mysqli_fetch_assoc($cartCountResult);
			$_SESSION['cart_count'] = $cartCountRow['cart_count'];
		}
		
		header("Location: cart.php");
		exit;
    } else {
        // Handle the case when book_id is not present in $_POST
        // You can display an error message or perform appropriate error handling here
    }
}

// Checkout button action that will insert into orderstbl
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
	
	//The following method was taken from stackoverflow :get unique id
				// Author: Ken Tang
				//Link: https://stackoverflow.com/questions/22279146/php-generate-unique-order-number-with-date#:~:text=Where%3A,))%3B%20%24unique%20%3D%20%24today%20.
				
    $today = intval(date("Ymd")); // Convert $today to an integer
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 4)); // $rand remains a string

    $order_num = $today * intval($rand); // Perform multiplication on integer values
	
    //The following method was taken from website :for now() function to get order date//
				// Author: educba
				//Link: https://www.educba.com/php-now/

	//The following method was taken from youtube : insert into orderstbl 
				// Author: Mr Web Design 
				//Link: https://youtu.be/Ep7NSDSRouY
				
    // Insert the order details into the orderstbl table
    $insertOrderQuery = "INSERT INTO orderstbl (student_id, book_id, order_date, total_price, order_num,bookTitle)
                     SELECT '$student_id', b.book_id, NOW(), b.price * c.quantity, '$order_num',b.bookTitle
                     FROM bookstbl b
                     JOIN cart_tbl c ON b.book_id = c.book_id
                     WHERE c.student_id = '$student_id'";


						 
	if (mysqli_query($conn, $insertOrderQuery)) {			
		 echo "Order inserted successfully!";
		 // Clear the cart
		$clearCartQuery = "DELETE FROM cart_tbl WHERE student_id = '$student_id'";
		mysqli_query($conn, $clearCartQuery);

		// Update the cart count for the student
		$updateCartCountQuery = "UPDATE cart_tbl SET cart_count = 0 WHERE student_id = '$student_id'";
		mysqli_query($conn, $updateCartCountQuery);

		// Store the order number and sessionId in session variables
		$_SESSION['order_num'] = $order_num;
		$_SESSION['sessionId'] = session_id();

		// Redirect to the checkout page
		header("Location: checkout.php");
	
	}else {
    echo "Error inserting order: " . mysqli_error($conn);
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
		<br>
	
	<div class="container">
        <h1 class="text-center">Cart</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $grandTotal = 0;
                while ($row = mysqli_fetch_assoc($result)) {
					 
                    $book_id = $row['book_id'];
                    $title = $row['bookTitle'];
                    $author = $row['author'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $grandTotal += $quantity * $price;
                ?>
                    <tr>
                        <td><img src="<?php echo $row['bookImage']; ?>" alt="Book Image" width="50"></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $author; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $quantity * $price; ?></td>
						<td>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" action="cart.php">
                                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                                <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="10">
                                <input type="submit" name="update" class="btn btn-primary btn-sm" value="Update">
                            </form>
                        </td>
                        <td>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" action="cart.php">
                                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                                <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete">
                            </form>
                        </td>
                    </tr>
				
                <?php } ?>
                <tr>
                    <td colspan="5" class="text-end"><strong>Total:</strong></td>
                    <td><?php echo $grandTotal; ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
			<div class="row">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
					<div class="d-grid gap-2">
						<button class="btn btn-success" name="checkout" type="submit">CHECKOUT</button>
					</div>
				</form>
			</div>
			<div class="row mt-2">
				<div class="d-grid gap-2">
						<a class="btn btn-outline-dark" href="bookstore.php" >CONTINUE TO SHOPPING</a>
				</div>
			</div>
			
    </div>
	
</body>