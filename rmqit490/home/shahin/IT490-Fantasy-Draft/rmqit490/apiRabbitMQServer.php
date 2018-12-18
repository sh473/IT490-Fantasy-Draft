#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function playerSearch($playerID){
  ini_set("allow_url_fopen", 1);
  $url = "https://stats.nba.com/stats/playerprofile/?PlayerID=$playerID&LeagueID=00&Season=2018-19&SeasonType=Regular%20Season&GraphStartSeason=2018-19&GraphEndSeason=2018-19&GraphStat=PTS";
  $data = file_get_contents($url);
  echo $data;
  return $data;
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
    case "playerID":
      return playerSearch($request['playerID']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}