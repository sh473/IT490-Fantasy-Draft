<?php
define("DB_HOST" , "10.0.2.4:3306");
define("DB_USER" , "oo69");
define("DB_PASS" , "Sammyboy252");
define("DB_NAME" , "it490");
$connection = mysql_connect("DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);
?>