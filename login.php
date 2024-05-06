<?php
	session_start();
	
	//References:  // Gosselin, D.,Kokoska, P and Easterbrooks, R.2010. PHP Programming With MySQL. 2nd ed.Boston: Cengage learning
	include 'dbConn.php';
	// Process login form submission
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$student_id = $_POST["student_id"];
		$password = $_POST["password"];
	

	// SQL query to get the hashed password and approval status based on the student ID
    $sql = "SELECT password, reg_approval FROM userstbl WHERE student_id = '$student_id'";
    $result = mysqli_query($conn, $sql);
	
	//The following method was taken from StackOverFlow
            // Author: Akar
            //Link: https://stackoverflow.com/questions/30279321/how-to-use-phps-password-hash-to-hash-and-verify-passwords
	
	if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        $approvalStatus = $row['reg_approval'];

        // Verify the password using password_verify() and check the approval status
        if (password_verify($password, $hashedPassword) && $approvalStatus === 'Approved') {
            // Password is correct and user is approved, perform login actions
            // ...
			$_SESSION['student_id'] = $student_id;
            $success_message = "Login successful!";
			header("Location: index.php");
        } else {
            // Invalid student ID, password, or not approved
            $error_message = "Invalid student ID, password, or not approved.";
        }
    } else {
        // Student ID not found in the database
        $error_message = "Invalid student ID, password, or not approved.";
    }

}

$conn->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
         <meta name="viewport" content ="width=device-width, initial-scale=1.0">
		 <title>Login</title>
		 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
		<link rel="stylesheet" href="CSS-doc.css">
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
	
		<form class="p-5 rounded shadow " style= "max-width: 30rem; width: 100%" method="POST" action="login.php">
		<div class="profile-icon">
			<i class="fas fa-user"></i>
		</div>
		  <h1 class= "text-center">Login</h1>	
		  <div class="mb-3">
				<label for="email" class="form-label" >Student ID :</label>
				<input type="text" class="form-control" id="student_id" name="student_id" required>
			</div>
		  <div class="mb-3">
				<label for="password" class="form-label" >Password:</label>
				<input type="password" class="form-control" id="password" name="password" required>
		  </div>
		  <div class="row">
				<div class="d-grid gap-2">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
		  </div>
		  <div class="row mt-2">
				<div class="d-grid gap-2">
					<button type="button" class="btn btn-secondary" onclick="window.location.href = 'index.php';">Cancel</button>
				</div>
		  </div>
		  <br><br>
		  <a href="admin-login.php" >ADMIN LOGIN</a><br>
		  <a href="register.php">If not registered click here to register</a>
		  
		</form>
	</div>
	
</body>