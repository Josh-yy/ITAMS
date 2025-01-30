<?php
@session_start();
require("assets/settings/db_conn.php");
require("assets/settings/functions.php");


$qrcode = $_POST['param'];
$sql = "select * from m_hardware_assets WHERE auto_qr_code = '$qrcode' or serial_number='$qrcode' or model_number='$qrcode' or code='$qrcode'";
if(get_exist2($sql,$db)>0){
?>
<style>
.container {
  position: relative;
}

/* Background image */
.background-image {
  width: 100%;
  height: auto;
}

/* Container for the circular image */
.circle-image-container {
  position: absolute;
  top: 50%; /* Adjust this value to position it vertically */
  left: 50%; /* Adjust this value to position it horizontally */
  transform: translate(-50%, -50%); /* Center the container */
  border-radius: 5%; /* Make the container circular */
  overflow: hidden; /* Hide the excess part of the circular image */
  width: 100px; /* Adjust the size as needed */
  height: 100px; /* Adjust the size as needed */
}

/* Circular image */
.circle-image {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Preserve the aspect ratio and cover the circular container */

}
</style>
<div class="card">
<div class="card-body">
   
<div class="row">
    <div class="container">
          <img class="background-image" src="assets/images/asset/<?php echo get_column2("asset_photo",$sql,$db) ?>" alt="Background Image">
          <div class="circle-image-container">
            <img class="circle-image" src="assets/img/qr_codes/<?php echo get_column2("auto_qr_code",$sql,$db) ?>.png" alt="Circle Image">
          </div>
        </div>
</div>  
<table class="table table-stiped table-bordered">
    <tbody>
        <tr>
            <td><b>Machine Name:</b></td>
            <td><?php echo get_column2("machine_name",$sql,$db) ?></td>
        </tr>
        <tr>
            <td><b>Model No:</b></td>
            <td><?php echo get_column2("model_number",$sql,$db) ?></td>
        </tr>
         <tr>
            <td><b>Serial No:</b></td>
            <td><?php echo get_column2("serial_number",$sql,$db) ?></td>
        </tr>
         <tr>
            <td><b>Date Purchased:</b></td>
            <td><?php echo get_column2("date_purchased",$sql,$db) ?></td>
        </tr>
        <tr>
            <td><b>Status:</b></td>
            <td><?php echo get_column2("status",$sql,$db) ?></td>
        </tr>
    </tbody>
</table>

</div>
</div>
</div>
<?php
}
else{
?>
0
<?php
}
?>