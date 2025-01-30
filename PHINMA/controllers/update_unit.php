<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$id = $_POST['id'];
$code = $_POST['code'];
$name = $_POST['name'];

$db->query("UPDATE  t_branch_units SET code = '$code',name='$name' where id = '$id'");
echo 0;

?>