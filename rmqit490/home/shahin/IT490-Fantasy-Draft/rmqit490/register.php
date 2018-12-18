<?php
include ('testRabbitMQClient.php');
$email = $_GET["email"];
$user = $_GET["user"];
$password = $_GET["password"];
#$email = "test";
#$user = "test";
#$pass = "test";
#echo $user;
#echo $pass;

$resp = reg($user,$password,$email);
if( $resp == 1){
	echo "Registration Successful";
	header("Refresh:1; login.html", true, 303);
	#$message = "$user Login Successful";
	#shell_exec("touch /tmp/error.log");
	#shell_exec('echo $message >> /tmp/error.log');
}
else{
	echo "Registeration Unsucessful";
}
?>