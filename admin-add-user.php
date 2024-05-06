<?php
//References:  // Gosselin, D.,Kokoska, P and Easterbrooks, R.2010. PHP Programming With MySQL. 2nd ed.Boston: Cengage learning
	include 'dbConn.php';
	//Adding the users
	// Process form data
	if (isset($_POST['addUser'])) 
	{
		$student_id = $_POST["student_id"];
		$s_name = $_POST["s_name"];
		$s_surname = $_POST["s_surname"];
		$campus = $_POST["campus"];
		$s_email = $_POST["s_email"];
		$password = $_POST["password"];
		// Check if all fields are entered
		if (empty($student_id) || empty($s_name) || empty($s_surname)||empty($campus) || empty($s_email) || empty($password)) {
			$error_message = "Please fill in all fields.";
		} 
		else {
			//The following method was taken from StackOverFlow
            // Author: Akar
            //Link: https://stackoverflow.com/questions/30279321/how-to-use-phps-password-hash-to-hash-and-verify-passwords
			//Password Hash
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			
			// SQL query to insert data into the database
			$sql = "INSERT INTO userstbl (student_id,s_name,s_surname,campus, s_email, password,reg_approval)
					VALUES ('$student_id','$s_name','$s_surname','$campus','$s_email','$hashedPassword','Pending')";

			if ($conn->query($sql) === TRUE) {
					$success_message = "User added successfully.";		
					header("location:admin.php");
					exit;
			} 
			else {
				echo "" . $sql . "<br>" . $conn->error;
				$error_message = "Error occurred while adding the users.";
			}
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
		<!-- The following method was taken from Youtube
            // Author: Coding with Elias
            //Link: https://youtu.be/IMCHi-5Ig40 -->
    <div class = "d-flex justify-content-center align-items-center " style="min-height : 100vh;">
		
		<form class="p-5 rounded shadow " style= " max-width: 30rem; width: 100%" method="POST" action="admin-add-user.php">
		<h1 class= "text-center">Admin Add User</h1>	
			<div class="mb-3">
				<label for="student_id" class="form-label">Student ID:</label>
				<input type="text" class="form-control"  id="student_id"  name="student_id" required>
			</div>
			<div class="mb-3">
				<label for="student_id" class="form-label" >Name:</label>
				<input type="text" class="form-control"  id="s_name" name="s_name" required>
			</div>
			<div class="mb-3">
				<label for="student_id" class="form-label" >Surname:</label>
				<input type="text" class="form-control" id="s_surname" name="s_surname" required>
			</div>
			<div class="mb-3">
				<label for="campus" class="form-label" >Campus:</label>
				<input type="text" class="form-control" id="campus" name="campus">
			</div>
			<div class="mb-3">
				<label for="email" class="form-label" >Email:</label>
				<input type="email" class="form-control" id="s_email" name="s_email" required>
			</div>
			<div class="mb-3">
				<label for="password" class="form-label" >Password:</label>
				<input type="password" class="form-control" id="password" name="password" required>
			</div>
			
			
			<div class="row">
			  <div class="col-md-4"><input type="submit" class="btn btn-primary" name="addUser" value="Add"></div>
			  <div class="col-md-4 ms-auto"><button type="button" class="btn btn-secondary" onclick="window.location.href = 'admin.php';">Cancel</button></div>
			</div>	
		</form>
	</div>
	
    </div>
</body>
</html>
