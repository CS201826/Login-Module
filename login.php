<?php

error_reporting(0);
session_start();

$task = $_GET['task'];

if($task == 'logout') {
	unset($_SESSION['username']);
	session_destroy();
	header('Location: login.php');
}

$error = '';
if (!empty($_SESSION['errormsg'])) {
    // let's show our message to a user
	$error = $_SESSION['errormsg'];
    // and don't forget to erase it from session
    unset($_SESSION['errormsg']);
} else if ($_SESSION['username']) {
	header('Location: index.php');
}
?>
<html>
	<head>
		<title>Login page</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	
	<body>
		<div class="wrapper">
			<h1>Login</h1>
			<div class="alert"><?php echo $error; ?></div>
			<form action="functions.php" method="post">
				<input type="hidden" name="task" value="login">
				
				<div class="form-data">
					<p><label for="name">Username</label></p>
					<p><input type="text" name="username" value="" required /></p>
				</div>
				
				<div class="form-data">
					<p><label for="password">Password</label></p>
					<p><input type="password" name="password" value="" required /></p> 					
				</div>
				
				<div class="form-data">					
					<input type="submit" value="Login" class="btn"/> 					
				</div>				
				
			</form>	
			<a href="register.php">Register here</a>
		</div>
	</body>
</html>