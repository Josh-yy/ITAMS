<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$branch_id = $_POST['branch_id'];
$room = $_POST['room'];
$department = $_POST['department'];
$unit = $_POST['unit'];
$usage = $_POST['usage'];
$userid = $_POST['userid'];
$asset_id = $_POST['asset_id'];
$transaction_code = time();
    
    $activity =  $_SESSION['data']['account_name'] . "has request an asset tagging re-assignment" ;
    activity_log_maker("Asset Tagging",$db->sanitize($activity),$_SESSION['data']['account_id'],$db);
    
	$db->query("UPDATE t_asset_tagging set status = 0 where asset_id = '$asset_id'");

	

	$asql = "INSERT INTO t_asset_tagging VALUES (id,'$transaction_code', '$asset_id','$userid ','$branch_id','$unit','$department','$usage','$newdate','".$_SESSION['data']['account_id']."',0,null,null,1)";
	$db->query($asql);
	$db->query("UPDATE t_asset_tagging_history set status = 0 where asset_id = '$asset_id'");
	$db->query("INSERT INTO t_asset_tagging_history VALUES (id,'$asset_id','$userid','$usage','$newdate',1)");
	$db->query("INSERT INTO t_asset_notification VALUES (id,'$transaction_code',0,'$newdate')");
	

	echo 0;

?>