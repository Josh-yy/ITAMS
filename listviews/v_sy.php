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
	$sql = "select * from m_sy ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select * from m_sy a where a.code LIKE '%".$_REQUEST['search']."%' OR a.sy LIKE '%".$_REQUEST['search']."%'";
		}
		else{
				$final_sql = "select * from m_sy LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select * from m_sy LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_sy','display_list','<?php echo ($page-(1))  + '&search=' ?>')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_sy','display_list','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
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
					<th>School Year</th>
					<th>Active</th>
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
					$class="";
			?>
				<tr>
				 <td><?php echo $i ?></td>
				<td><?php echo $row['code'] ?></td>
				<td><?php echo $row['sy'] ?></td>
				<td>
					<?php
						if($row['is_active']=="1"){
							echo "<span class='badge bg-success'>Active</span>";
						}else{
						?>
						<span class="text-muted" role="button" onclick="activate_record('<?php echo $row['sy_id'] ?>','<?php echo $row['sy'] ?>','activatesy','../listviews/v_sy','display_list',1)">Activate</span>
						<?php
						}
					?>
				</td>
				
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
					
							<button class="btn-pill btn btn-warning" onclick="get_edit('<?php echo $row['sy_id'] ?>','<?php echo $row['code'] ?>','<?php echo $row['sy'] ?>','<?php echo $row['sy_id'] ?>')" data-bs-toggle="modal" data-bs-target="#mdl_update"><i class="ti ti-edit"></i></button>
							<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['sy_id'] ?>','<?php echo $row['sy'] ?>','deletesy','../listviews/v_sy','display_list',1)"><i class="ti ti-trash"></i></button>
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
function get_edit(id,a,b,c){
	$('#eid').val(id);
	$('#code').val(a);
	$('#name').val(b);
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