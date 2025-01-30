<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
$added_by = $_SESSION['data']['account_id'];
$newdate = date('Y-m-d h:i:s');
$property_id = $db->sanitize($_POST['property_id']);
$asset_id = $db->sanitize($_POST['asset_id']);
$prop_value = $db->sanitize($_POST['prop_value']);

$property = get_column2("property_name","select * from t_asset_cat_property where id = '$property_i'",$db);

	if(get_exist2("select * from t_asset_properties where asset_id = '$asset_id' and property_id = '$property_id'",$db)>0){
	    $machine_name  = get_column2("machine_name","select * from m_hardware_assets where id = '".$asset_id."'",$db);
    $activity =  $_SESSION['data']['account_name'] . " updated the ".$propert."  of the hardware asset " . $machine_name . " to " . $prop_value;
    activity_log_maker("Update",$activity,$_SESSION['data']['account_id'],$db);
		$sql = "update t_asset_properties set prop_value='$prop_value', date_modified='$newdate',modified_by='".$_SESSION['data']['account_id']."' where asset_id = '$asset_id'";
		$db->query($sql);
		$activity = $_SESSION['data']['account_name'] . " set the " . get_column2("property_name","select * from t_asset_cat_property where id = '$property_id'",$db) . " with " . $prop_value;
		$usql = "INSERT INTO t_asset_property_changes_history VALUES (id,'$asset_id',(select property_name from t_asset_cat_property where id = '$property_id'),'$prop_value','$newdate','".$db->sanitize($activity)."','Add')";

		$db->query($usql);
		echo 1;
	}else{
	      $machine_name  = get_column2("machine_name","select * from m_hardware_assets where id = '".$asset_id."'",$db);
    $activity =  $_SESSION['data']['account_name'] . " set the ".$propert."  of the hardware asset " . $machine_name . " with " . $prop_value;
    activity_log_maker("Add",$activity,$_SESSION['data']['account_id'],$db);
		$db->query("insert into t_asset_properties values (id, '$asset_id','$property_id','$prop_value','$newdate','".$_SESSION['data']['account_id']."',null,null)");
			$activity = $_SESSION['data']['account_name'] . " updated the " . get_column2("property_name","select * from t_asset_cat_property where id = '$property_id'",$db) . " with " . $prop_value;

		$usql = "INSERT INTO t_asset_property_changes_history VALUES (id,'$asset_id',(select property_name from t_asset_cat_property where id = '$property_id'),'$prop_value','$newdate','".$db->sanitize($activity)."','Update')";

		$db->query($usql);
		echo 0;
	}
?>