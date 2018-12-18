<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=login.html", true, 303);
 }
?>

<html>
<head>
</head>
<body>
<a href="playerSearch.php">Search a player</a>
<a href="">Speciality</a>
<a href="">Insurance</a>
</body>

</html>