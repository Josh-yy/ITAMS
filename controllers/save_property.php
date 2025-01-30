<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$code = $_POST['code'];
$name = $_POST['name'];
$branch_id = $_POST['branch_id'];


	if(get_exist2("select * from t_asset_cat_property where property_name = '$code' and cat_id='$branch_id'",$db)>0){
		echo 1;
	}else{
		$db->query("insert into t_asset_cat_property values (id,'$branch_id', '$code','$name','$newdate','".$_SESSION['data']['account_id']."')");
		echo 0;
	}
?>