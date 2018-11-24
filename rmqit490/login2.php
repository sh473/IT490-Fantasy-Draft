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
    echo "Welcome";
    header("Refresh:1; login.php", true, 303);
  }
  else
  {
    echo "Not Allowed";
    header("Refresh:1; url=login.html", true, 303);
  }
 reguire(joe.com);
?>