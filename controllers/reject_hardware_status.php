<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d H:i:s');
$action = $_REQUEST['action'];
$id = $_POST['id'];


    $activity = $_SESSION['data']['account_name'] . " has rejected the hardware asset update status " . get_column2("machine_name", "select * from m_hardware_assets where id = (select asset_id from t_hardware_update_status where id = '$id') ", $db) . " due to <b class='text-danger'>" . get_column2("reasons", "select reasons from t_hardware_update_status where id = '$id'", $db) . "</b>";
    activity_log_maker("Rejection", $db->sanitize($activity), $_SESSION['data']['account_id'], $db);

    $db->query("UPDATE t_hardware_update_status SET is_approved = 3, date_approve = '$newdate', approved_by = '".$_SESSION['data']['account_id']."' where id = '".$id."'");

    echo 0; // Success

?>
