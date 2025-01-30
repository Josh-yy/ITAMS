<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$name = $_POST['name'];
	$desc = $_POST['desc'];

	if(get_exist2("select * from m_usage where typename = '$name'",$db)>0){
		echo 1;
	}else{
		$db->query("insert into m_usage values (id, '$name','$desc','$newdate','".$_SESSION['data']['account_id']."')");
		echo 0;
	}
?>