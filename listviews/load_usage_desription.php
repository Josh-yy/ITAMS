<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");


$qrcode = $_POST['param'];
$sql = "select * from m_usage where id = '$qrcode'";
if(get_exist2($sql,$db)>0){
?>

<div class="alert alert-success">
<b><i class="ti ti-folder"></i> Usage Description</b><br><?php echo get_column2("description",$sql,$db) ?>
</div>

<?php
}
else{
?>
0
<?php
}
?>