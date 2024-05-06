<?php 
	include 'dbConn.php';
	//References:  // Gosselin, D.,Kokoska, P and Easterbrooks, R.2010. PHP Programming With MySQL. 2nd ed.Boston: Cengage learning
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
	 <h1 class= "text-center">ADMIN</h1>
		<h3 class = "text-center">Registeration Requests</h3>
	 <div class="container"> 
		<!-- The following method was taken from Youtube
            // Author: BoostMyTool
            //Link: https://youtu.be/NqP0-UkIQS4 -->
		 <?php 
			// Retrieve pending registration requests from userstbl
			$sql = "SELECT * FROM userstbl WHERE reg_approval = 'Pending'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Display registration requests
				echo "<table class='table'>";
				// echo "<tr><th>Student ID</th><th>Name</th><th>Surname</th><th>Email</th><th>Action</th></tr>";
				echo "<thead> ";
				echo "<tr>";
				echo"<th scope='col'>Student ID</th>";
				echo"<th scope='col'>Name</th>";
				echo"<th scope='col'>Surname</th>";
				echo"<th scope='col'>Email</th>";
				echo"<th scope='col'>Campus</th>";
				echo"<th scope='col'></th>";
				echo"<th scope='col'>Action</th>";
				
				echo"</tr>";
				echo"</thead>";
		

				while ($row = $result->fetch_assoc()) {
					echo"<tbody>";
					echo "<tr>";
					echo "<td>" . $row["student_id"] . "</td>";
					echo "<td>" . $row["s_name"] . "</td>";
					echo "<td>" . $row["s_surname"] . "</td>";
					echo "<td>" . $row["s_email"] . "</td>";
					echo "<td>" . $row["campus"]."<td>";
					echo "<td>";
				    echo "<a class = 'btn btn-success' href='approve_student.php?student_id=" . $row["student_id"] . "'>Approve</a> | ";
					echo "<a class = 'btn btn-danger' href='reject-student.php?student_id=" . $row["student_id"] . "'>Reject</a>";
					echo "</td>";
					echo "</tr>";
					echo "</tbody>";
					
				}
				echo "</table>";
			} else {
				echo "No pending registration requests.";
			}

			
		 ?>
	 </div>
	 <!-- The following method was taken from Youtube
            // Author: BoostMyTool
            //Link: https://youtu.be/NqP0-UkIQS4 -->
	 <div class="container">
		<h3 class = "text-center">Users Management</h3><br>
		<a class = "btn btn-primary" href="admin-add-user.php">Add User</a>
		<?php 
			// Retrieve pending registration requests from userstbl
			$sql = "SELECT * FROM userstbl";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Display registration requests
				echo "<table class='table'>";
				
				echo "<thead> ";
				echo "<tr>";
				echo"<th>Student ID</th>";
				echo"<th>Name</th>";
				echo"<th>Surname</th>";
				echo"<th>Email</th>";
				echo"<th>Campus</th>";
				//echo"<th>Password</th>";
				echo"<th></th>";
				echo"<th>Registeration Verification</th>";
				echo"<th>Action</th>";
				echo"</tr>";
				echo"</thead>";
		

				while ($row = $result->fetch_assoc()) {
					echo"<tbody>";
					echo "<tr>";
					echo "<td>" . $row["student_id"] . "</td>";
					echo "<td>" . $row["s_name"] . "</td>";
					echo "<td>" . $row["s_surname"] . "</td>";
					echo "<td>" . $row["s_email"] . "</td>";
					echo "<td>" . $row["campus"]."<td>";
					//echo "<td>" . $row["password"]."<td>";
					echo "<td>" . $row["reg_approval"]."<td>";
					echo "<a class = 'btn btn-secondary' href='edit-user.php?student_id=" . $row["student_id"] . "'>Edit</a> | ";
					echo "<a class = 'btn btn-danger' href='admin-delete-user.php?student_id=" . $row["student_id"] . "'>Delete</a>";
					echo "</td>";
					echo "</tr>";
					echo "</tbody>";
				}
				echo "</table>";
			} else {
				echo "No Users .";
			}
			?>
			<div class="container">
		<h3 class = "text-center">Manage Books</h3><br>
		<a class = "btn btn-primary" href="admin-add-books.php">Add Book</a>
		<?php 
			// Retrieve pending registration requests from userstbl
			$sql = "SELECT * FROM bookstbl";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Display registration requests
				echo "<table class='table'>";
				
				echo "<thead> ";
				echo "<tr>";
				echo"<th>Book Title</th>";
				echo"<th>Book Author</th>";
				echo"<th>Book Genre</th>";
				echo"<th>Book Edition</th>";
				echo"<th>Book Price</th>";
				echo"<th>Book Image</th>";
				echo"<th>Action</th>";
				echo"</tr>";
				echo"</thead>";
		

				while ($row = $result->fetch_assoc()) {
					echo"<tbody>";
					echo "<tr>";
					echo "<td>" . $row["bookTitle"] . "</td>";
					echo "<td>" . $row["author"] . "</td>";
					echo "<td>" . $row["genre"] . "</td>";
					echo "<td>" . $row["edition"] . "</td>";
					echo "<td>" . $row["price"] . "</td>";
					echo "<td>";
					echo "<img src='" . $row['bookImage'] . "' alt='Book Image' height='100px'>";
					echo "</td>";
					echo"<td>";
					echo "<a class = 'btn btn-secondary' href='admin-edit-book.php?book_id=" . $row["book_id"] . "'>Edit</a> | ";
					echo "<a class = 'btn btn-danger' href='admin-delete-books.php?book_id=" . $row["book_id"] . "'>Delete</a>";
					echo "</td>";
					echo "</tr>";
					echo "</tbody>";
				}
				echo "</table>";
			} else {
				echo "No Books .";
			}
			
		 ?>
	 </div>
			</div>
		<div class="container">
		<h3 class = "text-center">Request To Sell Books</h3><br>
		<?php 
			// Retrieve pending registration requests from userstbl
			$sql = "SELECT * FROM salerequests_tbl";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Display registration requests
				echo "<table class='table'>";
				
				echo "<thead> ";
				echo "<tr>";
				echo"<th>Book Title</th>";
				echo"<th>Book Author</th>";
				echo"<th>Book ISBN</th>";
				echo"<th>Book Image</th>";
				echo"<th>Book Condition</th>";
				echo"<th>Upload Book</th>";
				echo"</tr>";
				echo"</thead>";
		

				while ($row = $result->fetch_assoc()) {
					echo"<tbody>";
					echo "<tr>";
					echo "<td>" . $row["sbook_title"] . "</td>";
					echo "<td>" . $row["sbook_author"] . "</td>";
					echo "<td>" . $row["sbook_ISBN"] . "</td>";
					echo "<td>";
					echo "<img src='" . $row['sbook_image'] . "' alt='Book Image' height='100px'>";
					echo "</td>";
					echo "<td>" . $row["sbook_condition"]."<td>";
					echo "<a class = 'btn btn-secondary' href='upload-saleBook.php?id=" . $row["id"] . "'>Upload</a> ";
					echo "</td>";
					echo "</tr>";
					echo "</tbody>";
				}
				echo "</table>";
			} else {
				echo "No Users .";
			}
			$conn->close();
		 ?>
	 </div>
	 
</body>
</html>