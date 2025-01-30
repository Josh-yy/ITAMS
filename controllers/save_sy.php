<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$code = $_POST['code'];
$name = $_POST['name'];



	if(get_exist2("select * from m_sy where sy = '$name' or code = '$code'",$db)>0){
		echo 1;
	}else{
		$db->query("insert into m_sy values (sy_id, '$code','$name',0,'$newdate','".$_SESSION['data']['account_id']."')");
		echo 0;
	}
?>