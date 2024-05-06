<?php
include 'dbConn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		// Retrieve the form data
		  $bookTitle = $_POST['bookTitle'];
		  $author = $_POST['author'];
		  $ISBN = $_POST['ISBN'];
		  $genre = $_POST['genre'];
		  $description = $_POST['description'];
		  $edition = $_POST['edition']; 
		  $price = $_POST['price'];
		  $bookImage = $_POST['bookImage'];
		  

				 
				// SQL query to insert data into the database
				 $sql = "INSERT INTO bookstbl (bookTitle, author, ISBN, genre, description, edition, price, bookImage) 
					VALUES ('$bookTitle', '$author', '$ISBN', '$genre', '$description','$edition','$price','$bookImage')";


				if ($conn->query($sql) === TRUE) {
					$success_message = "Successfully Upload.";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
		// Retrieve user information for pre-filling the form
		if (isset($_GET['id'])) {
		$id = $_GET['id'];

		// Fetch the user data from the database
		$query = "SELECT * FROM salerequests_tbl WHERE id = '$id'";
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) > 0) {
			$user_fetched = mysqli_fetch_assoc($result);
			$sbook_title = $user_fetched['sbook_title'];
			$sbook_author = $user_fetched['sbook_author'];
			$sbook_ISBN = $user_fetched['sbook_ISBN'];
			$sbook_image = $user_fetched['sbook_image'];
	
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
			
    <div class = "d-flex justify-content-center align-items-center " style="min-height : 100vh;">
		<form class="p-5 rounded shadow " style= " max-width: 30rem; width: 100%" method="POST" action="upload-saleBook.php">
		<h1 class= "text-center">Send In A Sale Request</h1>	
			<div class="mb-3">
				<label for="bookTitle" class="form-label">Book Title:</label>
				<input type="text" class="form-control"  id="bookTitle"  name="bookTitle" value="<?php echo isset($sbook_title) ? $sbook_title : ''; ?>" required>
			</div>
			<div class="mb-3">
				<label for="author" class="form-label" >Book Author:</label>
				<input type="text" class="form-control"  id="author" name="author" value="<?php echo isset($sbook_author) ? $sbook_author : ''; ?>" required>
			</div>
			<div class="mb-3">
				<label for="ISBN" class="form-label" >Book ISBN:</label>
				<input type="text" class="form-control" id="ISBN" name="ISBN" value="<?php echo isset($sbook_ISBN) ? $sbook_ISBN : ''; ?>" required>
			</div>
			<div class="mb-3">
				<label for="Genre" class="form-label" >Genre:</label>
				<input type="text" class="form-control" id="genre" name="genre" required>
			</div>
			<div class="mb-3">
				<label for="description" class="form-label" >Description:</label>
				<input type="text" class="form-control" id="description" name="description" required>
			</div>
			<div class="mb-3">
				<label for="edition" class="form-label" >Edition: </label>
				<input type="text" class="form-control" id="edition" name="edition">
			</div>
			<div class="mb-3">
				<label for="price" class="form-label" >Price: </label>
				<input type="text" class="form-control" id="price" name="price">
			</div>
			<div class="mb-3">
				<label for="bookImage" class="form-label" >Books Image: </label>
				<input type="text" class="form-control" id="bookImage" name="bookImage" value="<?php echo isset($sbook_image) ? $sbook_image : ''; ?>">
			</div>
		
			<div class="row">
			  <div class="col-md-4"><input type="submit" class="btn btn-primary" value="Upload"></div>
			  <div class="col-md-4 ms-auto"><button type="button" class="btn btn-secondary" onclick="window.location.href = 'admin.php';">Cancel</button></div>
			</div>	
		</form>
	</div>
</body>
</html>