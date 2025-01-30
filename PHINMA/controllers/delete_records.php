<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$action = $_REQUEST['action'];
$id = $_POST['id'];
if($action=="delete_facility"){
	$db->query("DELETE FROM  m_facilities  where id = '$id'");
}

else if($action=="deleteuser"){
	$query = "DELETE FROM m_users WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleterecepient"){
	$query = "DELETE FROM t_asset_disposal_recepients WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}

else if($action=="deleteusage"){
	$query = "DELETE FROM m_usage WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="delete_software"){
	$query = "DELETE FROM t_hardware_software_installed WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}

else if($action=="deletedepartment"){
	$query = "DELETE FROM m_department WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleteposition"){
	$query = "DELETE FROM m_positions WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleteunit"){
	$query = "DELETE FROM t_branch_units WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleterole"){
	$query = "DELETE FROM t_user_roles WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleteproperty"){
	$query = "DELETE FROM t_asset_cat_property WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="delete_usertype"){
	$query = "DELETE FROM m_usertype WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deactivateuser"){
	$query = "UPDATE m_users set is_active = 0 WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="activateuser"){
	$query = "UPDATE m_users set is_active = 1 WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleteassetcat"){
	$query = "DELETE FROM m_asset_category WHERE id = '$id'";
	$db->query($query);
	$query = "DELETE FROM m_asset_category WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deletecurr"){
	$query = "DELETE FROM m_branches WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deletecurrsubject"){
	$query = "DELETE FROM t_curr_subjects WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}

else if($action=="deletesubject"){
	$query = "DELETE FROM m_sujects	 WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deletepredictor"){
	$query = "DELETE FROM t_prediction_variables WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleteclass"){
	$query = "DELETE FROM m_class_info WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deletesy"){
	$query = "DELETE FROM m_sy WHERE sy_id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="activatesy"){
	$db->query("UPDATE  m_sy SET is_active=0");
	$query = "UPDATE  m_sy SET is_active=1 WHERE sy_id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleteclasslist"){
	$query = "DELETE FROM t_class_students WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="reprocess"){
	$query = "DELETE FROM t_prediction_records WHERE sy_id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deleteassetinfo"){
	$query = "DELETE FROM m_hardware_assets WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
else if($action=="deletesoftware"){
	$query = "DELETE FROM m_software_assets WHERE id = '$id'";
	$db->query($query);
	
	echo 0;
}
?>