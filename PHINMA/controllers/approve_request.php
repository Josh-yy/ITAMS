<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d H:i:s');
$action = $_REQUEST['action'];
$id = $_POST['id'];
   
   $activity =  $_SESSION['data']['account_name'] . " has approved the asset tagging request " ;
    activity_log_maker("Approval",$db->sanitize($activity),$_SESSION['data']['account_id'],$db);
   
	$db->query("UPDATE m_hardware_assets set status = 'Non-Functonal' WHERE transaction_code = (select asset_id from t_asset_notification where id = '".$id."')");
    $db->query("UPDATE t_asset_notification set is_viewed = 1 WHERE id =  '".$id."'");
    $db->query("UPDATE t_hardware_update_status set is_approved = 1, approved_by = '".$_SESSION['data']['account_id']."', date_approve ='$newdate'  WHERE asset_id = (select asset_id from t_asset_notification where id = '".$id."')");
	echo 0;

?>