<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
$newdate = date('Y-m-d h:i:s');
$usertypeid = $_REQUEST['usertypeid'];
$part_id=$_POST['facility'];
$facility = explode(',', $part_id);

		
foreach ($facility as $key) {
	 	//$activity =  $_SESSION['data']['account_name'] . " added user role facility id " . $part_id;
			//activity_log_maker("Update",$activity,$_SESSION['data']['account_id'],$db);
		$query = "INSERT INTO t_user_roles VALUES (ID,'$usertypeid','$key','$newdate','".$_SESSION['data']['account_id']."')";
		 $db->query($query);
	}
		echo 0;
?>