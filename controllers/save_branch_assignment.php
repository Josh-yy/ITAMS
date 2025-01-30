<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$userid = $_POST['userid'];
$branch_id = $_POST['branch_id'];


	if(get_exist2("select * from t_user_assignment where user_id = '$userid'",$db)>0){
		$db->query("update t_user_assignment  set branch_id = '$branch_id' where user_id = '$userid'");
		echo 0;
	}else{
		$db->query("insert into t_user_assignment values (id, '$userid','$branch_id','$newdate','".$_SESSION['data']['account_id']."')");
		echo 0;
	}
?>