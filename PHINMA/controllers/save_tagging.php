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
if(get_exist2("select * from t_asset_tagging where asset_id = '$asset_id'",$db)==0){
	$db->query("INSERT INTO t_asset_tagging_history VALUES (id,'$asset_id','$userid','$usage','$newdate',1)");
	$sql = "";
	if($_SESSION['data']['account_id']==get_column2("approver_id","select * from m_approver",$db)){
	     $machine_name  = get_column2("machine_name","select * from m_hardware_assets where id = '".$asset_id."'",$db);
    $activity =  $_SESSION['data']['account_name'] . " assigned/tagged the hardware asset " . $machine_name . " to " .get_column2("ename","select concat(ln, ' ', fn, ' ', mn) as ename from m_users where id = '".$userid."'",$db);
    activity_log_maker("Add",$activity,$_SESSION['data']['account_id'],$db);
		$sql = "INSERT INTO t_asset_tagging VALUES (id,'$transaction_code', '$asset_id','$userid ','$branch_id','$unit','$department','$usage','$newdate','".$_SESSION['data']['account_id']."',1,'$newdate',null,1)";
		$db->query($sql);

	}else{
	     $activity =  $_SESSION['data']['account_name'] . " assigned/tagged the hardware asset " . $machine_name . " to " .get_column2("ename","select concat(ln, ' ', fn, ' ', mn) as ename from m_users where id = '".$userid."'",$db);
            activity_log_maker("Add",$activity,$_SESSION['data']['account_id'],$db);
		$sql = "INSERT INTO t_asset_tagging VALUES (id,'$transaction_code', '$asset_id','$userid ','$branch_id','$unit','$department','$usage','$newdate','".$_SESSION['data']['account_id']."',0,null,null,1)";
		$db->query("INSERT INTO t_asset_notification VALUES (id,'$transaction_code',0,(select approver_id from m_approver),'$newdate','tagging')");
		$db->query($sql);
	}
	
	
	

	echo 0;
}else{
	if(get_exist2("select * from t_asset_tagging where asset_id = '$asset_id' and status = 0",$db)){
		echo 2;
	}
	else{
	echo 1;	
	}
}
?>