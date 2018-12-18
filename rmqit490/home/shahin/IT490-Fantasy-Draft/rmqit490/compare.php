<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=index.html", true, 303);
 }
include ('testRabbitMQClient.php');
$playerID = $_GET['playerID'];
$player2ID = $_GET['player2ID'];
$response = playerCompare($playerID, $player2ID);
$respo = rtrim($response);
header('Content-Type: application/json;charset=utf-8');
//echo json_decode($data);
echo ($respo);
?>