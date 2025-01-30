<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$no_days = $_POST['no_days'];


	if(get_exist2("select * from t_trigger_notification",$db)>0){
		$db->query("UPDATE t_trigger_notification SET number_of_days = '$no_days', date_modified='$newdate', modified_by='".$_SESSION['data']['account_id']."'");
		echo 0;
	}else{
		$db->query("insert into t_trigger_notification VALUES ('$no_days','".$_SESSION['data']['account_id']."','$newdate')");
		echo 0;
	}
?>