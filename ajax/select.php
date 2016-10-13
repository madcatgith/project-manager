 <?php
include_once("config.php");

if (!$mysqli) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
} 

//$result = mysqli_query($mysqli, 'SELECT \'name\' FROM `projects` LEFT JOIN `cms` USING (p_id) LEFT JOIN `ftp` USING (p_id)');
if (isset($_POST['select_all'])){

	if(isset($_POST['order'])&&(!empty($_POST['order']))){$ord=$_POST['order'];}else{$ord='ASC';}
	if(isset($_POST['search'])&&(!empty($_POST['search']))){$search='WHERE `name` LIKE \''.$_POST['search'].'%\'';}else{$search='';}	
	$result = mysqli_query($mysqli, 'SELECT `p_id`,`name` FROM `projects` '.$search.' ORDER BY `name` '.$ord);
	$i=0;
	while( $row = mysqli_fetch_assoc($result) ){ 
		$data[$i]=array('pid'=>$row['p_id'],'name'=>$row['name']);
		$i++;
	}	
}

if(isset($_POST['show_acc'])){
	$result = mysqli_query($mysqli, 'SELECT * FROM `projects` LEFT JOIN `cms` USING (p_id) LEFT JOIN `ftp` USING(p_id) LEFT JOIN `host` USING(p_id) LEFT JOIN `db` USING(p_id) WHERE `p_id`=\''.$_POST['p_id'].'\'');
	while( $row = mysqli_fetch_assoc($result) ){
		$data['p_id']=$row['p_id'];
		$data['name']=$row['name'];
		$data['url']=$row['url']; 
		$data['cms_type']=$row['cms_type'];
		$data['cms_login']=$row['cms_login'];
		$data['cms_password']=$row['cms_password'];
		$data['ftp_server']=$row['ftp_server'];
		$data['ftp_login']=$row['ftp_login'];
		$data['ftp_password']=$row['ftp_password'];
		$data['host_server']=$row['hosting'];
		$data['host_login']=$row['host_login'];
		$data['host_password']=$row['host_password'];
		$data['db']=$row['db_name'];
		$data['db_login']=$row['db_login'];
		$data['db_password']=$row['db_password'];
		$data['desc']=$row['descr'];
	}
}

if (isset($data)){
echo json_encode($data);
}
else{
	echo json_encode('no_data');
}

/*while( $row = mysqli_fetch_assoc($result) ){ 
        $data[$row['name']]
        printf($row['cms_type'].'<br>');
        printf($row['cms_login'].'<br>');
        printf($row['cms_password'].'<br>ftp<br>');
        printf($row['ftp_server'].'<br>');
        printf($row['ftp_login'].'<br>');
        printf($row['ftp_password'].'<br><br>');
    }*/ 
mysqli_close($mysqli);