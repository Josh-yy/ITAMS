<?php
@session_start();
require("assets/settings/db_conn.php");
require("assets/settings/functions.php");


$qrcode = $_POST['param'];
$sql = "select * from m_hardware_assets WHERE auto_qr_code = '$qrcode'";
if(get_exist2($sql,$db)>0){
?>
Serial No : <?php echo get_column2("serial_number",$sql,$db) ?>

<?php
}
else{
?>
Serial No : --
<?php
}
?>