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
	$sql = ""; 
	if(isset($_REQUEST['year_level'])){
		$sql = "select * from v_curr_subjects WHERE curr_id = '".$_REQUEST['curr_id']."' and year_level_id = '".$_REQUEST['year_level']."' ORDER BY year_level_id,sem_id";
	}elseif(isset($_REQUEST['year_level']) && isset($_REQUEST['semester'])){
		$sql = "select * from v_curr_subjects WHERE curr_id = '".$_REQUEST['curr_id']."'  and year_level_id = '".$_REQUEST['year_level']."'  and sem_id = '".$_REQUEST['sem_id']."' ORDER BY year_level_id,sem_id";
	}
		else{
			$sql = "select * from v_curr_subjects WHERE curr_id = '".$_REQUEST['curr_id']."'   ORDER BY year_level_id,sem_id";
	}


	

	//echo $sql;
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select * from v_curr_subjects a where curr_id = '".$_REQUEST['curr_id']."' and a.subject_name LIKE '%".$_REQUEST['search']."%' OR a.description LIKE '%".$_REQUEST['search']."%' OR a.category_name LIKE '%".$_REQUEST['search']."%'";
		}
		else{
			if(isset($_REQUEST['year_level']) ){
				if(($_REQUEST['semester']!=="" && $_REQUEST['year_level']!=="")){
				$final_sql = "select * from v_curr_subjects WHERE curr_id = '".$_REQUEST['curr_id']."' and year_level_id = '".$_REQUEST['year_level']."' and sem_id = '".$_REQUEST['semester']."'  LIMIT " . $page_first_result . ',' . $results_per_page;
				}
				else{
					$final_sql = "select * from v_curr_subjects WHERE curr_id = '".$_REQUEST['curr_id']."' and year_level_id = '".$_REQUEST['year_level']."' LIMIT " . $page_first_result . ',' . $results_per_page;
				}
			}
			else{
				$final_sql = "select * from v_curr_subjects WHERE curr_id = '".$_REQUEST['curr_id']."'    LIMIT " . $page_first_result . ',' . $results_per_page;
			}
			}
		}else{

					$final_sql = "select * from v_curr_subjects WHERE curr_id = '".$_REQUEST['curr_id']."'    LIMIT " . $page_first_result . ',' . $results_per_page;
			}
					
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_curriculum_subjects','dusplay_curr_subjects','<?php echo ($page-1) ?>' + '&search=' +'&curr_id=' + <?php echo $_REQUEST['curr_id'] ?>)"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_curriculum_subjects','dusplay_curr_subjects','<?php echo ($page+1) ?>' + '&search=' +'&curr_id=' + <?php echo $_REQUEST['curr_id'] ?>)">Next <i class="ti ti-arrow-right"></i></button>
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
					<th>Subject</th>
					<th>Units</th>
					<th>Subject Group</th>
					<th>Year Level | Semester</th>
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
				<td><?php echo $row['subject_code'] ?></td>
				<td><b><?php echo $row['subject_name'] ?></b>
					<br>
					<?php echo $row['description'] ?>
					
				</td>
				<td><b class="btn btn-secondary text-white btn-sm"><?php echo $row['units'] ?></b></td>
				<td><b><?php echo $row['category_name'] ?></b></td>
				
				<td><?php echo $row['year_level'] . " | " . $row['semester']  ?></td>
				
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
						
						
							<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['id'] ?>','<?php echo $row['subject_code'] ?>','deletecurrsubject','../listviews/v_curriculum_subjects','dusplay_curr_subjects',1 + '&curr_id=' + <?php echo $_REQUEST['curr_id'] ?>)"><i class="ti ti-trash"></i></button>
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
	$('#description').val(c);
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