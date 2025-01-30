<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$facility = $db->sanitize($_REQUEST['facility']);
$desc = $db->sanitize($_REQUEST['desc']);
$node = $db->sanitize($_REQUEST['node']);
$facility_link = $db->sanitize($_REQUEST['facility_link']);
$order = $db->sanitize($_REQUEST['order']);
$ismenu = $db->sanitize($_REQUEST['ismenu']);
if(get_exist($facility,$db,"m_facilities","facility_name")>0)
{
	echo 1;
}
else
{
	//$activity =  $_SESSION['data']['account_name'] . " Added a facility " . $facility;
	//activity_log_maker("Add",$activity,$_SESSION['data']['account_id'],$db);
	$query = "INSERT INTO m_facilities VALUES (ID, '$facility','$desc','$facility_link','$node','$order','$ismenu','$newdate','".$_SESSION['data']['account_id']."')";
	 $db->query($query);

	 echo 0;
}
?>