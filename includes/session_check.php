<?php
@session_start();
$current_page = $_SERVER['PHP_SELF'];
// or
$current_page = $_SERVER['REQUEST_URI'];


if (!isset($_SESSION['data']['account_id'])){
	if($current_page!=="/login"){
		@header("location:../login");
	}else{

	}
}
?>