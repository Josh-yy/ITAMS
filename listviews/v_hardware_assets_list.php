<?php
@session_start();
require("../assets/settings/db_conn.php");
require("../assets/settings/functions.php");
	if (!isset ($_REQUEST['param'])) {  
    $page = 1;  
	} else {  
	    $page = $_REQUEST['param'];  
	}  
	$locator="";
	if(isset($_REQUEST['locator'])){
		$locator=$_REQUEST['locator'];
	}


	
	$i=1;
	$results_per_page = 10;
	$page_first_result = ($page-1) * $results_per_page;  
	$sql = "select * from  m_hardware_assets where status != 'Disposed'";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select *  from m_hardware_assets a where status != 'Disposed' and code  LIKE '%".$_REQUEST['search']."%' OR a.machine_name LIKE '%".$_REQUEST['search']."%' OR a.serial_number LIKE '%".$_REQUEST['search']."%' ";
		}
		else{
				$final_sql = "select *  from m_hardware_assets a where status != 'Disposed' LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select *  from m_hardware_assetsa  where status != 'Disposed' LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_hardware_assets_list','display_hardware_assets','<?php echo ($page-1)  ?>' + '&search')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_hardware_assets_list','display_hardware_assets','<?php echo ($page+1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
	 		<?php
	 		}
	 	?>
</div>
	</div>
		<div class="card-body table-responsive">
			<table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th style="width:10%">Image</th>
					<th>Asset Information</th>
					<th>Asset Category</th>
					<th>Status</th>
					
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {	
			?>
				<tr role="button" onclick="close_modal('<?php echo $row['auto_qr_code'] ?>','mdl_search_list','<?php echo $row['serial_number'] ?>','<?php echo $locator ?>')">
				
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
function close_modal(id,modal_id,c,locator){
	loadcontent('search_hardware_asset','asset_information',id);
	$('#txtassetname').html("Serial # : " + c);
	if(locator==1){
			listrecord('listviews/asset_track_record_locator','asset_other_information',id);
	}else{
		listrecord('listviews/asset_track_record','asset_other_information',id);
	}
	
	$("#" + modal_id + ' .close').click();
}
</script>