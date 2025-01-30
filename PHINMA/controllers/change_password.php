<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$new = $_REQUEST['newpassword'];


if($_SESSION['data']['usertype']=="student"){
$query = "UPDATE t_student_account set password='".encrypt($new)."' WHERE user_id = '".$_SESSION['data']['account_id']."'";
$db->query($query);

}else{
	$query = "UPDATE m_users set password='".encrypt($new)."' WHERE id = '".$_SESSION['data']['account_id']."'";
$db->query($query);

}

?>