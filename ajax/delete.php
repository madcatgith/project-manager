<?php
include_once("config.php");

if (!$mysqli) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
} 

$result = mysqli_query($mysqli, 'DELETE FROM `projects` WHERE `p_id`=\''.$_POST['p_id'].'\'');
$result2 = mysqli_query($mysqli, 'DELETE FROM `cms` WHERE `p_id`=\''.$_POST['p_id'].'\'');
$result3 = mysqli_query($mysqli, 'DELETE FROM `ftp` WHERE `p_id`=\''.$_POST['p_id'].'\'');
$result4 = mysqli_query($mysqli, 'DELETE FROM `db` WHERE `p_id`=\''.$_POST['p_id'].'\'');
$result5 = mysqli_query($mysqli, 'DELETE FROM `host` WHERE `p_id`=\''.$_POST['p_id'].'\'');
		if ($result && $result2 && $result3 && $result4 && $result5){
			echo 'Deleted'; 
		}
mysqli_close($mysqli);		