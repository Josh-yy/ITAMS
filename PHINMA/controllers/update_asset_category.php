<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$id = $_POST['id'];
$code = $_POST['code'];
$name = $_POST['name'];
$desc = $_POST['desc'];
if(isset($_POST['has_properties'])) {
    $has_properties = 1;
} else {
    $has_properties = 0;
}

$db->query("UPDATE  m_asset_category SET with_properties = '$has_properties',code = '$code',name='$name',description = '$desc' where id = '$id'");
echo 0;

?>