#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function authentication($email,$userpass)
{
      $host = 'localhost';
      $user = 'usr';
      $dbpass = 'password';
      $db = 'accounts';
      $mysqli = new mysqli($host,$user,$dbpass,$db);
      if($mysqli->connect_errno){
        echo "\nMaster server down, switching to backup...\n";
        $host = '192.168.43.25';
        $user = 'usr';
        $dbpass = 'password';
        $db = 'accounts';
        $mysqli = new mysqli($host,$user,$dbpass,$db) or die($mysqli->error);
      }
      else{
        echo "Using master.\n";
      }
      $userinfo = array();
      $email = $mysqli->escape_string($email);
      $result = $mysqli->query("SELECT * FROM users WHERE email='$email' and password='$userpass'");
      $user = $result->fetch_assoc();
      if ( $result->num_rows == 0 ){ // User doesn't exist
          echo "Incorrect Credentials\n";
          return false;
      }
      else { // User exists
          echo "Correct Credentials, logging in...\n";
          $userinfo['email'] = $user['email'];
          $userinfo['first_name'] = $user['first_name'];
          $userinfo['last_name'] = $user['last_name'];
          $userinfo['active'] = $user['active'];
          return json_encode($userinfo);
      }
}
function registration($firstname, $lastname, $email, $password){
      $host = 'localhost';
      $user = 'usr';
      $dbpass = 'password';
      $db = 'accounts';
      $mysqli = new mysqli($host,$user,$dbpass,$db);
      if($mysqli->connect_errno){
        echo "\nMaster server down, switching to backup...\n";
        $host = '192.168.43.25';
        $user = 'usr';
        $dbpass = 'password';
        $db = 'accounts';
        $mysqli = new mysqli($host,$user,$dbpass,$db) or die($mysqli->error);
      }
      else{
        echo "Using master.\n";
      }
      $userinfo = array();
      // Check if user with that email already exists
      $result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());
      if ( $result->num_rows > 0 ) { //Email already exists
          return false;
      }
      else { // Email doesn't already exist in a database, proceed...
          //connection to database for user related tables
          $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');
          //create user table for owned games
          $owned = "CREATE TABLE `owned_$email`(
            steam_app_id INT NOT NULL,
            rating ENUM('null','like','dislike') DEFAULT 'null',
            game_name VARCHAR(255),
            PRIMARY KEY (steam_app_id)
          )";
          $user->query($owned) or die($user->error);
          //table for user preferences
          $pref = "CREATE TABLE `pref_$email`(
            genre_id INT NOT NULL AUTO_INCREMENT,
            genre INT NOT NULL,
            PRIMARY KEY (genre_id)
          )";
          $user->query($pref) or die($user->error);
          //table for user preferences
          $watch = "CREATE TABLE `watch_$email`(
            steam_app_id INT NOT NULL,
            game_name VARCHAR(255),
            exp_release_date DATE,
            PRIMARY KEY (steam_app_id)
          )";
          $user->query($watch) or die($user->error);
          //insert user info into users table
          $sql = "INSERT INTO users (first_name, last_name, email, password) "
                  . "VALUES ('$firstname','$lastname','$email','$password')";
          $mysqli->query($sql) or die($mysqli->error);
          $userinfo['email'] = $email;
          $userinfo['first_name'] = $firstname;
          $userinfo['last_name'] = $lastname;
          echo "Creating account...\n";
          return json_encode($userinfo);
        }
}
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Login":
      return authentication($request['email'],$request['password']);
      break;
    case "Register":
      return registration($request['firstname'],$request['lastname'],$request['password'],$request['email']);
      break;
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
$server->process_requests('requestProcessor');
exit();
?>