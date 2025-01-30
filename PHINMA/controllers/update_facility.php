<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$facility = $db->sanitize($_REQUEST['facility']);
$desc = $db->sanitize($_REQUEST['desc']);
$facility_link = $db->sanitize($_REQUEST['facility_link']);
$node = $db->sanitize($_REQUEST['node']);
$order = $db->sanitize($_REQUEST['order']);
$ismenu = $db->sanitize($_REQUEST['ismenu']);
$id = $db->sanitize($_REQUEST['eid']);

if(get_exist_edit("facility_name",$db,"m_facilities",$id,$facility)){
	echo 1;
}
else
{
	//$activity =  $_SESSION['data']['account_name'] . " Updated facility " . $facility;
	//activity_log_maker("Update",$activity,$_SESSION['data']['account_id'],$db);
	$query = "UPDATE m_facilities SET facility_name = '$facility',node='$node',description = '$desc',facility_link = '$facility_link',orderno='$order',ismenu='$ismenu' where id = '$id'";
	 $db->query($query);

	 echo 0;
}
?>