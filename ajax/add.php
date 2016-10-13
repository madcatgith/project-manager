 <?php
include_once("config.php");

if (!$mysqli) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
}
$res=1;
if (!$_POST['project_name']==''){
	if (!$_POST['p_id']==''){
		$result = mysqli_query($mysqli, 'DELETE FROM `projects` WHERE `p_id`=\''.$_POST['p_id'].'\'');
		$result2 = mysqli_query($mysqli, 'DELETE FROM `cms` WHERE `p_id`=\''.$_POST['p_id'].'\'');
		$result3 = mysqli_query($mysqli, 'DELETE FROM `ftp` WHERE `p_id`=\''.$_POST['p_id'].'\'');
		$result2 = mysqli_query($mysqli, 'DELETE FROM `host` WHERE `p_id`=\''.$_POST['p_id'].'\'');
		$result3 = mysqli_query($mysqli, 'DELETE FROM `db` WHERE `p_id`=\''.$_POST['p_id'].'\'');
		if ($result && $result2 && $result3){
		$result = mysqli_query($mysqli, 'INSERT INTO `projects`(`p_id`,`name`,`url`,`descr`) VALUES (\''.$_POST['p_id'].'\',\''.$_POST['project_name'].'\',\''.$_POST['project_url'].'\',\''.$_POST['project_descr'].'\')' );
		$my_id=$_POST['p_id'];}
	}
	else{
		$result = mysqli_query($mysqli, 'INSERT INTO `projects`(`name`,`url`,`descr`) VALUES (\''.$_POST['project_name'].'\',\''.$_POST['project_url'].'\',\''.$_POST['project_descr'].'\')' );
		$my_id = mysqli_insert_id($mysqli);}
if ($result){
	$res='<strong>Project was successfully added:</strong>';
}
else
{
	$res=$result;
}
	if((!$_POST['cms_type']=='')&&(!$_POST['cms_login']=='')&&(!$_POST['cms_password']==''))
	{
		$result = mysqli_query($mysqli, 'INSERT INTO `cms` VALUES (\''.$my_id.'\',\''.$_POST['cms_type'].'\',\''.$_POST['cms_login'].'\',\''.$_POST['cms_password'].'\')' );
		if ($result){
			$res=$res.'<br/>Cms data added. ';
		}		
	}

		if((!$_POST['ftp_server']=='')&&(!$_POST['ftp_login']=='')&&(!$_POST['ftp_password']==''))
	{
		$result = mysqli_query($mysqli, 'INSERT INTO `ftp` VALUES (\''.$my_id.'\',\''.$_POST['ftp_server'].'\',\''.$_POST['ftp_login'].'\',\''.$_POST['ftp_password'].'\')' );
		if ($result){
			$res=$res.'<br/>Ftp data added. ';
		}		
	}

	if((!$_POST['host_login']=='')&&(!$_POST['host_password']==''))
	{
		$result = mysqli_query($mysqli, 'INSERT INTO `host` VALUES (\''.$my_id.'\',\''.$_POST["host_server"].'\',\''.$_POST['host_login'].'\',\''.$_POST['host_password'].'\')' );
		if ($result){
			$res=$res.'<br/>host data added. ';
		}		
	}

	if((!$_POST['db']=='')&&(!$_POST['db_login']=='')&&(!$_POST['db_password']==''))
	{
		$result = mysqli_query($mysqli, 'INSERT INTO `db` VALUES (\''.$my_id.'\',\''.$_POST['db'].'\',\''.$_POST['db_login'].'\',\''.$_POST['db_password'].'\')' );
		if ($result){
			$res=$res.'<br/>db data added. ';
		}		
	}

}

echo $res;
mysqli_close($mysqli);