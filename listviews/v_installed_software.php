<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	date_default_timezone_set("Asia/Manila");
$sql = "select * from m_hardware_assets where id = '".$_REQUEST['param']."'";
?>
<div class="card border">


	<div class="card-body">
			<div class="row">
				<div class="col-md-3 col-sm-12">
					<div class="card -border">
						<div class="card-header" style="background: #f3f3f3;">
							<b>Asset Information</b>
						</div>
					<?php
					$sql = "select * from m_hardware_assets where id = '".$_REQUEST['param']."'";
					?>
					   
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
				<div class="col-md-9 col-sm-12">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card border">
								<div class="card-header bg-warning"><b><i class="ti ti-list"></i> List of Installed Software</b></div>
							</div>
							<div class="card-body">
								<?php
								$sql = " select *,a.id as installed_id,date_format(a.date_added, '%M-%d-%Y %h:%i:%s %p') as date_installed from t_hardware_software_installed a inner join m_software_assets b on a.software_id = b.id where asset_id = '".$_REQUEST['param']."'";
								$data = $db->query($sql)->fetchAll();
								foreach($data as $row){
								
								?>
								<div class="card border">
									<div class="card-body">
										<div class="row">
											<div class="col-md-8 col-sm-12">
												<h3><?php echo $row['software_name'] ?> </h3>
												<p><?php echo $row['serial_number'] ?><br><?php echo $row['date_installed'] ?></p>
										
											</div>
											<div class="col-md-4 col-sm-12">
												<button class="btn btn-outline-danger float-end" title="Remove Software" onclick="delete_record('<?php echo $row['installed_id'] ?>','<?php echo $row['software_name'] ?>','delete_software','../listviews/v_installed_software','display_records','<?php echo $_REQUEST['param'] ?>')"><i class="ti ti-trash"></i></button>
											</div>
										</div>
										
										</div>

									</div>
						
								<?php 
									}
								?>
							</div>
									</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<script>

	</script>
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