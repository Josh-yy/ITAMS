<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$action = $_REQUEST['action'];
$id = $_POST['id'];
	
    $activity =  $_SESSION['data']['account_name'] . " has approved the asset tagging request " ;
    activity_log_maker("Approval",$db->sanitize($activity),$_SESSION['data']['account_id'],$db);
    
    
	$db->query("UPDATE t_asset_tagging  set  is_approve = 1, date_approve = '$newdate',approved_by='".$_SESSION['data']['account_id']."' ,status = 1  where id = '$id'");
	
	$db->query("UPDATE t_asset_notification set is_viewed = 1 WHERE asset_id = (select transaction_code from t_asset_tagging where id = '".$id."')");

	echo 0;

?>