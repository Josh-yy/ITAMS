<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sql = "select * from m_hardware_assets where auto_qr_code = '".$db->sanitize($_POST['param'])."' or serial_number = '".$db->sanitize($_POST['param'])."' or code = '".$db->sanitize($_POST['param'])."' or model_number = '".$db->sanitize($_POST['param'])."'";
$hardware_asset_id = get_column2("id",$sql,$db);
$hardware_asset_cat_id = get_column2("asset_cat_id",$sql,$db);
$serial = get_column2("serial_number",$sql,$db);

if(get_exist2($sql,$db)>0)
{
?>

<div class="d-grid">

<div class="card">
<div class="card-body">

<ul class="nav nav-tabs profile-tabs border-bottom mb-3 d-print-none" id="myTab" role="tablist">
<li class="nav-item">
	
<a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">
<div class="media align-items-center">
<div class="avtar avtar-s">
<i class="material-icons-two-tone me-2">description</i>
</div>
<div class="media-body ms-3">
 Properties
<p class="text-sm mb-0">Assign asset properties values below</p>
</div>
</div>
</a>
</li>
<li class="nav-item">
<a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab" aria-selected="true">
<div class="media align-items-center">
<div class="avtar avtar-s">
<i class="material-icons-two-tone me-2">history</i>
</div>
<div class="media-body ms-3">
 Property Logs
<p class="text-sm mb-0">View history of property logs</p>
</div>
</div>
</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show" id="history" role="tabpanel" aria-labelledby="history-tab">
			<div class="col-sm-12">
				<div class="card">
				<?php
					$asql = "select *,date_format(date_added,'%M-%d-%Y %H-%m-%s %r') as edate from t_asset_property_changes_history where asset_id = '".$hardware_asset_id."' ORDER by ID DESC";
					$adata = $db->query($asql)->fetchAll();
					foreach($adata as $arow){
					?>
						<div class="card-body">
				<div class="row">
				<label class="col-lg-3 col-sm-12 text-lg-end"><b><?php echo $arow['edate'] ?></b></label>
				<div class="col-lg-6 col-md-9 col-sm-12">
				<p class="user-select-all"><?php echo $arow['activity'] ?></p>
				</div>
				</div>
				</div>
				<?php
					}
				?>
				</div>
		</div>
		</div>
	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			<table class="table table-border table-hover table-striped">
					<thead>
							<tr>
									<th>No</th>
									<th>Property Name</th>
									<th>Property Value</th>
									<th>Status</th>
							</tr>
					</thead>
					<tbody>
							<?php
								$sql = "select * from t_asset_cat_property where cat_id = '".$hardware_asset_cat_id."'";
								$data = $db->query($sql)->fetchAll();
								$i=1;
								foreach($data as $row)
								{
									$asql = "select * from t_asset_properties where asset_id = '$hardware_asset_id' and property_id = '".$row['id']."'"
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row['property_name'] ?></td>
								<td><input type="text" onkeyup="save_property(event,'<?php echo $row['id'] ?>','<?php echo $hardware_asset_id ?>')" id="txtprop<?php echo $row['id'] ?>" value="<?php echo get_column2("prop_value",$asql,$db)  ?>" class="form-control" placeholder="enter <?php echo $row['property_name'] ?> here..."></td>
								<td>

									<span id="err_msg<?php echo $row['id'] ?>">
											<?php

											if(get_column2("prop_value",$asql,$db)==""){
													echo '<i class="material-icons-two-tone me-2 text-danger">info</i>';
											}else{
												echo '<i class="material-icons-two-tone me-2 text-success">check</i>';
											}
											?>
									</span>
								</td>
							</tr>
							<?php
							$i++;
								}
							?>		
					</tbody>
			</table>
	</div>
</div>
</div>



</div>

</div>

	
<?php
}
else
{
?>
  <div class="col-12">
     <div class="alert alert-warning d-flex align-items-center" role="alert">
  
    <div><h3>   <i class="ti ti-info-circle"></i>The asset you wanted to manage is not existing! <b></b></h3>
      <p>
        Try searching another asset.
      </p>
    </div>
    </div>
    </div>
<?php
}
?>

<script>
function save_property(event,property_id, asset_id){
	 if (event.keyCode === 13) {
	 	
	 	var propval=$('#txtprop' + property_id).val();

	 	if(propval==""){
	 		fire_message("Notifier","Enter property value! nothing has been changed","error");
	 		$('#txtprop' + property_id).focus();
	 	}else{
	 		
	 		 $.ajax({
				type:'POST',
				url:'controllers/save_asset_property',
				cache:false,
				data:"property_id=" + property_id + "&asset_id=" + asset_id + "&prop_value=" + $('#txtprop' + property_id).val(),
				beforeSend:function(){
					$('#txtprop' + property_id).attr("disabled",true);
				},success:function(data){
					//	alert(data);
					$('#txtprop' + property_id).attr("disabled",false);
					if(data==0){
						fire_message("Notifier","Asset property saved!","info");
						$('#err_msg' + property_id).html('<i class="material-icons-two-tone me-2 text-success">check</i>');
					}
					else if(data==1){
						fire_message("Notifier","Asset property updated!","info");
						$('#err_msg' + property_id).html('<i class="material-icons-two-tone me-2 text-success">check</i>');
					}
					else{
						$('#err_msg' + property_id).html('<span class="badge bg-danger"><i class="ti ti-info"></i> Cannot saved changes '+data+'</span>');
					}

				}
			})
	 	}
	
}
}
</script>
