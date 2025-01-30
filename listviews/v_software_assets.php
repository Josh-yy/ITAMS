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
	$sql = "select * from m_software_assets ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select * from m_software_assets a where a.code LIKE '%".$_REQUEST['search']."%' OR a.software_name LIKE '%".$_REQUEST['search']."%' OR a.serial_number LIKE '%".$_REQUEST['search']."%'";
		}
		else{
				$final_sql = "select * from m_software_assets LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select * from m_software_assets LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_software_assets','display_list','<?php echo ($page-(1))  ?>' + '&search')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_software_assets','display_list','<?php echo ($page+1) ?>' + '&search=' )"> <i class="ti ti-arrow-right"></i>Next</button>
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
					<th>Software Info</th>
					<th>Expiration Date</th>
					<th>Type</th>
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
					$class="";
					
			?>
				<tr>
				 <td><?php echo $i + (($page - 1) * 10) ?></td>
				
				<td>
					<b>Code : </b><?php echo $row['code'] ?><br>
					<b>Name : </b><?php echo $row['software_name'] ?><br>
					<b>Serial No. : </b><?php echo $row['serial_number'] ?><br>
					<b>Date Purchased : </b><?php echo $row['date_purchased'] ?><br>
					<b class="badge bg-warning"><?php echo $row['license_type'] ?></b>
				</td>
				<td><?php echo $row['expiration_date'] ?></td>
				<td><?php echo get_column2("name", "select * from m_asset_category where id = '".$row['asset_cat_id']."'",$db) ?></td>
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
							<button class="btn-pill btn btn-warning" onclick="get_edit('<?php echo $row['id'] ?>','<?php echo $row['code'] ?>','<?php echo $row['software_name'] ?>','<?php echo $row['serial_number'] ?>','<?php echo $row['date_purchased'] ?>','<?php echo $row['license_type'] ?>','<?php echo $row['asset_cat_id'] ?>')" data-bs-toggle="modal" data-bs-target="#mdl_update"><i class="ti ti-edit"></i></button>
							<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['id'] ?>','<?php echo $row['software_name'] ?>','deletesoftware','../listviews/v_software_assets','display_list',1)"><i class="ti ti-trash"></i></button>
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
function get_edit(id,a,b,c,d,e,f){
	$('#eid').val(id);
	$('#code').val(a);
	$('#name').val(b);
	$('#serial_number').val(c);
	$('#date_purchased').val(d);
	$('#ltype').val(e);
	$('#assetcat').val(f);
}
function get_delete(id){
	$('#did').val(id);
}
function get_deleterole(id){
	$('#ddid').val(id);
}
function get_id(id){
	$('#txttypeid').val(id);
	listrecord('../listviews/v_curriculum','display_facilities',id);
}
</script>