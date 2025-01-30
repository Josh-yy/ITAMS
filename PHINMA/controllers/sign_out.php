<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	 $activity =  $_SESSION['data']['account_name'] . " has logged-out to the system ";
         activity_log_maker("Logout",$activity,$_SESSION['data']['account_id'],$db);
@session_destroy();

@header("location:../index");
?>