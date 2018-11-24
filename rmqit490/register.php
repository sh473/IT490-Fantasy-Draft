<?php
include ('testRabbitMQClient.php');
$email = $_GET["email"];
$user = $_GET["user"];
$pass = $_GET["password"];
#$email = "test";
#$user = "test";
#$pass = "test";
#echo $user;
#echo $pass;
$resp = reg($email,$user,$pass);
if( $resp == 1){
echo "Registeration Successful";
echo "<a href='indextest.html'>Login</a>";
#$message = "$user Login Successful";
#shell_exec("touch /tmp/error.log");
#shell_exec('echo $message >> /tmp/error.log');
}
else
{
echo "Registeration Unsucessful";
}
?>