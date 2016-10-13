<?php
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

########## MySql details #############
$username = "optfashion_def"; //mysql username
$password = "asdfg"; //mysql password
$hostname = "localhost"; //hostname
$databasename = 'optfashion_projectmanager'; //databasename

//connect to database
$mysqli = new mysqli($hostname, $username, $password, $databasename);

?>