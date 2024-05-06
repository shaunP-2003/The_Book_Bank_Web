<?php
include 'dbConn.php';

//The following method was taken from youtube
				// Author: step by step
				//Link: https://youtu.be/72U5Af8KUpA
				
// Process form data
if (isset($_POST['updateBook'])) {
	$book_id = $_POST['book_id'];
    $bookTitle = $_POST['bookTitle'];
    $author = $_POST['author'];
    $ISBN = $_POST['ISBN'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $edition = $_POST['edition'];
    $price = $_POST['price'];

    // Check if all fields are entered
    if ( empty($bookTitle) || empty($author) || empty($ISBN) || empty($genre) || empty($description) || empty($edition) || empty($price)) {
        $error_message = "Please fill in all fields.";
    } else {
        // SQL query to update book data in the database
        $sql = "UPDATE bookstbl SET bookTitle = '$bookTitle', author = '$author', ISBN = '$ISBN', genre = '$genre', description = '$description', edition = '$edition', price = '$price' WHERE book_id = '$book_id'";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Book updated successfully.";
           header("location:admin.php");
		
		   
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $error_message = "Error occurred while updating the book.";
        }
    }
}

// Retrieve book information for pre-filling the form
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Fetch the book data from the database
    $query = "SELECT * FROM bookstbl WHERE book_id = '$book_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
        $bookTitle = $book['bookTitle'];
        $author = $book['author'];
        $ISBN = $book['ISBN'];
        $genre = $book['genre'];
        $description = $book['description'];
        $edition = $book['edition'];
        $price = $book['price'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Book Bank</title>
    <!-- Bootstrap 5.1.0 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap JS 5.1.0 CDN -->
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

    <!-- Edit Book Form -->
    <div class = "d-flex justify-content-center align-items-center " style="min-height : 100vh;">
        <form class="p-5 rounded shadow " style= " max-width: 30rem; width: 100%" method="POST" action="admin-edit-book.php">
			<h1 class= "text-center">Admin Update Book</h1>
             <div class="mb-3">
			 <label for="bookTitle" class="form-label">Book Title:</label>
            <input type="text" class="form-control" id="bookTitle" name="bookTitle" value="<?php echo $bookTitle; ?>">
			</div>
			<div class="mb-3">
				<label for="author" class="form-label">Author:</label>
				<input type="text" class="form-control" id="author" name="author" value="<?php echo $author; ?>">
			</div>
			<div class="mb-3">
				<label for="ISBN" class="form-label">ISBN:</label>
				<input type="text" class="form-control" id="ISBN" name="ISBN" value="<?php echo $ISBN; ?>">
			</div>
			<div class="mb-3">
				<label for="genre" class="form-label">Genre:</label>
				<input type="text" class="form-control" id="genre" name="genre" value="<?php echo $genre; ?>">
			</div>
			<div class="mb-3">
				<label for="description" class="form-label">Description:</label>
				<textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
			</div>
			<div class="mb-3">
				<label for="edition" class="form-label">Edition:</label>
				<input type="text" class="form-control" id="edition" name="edition" value="<?php echo $edition; ?>">
			</div>
			<div class="mb-3">
				<label for="price" class="form-label">Price:</label>
				<input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
			</div>

            <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
            <button type="submit" class="btn btn-primary" name="updateBook">Update Book</button>
        </form>
    </div>
</body>
</html>
