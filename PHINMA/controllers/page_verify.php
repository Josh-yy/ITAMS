<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");


$username = $_POST['username'];
$password = encrypt($_POST['password']);
$sql = "select * from m_users where username = '$username' and password = '$password'";
if(get_exist2($sql,$db)>0){
	$_SESSION['data']['account_id'] = get_column2("id",$sql,$db);
	$_SESSION['data']['account_name'] = get_column2("fn",$sql,$db);	
	echo 1;

}else{
	echo $sql;
}
?>