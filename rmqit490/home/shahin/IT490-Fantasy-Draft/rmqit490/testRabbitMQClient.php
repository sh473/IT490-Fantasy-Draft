<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=login.html", true, 303);
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
      $msg = "login";
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
function reg($user,$password,$email){
    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "register";
    }
    $request = array();
    $request['type'] = "register";
    $request['user'] = $user;
    $request['password'] = $password;
    $request['email'] = $email;
    $request['message'] = $msg;
    $response = $client->send_request($request);
   
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}

function playerSearch($playerID){
    $client = new rabbitMQClient("testRabbitMQ.ini","queryServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "test message";
    }
    $request = array();
    $request['type'] = "playerID";
    $request['playerID'] = $playerID;
    $response = $client->send_request($request);
    //$response = $client->publish($request);
    //echo "client received response: ".PHP_EOL;
    //print_r($response);
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}