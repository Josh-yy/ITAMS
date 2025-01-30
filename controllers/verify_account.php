<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");


$email = $_POST['email'];

echo get_exist2("select * from m_users where username = '$email'",$db);
?>