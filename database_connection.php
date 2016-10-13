<?php
########## MySql details #############
$username = "root"; //mysql username
$password = ""; //mysql password
$hostname = "localhost"; //hostname
$databasename = 'projects'; //databasename

//connect to database
$mysqli = new mysqli($hostname, $username, $password, $databasename);

?>