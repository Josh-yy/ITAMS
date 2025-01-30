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
	$sql = "select * from m_subjects ";
	$number_of_result = get_exist2($sql,$db);
	$number_of_page = ceil ($number_of_result / $results_per_page); 
	$final_sql = "";
		if(isset($_REQUEST['search'])){
			if($_REQUEST['search']!==""){
				$final_sql = "select * from m_subjects a where a.subject_name LIKE '%".$_REQUEST['search']."%' OR a.description LIKE '%".$_REQUEST['search']."%' OR a.subject_code LIKE '%".$_REQUEST['search']."%'";
		}
		else{
				$final_sql = "select * from m_subjects LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
		}else{
				$final_sql = "select * from m_subjects LIMIT " . $page_first_result . ',' . $results_per_page; 
			}
				
	$data = $db->query($final_sql)->fetchAll();

?>
<div class="card">
	<div class="card-header">
		<div class="input-group " >
	 	<?php
	 		if($page>1){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_subjects','display_list','<?php echo ($page-(1)) ?>' + '&search=' )"><i class="ti ti-arrow-left"></i> Prev</button>
	 		<?php
	 		}
	 	?>
		<button class="btn btn-light-secondary">Showing Page <?php echo $page ?> of <?php echo $number_of_page ?></button>
	  	<?php
	 		if($number_of_page>$page){
	 		?>
	 		<button class="btn btn-secondary" onclick="listrecord('listviews/v_subjects','display_list','<?php echo ($page + 1) ?>' + '&search=' )">Next <i class="ti ti-arrow-right"></i></button>
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
			
					<th>Units</th>
					<th style="width:10%">Included in GWA Computation</th>	
					<th>Subject Group</th>
					<th>Task</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($data as $row) {
					$class="";
					if($row['subject_group']==1){
						$class="bg-light-warning";
					}
					if($row['subject_group']==2){
						$class="bg-light-primary";
					}
					if($row['subject_group']==3){
						$class="bg-light-success";
					}
					if($row['subject_group']==4){
						$class="bg-light-secondary";
					}
			?>
				<tr>
				 <td><?php echo $i ?></td>
				<td><?php echo $row['subject_code'] ?></td>
				<td><b><?php echo $row['subject_name'] ?></b>
					<br><?php echo $row['description'] ?></td>
				<td><?php echo $row['units'] ?></td>
				<td>
					<input class="form-check-input" name="is_computed" type="checkbox" value="1" id="flexCheckChecked"  disabled <?php echo ($row['is_computed']==1) ? 'checked' : 0 ?>>  
				</td>

				<td><span class="badge <?php echo $class ?> rounded-pill f-14" ><?php echo get_column2("category_name","select * from m_subject_category where id = '".$row['subject_group'] ."'",$db) ?></span></td>
				<td>
					<div role="group" class="btn-group-sm btn-group btn-group-toggle">
						
							<button class="btn-pill btn btn-warning" onclick="get_edit('<?php echo $row['id'] ?>','<?php echo $row['subject_code'] ?>','<?php echo $row['subject_name'] ?>','<?php echo $row['description'] ?>','<?php echo $row['subject_group'] ?>','<?php echo $row['units'] ?>','<?php echo $row['is_computed'] ?>')" data-bs-toggle="modal" data-bs-target="#mdl_update"><i class="ti ti-edit"></i></button>
							<button  class="btn btn-danger btn-sm" id="btn_delete_user" onclick="delete_record('<?php echo $row['id'] ?>','<?php echo $row['subject_code'] ?>','deletesubject','../listviews/v_subjects','display_list',1)"><i class="ti ti-trash"></i></button>
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
	$('#description').val(c);
	$('#subject_group').val(d);
	$('#units').val(e);
	if(f==1){
		$('#is_computed').attr("checked",true);
	}else{
		$('#is_computed').attr("checked",false);
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
	listrecord('../listviews/d_facilities','display_facilities',id);
}
</script>