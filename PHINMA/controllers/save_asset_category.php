<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$code = $_POST['code'];
$name = $_POST['name'];
$desc = $_POST['desc'];
if(isset($_POST['has_properties'])) {
    $has_properties = 1;
} else {
    $has_properties = 0;
}

     $activity =  $_SESSION['data']['account_name'] . " has added new asset category " . $name;
    activity_log_maker("Add",$activity,$_SESSION['data']['account_id'],$db);

	if(get_exist2("select * from m_asset_category where code = '$code'",$db)>0){
		echo 1;
	}else{
		$db->query("insert into m_asset_category values (id, '$code','$name','$desc',1,'$has_properties','$newdate','".$_SESSION['data']['account_id']."')");
		echo 0;
	}
?>