<?php
include 'dbConn.php';
//The following method was taken from youtube
				// Author: steo by step
				//Link: https://youtu.be/72U5Af8KUpA
				
// Process form data
if (isset($_POST['addBook'])) {
    $bookTitle = $_POST["bookTitle"];
    $author = $_POST["author"];
    $ISBN = $_POST["ISBN"];
    $genre = $_POST["genre"];
    $description = $_POST["description"];
    $edition = $_POST["edition"];
    $price = $_POST["price"];
    $bookImage = $_FILES["bookImage"];

	
    // Check if all fields are entered
    if (empty($bookTitle) || empty($author) || empty($ISBN) || empty($genre) || empty($description) || empty($edition) || empty($price) || empty($bookImage)) {
        $error_message = "Please fill in all fields.";
    } else {
		
		// Move the uploaded image to a desired directory
				$targetDir = 'Images/';
				$targetFile = $targetDir . basename($bookImage['name']);
			     move_uploaded_file($bookImage['tmp_name'], $targetFile);
				 
        // SQL query to insert data into the database
        $sql = "INSERT INTO bookstbl (bookTitle, author, ISBN, genre, description, edition, price, bookImage)
                VALUES ('$bookTitle', '$author', '$ISBN', '$genre', '$description', '$edition', '$price', '$targetFile')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Book added successfully.";
            header("location:admin.php");
            exit;
        } else {
            echo "" . $sql . "<br>" . $conn->error;
            $error_message = "Error occurred while adding the book.";
        }
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

    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form class="p-5 rounded shadow" style="max-width: 30rem; width: 100%" method="POST" action="admin-add-books.php" enctype="multipart/form-data">
            <h1 class="text-center">Admin Add Book</h1>
            <div class="mb-3">
                <label for="bookTitle" class="form-label">Book Title:</label>
                <input type="text" class="form-control" id="bookTitle" name="bookTitle" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author:</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="ISBN" class="form-label">ISBN:</label>
                <input type="text" class="form-control" id="ISBN" name="ISBN" required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genre:</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="edition" class="form-label">Edition:</label>
                <input type="text" class="form-control" id="edition" name="edition" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="bookImage" class="form-label">Book Image:</label>
                <input type="file" class="form-control" id="bookImage" name="bookImage" required>
            </div>
            <div class="row">
                <div class="col-md-4"><input type="submit" class="btn btn-primary" name="addBook" value="Add"></div>
                <div class="col-md-4 ms-auto"><button type="button" class="btn btn-secondary" onclick="window.location.href = 'admin.php';">Cancel</button></div>
            </div>
        </form>
    </div>
</body>
</html>
