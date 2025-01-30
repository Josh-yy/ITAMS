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
<a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#homes" role="tab" aria-controls="home" aria-selected="true"><i class="ti ti-user-plus"></i>Asset Information</a>
</li>
<li class="nav-item" style="display:none">
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


	<div class="tab-pane fade show active" id="homes" role="tabpanel" aria-labelledby="home-tab">

		<div class="row">
		    
				<div class="col-md-4 col-sm-12">
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

				<div class="col-md-7 col-sm-12">
							<div class="d-grid">
								<div class="alert alert-warning d-flex align-items-center" role="alert">
						    <div><h3> <i class="ti ti-info-circle"></i> <b>Important Note : </b></h3>
						      <p>
						       You are processing the update of an asset information to non-functional. Marking an asset non-functional is subjected for approval of the ICT Administrator.
						      </p>
						    </div>
						    </div>
						    <input type="hidden" id="asset_id" value="<?php echo $hardware_asset_id ?>">
						    <div class="card border">
						    
						    <form id="save_hardware_stats" onsubmit="event.preventDefault();submit_forms('save_hardware_stats','btnsaveselected','../controllers/request_hardware_stat','Successfully Requested Hardware Asset Status','../listviews/asset_hardware_viewer','display_list','addnewasset')">
						    <div class="card border">
						    	<input type="hidden" value="<?php echo $hardware_asset_id ?>" name="asset_id" class="form-control">
						    		<div class="card-header">
						    				<b>Hardware Status Update</b>
						    		</div>
						    		<div class="card-body">
						    			    <div class="form-group">
						    			           <select class="form-control" name="status" required>
						    			               <option value="">-Select Status-</option>
						    			               <option value="Assigned">Assigned</option>
						    			               <option value="Returned/In-Stock">Returned/In-Stock</option>
						    			               <option value="for Disposal">for Disposal</option>
						    			               <option value="Purchased">Purchased</option>
						    			               <option value="Disposed">Disposed</option>
						    			                <option value="No Record">No Record</option>
						    			           </select>
						    			        
						    			    </div>
						    				<div class="form-group">
						    						Reasons : 
						    						<textarea class="form-control" placeholder="state the very reason why the asset is non-functional" name="reasons" style="height:300px" required></textarea>
						    				</div>
						    		</div>
						    	<div class="card-footer">
						    		<button class="btn btn-outline-primary" id="btnsaveselected"><i class="ti ti-check"></i> Save Transaction</button>
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