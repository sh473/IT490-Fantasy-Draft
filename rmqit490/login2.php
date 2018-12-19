<?php
session_start();
include("testRabbitMQClient.php");
$user = $_POST['user'];
$password = $_POST['password'];
$response = login($user, $password);
if($response == true)
	{ 
		$_SESSION['user'] = $user;
		$txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Successfully logged in";
      	$file = file_put_contents('flog.txt', $txt, FILE_APPEND | LOCK_EX);
    	echo "Welcome";
    	header("Refresh:1; url=welcomepage.html", true, 303);
  	}
else
 	{
 		$txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Unsuccessful login attempt";
      	$file = file_put_contents('flog.txt', $txt, FILE_APPEND | LOCK_EX);
    	echo "Not Allowed";
    	header("Refresh:1; url=login.html", true, 303);
  	}
?>