<?php

// Include database file
include('database.php');

session_start();
$_SESSION['errormsg'] = '';

/** Method to login a user
 *
 * @param mixed posted data
 * @return null
 */
function login()
{
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	$query = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
	$result = mysql_query($query);
	
	if(mysql_num_rows($result)) {
		$_SESSION['username'] = $username;
		header('Location: index.php');		
	} else {
		$_SESSION['errormsg'] = "Please try again - Username/Password does not match";
		header('Location: login.php');				
	}	
}


/** Method to register a user
 *
 * @param mixed posted data
 * @return boolean
 */
function register()
{
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$category = $_POST['category'];	
	$image = '';
	$created_date = date('Y-m-d H:i:s');
	
	// Call to function to check out whether same email/username already exists
	$checkUser = getUserExistsOrNot();
	
	if(empty($checkUser)) {
	
		if($_FILES['image']['tmp_name']) {
			$timestamp = time();
			$image = $timestamp.$_FILES['image']['name'];			
			move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$image);
		}
		
		$query = "INSERT INTO users(name, username, email, phone, password, address, category, image, created_date) VALUES ('".$name."', '".$username."', '".$email."', '".$phone."', '".$password."', '".$address."', '".$category."', '".$image."', '".$created_date."')";
		$result = mysql_query($query) or die('Failed to enter details in user table: '.mysql_error());
		
		if($result) {
			header("Location: index.php");
		} else {
			
			if($_FILES['image']['tmp_name']) {
					unlink('uploads/'.$image);
			}
			
			$_SESSION['errormsg'] = "Please try again: Registration failed";
			header("Location: register.php");
		} 
	} else {
		$_SESSION['errormsg'] = "Please choose again: Username already exists";
		header("Location: register.php");		
	}
} 


/** Method to check whether a user already exists or not
 *
 * @param mixed posted data
 * @return null
 */
function getUserExistsOrNot() 
{
	$username = $_POST['username'];	
	$query = "SELECT id FROM users WHERE username='".$username."'";
	$result = mysql_query($query) or die("Failed to fetch data: ".mysql_error());
	
	if(!mysql_num_rows($result)) {
		return false;
	} else {
		return true;
	}	
}


/** Method to get user profile
 *
 * @param string session data
 * @return mixed response
 */
function getUserProfile()
{
	$username = $_SESSION['username'];	
	$query = "SELECT * FROM users WHERE username='".$username."'";
	$result = mysql_query($query) or die("Failed to fetch data: ".mysql_error());
	$data = mysql_fetch_assoc($result);
	return $data;
}

// Condition to check post or not
if(isset($_POST) && $_POST['username']) {
	$task = $_POST['task'];
	
	switch($task) {
		case 'login':
			login();
			break;
		case 'register':
			register();
			break;
		default:
	}	
}
