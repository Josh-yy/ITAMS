<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sql = "select * from m_hardware_assets where auto_qr_code = '".$db->sanitize($_POST['param'])."' or serial_number = '".$db->sanitize($_POST['param'])."' or code = '".$db->sanitize($_POST['param'])."'";
$hardware_asset_id = get_column2("id",$sql,$db);
$serial = get_column2("serial_number",$sql,$db);

if(get_exist2($sql,$db)>0)
{
?>


<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="ti ti-user-plus"></i>Asset Information</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="ti ti-history"></i>Installed Software, Hardware Properties and Tagging History</a>
</li>

</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show" id="installed" role="tabpanel" aria-labelledby="home-tab">
	<div class="card border">
		<div class="card-body">
				<div class="row">
						<div class="col-md-7">
									
						</div>
							<div class="col-md-5">
								<div class="card border">
										<div class="card-header" style="background:#f3f3f3">
											<b class="card-title">Installed Software</b>
										</div>
										<div class="card-body">
											 <table class="table table-border">
								          <?php
								          $asql = "select *,a.id as installed_id, date_format(a.date_added,'%M-%d-%Y %r') as date_installed from t_hardware_software_installed a inner join m_software_assets b on a.software_id = b.id where asset_id = '".$hardware_asset_id."'";
								            if(get_exist2($asql,$db)){
								              $adata = $db->query($asql)->fetchAll();
								              foreach($adata as $arow)
								              {
								          ?>
								          <tr>
								            <td><h3><?php echo $arow['software_name'] ?> </h3></td>
								            <td><p><?php echo $arow['serial_number'] ?><br><?php echo $arow['date_installed'] ?></p></td>
								          </tr>
								          <?php
								              }
								            }
								          ?>
								        </table>
										</div>
									</div>
								</div>

				</div>
		</div>
	</div>
</div>
<div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="home-tab">
<div class="card border">
<div class="card-body">
	<div class="row">
		<div class="col-md-5 col-sm-12">
			<div class="card border">
										<div class="card-header" style="background:#f3f3f3">
											<b class="card-title">Hardware Properties</b>
										</div>
										<div class="card-body">
											<table class="table table-bordered table-striped">
													<thead>
															<tr>
																<th>Property</th>
																<th>Value</th>
													</thead>
															</tr>
															 <?php
											          $hsql = "select * from t_asset_properties a inner join t_asset_cat_property b on a.property_id = b.id where a.asset_id = '".$hardware_asset_id."'";


											            if(get_exist2($hsql,$db)>0){
											              $hdata = $db->query($hsql)->fetchAll();
											              foreach($hdata as $hrow)
											              {
											          ?>
											          <tr>
											            <td><?php echo $hrow['property_name'] ?> </td>
											            <td><?php echo $hrow['prop_value'] ?></td>
											          </tr>
											          <?php
											              }
											            }
											          ?>
													
											</table>
										</div>
								</div>	
				<div class="card border">
										<div class="card-header" style="background:#f3f3f3">
											<b class="card-title">Installed Software</b>
										</div>
										<div class="card-body">
											<table class="table table-bordered table-striped">
													<thead>
														</thead>
															  <?php
										          $asql = "select *,a.id as installed_id, date_format(a.date_added,'%M-%d-%Y %r') as date_installed from t_hardware_software_installed a inner join m_software_assets b on a.software_id = b.id where asset_id = '".$hardware_asset_id."'";
										            if(get_exist2($asql,$db)){
										              $adata = $db->query($asql)->fetchAll();
										              foreach($adata as $arow)
										              {
										          ?>
										          <tr>
										            <td><h3><?php echo $arow['software_name'] ?> </h3></td>
										            <td><p><?php echo $arow['serial_number'] ?><br><?php echo $arow['date_installed'] ?></p></td>
										          </tr>
										          <?php
										              }
										            }
										          ?>
												
											</table>
										</div>
								</div>
		</div>
			<div class="col-md-7 col-sm-12">
			<div class="card border">
										<div class="card-header" style="background:#f3f3f3">
											<b class="card-title">Tagging History</b>
										</div>
										<div class="card-body">
											<?php
												$nsql = "select * from v_asset_history where asset_id = '$hardware_asset_id' order by status DESC";
												$ndata = $db->query($nsql)->fetchAll();
												foreach($ndata as $nrow){
																		if($nrow['avatar']!=""){
																			$src = "../assets/employee/".$nrow['qr_code']."/" .$nrow['avatar'];
																		}
																		else{
																			$src = "../assets/employee/nopic.png";
																		}
																		$qrcode =  "../assets/images/qrcode/".$nrow['qr_code'] . ".png";
											?>
												<div class="card border">
													<div class="card-header">
															<div class="row" >
											    				
																			<div class="col-md-2 col-sm-12">
																				<b><?php echo $nrow['dateadded'] ?></b>
																			</div>
																				<div class="col-md-2 col-sm-12">
																		          <img class="background-image" style="width:100%" src="<?php echo $src ?>" alt="Background Image">
																			</div>
																			<div class="col-md-6 col-sm-12 row">
																				<div class="col-md-9">
																					<b class="text-secondary" style="font-size:15px"><?php echo $nrow['ename'] ?></b>
																					<br>
																					<span class="mb-1"><?php echo $nrow['gender'] ?></span> 
																					<br>

																					<?php echo $nrow['branch'] ?></span>
																					
																					<br>
																					<?php
																						if($nrow['status']==1){
																							echo '<span class="badge bg-success">Active</span>';
																						}else{
																							echo '<span class="badge bg-danger">In-active</span>';
																						}
																					?>
																				</div>
																				
																			</div>
																			<div class="col-md-2 col-sm-12">
																					<b class="badge bg-success"><?php echo $nrow['typename'] ?></b>
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


	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<?php
			
		?>
		<div class="row">
				<div class="col-md-3 col-sm-12">
					<div class="card border">
						<div class="card-header">
							<img class="circle-image" src="assets/img/qr_codes/<?php echo get_column2("auto_qr_code",$sql,$db) ?>.png" alt="Circle Image" style="width: 100%">
						</div>
						<div class="card-body"> 
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

				<div class="col-md-9 col-sm-12">
							<div class="d-grid">
								<div class="alert alert-info d-flex align-items-center" role="alert">
						    <div><h3> <i class="ti ti-info-circle"></i> <b>Important Note : </b></h3>
						      <p>
						        You are processing the request for Asset Disposal for the asset with a Serial Number  <b><?php echo $serial ?></b>. Kindly fill up the field below and click the save button to complete the transaction. Thank you!
						      </p>
						    </div>
						    </div>
						    <input type="hidden" id="asset_id" value="<?php echo $hardware_asset_id ?>">
						    <div class="card border">
						    	<?php
						    	$sql = "SELECT CASE WHEN TIMESTAMPDIFF(YEAR, date_purchased, CURDATE()) > 0 THEN CONCAT( TIMESTAMPDIFF(YEAR, date_purchased, CURDATE()), ' years ',TIMESTAMPDIFF(MONTH, date_purchased, CURDATE()) % 12, ' months ',TIMESTAMPDIFF(DAY, date_purchased, CURDATE()) % 30, ' days') WHEN TIMESTAMPDIFF(MONTH, date_purchased, CURDATE()) % 12 > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, date_purchased, CURDATE()) % 12, ' months ',TIMESTAMPDIFF(DAY, date_purchased, CURDATE()) % 30, ' days') ELSE CONCAT(TIMESTAMPDIFF(DAY, date_purchased, CURDATE()) % 30, ' days') END AS duration, serial_number FROM m_hardware_assets where id = '$hardware_asset_id'";
						    	$data = $db->query($sql)->fetchArray();

						    	?>
						    		<div class="card-body">
						    			<b style="font-size:20px">The hardware you have selected is already <span class="text-danger">
						    				<?php echo $data['duration'] ?>

						    			</span> from the time it was purchased up to now.</b>
						    		</div>
						    </div>
						    <form id="save_disposal" onsubmit="event.preventDefault();submit_forms('save_disposal','btnsaveselected','../controllers/save_asset_disposal','Successfully Saved Hardware Asset Disposal Information','../listviews/asset_information_viewer','display_list','addnewasset')">
						    <div class="card border">
						    	<input type="hidden" value="<?php echo $hardware_asset_id ?>" name="asset_id" class="form-control">
						    		<div class="card-header">
						    				<b>Asset Disposal Information</b>
						    		</div>
						    		<div class="card-body">
						    				<div class="form-group">
						    						Asset Non-Functional Date : 
						    						<input type="date" max="<?php echo date('Y-m-d') ?>" class="form-control" name="non_functional_date" required>
						    				</div>	
						    				<div class="form-group">
						    						Reasons for Disposal : 
						    						<textarea class="form-control" placeholder="state the reason of the asset disposal" name="reasons" required></textarea>
						    				</div>
						    		</div>
						    	<div class="card-footer">
						    		<button class="btn btn-outline-primary" id="btnsaveselected"><i class="ti ti-check"></i> Save Information</button>
						    	</div>
						    </div>
						  </form>
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
</div>

<script>
    function submit_forms(form_name,btn_name,url,message,listurl,div,modal)
{
    var logForm = $('#' + form_name).serialize();
    //alert(logForm);
        $.ajax({type: 'POST',
        url: url,
        data: logForm,
        cache:false,
        beforeSend: function (){
        $("#" + btn_name).attr("disabled",true);
      },success: function(data){
          //alert(data);
          $("#" + btn_name).attr("disabled",false);
          $("#" + modal + ' .close').click();
          if(data==1){

          fire_message("Record exist","The item you want to add is already existing","error");
          $("#" + btn_name).attr("disabled",false);
          }else if(data==0){
             fire_message("Notifier",message ,"success");
            if(modal!=='')
            { 
               document.getElementById(form_name).reset();
              $("#" + btn_name).attr("disabled",false); 
              listrecord(listurl,div,"1&search=");

            }
            else
            {
              setTimeout("reload_window()",1000);
            }
           
          }
         
          else
          {
            fire_message("System Message","Sorry but you cannot delete this item because there is a data referenced to this item." + data ,"info");
          }

        }})
  
}

</script>