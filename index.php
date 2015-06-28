<?php

// Require a file
require('functions.php');

// Check out session whether user is logged in or not
if ($_SESSION['username']) {
	// Get user profile data
	$result = getUserProfile();	
} else {	
	// Send to login page
	header("Location: login.php");
}

?>
<html>
	<head>
		<title>Profile page</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	
	<body>
		<div class="wrapper">
			<h1>Visit your profile</h1>			
			<hr/>
			<h3>Welcome user, <?php echo $result['username']; ?></h3>
			<p>See your below details</p>
			<div class="wrapper-inner">
				<div class="left-side">
					<strong>Name: </strong><?php echo $result['name']; ?><br/>
					<strong>Email: </strong><?php echo $result['email']; ?><br/>
					<strong>Phone: </strong><?php echo $result['phone']; ?><br/>
					<strong>Address: </strong><?php echo $result['address']; ?><br/>
					<strong>Category: </strong><?php echo $result['category']; ?><br/>
					<strong>Created date: </strong><?php echo date('jS F Y', strtotime($result['created_date'])); ?><br/>			
				</div>
				<div class="right-side">
					<?php if($result['image']): ?>
						<img src="uploads/<?php echo $result['image']; ?>" width="150px" height="150px" />
					<?php endif; ?>
				</div>
			</div>
			<a href="login.php?task=logout">Logout</a>
		</div>
	</body>
</html>