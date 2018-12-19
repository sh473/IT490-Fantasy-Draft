<?php
include ('testRabbitMQClient.php');
$email = $_GET["email"];
$user = $_GET["user"];
$password = $_GET["password"];

$resp = reg($user,$password,$email);
if( $resp == 1){
	echo "Registration Successful";
	header("Refresh:1; login.html", true, 303);
	$message = "user registration successful";
	shell_exec("touch ~/IT490-Fantasy-Draft/rmqit490/registration.log");
	shell_exec('echo $message >> ~/IT490-Fantasy-Draft/rmqit490/registration.log');
}
else{
	echo "Registration Unsucessful";
}
?>