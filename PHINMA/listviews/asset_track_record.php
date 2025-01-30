<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

$sql = "select * from m_hardware_assets where auto_qr_code = '".$db->sanitize($_POST['param'])."' or serial_number = '".$db->sanitize($_POST['param'])."' or code = '".$db->sanitize($_POST['param'])."'";
$hardware_asset_id = get_column2("id",$sql,$db);
$serial = get_column2("serial_number",$sql,$db);

if(get_exist2($sql,$db)>0)
{
?>

<div class="d-grid">

<div class="card">
<div class="card-body pc-component">

<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="ti ti-user-plus"></i>Assign</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="ti ti-history"></i>History</a>
</li>


</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="home-tab">
<div class="card border">




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
										<div class="col-md-1 col-sm-12">
								          <img class="background-image" src="<?php echo $src ?>" alt="Background Image">
									</div>
									<div class="col-md-7 col-sm-12 row">
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
	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<?php
		//check if the asset has previous transfer history
			if(get_exist2("select * from t_asset_tagging where asset_id = '$hardware_asset_id'",$db)==0){
		?>

		<div class="alert alert-info d-flex align-items-center" role="alert">
	    <div><h3> <i class="ti ti-info-circle"></i> <b>Important Note : </b></h3>
	      <p>
	        The hardware asset with serial # <b><?php echo $serial ?></b> has no track record history of user tagging!
	      </p>
	    </div>
	    </div>
	    <input type="hidden" id="asset_id" value="<?php echo $hardware_asset_id ?>">
		<?php
			}
			else{
			?>
			<div class="alert alert-danger d-flex align-items-center" role="alert">
	    <div><h3> <i class="ti ti-info-circle"></i> <b>Asset already tagged. </b></h3>
	      <p>
	        The hardware asset with serial # <b><?php echo $serial ?></b> is already tagged to a user. pleache check the user information below.
	      </p>
	    </div>
	    </div>

	    <div class="row " id="asset_holder_view">
	    	<div class="card border">
	    			<div class="card-body">
	    				<b><i class="ti ti-info-circle"></i> Asset Holder Information</b><br>
	    				<?php
	    					$sql = "select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)";

	    				//	echo $sql;
								if(get_column2("avatar",$sql,$db)!=""){
									$src = "../assets/employee/".get_column2("qr_code","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db)."/" .get_column2("avatar","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db);
								}
								else{
									$src = "../assets/employee/nopic.png";
								}
								$qrcode =  "../assets/images/qrcode/".get_column2("qr_code","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db) . ".png";
	    				?>
	    					<div class="row" >
	    						<div class="col-md-3 col-sm-12">
								          <img class="background-image" src="<?php echo $src ?>" alt="Background Image">
									</div>
									<div class="col-md-9 col-sm-12 row">
										<div class="col-md-9">
											<b class="text-secondary" style="font-size:30px"><?php echo get_column2("fn","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db) ?> <?php echo get_column2("mn","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db) ?> <?php echo get_column2("ln","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db) ?></b>
											<br>
											<span class="mb-1"><?php echo get_column2("gender","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db)?></span> | 
											<span class="mb-1"><?php echo get_column2("civil_status","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db) ?></span> <br>

											<span class="badge bg-secondary"><?php echo get_column2("username","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db) ?></span>
											
											<br>
											<?php
												if(get_column2("is_active","select * from m_users where id = (select asset_holder_id from t_asset_tagging where asset_id = '$hardware_asset_id' and status = 1)",$db)==1){
													echo '<span class="badge bg-success">Active</span>';
												}else{
													echo '<span class="badge bg-danger">In-active</span>';
												}
											?>
										</div>
										<div class="col-md-3">
											<img  style="width:100%" src="<?php echo $qrcode ?>" alt="Circle Image">
										</div>
									</div>
	    					</div>
	    			</div>
	    	</div>
	    </div>
			<?php
			}
			//notify the user that the asset has no transfer history / track record

			//make a drop down select user or just enter the username name / search
		?>
		<div class="card border">	
				<div class="card-header">
					
					<div class="input-group">
                                      <button class="btn btn-secondary"><span class="ti ti-search"></span>   Accountable User</button>
                                      <input type="text" placeholder="Accountable User" id="txtuser" class="form-control" readonly="">
                                      <button class="btn btn-outline-secondary btn-sm " onclick="loadcontent('listviews/v_search_users','display_users',1 + '&search=' + '&hadware_asset_id=' + '<?php echo $hardware_asset_id ?>'); $('#asset_holder_view').slideUp(2000)" data-bs-toggle="modal" data-bs-target="#mdl_search_user"><i class="ti ti-list"></i></button>
                                    </div>
				</div>
			<div class="row">
					<div class="col-md-12">
								<div class="card border">
									<div class="card-body" id="display_selected_user">
										
									</div>
							</div>
					</div>
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
