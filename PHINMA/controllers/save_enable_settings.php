<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$state = $_POST['state'];




$activity =  $_SESSION['data']['account_name'] . " has updated the email facility settings ";
    activity_log_maker("Update",$activity,$_SESSION['data']['account_id'],$db);
    
		$db->query("UPDATE t_email_facility_settings SET is_enabled = '$state'");
			echo 0;
		
?>