<?php

session_start();

$error = '';
if (!empty($_SESSION['errormsg'])) {
    // let's show our message to a user
	$error = $_SESSION['errormsg'];
    // and don't forget to erase it from session
    unset($_SESSION['errormsg']);
}

?>
<html>
	<head>
		<title>Register page</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	
	<body>
		<div class="wrapper">
			<h1>Register</h1>
			<div class="alert"><?php echo $error; ?></div>
			<form action="functions.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="task" value="register">
				
				<div class="form-data">
					<p><label for="name">Name</label></p>
					<p><input type="text" name="name" value="" required /></p>
				</div>
				
				<div class="form-data">
					<p><label for="name">Username</label></p>
					<p><input type="text" name="username" required /></p>
				</div>
				
				<div class="form-data">
					<p><label for="email">Email</label></p>
					<p><input type="text" name="email" required /></p>
				</div>

				<div class="form-data">
					<p><label for="phone">Phone</label></p>
					<p><input type="text" name="phone" /></p>
				</div>

				<div class="form-data">
					<p><label for="address">Address</label></p>
					<p><textarea name="address" rows="5" cols="10"></textarea></p>
				</div>

				<div class="form-data">
					<p><label for="password">Password</label></p>
					<p><input type="password" name="password" value="" required /></p> 					
				</div>
				
				<div class="form-data">
					<p><label for="category">Category</label></p>
					<p>
						<select name="category">
							<option value="student">Student</option>
							<option value="Tenant">Tenant</option>							
						</select>
					</p> 					
				</div>
				
				<div class="form-data">
					<p><label for="image">Select image</label></p>
					<p><input type="file" name="image" value="" /></p> 					
				</div>				
				
				<div class="form-data">					
					<input type="submit" value="Register" class="btn"/> 					
				</div>								
			</form>	
			<a href="login.php">Login here</a>			
		</div>
	</body>
</html>