<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=10.0.2.6:8080", true, 303);
 }
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function login($user,$password){
    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "test message";
    }
    $request = array();
    $request['type'] = "login";
    $request['user'] = $user;
    $request['password'] = $password;
    $request['message'] = $msg;
    $response = $client->send_request($request);
    
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}
function register($username,$password,$email){
    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "test message";
    }
    $request = array();
    $request['type'] = "register";
    $request['name'] = $user;
    $request['password'] = $pass;
    $request['email'] = $email;
    $request['message'] = $msg;
    $response = $client->send_request($request);
   
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}