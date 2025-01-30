<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$approver_id = $_POST['approver_id'];

    
	if(get_exist2("select * from m_approver",$db)>0){
		$db->query("UPDATE m_approver SET approver_id = '$approver_id'");
		echo 0;
	}else{
		$db->query("insert into m_approver VALUES ('$approver_id','$newdate')");
		echo 0;
	}
?>