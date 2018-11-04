<?php

	$username = "";
	$email = "";
	$password = "";
	$confirmpassword = "";
	$errors = array();


// connect to the database
	
	$db = mysqli_connect("10.0.2.4:15672", "root", "root", "it490");
	
// if the register button is clicked
	if (isset($_POST['register'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']);
	}

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	
	if ($password != $confirmpassword) {
		array_push($errors, "The two passwords must match");
	}
	
	//Check to see if this user already exists
	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	
	if ($user) {
		if ($user['username'] === $username) {
			array_push($errors, "Username already exists");
		}
		
		if ($user['email'] === $email) {
			array_push($errors, "email already exists");
		}
	}
	
	// if no errors occur, save user to database.
	if (count($errors) == 0 ) {
		$password = md5($password); //Encrypts password before putting into db
		$sql = "INSERT INTO users (username, email, password) 
					VALUES ('$username', '$email', '$password')";
		mysqli_query($db, $sql);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
	}

//LOGIN

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}



ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname('___FILE___') . '/log.txt');
error_reporting(E_ALL);



?>
	