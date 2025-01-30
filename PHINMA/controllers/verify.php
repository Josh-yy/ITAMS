<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
$numrows;
$username = $_POST['username'];
$password = $_POST['password'];
$newpassword = $db->sanitize(encrypt($password));
$sql = "SELECT * FROM v_user_accounts WHERE username = '$username' AND password = '".$newpassword."' ";
$result = $db->query($sql);
$time = $_SERVER['REQUEST_TIME'];

/**
* for a 30 minute timeout, specified in seconds
*/
$time = $_SERVER['REQUEST_TIME'];
$_SESSION['timeout_duration'] = 1239123781739123;
$_SESSION['LAST_ACTIVITY'] = $time;
$numrows =  $result->numRows();

if($numrows>0)
{
	$data = $db->query("SELECT * FROM v_user_accounts WHERE username = '$username' AND password = '".$newpassword."'")->fetchArray();
	
		$_SESSION['data']['admin']=$data['usertype'];
		$_SESSION['data']['utype']=$data['usertype'];
		$_SESSION['id']  = $data['id'];
		$_SESSION['data']['account_id'] = $data['id'];
		if($data['usertype']!=="student"){
			$_SESSION['data']['account_name'] = get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_users where id = '".$data['id']."'",$db);
			$_SESSION['data']['usertype'] = get_column2("typename","select * from m_usertype where id = '".$data['usertype']."'",$db);
		}else{
				$_SESSION['data']['account_name'] = get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_student_information where id = '".$data['id']."'",$db);

				$_SESSION['data']['usertype'] = $data['usertype'];
		}
		 $activity =  $_SESSION['data']['account_name'] . " has logged-in to the system ";
         activity_log_maker("Login",$activity,$_SESSION['data']['account_id'],$db);

		echo $data['usertype'];
	
}
else{
    echo 0;
}





?>