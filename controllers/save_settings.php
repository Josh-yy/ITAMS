<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$email_address = $_POST['email_address'];
$api_key = $_POST['api_key'];



	if(get_exist2("select * from t_email_facility_settings",$db)>0){
		$db->query("UPDATE t_email_facility_settings SET email_address = '$email_address',email_api_key='$api_key',date_modified='$newdate',modified_by = '".$_SESSION['data']['account_id']."'");

		echo 0;
	}else{
		$db->query("insert into t_email_facility_settings values (id, '$email_address','$api_key',1,'$newdate','".$_SESSION['data']['account_id']."')");
		echo 0;
	}
?>