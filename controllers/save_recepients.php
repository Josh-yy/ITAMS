<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
$newdate = date('Y-m-d h:i:s');

$part_id=$_POST['facility'];
$facility = explode(',', $part_id);

		
foreach ($facility as $key) {
	 	//$activity =  $_SESSION['data']['account_name'] . " added user role facility id " . $part_id;
			//activity_log_maker("Update",$activity,$_SESSION['data']['account_id'],$db);
		$query = "INSERT INTO t_asset_disposal_recepients VALUES (ID,'$key','$newdate')";
		 $db->query($query);
	}
		echo 0;
?>


