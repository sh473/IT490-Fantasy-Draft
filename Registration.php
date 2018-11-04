<?php include ('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
		<title> User Registration</title>
		<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
		<div class="header">
			<h2>Registration</h2>
		</div>
		
		<form method="post" action="Registration.php">
		<?php include ('errors.php'); ?>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="text" name="email" value="<?php echo $email; ?>">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password">
			</div>
			<div class="input-group">
				<label>Confirm Password</label>
				<input type="password" name="confirmpassword">
			</div>
			<div class="input-group">
				<button type="submit" name="register" class="btn">Register</button>
			</div>
			<p>
				Already a member? <a href="Login.php">Sign in</a>
			</p>
		</form>



</body>

<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname('___FILE___') . '/log.txt');
error_reporting(E_ALL);

?>


</html>