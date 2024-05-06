<?php
	include 'dbconn.php';
	
	// The following method was taken from Youtube
            // Author: BoostMyTool
            //Link: https://youtu.be/NqP0-UkIQS4 
	// Check if the update form is submitted
	if (isset($_POST['updateUser'])) {
		$student_id = $_POST['student_id'];
		$s_name = $_POST['s_name'];
		$s_surname = $_POST['s_surname'];
		$campus = $_POST['campus'];
		$s_email = $_POST['s_email'];
		$password = $_POST['password'];

		// Check if all fields are entered
		if (empty($student_id) || empty($s_name) || empty($s_surname) ||empty($campus)|| empty($s_email) || empty($password)) {
			$error_message = "Please fill in all fields.";
		} else {
			// Update the user data in the database
			$query = "UPDATE userstbl SET s_name = '$s_name', s_surname = '$s_surname',campus = '$campus', s_email = '$s_email', password = '$password' WHERE student_id = '$student_id'";
			$result = mysqli_query($conn, $query);

			if ($result) {
				// User updated successfully
				$success_message = "User updated successfully.";
				header("location:admin.php");
				exit;
				
			} else {
				// Error occurred while updating the user
				$error_message = "Error occurred while updating the user.";
				
				
			}
		}
	}
	// The following method was taken from Youtube
            // Author: BoostMyTool
            //Link: https://youtu.be/NqP0-UkIQS4 
			
	// Retrieve user information for pre-filling the form
	if (isset($_GET['student_id'])) {
		$student_id = $_GET['student_id'];

		// Fetch the user data from the database
		$query = "SELECT * FROM userstbl WHERE id = '$id'";
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) > 0) {
			$user_fetched = mysqli_fetch_assoc($result);
			$s_name = $user_fetched['s_name'];
			$s_surname = $user_fetched['s_surname'];
			$campus = $user_fetched['campus'];
			$s_email = $user_fetched['s_email'];
			$password = $user_fetched['password'];
		}
	}
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
		<!-- The following method was taken from Youtube
            // Author: BoostMyTool
            //Link: https://youtu.be/NqP0-UkIQS4 -->
    <div class = "d-flex justify-content-center align-items-center " style="min-height : 100vh;">
		
		<form class="p-5 rounded shadow " style= " max-width: 30rem; width: 100%" method="POST" action="edit-user.php">
		<h1 class= "text-center">Admin Update User</h1>
			<input type="hidden" value="<?php echo $student_id?>">		
			<div class="mb-3">
				<label for="student_id" class="form-label">Student ID:</label>
				<input type="text" class="form-control"  id="student_id"  name="student_id" value="<?php echo isset($student_id) ? $student_id : ''; ?>" required>
			</div>
			<div class="mb-3">
				<label for="student_id" class="form-label" >Name:</label>
				<input type="text" class="form-control"  id="s_name" name="s_name" value="<?php echo isset($s_name) ? $s_name : ''; ?>" required>
			</div>
			<div class="mb-3">
				<label for="student_id" class="form-label" >Surname:</label>
				<input type="text" class="form-control" id="s_surname" name="s_surname" value="<?php echo isset($s_surname) ? $s_surname : ''; ?>" required>
			</div>
			<div class="mb-3">
				<label for="campus" class="form-label" >Campus:</label>
				<input type="text" class="form-control" id="campus" name="campus" value="<?php echo isset($campus) ? $campus : ''; ?>" required>
			</div>
			<div class="mb-3">
				<label for="email" class="form-label" >Email:</label>
				<input type="email" class="form-control" id="s_email" name="s_email" value="<?php echo isset($s_email) ? $s_email : ''; ?>" required>
			</div>
			<div class="mb-3">
				<label for="password" class="form-label" >Password:</label>
				<input type="password" class="form-control" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>"  required>
			</div>
			
			
			<div class="row">
			  <div class="col-md-4"><input type="submit" class="btn btn-primary" name="updateUser" value="Update"></div>
			  <div class="col-md-4 ms-auto"><button type="button" class="btn btn-secondary" onclick="window.location.href = 'admin.php';">Cancel</button></div>
			</div>
		</form>
	</div>
	
    </div>
</body>
</html>
