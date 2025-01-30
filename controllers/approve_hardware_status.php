<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d H:i:s');
$action = $_REQUEST['action'];
$id = $_POST['id'];


   $activity =  $_SESSION['data']['account_name'] . " has approved the hardware asset update status " . get_column2("machine_name","select * from m_hardware_assets where id = (select asset_id from t_hardware_update_status where id = '$id') ",$db) . " to " . "<b>".get_column2("status","select status from t_hardware_update_status where id = '$id'",$db)."</b> due to <b class='text-success'>" . get_column2("reasons","select reasons from t_hardware_update_status where id = '$id'",$db) . "</b>" ;
            activity_log_maker("Approval",$db->sanitize($activity),$_SESSION['data']['account_id'],$db);
            
  $db->query("UPDATE t_hardware_update_status SET is_approved = 1, date_approve = '$newdate', approved_by = '".$_SESSION['data']['account_id']."' where id = '".$id."'");
    $db->query("UPDATE m_hardware_assets set status = (select status from t_hardware_update_status where id = '$id')  WHERE id = (select asset_id from t_hardware_update_status where id = '$id')");
  
  

  echo 0;

?>