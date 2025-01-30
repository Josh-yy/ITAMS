<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
include('../assets/libs/phpqrcode/qrlib.php');
$newdate = date('Y-m-d h:i:s');
$eid = $_POST['eid'];
$asset_photo = get_column2("asset_photo","select * from m_hardware_assets where id = '".$eid."'",$db);
$transaction_code = $_POST['transaction_code'];
$asset_code = $_POST['asset_code'];
$machinename = $_POST['machinename'];
$modelno = $_POST['modelno'];
$serialno = $_POST['serialno'];
$datepurchase = $_POST['datepurchase'];
$assetcat = $_POST['assetcat'];
$status = $_POST['status'];
$machinename = $_POST['machinename'];
$installable = $_POST['installable'];
$manufacturer_name = $_POST['manufacturer_name'];
	if(get_exist2("select * from v_temp_image",$db)==0){
	     $activity =  $_SESSION['data']['account_name'] . " updated  hardware asset with the transaction number" . $transaction_code;
                activity_log_maker("UPdate",$activity,$_SESSION['data']['account_id'],$db);
		$sql = "UPDATE m_hardware_assets SET transaction_code='$transaction_code',code='$asset_code',
machine_name='$machinename',model_number='$modelno',installable_with_software='$installable',serial_number='$serialno',asset_cat_id='$assetcat',date_purchased='$datepurchase',manufacturer_name='$manufacturer_name' WHERE id = '$eid'" ;
    $db->query($sql);
        $db->query("DELETE from v_temp_image");
        echo 0;
	}else{ 	
	       $activity =  $_SESSION['data']['account_name'] . " updated  hardware asset with the transaction number" . $transaction_code;
                activity_log_maker("Updated",$activity,$_SESSION['data']['account_id'],$db);
		$sql = "UPDATE m_hardware_assets SET transaction_code='$transaction_code',code='$asset_code',
machine_name='$asset_code',model_number='$modelno',installable_with_software='$installable',serial_number='$serialno',asset_photo=(select filename from v_temp_image),asset_cat_id='$assetcat',date_purchased='$datepurchase',manufacturer_name='$manufacturer_name' WHERE id = '$eid'" ;
		$db->query($sql);
		$db->query("DELETE from v_temp_image");
		echo 0;
	}


?>