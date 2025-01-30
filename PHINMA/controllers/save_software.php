<?php
@session_start();

require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
date_default_timezone_set("Asia/Manila");
$newdate = date('Y-m-d H:i:s');
$asset_id = $_REQUEST['asset_id'];
$part_id=$_POST['facility'];
$facility = explode(',', $part_id);

		
foreach ($facility as $key) {
	 	//$activity =  $_SESSION['data']['account_name'] . " added user role facility id " . $part_id;
			//activity_log_maker("Update",$activity,$_SESSION['data']['account_id'],$db);
		$query = "INSERT INTO t_hardware_software_installed VALUES (ID,'$asset_id','$key','$newdate','".$_SESSION['data']['account_id']."')";
		 $db->query($query);
	}
		echo $newdate;
?>


