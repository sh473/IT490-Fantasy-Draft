<?php
session_start();
//ini_set("display_errors", 0);
//ini_set("log_errors",1);
//ini_set("example", dirname(__FILE__). '/log.txt');
//error_reporting( E_ALL);
include("testRabbitMQClient.php");
$user = $_POST['user'];
$password = $_POST['password'];
$response = login($user, $password);
if($response == true)
	{ 
		$_SESSION['user'] = $user;
		$txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Successfully logged in";
      	$file = file_put_contents('flog.txt', $txt);
    	echo "Welcome";
    	header("Refresh:1; url=welcomepage.html", true, 303);
  	}
else
 	{
 		$txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Unsuccessful login attempt";
      	$file = file_put_contents('flog.txt', $txt);
    	echo "Not Allowed";
    	header("Refresh:1; url=login.html", true, 303);
  	}
?>