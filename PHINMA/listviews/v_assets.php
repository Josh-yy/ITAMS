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
	$sql = "select * from m_asset_category ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select * from m_asset_category a where a.code LIKE '%".$_REQUEST['search']."%' OR a.name LIKE '%".$_REQUEST['search']."%' OR a.description LIKE '%".$_REQUEST['search']."%'";
		}
		else{
				$final_sql = "select * from m_asset_category LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select * from m_asset_category LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_assets','display_list','<?php echo ($page-(1))  + '&search=' ?>')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_assets','display_list','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
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
					<th>Code</th>
					<th>Name</th>
					<th>Description</th>
					<th>Has Properties</th>
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
				
			?>
				<tr>
				 <td><?php echo $i ?></td>
				<td><?php echo $row['code'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo $row['description'] ?></td>
				<td>

					<?php
					if($row['with_properties']==1){
						echo "";
					?>
						<div class="btn-group">
							<a href="manage_properties?cid=<?php echo $row['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="ti ti-plus"></i> Manage Properties</a>
							<button type="button" class="btn btn-secondary btn-sm"><?php echo get_exist2("select * from t_asset_cat_property where cat_id = '".$row['id']."'",$db) ?></button>
							
						</div>
						
					<?php
					}
					else{
						echo "<span class='badge bg-danger'>without properties</span>";
					?>
					
					<?php
					}
					?>
				</td>
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
							<button class="btn-pill btn btn-warning" onclick="get_edit('<?php echo $row['id'] ?>','<?php echo $row['code'] ?>','<?php echo $row['name'] ?>','<?php echo $row['description'] ?>','<?php echo $row['with_properties'] ?>')" data-bs-toggle="modal" data-bs-target="#mdl_update"><i class="ti ti-edit"></i></button>
							<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['id'] ?>','<?php echo $row['name'] ?>','deleteassetcat','../listviews/v_assets','display_list',1)"><i class="ti ti-trash"></i></button>
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
function get_edit(id,a,b,c,d){
	$('#eid').val(id);
	$('#code').val(a);
	$('#name').val(b);
	$('#description').val(c);
	if(d==1){
		
		$("#has_properties").prop("checked", true);
	}else{
		$("#has_properties").prop("checked", false);
	}
	
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