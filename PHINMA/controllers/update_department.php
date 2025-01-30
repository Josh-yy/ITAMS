<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$id = $_POST['id'];
	$name = $_POST['name'];
	$desc = $_POST['desc'];

	
		$db->query("UPDATE  m_department SET name = '$name',acronym = '$desc' where id = '$id'");
		echo 0;
?>