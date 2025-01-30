<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

date_default_timezone_set("Asia/Manila");
$newdate = date('Y-m-d H:i:s');
$id = $_POST['id'];
$code = $_POST['code'];
$name = $_POST['name'];

$db->query("UPDATE  t_asset_cat_property SET property_name = '$code',description='$name' where id = '$id'");
echo 0;

?>