<?php
//References:  // Gosselin, D.,Kokoska, P and Easterbrooks, R.2010. PHP Programming With MySQL. 2nd ed.Boston: Cengage learning
	include 'dbConn.php';
 // Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST["admin_username"];
    $admin_password = $_POST["admin_password"];

    // SQL query to fetch user data
    $sql = "SELECT * FROM admintbl WHERE admin_username = '$admin_username' AND admin_password = '$admin_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, redirect to a success page or perform further actions
         header("Location: admin.php");
    } else {
        // Invalid credentials, display error message or perform other actions
        echo "Invalid username or password.";
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
    <div class = "d-flex justify-content-center align-items-center " style="min-height : 100vh;">
		<form class="p-5 rounded shadow " style= " max-width: 30rem; width: 100%" method="POST" action="admin-login.php">
		<h1 class= "text-center">Admin Login</h1>	
			<div class="mb-3">
				<label for="admin_username" class="form-label">Username:</label>
				<input type="text" class="form-control"  id="admin_username"  name="admin_username" required>
			</div>
			
			<div class="mb-3">
				<label for="admin_password" class="form-label" >Password:</label>
				<input type="password" class="form-control" id="admin_password" name="admin_password" required>
			</div>
			
			<div class="row">
			  <div class="col-md-4"><input type="submit" class="btn btn-primary" value="Login"></div>
			  <div class="col-md-4 ms-auto"><button type="button" class="btn btn-secondary" onclick="window.location.href = 'login.php';">Cancel</button></div>
			</div>	
		</form>
	</div>
</body>
</html>
