<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	if (!isset ($_REQUEST['param'])) {  
    $page = 1;  
	} else {  
	    $page = $_REQUEST['param'];  
	}  
	$i=1;
	$results_per_page = 10;
	$page_first_result = ($page-1) * $results_per_page;  
	$sql = "select * from  m_hardware_assets ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select *  from m_hardware_assets a where code  LIKE '%".$_REQUEST['search']."%' OR a.machine_name LIKE '%".$_REQUEST['search']."%' OR a.serial_number LIKE '%".$_REQUEST['search']."%'  OR a.model_number LIKE '%".$_REQUEST['search']."%' ";
		}
		else{
				$final_sql = "select *  from m_hardware_assets LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select *  from m_hardware_assets LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_students','display_list','<?php echo ($page-(1))  ?>' + '&search')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_students','display_list','<?php echo ($page+1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
	 		<?php
	 		}
	 	?>
</div>
	</div>
		<div class="card-body table-responsive">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>
					<th style="width:10%">Image</th>
					<th>Asset Infomation</th>
					<th>Asset Category</th>
					<th>Status</th>
					<th>Asset Code</th>
					<th>Record Info.</th>
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {	
			?>
				<tr>
				 <td><?php echo $i + (($page - 1) * 10) ?></td>
				<td style="width:10%"><img src="../assets/images/asset/<?php echo $row['asset_photo'] ?>" style="width:100%"></td>
				<td>
				<b>Code : </b> <?php echo $row['code'] ?>
				<br>
				<b>Machine Name : </b><?php echo $row['machine_name'] ?><br>
				<b>Model Number : </b><?php echo $row['model_number'] ?><br>
				<b>Serial Number : </b><?php echo $row['serial_number'] ?><b><br>
				Date Purchased : </b><?php echo $row['date_purchased'] ?></td>

				<td><?php echo get_column2("name", "select * from m_asset_category where id = '".$row['asset_cat_id']."'",$db) ?></td>
				<td><?php echo $row['status'] ?></td>
				<td style="width:10%"><img src="../assets/img/qr_codes/<?php echo $row['auto_qr_code'] ?>.png" style="width:100%"></td>
				<td>
					<b class="text-secondary"><i class="ti ti-folder"></i> <?php echo get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_users where id = '".$row['added_by']."'",$db) ?></b>
					<br>
					<small>
						<?php echo $row['date_added'] ?>
					</small>
				</td>
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
						<?php
							if($row['installable_with_software']=="Yes"){


						?>
						<a href="setup_software_installed?hid=<?php echo $row['id'] ?>" class="btn btn-primary" title="Manage Installed Software"><i class="ti ti-settings"></i></a>
							<?php
								}
							?>
							<a href="assets/pdf_report/printqr?eid=<?php echo $row['id'] ?>" title="Print Hardware Asset QR Code" class="btn btn-secondary" target="_new"><i class="ti ti-printer"></i></a>
							<a class="btn-pill btn btn-warning" href="update_asset?eid=<?php echo $row['id'] ?>"><i class="ti ti-edit"></i></a>
							<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['id'] ?>','<?php echo $row['machine_name'] ?>','deleteassetinfo','../listviews/v_assets_info','display_list',1)"><i class="ti ti-trash"></i></button>
					</div>
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
<script>
function get_edit(id,a,b,c,d,e,f,g){
	
	$('#eid').val(id);
	$('#student_id').val(a);
	$('#fn').val(b);
	$('#mn').val(c);
	$('#ln').val(d);
	$('#gender').val(e);
	$('#dob').val(f);
	$('#address').val(g);
}
function get_delete(id){
	$('#did').val(id);
}
function get_deleterole(id){
	$('#ddid').val(id);
}
function get_id(id){
	$('#txttypeid').val(id);
	listrecord('../listviews/d_facilities','display_facilities',id);
}
</script>