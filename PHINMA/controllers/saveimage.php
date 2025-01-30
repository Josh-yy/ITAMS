<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$newdate = date('Y-m-d h:i:s');
$filename = time() . ".jpg";
$folderPath = '../assets/images/asset/';
$image_parts = explode(";base64,", $_POST['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file = $folderPath . $filename;
file_put_contents($file, $image_base64);
$password = encrypt(substr(time(),0,4));
$db->query("DELETE from v_temp_image");
$db->query("INSERT INTO v_temp_image VALUES (id,'".$filename."','$newdate')");
?>
