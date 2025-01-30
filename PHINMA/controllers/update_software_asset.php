<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
include('../assets/libs/phpqrcode/qrlib.php');
$newdate = date('Y-m-d h:i:s');
$eid = $_POST['id'];
$code = $_POST['code'];
$name = $_POST['name'];
$serial_number = $_POST['serial_number'];
$date_purchased = $_POST['date_purchased'];
$ltype = $_POST['ltype'];
$assetcat = $_POST['assetcat'];
$expiration_date = $_POST['expiration_date'];
$qr_code = $db->sanitize(encrypt($code));
$has_properties=0;

      $activity =  $_SESSION['data']['account_name'] . " updated a software asset with a serial number of " . $serial_number;
                activity_log_maker("Update",$activity,$_SESSION['data']['account_id'],$db);
		$sql  ="UPDATE m_software_assets SET code='$code',expiration_date='$expiration_date',software_name='$name',serial_number='$serial_number',date_purchased='$date_purchased',license_type='$ltype',asset_cat_id='$assetcat' WHERE id = '$eid'";
		$db->query($sql);
	
		echo 0;
	


?>