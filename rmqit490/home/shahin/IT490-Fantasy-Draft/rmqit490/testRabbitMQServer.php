#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function auth($name, $password) {
    ( $db = mysqli_connect ( 'localhost', 'root', 'root', 'it490' ) );
    if (mysqli_connect_errno())
    {
      $txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Failed to connect to MySQL database for authentication";
      $file = file_put_contents('log.txt', $txt);
      echo "Failed to connect to MYSQL". mysqli_connect_error();
      exit();
    }
    $save ="Successfully connected to MySQL<br><br>";
  echo $save;
$GLOBALS['ss'] = $save;
echo $GLOBALS['ss'];
    mysqli_select_db($db, 'it490' );
    $s = "select * from users where name = '$name' and password = SHA1('$password')";
    //echo "The SQL statement is $s";
    ($t = mysqli_query ($db,$s)) or die(mysqli_error());
    $num = mysqli_num_rows($t);
    if ($num == 0){
      $txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Username and password do not match";
      $file = file_put_contents('log.txt', $txt);
      return false;
    }else
    {
      $txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Successfully authenticated";
      $file = file_put_contents('log.txt', $txt);
      print "<br>Authorized";
      return true;
    }
}
function tst(){
return $GLOBALS['ss'];
}
function register($name,$password,$email) {
    ( $db = mysqli_connect ( 'localhost', 'root', '12345678', 'it490' ) );
    if (mysqli_connect_errno())
    {
      $txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Failed to connect to MySQL database for registration";
      $file = file_put_contents('log.txt', $txt);
      echo"Failed to connect to MYSQL". mysqli_connect_error();
      exit();
    }
    echo "Successfully connected to MySQL";
    mysqli_select_db($db, 'it490' );
    $salt = "dskjfoewiufds".$b;
    $s = "insert into users (name,password,email) values ('$name', SHA1('$password'),'$email')";
    //echo "The SQL statement is $s";
    ($t = mysqli_query ($db,$s)) or die(mysqli_error());
    $txt = " " .date("y-m-d") . " " .date("h:i:sa") . " " . "Successfully registered";
    $file = file_put_contents('log.txt', $txt);
    print "Registered";
    return true;
}
function test($word)
{
  echo $word;
  return true;
}

function playerSearch($playerID){
<?php

$request = new HttpRequest();
$request->setUrl('https://stats.nba.com/stats/playerprofilev2');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'LeagueID' => '',
  'PerMode' => 'Totals',
  'PlayerID' => $playerID
));

$request->setHeaders(array(
  'Postman-Token' => '536c5cfd-9a52-4578-be90-5a4b17a0d9c6',
  'cache-control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
  return $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
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
    case "login":
      return auth($request['name'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
    case "register":
      return register($request['name'],$request['password'],$request['email']);
    case "Test":
      return test($request['message']);
    case "playerID":
      return playerSearch($request['playerID']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
exit();
?>