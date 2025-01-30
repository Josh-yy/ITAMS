<?php
@date_default_timezone_set("Asia/Manila");

function encrypt($string)
{
	$ciphering = "AES-128-CTR";
	$option = 0;
	$encryotion_iv = "1234567890123456";
	$encryption_key = "ClSu13_#@143bsit";
	$encryption = openssl_encrypt($string, $ciphering, $encryotion_iv,$option,$encryption_key);

	return $encryption;
}
function decrypt($string)
{
	$ciphering = "AES-128-CTR";
	$option = 0;
	$encryotion_iv = "1234567890123456";
	$encryption_key = "ClSu13_#@143bsit";
	$encryption = openssl_decrypt($string, $ciphering, $encryotion_iv,$option,$encryption_key);

	return $encryption;
}



function get_exist($name,$db,$table_name,$column)
{
	$sql = "Select * from " . $table_name . " where " . $column	." ='$name'";
	$accounts = $db->query($sql);
	return $accounts->numRows();
}
function get_exist2($sql,$db)
{
	$accounts = $db->query($sql);
	return $accounts->numRows();
}


function get_exist_edit($fcolumn,$db,$table_name,$eid,$scolumn)
{
	$sql = "Select * from " . $table_name . " where " . $fcolumn . " ='$scolumn' and id <> '$eid'";
	$accounts = $db->query($sql);
	return $accounts->numRows();
}

function get_column($column1,$column2,$table,$cparam,$db)
{
	$sql = "Select ".$column1." from " . $table . " where " . $column2	." ='$cparam'";
	$accounts = $db->query($sql)->fetchArray();
	if($accounts[$column1]=="")
	{
		return 0;
	}
	else{return $accounts[$column1];}
}

function get_column2($column,$sql,$db)
{
	if(get_exist2($sql,$db)>0)
	{
	$accounts = $db->query($sql)->fetchArray();
	return $accounts[$column];
	}
	else
	{
		return "";
	}
}

function activity_log_maker($activity,$activity_type,$uid,$db)
{
	$newdate = date('Y-m-d h:i:s');
	$sql = "INSERT INTO t_activity_logs VALUES (id,'".$activity."','".$activity_type."','".$uid."','".$newdate."','".$_SERVER['REMOTE_ADDR']."')";
	$accounts = $db->query($sql);
}



?>