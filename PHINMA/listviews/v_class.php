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
	$sql = "select * from m_class_info ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select * from m_class_info a where a.code LIKE '%".$_REQUEST['search']."%' OR a.name LIKE '%".$_REQUEST['search']."%'";
		}
		else{
				$final_sql = "select * from m_class_info LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select * from m_class_info LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_classes','display_list','<?php echo ($page-(1))  + '&search=' ?>')"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_classes','display_list','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
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
					<th>Year</th>
					<th>Number of Students</th>
					<th>Adviser</th>
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
				<td><?php echo $row['class_name'] ?></td>
				<td><?php echo get_column2("sy","select * from m_sy where sy_id = '".$row['sy_id']."'",$db) ?></td>
				<td><?php echo get_column2("counter","select count(*) as counter from t_class_students where class_id = '".$row['id']."'",$db) ?></td>
				<td><?php echo get_column2("ename","select concat(fn, ' ', mn, ' ', ln) as ename from m_users where id = '".$row['adviser_id']."'",$db) ?></td>
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
						<a href="manage_section?class_id=<?php echo $row['id'] ?>" class="btn btn-primary"><i class="ti ti-folders"></i> Manage Class</a>
							
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
	$('#sy').val(c);
	$('#adviser_id').val(d);
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