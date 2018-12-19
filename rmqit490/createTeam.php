<?php
include ('testRabbitMQClient.php');
$teamName = $_GET["teamName"];
$teamLocation = $_GET["teamLocation"];
$user = $_GET["user"];

$resp = createTeam($teamName,$teamLocation,$user);
if( $resp == 1){
	$_SESSION['teamName'] = $teamName;
	echo "Team Creation Successful\n";
	echo $teamName;
	header("Refresh:1; welcomepage.html", true, 303);
	$message = "team creation successful";
	shell_exec("touch ~/IT490-Fantasy-Draft/rmqit490/team.log");
	shell_exec('echo $message >> ~/IT490-Fantasy-Draft/rmqit490/team.log');
}
else{
	echo "Team Creation Unsucessful";
}
?>