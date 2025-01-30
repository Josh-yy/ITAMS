<?php
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");

				
	$data = $db->query("select a.*, b.typename from m_users a inner join m_usertype b on a.usertype = b.id WHERE  a.id =  '".$_REQUEST['param']."'")->fetchAll();
$class="";


?>

		<div class="card border">
				<div class="card-header">
					<b><i class="ti ti-user"></i> User Information</b>
				</div>
				<div class="card-body row">
					<?php
						foreach ($data as $row) {
							if(get_exist2("select * from t_user_assignment where user_id = '".$row['id']."'",$db)>0){
							if($row['avatar']!=""){
								$src = "../assets/employee/".$row['qr_code']."/" . $row['avatar'];
							}
							else{
								$src = "../assets/employee/nopic.png";
							}
							$qrcode =  "../assets/images/qrcode/".$row['qr_code'] . ".png";
							$name = $row['fn'] . " " . $row['mn'] . " " . $row['ln'] . " [ ".get_column2("name","select name from m_branches where id = (select branch_id from t_user_assignment where user_id = '".$row['id']."')",$db)." ] ";
							$branch_id = get_column2("branch_id","select branch_id from t_user_assignment where user_id = '".$row['id']."'",$db);
					?>	
					<div class="col-md-3 col-sm-12">
						
								          <img class="background-image" src="<?php echo $src ?>" alt="Background Image">
					
					</div>
					<div class="col-md-9 col-sm-12 row">
						<div class="col-md-9">
							<b class="text-secondary" style="font-size:30px"><?php echo $row['fn'] ?> <?php echo $row['mn'] ?> <?php echo $row['ln'] ?></b>
							<br>
							<span class="mb-1"><?php echo $row['gender'] ?></span> | 
							<span class="mb-1"><?php echo $row['civil_status'] ?></span> <br>

							<span class="badge bg-secondary"><?php echo $row['username'] ?></span>
							<br>
							<?php echo $row['typename'] ?> | <?php echo get_column2("name","select name from m_branches where id = (select branch_id from t_user_assignment where user_id = '".$row['id']."')",$db) =="" ? "NA" : get_column2("name","select name from m_branches where id = (select branch_id from t_user_assignment where user_id = '".$row['id']."')",$db) ?>
							<br>
							<?php
								if($row['is_active']==1){
									echo '<span class="badge bg-success">Active</span>';
								}else{
									echo '<span class="badge bg-danger">In-active</span>';
								}
							?>
						</div>
					
					</div>
					<?php	
						}
					}
					?>
					
				</div>
				
		</div>
		<div class="card border">
				<div class="card-header" style="background: #f2f2f2;">
					<b><i class="ti ti-info"></i> </b> <b> Asset Usage</b> 
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-7 col-sm-12">
							<div class="form-group">
								<b class="text-danger">*  </b> Usage
								<select class="form-control" id="cbousage" onchange="loadcontent('listviews/load_usage_desription','display_usage_info',$('#cbousage').val())">
									<option value="">--</option>
										<?php
											$sql = "select * from m_usage";
											$data = $db->query($sql)->fetchAll();
											foreach($data as $row){
										?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['typename'] ?></option>
										<?php
											}
										?>
								</select>
							</div>
						</div>
						<div class="col-md-5  col-sm-12"  id="display_usage_info">
							
						</div>
					</div>
				</div>
		</div>
		<div class="card border">
				<div class="card-header" style="background: #f2f2f2;">
					<b><i class="ti ti-map"></i> Asset Location </b> 
				</div>
				<div class="card-body row">
					
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<b class="text-danger">*</b>Department : 
								<select class="form-control" id="cbodepartment">
									<option value="">--</option>
										<?php
											$sql = "select * from m_department";
											$data = $db->query($sql)->fetchAll();
											foreach($data as $row){
										?>
										<option value="<?php echo $row['id'] ?>"><b><?php echo strtoupper($row['name']) ?></b> - <?php echo strtoupper($row['acronym']) ?></option>
										<?php
											}
										?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<b class="text-danger">*</b>Unit : 
								<select class="form-control" id="cbounit">
									<option value="">--</option>
										<?php
											$sql = "select * from t_branch_units where branch_id = '".$branch_id."'";
											$data = $db->query($sql)->fetchAll();
											foreach($data as $row){
										?>
										<option value="<?php echo $row['id'] ?>"><b><?php echo strtoupper($row['name']) ?></b> </option>
										<?php
											}
										?>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<input type="text" placeholder="Enter room name here" id="txtroom" class="form-control">
						</div>


					</div>
					<div class="card-footer row">
						<div class="col-md-4 col-sm-12">&nbsp;</div>
						<div class="col-md-4 col-sm-12">&nbsp;</div>
						<div class="col-md-4 col-sm-12">
							<div class="d-grid gap-2 mt-2">
								<button id="btn_save_trasaction" class="btn btn-outline-primary float-right">
								 <i class="ti ti-check"></i> Done Tagging
							</button>
							</div>
						</div>
							
						</div>
				
		</div>

		

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$('#btn_save_trasaction').on("click", function(){
		
		if($('#cbousage').val()==""){
			fire_message("Field needed!","Please select a usage","info");
		}
		else if($('#cbodepartment').val()==""){
			fire_message("Field needed!","Please select a department","info");
		}
		else if($('#cbounit').val()==""){
			fire_message("Field needed!","Please select a branch unit","info");
		}
		else if($('#txtroom').val()==""){
			fire_message("Field needed!","Please enter room name","info");
		}
		else {
			var mydata = "branch_id=<?php echo $branch_id ?>&room=" + $('#txtroom').val() + "&department=" + $('#cbodepartment').val() + "&unit=" + $('#cbounit').val() + "&usage=" + $('#cbousage').val() + "&userid=<?php echo $_REQUEST['param'] ?>" + "&asset_id=<?php echo $_REQUEST['asset_id'] ?>";
	       // alert(mydata);
			$.ajax({
				type:'POST',
				url:'controllers/save_tagging',
				cache:false,
				data:mydata,
				beforeSend:function(){
					$('#btn_save_trasaction').attr("disadled",true);
				},success:function(data){
					var edata = "branch_id=<?php echo $branch_id ?>&room=" + $('#txtroom').val() + "&department=" + $('#cbodepartment').val() + "&unit=" + $('#cbounit').val() + "&usage=" + $('#cbousage').val() + "&userid=<?php echo $_REQUEST['param'] ?>" + "&asset_id=<?php echo $_REQUEST['asset_id'] ?>";
				
					if(data==1){
				
						Swal.fire({
                      title: 'Asset is previously tagged! Do you wish to re-assign asset tagging?',
                      showDenyButton: true,
                      showCancelButton: false,
                      confirmButtonText: 'Yes',
                      icon: "question",
                      denyButtonText: `No`,
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                          $.ajax({

                          url: 'controllers/asset_tagging_reassignment',
                          type: 'POST',
                          data: mydata,
                          cache: false,
                          beforeSend: function() {
                            $('#btnclear').attr('disabled', true);
                          },
                          success: function(data) {
                             $('#btnclear').attr('disabled', true);
                           	fire_message("Notifier","Asset reaasignment processed successfully","success");
                          	 setTimeout(function() {
					            location.reload();
					        }, 2000);
                          }
                        })
                      } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                      }
                    })
					}else if (data==0){
						fire_message("","Hardware asset successfully tagged!","success");
						setTimeout(function() {
					            location.reload();
					        }, 2000);
					}else if(data==2){
						fire_message("","Pending reassignment not yet approved. PLease wait until it is approved by the administrator","error");
					}
				}
			})
		}
	})
function get_user_info(user,id){
	$('#txtuser').val(user);
	$('#mdl_search_user .close').click();
}
</script>

