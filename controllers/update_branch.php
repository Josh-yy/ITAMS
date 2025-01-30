<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$id = $_POST['id'];
$code = $_POST['code'];
$name = $_POST['name'];
$desc = $_POST['desc'];

$db->query("UPDATE  m_branches SET code = '$code',name='$name',description = '$desc' where id = '$id'");
echo 0;

?>